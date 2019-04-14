@extends('inc.app')

@section('content')
    <h2>Edit Product details</h2>
<form style="display:flex;flex-direction:column;" action="/products/{{$product->id}}" method="post">
        @csrf
        <label for="name">Name</label>
<input type="text" name="name" value="{{$product->name}}">
        <label for="name">Type</label>
        <input type="text" name="type" value="{{$product->type}}">
        <label for="name">Description</label>
        <input type="textarea" name="description" value="{{$product->description}}">
        <label for="name">Available Qty</label>
        <input type="number" name="available_quantity" value="{{$product->available_quantity}}">
        <label for="name">Price</label>
        <input type="number" name="price" value="{{$product->price}}">
        <label for="name">Discount(%)</label>
        <input type="number" name="discount_percent" value="{{$product->discount_percent}}">
        <label for="name">Updated By</label>
        <input type="text" name="updated_by" value="{{$product->updated_by}}">
        <input type="hidden" name="_method" value="PUT">
        <input type="submit" value="Submit">
    </form>    
@endsection