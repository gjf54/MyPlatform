@extends('layouts.main_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/catalog/products.css') }}">
@endsection

@section('content')

<div class="products row col-sm-12 col-md-4 d-flex justify-content-around offset-3">
@foreach($products as $product)
    <div class="product d-flex flex-column">
        <a href="{{ route('catalog_product_view', ['id_category' => $category->id, 'id_product' => $product->id]) }}">
            <img src="{{ asset(Storage::url($product->image)) }}" alt="product img">
        </a>
        <span role="product_price"><?='$' . $product->price ?></span>

        <?php 
            $curr_name = $product->name;
            if (strlen($curr_name) > 20) {
                $curr_name = str_split($curr_name, 17);
                echo '<span role="product_name">' . $curr_name[0] . '...' .'</span>';
            } else {
                echo '<span role="product_name">' . $product->name . '</span>';
            }
        ?>
        
        @php($flag = true)
        @foreach($cart as $el)
            @if($el->product_id == $product->id)
                @php($flag = false)
                <div class="product_control_buttons d-flex flex-row justify-content-around align-items-center">
                    <div class="plus_button" onclick="add_amount('<?= route('cart_add_amount', ['id' => $el->id]) ?>')"></div>
                    <span id="<?= 'amount-' . $el->id ?>" class="d-flex justify-content-center align-items-center">{{ $el->amount }}</span>
                    <div class="minus_button" onclick="rem_amount('<?= route('cart_rem_amount', ['id' => $el->id]) ?>')" ></div>
                </div>
            @endif
        @endforeach
        @if($flag and auth()->user())
            <button id="<?= 'product-' . $product->id ?>" class="btn btn-primary" onclick="set_element('<?= route('cart_set_element', ['id' => $product->id]) ?>')">В корзину</button>
        @endif
        @if($flag == false)
            
        @endif
        @if(empty(auth()->user()))
            <a href="{{ route('profile') }}" class="btn btn-primary">В корзину</a>
        @endif
        
    </div>
@endforeach
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/shopping_cart.js') }}"></script>
@endsection