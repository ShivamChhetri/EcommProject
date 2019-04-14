<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\ProductPic;
// use Image;

class AdminProductPicsController extends Controller
{

    public function addPic($product_id)
    {
        return view("admin.addPic")->with('product_id',$product_id);
    }

    public function storePic(Request $request)
    {
        $this->validate($request,[
            'product_id'=>'required',
            'image_1'=>'image|nullable|max:1999',
            'image_2'=>'image|nullable|max:1999',
            'image_3'=>'image|nullable|max:1999',
            'image_4'=>'image|nullable|max:1999'     
        ]);

        if(!$request->hasFile('image_1')){
            return redirect('/productPics/add/'.$request->input('product_id'))
                    ->with('error',"Image 1 can't be null");
        }
        
        $count=0;
        $flag=1;
        for($i=1;$i<=4;$i++){
            if($request->hasFile('image_'.$i)){
                //for inserting only if one of the image is present
                if($flag){
                    $productPic= ProductPic::where('product_id',$request->input('product_id'))->first();
                    $flag=0; 
                    // $productPic= new ProductPic();
                    // $productPic->product_id= $request->input('product_id');
                    // $flag=0;
                }
                $image= $request->file('image_'.$i);
                $fileNameWithExtn= $image->getClientOriginalName();
                $fileName= pathinfo($fileNameWithExtn,PATHINFO_FILENAME);
                $extension= $image->getClientOriginalExtension();
                $fileNameStore= $fileName.'_'.time().'.'.$extension;
                // Image::make($profilepic)->resize(300,300)->save(public_path('Upload/productPics/'.$fileNameStore));
                $path= $image->storeAs('public/Uploads/productPics/'.$productPic->product_id,$fileNameStore);
                $count++;
                
                // if($request->hasFile('image_'.$i)){
                //     if($i==1){
                //         $productPic->image_1= $fileNameStore;
                //     }
                //     elseif($i==2){
                //         $productPic->image_2= $fileNameStore;
                //     }elseif($i==3){
                //         $productPic->image_3= $fileNameStore;
                //     }elseif($i==4){
                //         $productPic->image_4= $fileNameStore;
                //     }
                // }
                switch($i){
                    case 1: 
                        $productPic->image_1= $fileNameStore;
                        break;
                    case 2: 
                        $productPic->image_2= $fileNameStore;
                        break;
                    case 3: 
                        $productPic->image_3= $fileNameStore;
                        break;
                    case 4: 
                        $productPic->image_4= $fileNameStore;
                        break;
                }
            }
        }
        if($count){
            $productPic->save();
            return redirect('/products')->with('success',$count." Image Added");
        }else{
            return redirect('/products')->with('error',"Image not added");
        }
    }

    public function edit($id)
    {
        $productPic= ProductPic::find($id);
        return view('admin.editPic')
                ->with('id',$id)
                ->with('productPic',$productPic);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'image_1'=>'image|nullable|max:1999',
            'image_2'=>'image|nullable|max:1999',
            'image_3'=>'image|nullable|max:1999',
            'image_4'=>'image|nullable|max:1999'     
        ]);
        
        $count=0;
        $flag=1;
        for($i=1;$i<=4;$i++){
            if($request->hasFile('image_'.$i)){
                //for inserting only if one of the image is present
                if($flag){ 
                    $productPic= ProductPic::find($id);
                    $flag=0;
                }
                $image= $request->file('image_'.$i);
                $fileNameWithExtn= $image->getClientOriginalName();
                $fileName= pathinfo($fileNameWithExtn,PATHINFO_FILENAME);
                $extension= $image->getClientOriginalExtension();
                $fileNameStore= $fileName.'_'.time().'.'.$extension;
                // Image::make($profilepic)->resize(300,300)->save(public_path('Upload/productPics/'.$fileNameStore));
                $path= $image->storeAs('public/Uploads/productPics/'.$productPic->product_id,$fileNameStore);
                $count++;
                
                switch($i){
                    case 1:
                        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_1);
                        $productPic->image_1= $fileNameStore;
                        break;
                    case 2: 
                        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_2);
                        $productPic->image_2= $fileNameStore;
                        break;
                    case 3:
                        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_3); 
                        $productPic->image_3= $fileNameStore;
                        break;
                    case 4:
                        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_4); 
                        $productPic->image_4= $fileNameStore;
                        break;
                }
            }
        }
        if($count){
            $productPic->save();
            return redirect('/products')->with('success',$count." Image Updated");
        }else{
            return redirect('/products')->with('error',"Image Not Updated");
        }

        // if($request->hasFile('image_1')){
        //     $productPic= ProductPic::find($id);

        //     $image_1= $request->file('image_1');
        //     $fileNameWithExtn= $image_1->getClientOriginalName();
        //     $fileName= pathinfo($fileNameWithExtn,PATHINFO_FILENAME);
        //     $extension= $image_1->getClientOriginalExtension();
        //     $fileNameStore= $fileName.'_'.time().'.'.$extension;
        //     // Image::make($profilepic)->resize(300,300)->save(public_path('Upload/productPics/'.$fileNameStore));
        //     $path= $image_1->storeAs('public/Uploads/productPics',$fileNameStore);
        //     Storage::delete('public/Uploads/productPics/'.$productPic->image_1);
            
        //     $productPic->image_1= $fileNameStore;
        //     $productPic->image_2= $fileNameStore;
        //     $productPic->image_3= $fileNameStore;
        //     $productPic->image_4= $fileNameStore;
        //     $productPic->save();

        //     return redirect('/products')->with('success',"Image Updated");
        // }
        // return redirect('/products')->with('error',"Image not Updated");
    }

    public function destroy($id)
    {
        $productPic= ProductPic::find($id);
        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_1);
        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_2);
        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_3);
        Storage::delete('public/Uploads/productPics/'.$productPic->product_id.'/'.$productPic->image_4);
        Storage::deleteDirectory('public/Uploads/productPics/'.$productPic->product_id);
        $productPic->image_1="default.png";
        $productPic->image_2=null;
        $productPic->image_3=null;
        $productPic->image_4=null;
        $productPic->save();
        return redirect('/products')->with('success',"All Images Deleted");
    }
}
