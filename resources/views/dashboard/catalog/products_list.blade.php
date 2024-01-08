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
    <div class="add_product col-xl-3 col-md-4">
        <a href="#">Add product</a>
    </div>
    @foreach($products as $product)
        <div class="product col-xl-3 col-md-4">
            <a href="#">{{ $product->name }}</a>
        </div>
    @endforeach
</div>
@endsection