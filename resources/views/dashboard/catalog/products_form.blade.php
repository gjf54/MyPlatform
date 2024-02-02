@extends('layouts.dashboard_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/dashboard/catalog/products_form.css') }}">
@endsection

@section('title')

@if($status == 'create')
    Create product
@else
    Edit product
@endif

@endsection

@section('content')
<div class="form">
    <form action="<? $status == 'create' ? route('dashboard_send_created_product', ['id' => $category->id]) : route('dashboard_save_edited_product', ['id' => $category->id]) ?>">
        <div class="mb-3 d-flex flex-column mb-3">
            <label for="name" class="form-label">Name of product</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3 d-flex flex-column mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" name="price" id="price" class="form-control">
        </div>
        <div class="mb-3 d-flex flex-column mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <input type="text" name="description" id="description" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">
            @if($status == 'create')
                Create product
            @else
                Save changes
            @endif
        </button>
    </form>
</div>
@endsection