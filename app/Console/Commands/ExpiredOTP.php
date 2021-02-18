<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Log;

class ExpiredOTP extends Command
{
    protected $signature = 'otp:expire';
    protected $description = 'OTP send time after decided time duration expired.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $this->info('================== Job start ==================');
            Log::info("================== otp:expire Job start ==================");
            $toDay = date('Y-m-d H:i:s');
            //send OTP date time is less then or equal to current time
            $users = User::whereNotNull("otp")->whereNotNull("otp_time")->get();

            if (!empty($users) && count($users) > 0) {

                foreach ($users as $user) {
                    $this->info('--------------------------------');
                    $this->info('user id: ' . $user->id);
                    $otpDateTime = date("Y-m-d H:i:s",strtotime('+1 minutes',strtotime($user->otp_time)));
                    if($otpDateTime <= $toDay) {
                        $user->otp = null;
                        $user->otp_time = null;
                        $user->save();

                        $this->info('OTP Status: Expired');
                        Log::info("OTP Status:",["Expired","user"=>$user]);
                        $this->info('--------------------------------');
                    }else{

                        $this->info('OTP Status: Active');
                        $this->info('--------------------------------');
                        Log::info("OTP Status:",["Active","user"=>$user]);
                    }


                }
            } else {
                $this->info('no any OTP expired Yet.');
            }
            $this->info('================== Job end ==================');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage() . "Cause".$e->getTraceAsString());
        }
    }
}
