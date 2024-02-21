<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\Category.php;
use app\models\Product.php;

class CatalogController extends Controller
{
    public function display_categories() {
    	$categories = Category:all();
    
        return view('catalog',  [
			'categories' => $categories,
		]);
    }
    
    public function display_category_products($id) {
    	
    }
}
