@extends('layouts.dashboard_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/dashboard/catalog/product_view.css') }}">
@endsection

@section('title')
{{ $product->name }}
@endsection

@section('content')
<div class="row d-flex justify-content-start main">
    <div class="image col-md-4 col-sm-12 d-flex">
        <img src="{{ asset(Storage::url($product->image)) }}" alt="product img">
        <a href="#" class="btn btn-primary disabled">Add to cart</a>
    </div>
    <div class="info col-md-4 col-sm-12 d-flex flex-column">
        <div class="">
            <div class="info_el d-flex flex-column">
                <span role="title">Name:</span>
                <span role="name">{{ $product->name }}</span>
            </div>
            <div class="info_el d-flex flex-column">
                <span role="title">Price:</span>
                <span role="price">{{ "$".$product->price }}</span>
            </div>
        </div>
        <div class="info_description d-flex flex-column">
            <span role="title">Description</span>
            <span><?= $product->description == '' ? '...' : $product->description ?></span>
        </div>
    </div>
</div>
@endsection