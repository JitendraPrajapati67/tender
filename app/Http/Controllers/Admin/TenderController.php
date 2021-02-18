<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTenderRequest;
use App\Http\Requests\StoreTenderRequest;
use App\Http\Requests\UpdateTenderRequest;
use App\Models\Tender;
use App\Models\Material;
use App\Models\TenderCategory;
use App\Models\TenderMapDocument;
use App\Models\TenderMapMaterials;
use App\Models\BidManager;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use DB;

class TenderController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        if($user_id==1){
            $tender = Tender::orderBy('id', 'DESC')->get();
            return view('admin.tenderManagers.index', compact('tender'));
        }else{
            $tender = Tender::where('type',0)->orderBy('id', 'DESC')->get();
            $tender2 = Tender::select('tender.*','tender_invitations.tender_id', 'tender_invitations.user_id')->join("tender_invitations","tender_invitations.tender_id","=","tender.id")->where("tender_invitations.user_id",$user_id)->where('type',1)->groupBy('tender_invitations.tender_id', 'tender_invitations.user_id')->get();
            $tender = $tender->merge($tender2);
            $bids = BidManager::where('bidder_id','=',$user_id)->pluck('id','tender_id');
            $bids = $bids->toArray();
            return view('bid.list_tender', compact('tender','bids'));
        }
    }

    public function create()
    {
        $parentCategory = TenderCategory::where('parent_id','=',null)->orderBy('id', 'DESC')->get()->toArray();
        $category = TenderCategory::where('parent_id','!=',null)->orderBy('id', 'DESC')->get()->toArray();
        $material_array = [];
        foreach ($parentCategory as $key => $value) {
            $material_array[$key]= $value;
            foreach ($category as $key1 => $value1) {
                if($value['id'] == $value1['parent_id']){
                    $material_array[$key]['sub'][]= $value1;
                }
            }
        }
        $tenderCategoryarray = [];
        $tenderCategory = TenderCategory::orderBy('id', 'DESC')->get();

        return view('admin.tenderManagers.create',compact('material_array','tenderCategory'));
    }

    public function getDownload(){

       // $file = public_path()."/downloads/".$request->name;
        //$headers = array('Content-Type: application/doc',);
        //return Response::download($file, $request->name ,$headers);
    }
    public function test(){

       // $file = public_path()."/downloads/".$request->name;
        //$headers = array('Content-Type: application/doc',);
        //return Response::download($file, $request->name ,$headers);
    }
    public function store(Request $request)
    {
        request()->validate([
         'tender_reference_no' => 'required',
         'tender_title' => 'required',
         'tender_discription' => 'required',
         'open_date' => 'required',
         'category_id' => 'required',
         'close_date' => 'required',
         'status' => 'required',
         'type' => 'required',
         'document' => 'required',
         'document.*' => 'mimes:doc,pdf,docx,txt,xml'
        ]);

        DB::beginTransaction();
        $tender = new Tender();
        $tender->tender_reference_no=$request->tender_reference_no;
        $tender->tender_title =$request->tender_title;
        $tender->tender_discription =$request->tender_discription;
        $tender->category_id =$request->category_id;
        $tender->open_date =date('Y-m-d H:i');
        $tender->close_date = date('Y-m-d H:i');
        $tender->status=$request->status;
        $tender->type =$request->type;
        $tender->created_by=Auth::user()->id;
        $tender->created_at=date('Y-m-d H:i:s');
        $tender->updated_at=date('Y-m-d H:i:s');
        $tender->save();
        $tender_id =  $tender->id;
            // dd($request->category_id);
        // foreach($request->material as $key=>$val){
        //     TenderMapMaterials::insert([
        //     'tender_id'=>$tender_id,
        //     'tender_materials_id'=>$val,
        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s')
        //     ]);
        // }

        if($request->hasfile('document'))
        {
            foreach($request->file('document') as $file)
            {
                $filename  = $file->getClientOriginalName();
                $extension = $file->extension();
                $uniquesavename = time().uniqid(rand()).'.'.$extension;
                $file->move(public_path().'/files/', $uniquesavename);
                TenderMapDocument::insert([
                'tender_id' => $tender_id,
                'document' => $uniquesavename,
                'document_orignal_name'=>$filename,
                'document_type'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }
        DB::commit();
        return redirect()->route('admin.tender.index')->withSuccess('The Tender Was Save Successfully');

        // DB::rollback();
    }

    public function edit(Tender $tender)
    {
        $parentCategory = Material::where('parent','=',null)->orderBy('id', 'DESC')->get()->toArray();
        $category = Material::where('parent','!=',null)->orderBy('id', 'DESC')->get()->toArray();
        $material_array = [];
        foreach ($parentCategory as $key => $value) {
            foreach ($category as $key1 => $value1) {
                    if($value['id'] == $value1['parent']){
                    $material_array[$value['category_name']][] = $value1;
                }
            }
        }
        $tenderCategory = TenderCategory::all();
        $tenderdocument = TenderMapDocument::where('tender_id',$tender->id)->get();


        return view('admin.tenderManagers.edit', compact('tender','tenderCategory','tenderdocument','material_array'));
    }

    public function update(UpdateTenderRequest $request, Tender $tender)
    {
        Tender::where('id', $request->tender_id)
                ->update(['tender_reference_no' =>$request->tender_reference_no,
                'tender_title'=>$request->tender_title,
                'category_id' =>$request->category_id,
                'tender_discription' =>$request->tender_discription,
                'open_date'=>date('Y-m-d H:i:s',strtotime($request->open_date)),
                'close_date'=>date('Y-m-d H:i:s',strtotime($request->close_date)) ,
                'status'=>$request->status,
                'type'=>$request->type]);

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
                'document' => $uniquesavename,
                'document_orignal_name'=>$filename,
                'document_type'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }
        $tender->update($request->all());
        return redirect()->route('admin.tender.index')->withSuccess('The Tender Was Updated Successfully');
    }
    public function show(Tender $tender)
    {

        $tenderMapDocument = TenderMapDocument::where('tender_id','=',$tender->id)->where('document_type','=',1)->orderBy('id', 'DESC')->get();

        $bids = BidManager::where('tender_id','=',$tender->id)->orderBy('id', 'DESC')->get();
        $materials=TenderMapMaterials::select('materials.category_name')
                    ->join('materials','materials.id', '=', 'tender_map_materials.tender_materials_id')
                    ->where('tender_map_materials.tender_id','=',$tender->id)
                    ->get();
        return view('admin.tenderManagers.show', compact('tender','materials','bids','tenderMapDocument'));
    }
    public function destroyDocument(Request $request)
    {
        TenderMapDocument::where('id','=',$request->id)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function status(Request $request){

        if($request->status==0){
            $request->status=1;
        }else{
            $request->status=0;
        }

        Tender::where('id', $request->id)->update(['status' =>$request->status]);

        return redirect()->route('admin.tender.index')->withSuccess('The Tender status Updated Successfully');
    }

    public function destroy(Tender $tender)
    {
        $tender->delete();
        return back();
    }
    public function massDestroy(MassDestroyTenderRequest $request,Tender $tender)
    {

        Tender::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function sendTenderInvitation(Request $request)
    {

    }
}
