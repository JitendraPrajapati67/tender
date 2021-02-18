<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TenderInvitationMail;
use App\Models\Tender;
use App\Models\TenderInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TenderInvitationController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $tender = Tender::orderBy('id', 'DESC')->get();
        return view('admin.tenderInvitation.index', compact('tender'));
    }

    public function users(Request $request)
    {
        $user_id = Auth::user()->id;
        $tenderIds = $request->tender_ids;
        $users = User::where("status",1)->whereHas("roles", function($q){ $q->where("title", "Bidder"); })->select(sprintf('%s.*', (new User)->table))->orderBy('id', 'DESC')->get();
        return view('admin.tenderInvitation.user', compact('users','tenderIds'));
    }

    public function sendTenderInvitation(Request $request)
    {
        $user_id = Auth::user()->id;
        $tenderIds = explode(",", $request->tender_ids);
        $userIds = explode(",",$request->user_ids);
        $tenders = Tender::whereIn("id",$tenderIds)->orderBy('id', 'DESC')->get();
        foreach ($tenders as $tender){
            $users = User::select("id","name","email","mobile","supplier_name","company_reg_number","company_contact_person")->whereIn("id",$userIds)->orderBy('id', 'DESC')->get();
            foreach ($users as $user){
                //create invitation
                TenderInvitation::create(['tender_id'=>$tender->id,'user_id'=>$user->id]);
                $data['tender'] = $tender;
                $data['user'] = $user;

                //send email
                $response = Mail::to($user->email)->send(new TenderInvitationMail($data));
                Log::info("email response:",[$response]);
                //send sms
                $message = "Hello, $user->supplier_name Click below to tender details ".route('admin.tender.show',$data['tender']['id']);
                $response= $this->sendSMS($user->mobile, $message);
                Log::info("sms response:",[$response->body()]);
//                echo "<pre>";print_r($response->status());
//                echo "<pre>";print_r($response->body());exit();
            }
        }

        return redirect()->route('admin.tender.invitation')->withSuccess('Tender sent to the users successfully.');
    }


    public function sendSMS($num,$message){
        $code = "+91";

        // Authorisation details.
        $username = "info@swastiinfotech.com";
        $apikey = "a42c8187-39cc-4e6c-b6f8-cc6f4f070b36";

        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $senderName = "RSREST"; // This is who the message appears to be from.
        $numbers = $code . $num; // A single number or a comma-separated list of numbers

        $response = Http::get('http://sms.admarksolution.com/sendSMS', [
            'username' => $username,
            'message' => $message,
            'sendername' => $senderName,
            'smstype' => 'DNDPROMO', //'PROMO', 'TRANS',
            'numbers' => $numbers,
            'apikey' => $apikey,
        ]);
//        echo $response;exit();
        return $response;

    }
}

