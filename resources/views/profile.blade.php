@extends('layouts.main_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/profile.css') }}">
@endsection

@section('title')
Profile
@endsection()

@section('content')

<div class="header">
        <div class="grey"></div>
        <div class="header_content">
                <div class="main">
                        <img src="{{ asset(Storage::url($user->image)) }}" alt="avatar">
                        <div class="text">        
                                <span role="nameSurname">{{ $user->name }} {{ $user->surname }}</span>
                                <span role="login"> <?php echo '@'.$user->login ?></span>
                        </div>
                </div>
                <div class="buttons">
                         <div class="dropdown first">
                                <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Редактировать
                                </button>
                                <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('edit_data') }}">Инициалы</a></li>
                                        <li><a class="dropdown-item" href="{{ route('edit_avatar') }}">Аватар</a></li>
                                        <li><a class="dropdown-item" href="{{ route('edit_password') }}">Пароль</a></li>
                                        <li><a class="dropdown-item" href="{{ route('edit_email') }}">Электронная почта</a></li>
                                </ul>
                        </div>
                        @if($user->can('write_posts'))
                        <div class="second">
                                <a href="{{ route('dashboard') }}" class="btn btn-primary">Панель</a>
                        </div>
                        @endif
                        <div class="third">
                                <a href="{{ route('logout') }}" role="logout" class="btn btn-danger">Выйти</a>
                        </div>
                </div>
        </div>
</div>

<div class="orders">
        <span role="title col-sm-12">Ваши заказы</span>
        <div class="row d-flex justify-content-around">
        @if($orders->first())
                @foreach($orders as $order)
                        <div class="order col-md-4 col-sm-12">
                                <span role="order_title"><?= '#' . $order->id ?></span>
                                <div class="order_container">
                                @foreach($order->order_products as $el)
                                        @php($product = App\Models\Product::find(['id' => $el->product_id])->first())

                                        <div class="order_product">
                                                <div class="order_product_info">
                                                        <img src="{{ asset(Storage::url($product->image)) }}" alt="Product img">
                                                        <div>
                                                                <span>{{ $product->name }}</span>
                                                                <span>{{ $product->price }} x {{ $el->amount }} = <?= $product->price * $el->amount ?></span>
                                                        </div>
                                                </div>
                                        </div>
                                @endforeach
                                </div>
                        </div>

                @endforeach
        @endif
        </div>
</div>

@endsection()
