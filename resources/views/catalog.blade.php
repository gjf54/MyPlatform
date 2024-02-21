@extends('layouts.main_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('/styles/catalog.css') }}" />
@endsection

@section('title')
Catalog
@endsection()

@section('content')
<div class="categories row d-flex justify-content-center align-items-center">
	@foreach($categories as $category)
		<div class="category col-sm-6 col-md-4">
			<img src="{{ $category->image }}" alt="category image" />
			<span role="category_name">{{ $category->name }}</span>
		</div>
	@endforeach
</div>
@endsection()