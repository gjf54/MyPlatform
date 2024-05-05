<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\ShoppingCartCollection;
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

    public function add_amount($id) 
    {
        $element = ShoppingCartCollection::find($id);
        $element->amount += 1;
        $element->save();

        return json_encode($element);
    }

    public function remove_amount($id) {
        $element = ShoppingCartCollection::find($id);
        
        if($element->amount < 2) {
            return 0;
        }
        
        $element->amount -= 1;
        $element->save();

        return json_encode($element);
    }

    public function remove_element($id) {
        $element = ShoppingCartCollection::find($id);

        if($element == null) {
            return 0;
        }

        $element->delete();
        return json_encode(['status' => 'ok', 'id' => $id]);
    }
}
