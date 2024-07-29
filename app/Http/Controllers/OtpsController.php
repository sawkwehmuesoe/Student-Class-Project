<?php

namespace App\Http\Controllers;

use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpsController extends Controller
{

    protected $otpservice;

    public function __construct(OtpService $otpservice){
        $this->otpservice = $otpservice;
    }

    public function generate(){

        $userid = Auth::id();
        $getotp = $this->otpservice->generateotp($userid);

        return response()->json(['message'=>"OTP generated successfully",'otp'=>$getotp]);

    }

    public function verify(Request $request){

        $userid = $request->input('user_id');
        $otp = $request->input('otpcode');
        $isvalideotp = $this->otpservice->verifyotp($userid,$otp);

        if($isvalideotp){
            return response()->json(['message'=>'OTP is valid']);
        }else{
            return response()->json(['message'=>"OTP is Invalid"],400);
        }

    }
}
