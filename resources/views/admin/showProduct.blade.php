@extends('inc.app')

@section('content')
    <a href="/products" class="btn btn-secondary">Back</a>
    <div>
        <h2>{{$product->name}}</h2>
        <p>{{$product->type}}</p>
        <p>{{$product->description}}</p>
        <p>{{$product->available_quantity}}</p>
        <p>{{$product->price}}</p>
        <p>{{$product->discount_percent}}</p>
        <p>{{$product->updated_by}}</p>
        <p>{{$product->updated_at}}</p>
    </div>
    <a href="/products/{{$product->id}}/edit" class="btn btn-primary">Edit</a>
    <form action="/products/{{$product->id}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
    
    @if ($productPic->image_1 == "default.png")
        <a class="btn btn-warning" href="/productPics/add/{{$product->id}}">Add Images</a>
        <img src="/storage/Uploads/productPics/{{$productPic->image_1}}">  
    @else
        <a href="/productPics/{{$productPic->id}}/edit" class="btn btn-secondary">Edit Images</a>
        <img src="/storage/Uploads/productPics/{{$productPic->product_id}}/{{$productPic->image_1}}">
        <img src="/storage/Uploads/productPics/{{$productPic->product_id}}/{{$productPic->image_2}}">
        <img src="/storage/Uploads/productPics/{{$productPic->product_id}}/{{$productPic->image_3}}">
        <img src="/storage/Uploads/productPics/{{$productPic->product_id}}/{{$productPic->image_4}}">
    @endif
    
   
    <style>
        img{
            width:200px;
            height:200px;
        }
    </style>
@endsection