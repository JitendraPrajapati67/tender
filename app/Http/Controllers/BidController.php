<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTenderRequest;
use App\Http\Requests\StoreTenderRequest;
use App\Http\Requests\UpdateTenderRequest;
use App\Http\Requests\UpdateBidManagerRequest;
use App\Http\Requests\StoreBidManagerRequest;

use Illuminate\Http\Request;

use App\Models\Tender;
use App\Models\TenderMapMaterials;
// use App\Models\TenderCategory;
use App\Models\TenderMapDocument;
use App\Models\BidManager;
use Gate;
use App\Models\Material;
use App\Models\TenderCategory;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Http\Controllers\Route;
class BidController extends Controller
{
    public function index(){
       $user_id = Auth::user()->id;
       if($user_id==1){
            $bids=Tender::select('tender.tender_title',
                         'tender.close_date',
                         'bid.created_at',
                         'bid.id',
                         'tender_categories.category_name',
                         'tender.status')
                    ->join('bid','tender.id', '=', 'bid.tender_id')
                    ->join('tender_categories','tender.category_id', '=', 'tender_categories.id')
                    ->get();
            return view('bid.list', compact('bids'));
       }else{
        $bids = Tender::select('tender.tender_title',
                         'tender.close_date',
                         'bid.created_at',
                         'bid.id',
                         'bid.created_at',
                         'bid.id',
                         'bid.tender_id',
                         'bid.bidder_id',
                         'bid.price',
                         'bid.discription',
                         'bid.updated_at')
                    ->join('bid','tender.id', '=', 'bid.tender_id')
                    ->where('bid.bidder_id','=',$user_id)
                    ->get();
        return view('bid.index', compact('bids')); 
       }
    }
    public function getDownload(Request $request){
         $file_path = public_path('files/'.$request->name);
       return response()->download($file_path);

        // $file = public_path()."/downloads/".$request->name;
        // $headers = array('Content-Type: application/doc',);
        // return Response::download($file, $request->name ,$headers);
    }
    public function create(Request $request){
        $tenderMapDocument = TenderMapDocument::where('tender_id','=',$request->var1)
                                               ->where('document_type','=',1)
                                               ->get();
        $tender = Tender::where('id','=',$request->var1)->first();

        return view('bid.create',compact('tender','tenderMapDocument'));
    }
    public function destroyDocument(Request $request)
    {
        TenderMapDocument::where('id','=',$request->id)->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function store(StoreBidManagerRequest $request){
        request()->validate(['tender_id'=> 'required',
                             'price'=> 'required',
                             'discription'=> 'required',
                             'document' => 'required',
                             'document.*' => 'mimes:doc,pdf,docx,txt,xml'
                             ]);
        $user_id = Auth::user()->id;

        if (BidManager::where('tender_id', $request->tender_id)->where('bidder_id', $user_id)->first()) 
        {
            return redirect()->route('bid.index')->withErrors('Bid was already added');
        }else
        {
            $bid = new BidManager();
            $bid->tender_id   = $request->tender_id;
            $bid->bidder_id   = Auth::user()->id;
            $bid->price       = $request->price;
            $bid->discription = $request->discription;
            $bid->save();
            $bid_id = $bid->id;
            
            if($request->hasfile('document'))
            {
                foreach($request->file('document') as $file)
                {
                    $filename  = $file->getClientOriginalName();
                    $extension = $file->extension();
                    $uniquesavename = time().uniqid(rand()).'.'.$extension;
                    $file->move(public_path().'/files/', $uniquesavename);  
                    
                    TenderMapDocument::insert([
                    'tender_id' => $request->tender_id,
                    'bidder_id' =>$bid_id,
                    'document' => $uniquesavename,
                    'document_orignal_name'=>$filename,
                    'document_type'=>0,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                    ]);
                }
                return redirect()->route('bid.index')->withSuccess('The Bid add was saved successfully');
            }
 
        }
        
    }
    public function edit(BidManager $Bid){   
        
        $tenderdocument = TenderMapDocument::where('tender_id','=',$Bid->tender_id)->where('document_type','=',0)->where('bidder_id','=',$Bid->id)->get();
        $tender = Tender::where('id','=',$Bid->tender_id)->first();
        $tenderMapDocument = TenderMapDocument::where('tender_id','=',$Bid->tender_id)->where('document_type','=',1)->orderBy('id', 'DESC')->get();

        $materials=TenderMapMaterials::select('materials.category_name')
                    ->join('materials','materials.id', '=', 'tender_map_materials.tender_materials_id')
                    ->where('tender_map_materials.tender_id','=',$Bid->tender_id)
                    ->get();
                
        return view('bid.edit', compact('Bid','tenderdocument','tenderMapDocument','materials','tender'));
    }
    public function update(UpdateBidManagerRequest $request, BidManager $bidManager){
        
        BidManager::where('id', $request->id)
                ->update(['price' =>$request->price,
                'discription'=>$request->discription,
                'tender_id'=>$request->tender_id,
                'bidder_id'=> $request->bidder_id]);

        if($request->hasfile('document')){
            foreach($request->file('document') as $file){
                $filename  = $file->getClientOriginalName();
                $extension = $file->extension();
                $uniquesavename = time().uniqid(rand()).'.'.$extension;
                $file->move(public_path().'/files/', $uniquesavename);  

                TenderMapDocument::insert([
                'tender_id' => $request->tender_id,
                'bidder_id' =>$request->bid_id,
                'document' => $uniquesavename,
                'document_orignal_name'=>$filename,
                'document_type'=>0,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }
        return redirect()->route('bid.index')->withSuccess('The Bid was updated successfully');
    }
    public function show(BidManager $bid)
    {
        $tenderMapDocument = TenderMapDocument::where('tender_id','=',$bid->tender_id)->where('document_type','=',0)->where('bidder_id','=',$bid->id)->get();
        $tender = Tender::where('id','=',$bid->tender_id)->first();

        return view('bid.show', compact('bid','tenderMapDocument','tender'));
    }
}
