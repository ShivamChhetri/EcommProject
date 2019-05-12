<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserAddressController extends Controller
{
    public function addAddress(Request $request){
        $user=auth()->user();
        if(!$user){
            return response()->json(["error"=>"Unknown User"]);
        }
        $userAdd= DB::select("SELECT id FROM user_address
                              WHERE user_id=$user->id");
        if($userAdd){
            return response()->json(["response"=>"already address stored"]);
        }
        // $header = $request->header('Authorization');
        // return $header;
        $this->validate($request,[
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required'
        ]);

        // // $user_id= DB::select("SELECT id FROM users 
        // //                       WHERE token=$request->user_id");

        DB::insert("INSERT INTO user_address 
                    (user_id, address_1,address_2,city,state,pincode) 
                    values (?,?,?,?,?,?)", [$user->id,$request->address_1,$request->address_2,$request->city,$request->state,$request->pincode]);

        return response()->json(["response"=>"data inserted"]);
    }

    public function getAddress(){
        $user= auth()->user();
        if(!$user){
            return response()->json(["error"=>"Unknown User"]);
        }
        $address= DB::select("SELECT * FROM user_address
                              WHERE user_id=$user->id
                              LIMIT 1");
        return $address;
    }


    public function updateAddress(Request $request){
        $user=auth()->user();
        if(!$user){
            return response()->json(["error"=>"Unknown User"]);
        }
        $userAdd= DB::select("SELECT id FROM user_address
                              WHERE user_id=$user->id");
        if(!$userAdd){
            return response()->json(["response"=>"no address table for user"]);
        }
        $this->validate($request,[
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required'
        ]);

        DB::update("UPDATE user_address
                    SET address_1=?,address_2=?,city=?,state=?,pincode=?
                    WHERE user_id=?",
                    [$request->address_1,$request->address_2,$request->city,$request->state,$request->pincode,$user->id]);

        return response()->json(["response"=>"data updated"]);
    }
}
