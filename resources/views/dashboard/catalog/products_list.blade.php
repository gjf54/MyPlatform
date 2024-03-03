@extends('layouts.dashboard_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/dashboard/catalog/products_list.css') }}">
@endsection

@section('title')
Products list
@endsection

@section('content')
<a href="{{ route('dashboard_catalog') }}" id="return_to_categories" class="btn btn-outline-secondary">Return to categories</a>
<div class="products row g-4">
    <div class="add_product col-xl-4 col-md-6">
        <a href="{{ route('dashboard_create_product', ['id' => $category->id]) }}">Add product</a>
    </div>
    @foreach($products as $product)
        <div class="product col-xl-4 col-md-6">
            <div class="buttons">
                <a href="<?= route('dashboard_edit_product', ['id_category' => $category->id, 'id_product' => $product->id]) ?>" class="btn btn-primary">Edit</a>
                <a href="{{ route('dashboard_product_delete', ['id_category' => $category->id, 'id_product' => $product->id]) }}" class="btn btn-danger">Delete</a>
            </div>
            <a href="{{ route('product_view', ['id_category' => $category->id, 'id_product' => $product->id]) }}">
                <img src="{{ asset(Storage::url($product->image)) }}" alt="product img">
                <span role="name">{{ $product->name }}</span>
                <span role="price">{{ "$".$product->price }}</span>
            </a>
        </div>
    @endforeach
</div>
@endsection