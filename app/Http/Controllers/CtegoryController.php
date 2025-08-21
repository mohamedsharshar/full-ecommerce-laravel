<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CtegoryController extends Controller
{
    public function index()
    {
    $allCategories = Category::all();
    $mainCategories = $allCategories->whereNull('parent_id');
    $subCategories = $allCategories->whereNotNull('parent_id');
    $products = Product::with('category')->get();
    return view('category', compact('mainCategories', 'subCategories', 'allCategories', 'products'));
    }



}
