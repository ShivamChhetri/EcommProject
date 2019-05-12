<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserOrderController extends Controller
{
    public function addOrder(Request $request){
        $this->validate($request,[
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        $user=auth()->user();
        if(!$user){
            return response()->json(["error"=>"Unauthorized User"]);
        }
        
        shippingDetail($user->id,$request);

    }

    public function getOrder(){
        $user= auth()->user();
        if(!$user){
            return response()->json(["error"=>"Unknown User"]);
        }
        $userOrder= DB::select("SELECT * FROM user_order
                              WHERE user_id=$user->id");
        return $userOrder;
    }

    function shippingDetail($user_id,Request $request){
        $address= DB::select("SELECT * FROM user_address
                              WHERE user_id=$user_id");
        if(!$address){
            return response()->json(["error"=>"address not available"]);
        }
        
        $destination=$address->address_1.",".$address->address_2.",".$address->city.",".$address->state.",PIN-".$address->pincode;
        $order_table=DB::insert("INSERT INTO user_order 
                (user_id,product_id,quantity,status) 
                values (?,?,?,?)", [$user_id,$request->product_id,$request->quantity,0]);

        if($order_table){
            $order_id= DB::select("SELECT id FROM user_order
                                    WHERE user_id=$user_id
                                    AND product_id=$request->product_id");

            $shipment_table=DB::insert("INSERT INTO shipment
                                        (order_id,status,destination,courier,expected_delivery)
                                        VALUES (?,?,?,?,?)",[$order_id,0,$destination,"GATI","10_days"]);
            if($shipment_table){
                return response()->json(["response"=>"product added to order"]);
            }
        }
        return response()->json(["error"=>"product order failed"]);
      
    }
    


    // public function updateOrder(Request $request){

    //     $this->validate($request,[
    //         'product_id' => 'required',
    //         'quantity' => 'required'
    //     ]);

    //     $user=auth()->user();
    //     if(!$user){
    //         return response()->json(["error"=>"Unknown User"]);
    //     }
    //     $userOrder= DB::select("SELECT * FROM user_cart
    //                            WHERE user_id=$user->id AND product_id=$request->product_id");

    //     if(!$userOrder){
    //         return response()->json(["response"=>"product not ordered"]);
    //     }

    //     DB::update("UPDATE user_cart
    //                 SET quantity=?
    //                 WHERE user_id=? AND product_id=?",
    //                 [$request->quantity,$user->id,$request->product_id]);

    //     return response()->json(["response"=>"data updated"]);
    // }


    // public function cancelOrder(Request $request){

    //     $this->validate($request,[
    //         'product_id' => 'required'
    //     ]);
        
    //     $user=auth()->user();
    //     if(!$user){
    //         return response()->json(["error"=>"Unknown User"]);
    //     }

    //     $del=DB::delete("DELETE from user_order
    //                 WHERE user_id=$user->id AND product_id=$request->product_id");
    //     if($del==0){
    //         return response()->json(["error"=>"data not present"]);
    //     }
    //     return response()->json(["response"=>"product removed from order"]);
    // }
}
