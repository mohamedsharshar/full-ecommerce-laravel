<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
    $categories = Category::all();
    $mainCategories = $categories->whereNull('parent_id');
    $subCategories = $categories->whereNotNull('parent_id');
    $products = Product::all();
    return view('welcome', compact('categories', 'mainCategories', 'subCategories', 'products'));
    }


    public function show(Category $category){
        $categories = Category::all();
        $mainCategories = $categories->whereNull('parent_id');
        $subCategories = $categories->whereNotNull('parent_id');
        return view('category', compact('categories', 'mainCategories', 'subCategories'));
    }

}
