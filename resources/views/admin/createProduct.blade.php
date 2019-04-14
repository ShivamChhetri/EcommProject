@extends('inc.app')

@section('content')
    <h2>Product details</h2>
    <form style="display:flex;flex-direction:column;" action="/products" method="post">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name">
        <label for="name">Type</label>
        <input type="text" name="type">
        <label for="name">Description</label>
        <input type="textarea" name="description">
        <label for="name">Available Qty</label>
        <input type="number" name="available_quantity">
        <label for="name">Price</label>
        <input type="number" name="price">
        <label for="name">Discount(%)</label>
        <input type="number" name="discount_percent">
        <label for="name">Updated By</label>
        <input type="text" name="updated_by">
        <input type="submit" value="Submit">
    </form>    
@endsection