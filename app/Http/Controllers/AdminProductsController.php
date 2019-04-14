<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\ProductPic;
use DB;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products= Product::all();
        $products= DB::select('SELECT * from products');
        return view("admin.allProducts")->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.createProduct");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'name' => 'required'
        ]);

        $product= new Product;
        $product->name= $request->input('name');
        $product->type= $request->input('type');
        $product->description= $request->input('description');
        $product->available_quantity= $request->input('available_quantity');
        $product->price= $request->input('price');
        $product->discount_percent= $request->input('discount_percent');
        $product->updated_by= $request->input('updated_by');
        $product->save();

        $productPic= new ProductPic;
        $product_id= Product::where('name',$product->name)->first();
        $productPic->product_id= $product_id->id;
        $productPic->save();
        return redirect('/products')->with('success',"product added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product= Product::find($id);
        $productPic= ProductPic::where('product_id',$id)->first();

        // if($productPic->image_1=="default.png"){
        //     // return $productPic;
        //     $productPic= array("default.png","default.png");
        // }
        
        return view('admin.showProduct')
                ->with('product',$product)
                ->with('productPic',$productPic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product= Product::find($id);
        return view("admin.editProduct")->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required'
    ]);

    $product= Product::find($id);
    $product->name= $request->input('name');
    $product->type= $request->input('type');
    $product->description= $request->input('description');
    $product->available_quantity= $request->input('available_quantity');
    $product->price= $request->input('price');
    $product->discount_percent= $request->input('discount_percent');
    $product->updated_by= $request->input('updated_by');
    $product->save();
    return redirect('/products')->with('success',"product updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product= Product::find($id);
        $productPic= ProductPic::where('product_id',$id)->get();
        $productPic=$productPic[0];
        
        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_1);
        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_2);
        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_3);
        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_4);
        Storage::deleteDirectory('public/Uploads/productPics/'.$productPic->product_id);
        
        $product->delete();
        $productPic->delete();
        return redirect('/products')->with('success',"product removed");
    }
}
