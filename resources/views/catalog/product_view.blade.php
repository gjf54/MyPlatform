@extends('layouts.main_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/catalog/product_view.css') }}">
@endsection

@section('title')
{{ $product->name }}
@endsection

@section('content')

@endsection