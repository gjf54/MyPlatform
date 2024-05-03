@extends('layouts.main_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/shopping_cart.css') }}">
@endsection

@section('title')
Shopping Cart 
@endsection

@section('content')

<div class="products">
    @foreach($collection as $element)
    <div class="product d-flex justify-content-between align-items-center">
        <?php $product = App\Models\Product::find($element->product_id) ?>
        <a href="#" class="flex flex-row">
            <div class="product_info d-flex flex-row">
                <img src="{{ Storage::url($product->image) }}" alt="">
                <div class="d-flex flex-column">
                    <span role="name">{{ $product->name }}</span>
                    <span role="price" id="<?= "price-product-" . $element->product_id?>"><span role="price_real">{{ $product->price }}</span> x <span role="product_amount">{{ $element->amount }}</span> = <span role="price_result">{{ $product->price * $element->amount }}</span></span>
                </div>
            </div>    
        </a>    
        <div class="product_control_buttons d-flex flex-row justify-content-center align-items-center">
            <div class="plus_button" onclick="add_amount()"></div>
            <span id="<?= 'amount-' . $element->id ?>" class="d-flex justify-content-center align-items-center">{{ $element->amount }}</span>
            <div class="minus_button" onclick="rem_amount()"></div>
        </div>
    </div>
    @endforeach
</div>

@endsection

@section('scripts')
<script>
    let add_url = "{{ route('add_amount', ['id' => $element->id]) }}"
    let rem_url = "{{ route('rem_amount', ['id' => $element->id]) }}"
</script>
<script src="{{ asset('js/shopping_cart.js') }}"></script>
@endsection