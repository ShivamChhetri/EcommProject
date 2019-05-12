<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserCartController extends Controller
{
    public function addCart(Request $request){
        $this->validate($request,[
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        $user=auth()->user();
        if(!$user){
            return response()->json(["error"=>"Unauthorized User"]);
        }

        $userCart= DB::select("SELECT * FROM user_cart
                              WHERE user_id=$user->id");

        if($userCart){
            for($i=0;$i<count($userCart);$i++){
                if($userCart[$i]->product_id==$request->product_id){
                    DB::update("UPDATE user_cart
                        SET quantity=?
                        WHERE user_id=? AND product_id=?",
                        [($userCart[$i]->quantity+$request->quantity),$user->id,$userCart[$i]->product_id]);
                    return response()->json(["response"=>"product quantity incremented"]);
                }
            }
        }
        
        // // $user_id= DB::select("SELECT id FROM users 
        // //                       WHERE token=$request->user_id");

        DB::insert("INSERT INTO user_cart 
                    (user_id,product_id,quantity) 
                    values (?,?,?)", [$user->id,$request->product_id,$request->quantity]);

        return response()->json(["response"=>"product added to cart"]);
    }

    public function getCart(){
        $user= auth()->user();
        if(!$user){
            return response()->json(["error"=>"Unknown User"]);
        }
        $userCart= DB::select("SELECT * FROM user_cart
                              WHERE user_id=$user->id");
        return $userCart;
    }


    public function updateCart(Request $request){

        $this->validate($request,[
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        $user=auth()->user();
        if(!$user){
            return response()->json(["error"=>"Unknown User"]);
        }
        $userCart= DB::select("SELECT * FROM user_cart
                               WHERE user_id=$user->id AND product_id=$request->product_id");

        if(!$userCart){
            return response()->json(["response"=>"product not in cart"]);
        }

        DB::update("UPDATE user_cart
                    SET quantity=?
                    WHERE user_id=? AND product_id=?",
                    [$request->quantity,$user->id,$request->product_id]);

        return response()->json(["response"=>"data updated"]);
    }


    public function deleteCart(Request $request){

        $this->validate($request,[
            'product_id' => 'required'
        ]);
        
        $user=auth()->user();
        if(!$user){
            return response()->json(["error"=>"Unknown User"]);
        }

        $del=DB::delete("DELETE from user_cart
                    WHERE user_id=$user->id AND product_id=$request->product_id");
        if($del==0){
            return response()->json(["error"=>"data not present"]);
        }
        return response()->json(["response"=>"product removed from cart"]);
    }
}
