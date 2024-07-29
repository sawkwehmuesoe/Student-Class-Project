<?php

namespace App\Services;

use App\Models\Otp;
use Carbon\Carbon;

class OtpService{

    public function generateotp($userid){

        $randomotp = rand(100000,999999);
        $expiresat = Carbon::now()->addMinute(10);

        Otp::create([
            'user_id'=>$userid,
            'otp'=>$randomotp,
            'expires_at'=>$expiresat
        ]);

        // Send Otp via to email

        return $randomotp;

    }

    public function verifyotp($userid,$otp){

        $checkotp = Otp::where('user_id',$userid)
                ->where('otp',$otp)
                ->where('expires_at','>',\Carbon\Carbon::now());

        if($checkotp){
            // OTP Valid

            $checkotp->delete(); //Delete OTP after verification

            return true;
        }else{
             // OTP Invalid

            return false;
        }

    }

}



?>
