<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $mainCategories = Category::whereNull('parent_id')->get();
        $subCategories = Category::whereNotNull('parent_id')->get();
        $categories = Category::all();
    $products = Product::paginate(9);
        return view('welcome', compact('mainCategories', 'subCategories', 'categories', 'products'));
    }
}
