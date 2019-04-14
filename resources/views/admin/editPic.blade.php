@extends('inc.app')

@section('content')
<form action="/productPics/{{$id}}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Image_1</label>
    <input type="file" name="image_1">
    <label>Image_2</label>
    <input type="file" name="image_2">
    <label>Image_3</label>
    <input type="file" name="image_3">
    <label>Image_4</label>
    <input type="file" name="image_4">
    <input type="hidden" name="_method" value="PUT">
    <input type="submit" value="Upload">
</form>
<div>
    <img src="/storage/Uploads/productPics/{{$productPic->product_id}}/{{$productPic->image_1}}">
    <img src="/storage/Uploads/productPics/{{$productPic->product_id}}/{{$productPic->image_2}}">
    <img src="/storage/Uploads/productPics/{{$productPic->product_id}}/{{$productPic->image_3}}">
    <img src="/storage/Uploads/productPics/{{$productPic->product_id}}/{{$productPic->image_4}}">
</div>
<form action="/productPics/{{$productPic->id}}" method="post">
    @csrf
    <input type="hidden" name="_method" value="delete">
    <input class="btn btn-danger" type="submit" value="Delete Pics">
</form>

@endsection