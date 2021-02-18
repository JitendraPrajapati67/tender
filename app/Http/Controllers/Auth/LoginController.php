<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.otp.login');
    }

    public function login(Request $request)
    {
        try {
            $validator = $request->validate([
                'mobile' => ['required', 'digits:10'],
            ]);

            $user = User::where('mobile', $request->mobile)->first();
            if (empty($user)) {
                return back()->withError("Mobile number not found in system.");
            }
            $otp = User::generateOTP();

            /* Local testing purpose */
            if (App::environment('local')) {
                $otp = "1111";
            } else {
                //send email
                $this->sendSMS($request->mobile, "Your login otp is $otp");
            }
            $user->otp = $otp;
            $user->otp_time = date('Y-m-d H:i');
            $user->save();
            return redirect()->route('auth.otp', $user->mobile)->withSuccess("OTP send your mobile number $request->mobile");

        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function sendSMS($num, $message)
    {
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

    public function otp($number)
    {
        $user = User::where('mobile', $number)->first();
        if (empty($user)) {
            return redirect()->back()->withError("Mobile number not found in system.");
        }

//        if($user->otp == null){
//            return redirect()->back()->withError("This mobile number otp not found.");
//        }
        return view('auth.otp.otp', compact('user'));
    }

    public function resendOTP($number)
    {

        $user = User::where('mobile', $number)->first();
        if (empty($user)) {
            return redirect()->back()->withError("Mobile number not found in system.");
        }
        $otp = User::generateOTP();

        /* Local testing purpose */
        if (App::environment('local')) {
            $otp = "1111";
        } else {
            //send email
            $this->sendSMS($user->mobile, "Your login otp is $otp");
        }
        $user->otp = $otp;
        $user->otp_time = date('Y-m-d H:i');
        $user->save();
        return redirect()->route('auth.otp', $user->mobile)->withSuccess("OTP send your mobile number $user->mobile");
    }

    public function otpVerification(Request $request)
    {

        $validator = $request->validate([
            'mobile' => 'required|digits:10',
            'otp' => 'required|numeric|digits:4'
        ]);
        try {
            $user = User::where('mobile', $request->mobile)->first();
            if (empty($user)) {
                return redirect()->back()->withError("Mobile number not found in system.");
            }
            if ($user->otp != $request->otp) {
                return redirect()->back()->withError("OTP is invalid OR Either otp is expired. please resend otp and try again.");
            }
            $user->otp = null;
            $user->otp_time = null;
            $user->save();
            Auth::loginUsingId($user->id);
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
