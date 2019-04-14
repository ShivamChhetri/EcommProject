@extends('inc.app')

@section('content')

    <form action="/productPics/store" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Image_1</label>
        <input type="file" name="image_1">
        <label>Image_2</label>
        <input type="file" name="image_2">
        <label>Image_3</label>
        <input type="file" name="image_3">
        <label>Image_4</label>
        <input type="file" name="image_4">
        <input type="hidden" name="product_id" value="{{$product_id}}">
        <input type="submit" value="Upload">
    </form>
    
@endsection