<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function verify($token){
        $user= User::where('remember_token',$token)->first();
        if(!$user){
            return response()->json(["error"=>"invalid credentials"]);
        }
        $user->remember_token= null;
        $user->email_verified_at= Carbon::now();
        $user->save();
        return response()->json(["msg"=>"email verified"]);
    }


    public function sendMail(Request $request){
        $user= User::where('email',$request->email)->first();
        if(!$user){
            return response()->json(["error"=>"invalid email"]);
        }

        $verifyToken= str::random(40);

        $user->remember_token= $verifyToken;
        $user->save();

        Mail::to($user->email)->send(new ResetPassword($user));
      
        return response()->json([
            'response'=> 'reset link sent to email',
        ]);

    }

    public function reset($token){
        $user= User::where('remember_token',$token)->first();
        if(!$user){
            return response()->json(["error"=>"invalid credentials"]);
        }
        return response()->json(["token"=>$token]);
    }

    public function changePassword(Request $request){
        $user= User::where('remember_token',$request->remember_token)->first();
        if(!$user){
            return response()->json(["error"=>"Inavalid Credentials"]);
        }
        if($user->email==$request->email){
            // check password and reentered password match or not
            $user->password= Hash::make($request->password);
            $user->remember_token= null;
            $user->save();
            return response()->json(["success"=>"password changed"]);
        }
        
        return response()->json(['error'=>"Email doesn't match"]);
    }
}
