@extends('layouts.main_layout')

@section('title')
Shopping Cart 
@endsection

@section('content')

@foreach($collection as $element)
<?php $product = App\Models\Product::find($element->product_id) ?>
<span>{{ $product->name }}</span>
@endforeach

@endsection