<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CatalogController extends Controller
{
    public function display_categories() {
    	$categories = Category::all();
    
        return view('catalog.catalog',  [
			'categories' => $categories,
		]);
    }
    
    public function display_category_products($id) {
    	
    }
}
