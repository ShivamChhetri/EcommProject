<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductPic;
use DB;

class ProductApiController extends Controller
{
    public function index(){
        $products=  DB::select('SELECT * 
                    FROM products
                    INNER JOIN product_pics
                    ON products.id = product_pics.product_id'
                    );
        return $products;
    }


    public function show($id){
        $product=   DB::select("SELECT * 
                    FROM products
                    INNER JOIN product_pics
                    ON products.id = product_pics.product_id
                    WHERE products.id=$id
                    limit 1"
                    );
        
        if($product){
            return $product;
        }
        return response()->json("no product found");
    }


    // SORTING
    public function priceSort($bool){
        // $bool(0 acsending, 1 Descending)
        if(!$bool){
            $products = DB::select('SELECT * 
                        FROM products
                        INNER JOIN product_pics
                        ON products.id = product_pics.product_id
                        ORDER BY products.price ASC'
                        );
        }else{
            $products = DB::select('SELECT * 
                        FROM products
                        INNER JOIN product_pics
                        ON products.id = product_pics.product_id
                        ORDER BY products.price DESC'
                        );
        }
        if($products){
            return $products;
        }
        return response()->json("no product found");
    }


    public function timeSort($bool){
        // $bool(0 acsending, 1 Descending)
        if(!$bool){
            $products = DB::select('SELECT *
                        FROM products
                        INNER JOIN product_pics
                        ON products.id = product_pics.product_id
                        ORDER BY products.created_at ASC'
                        );
        }else{
            $products = DB::select('SELECT *
                        FROM products
                        INNER JOIN product_pics
                        ON products.id = product_pics.product_id
                        ORDER BY products.created_at DESC'
                        );
        }
        if($products){
            return $products;
        }
        return response()->json("no product found");        
    }

    public function discountSort($percent){
        $product=   DB::select("SELECT * 
                    FROM products
                    INNER JOIN product_pics
                    ON products.id = product_pics.product_id
                    WHERE products.discount_percent>$percent"
                    );
        if($product){
            return $product;
        }
        return response()->json("no product found");
    }
}
