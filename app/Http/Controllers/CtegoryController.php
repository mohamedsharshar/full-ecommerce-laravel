<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CtegoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
    $products = Product::with('category')->get();
        return view('category', compact('categories', 'products'));
    }

    public function show(Category $category){



    }

}
