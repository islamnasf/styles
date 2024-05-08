<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthOtpController extends Controller
{
    public function otpGenerate(Request $Request)
    {
        $Request->validate([
            'phone' => 'required|exists:providers,phone'
        ]);
        $userOtp=$this->generateOTP($Request->phone);
        $userOtp->send($Request->phone);
        return response()->json([
            'status' => 200,
            'message' => 'Otp Has Been Sent On Your Phone!',
        ], 200);
    }

    public function generateOTP($phone){
        $provider =  Provider::where('phone',$phone)->first();
        $userOtp = UserOtp::where('provider_id',$provider->id)->latest()->first();
        $now = now();
        if($userOtp && $now->isBefore($userOtp->expire_at)){
                return $userOtp;
        }
        return UserOtp::create([
            'provider_id'=>$provider->id,
            'otp'=>rand(123456,999999),
            'expire_at'=>$now->addMinutes(10)
        ]);
    }


    public function loginWithOtp(Request $Request){
        $Request->validate([
            'otp'=>'required',
            'provider_id'=>'required|exists:providers,id'
        ]);
        $userOtp = UserOtp::where('provider_id',$Request->provider_id)->where('otp',$Request->otp)->first();
        // $now = now();
        if(!$userOtp){
            return response()->json([
                'status' => 400,
                'message' => 'otp not correct!',
            ], 400);

        }
        // elseif($userOtp && $now->isAfter($userOtp->epire_at))
        // {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'otp has been expired!',
        //     ], 400);
        // }
        $provider = Provider::whereId($Request->provider_id)->first();
        if($provider){
            $userOtp->update([
                'expire_at'=>now()
            ]);
            Auth::login($provider);

            $token = auth()->guard('api')->tokenById(auth()->id());
    
            return $this->createNewToken($token,$provider);
        }        
        return response()->json([
            'status' => 400,
            'message' => 'otp not correct!',
        ], 400);
    }
    protected function createNewToken($token ,$provider)
{
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->guard('api')->factory()->getTTl() * 600000,
        'user' => $provider,
    ]);
}
public function updatePassword(request $request){
    $provider = Provider::whereId($request->provider_id)->first();
    $provider->update([
        'password' => bcrypt($request->password)
    ]);
    return response()->json([
        'status' => 200,
        'message' => 'Your Password Update Successfully! ',
        'data' => $provider
    ], 200);
}
   
}
