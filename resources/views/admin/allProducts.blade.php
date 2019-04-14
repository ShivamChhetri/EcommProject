@extends('inc.app')

@section('content')
    <div>
        <h2>Dashboard</h2>
        <a href="/products/create" class="btn btn-primary">Add product</a>
    </div>


    <h1>Products List</h1>
    @if(count($products)>0)
        <div class="grid">
            <div class="grid-item">
                <h2>Name</h2>
                @foreach ($products as $product)
                    <p><a href="/products/{{$product->id}}">{{$product->name}}</a><p>
                @endforeach            
            </div>
            <div class="grid-item">
                <h2>Type</h2>
                @foreach ($products as $product)
                    <p>{{$product->type}}</p>   
                @endforeach   
            </div>
            <div class="grid-item">
                <h2>Description</h2>
                @foreach ($products as $product)
                    <p>{{$product->description}}</p>   
                @endforeach   
            </div class="grid-item">
            <div class="grid-item">
                <h2>Available Qty</h2>
                @foreach ($products as $product)
                    <p>{{$product->available_quantity}}</p>   
                @endforeach   
            </div>
            <div class="grid-item">
                <h2>Price</h2>
                @foreach ($products as $product)
                    <p>{{$product->price}}</p>   
                @endforeach   
            </div>
            <div class="grid-item">
                <h2>Discount(%)</h2>
                @foreach ($products as $product)
                    <p>{{$product->discount_percent}}</p>   
                @endforeach   
            </div>
            <div class="grid-item">
                <h2>Updated By</h2>
                @foreach ($products as $product)
                    <p>{{$product->updated_by}}</p>   
                @endforeach   
            </div>
            <div class="grid-item">
                <h2>Last Updated</h2>
                @foreach ($products as $product)
                    <p>{{$product->updated_at}}</p>   
                @endforeach   
            </div>
        </div>
    @else
        <p>No Product found</p>
    @endif


    
@endsection