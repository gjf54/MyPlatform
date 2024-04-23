<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function generate_cart_page() {
        $user = User::find(auth()->user()->id);
        $cart = $user->shopping_cart;
        $collection = $cart->products_collection;
        
        return view('shopping_cart', [
            'collection' => $collection,
        ]);
    }
}
