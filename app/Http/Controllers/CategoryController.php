<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $allCategories = Category::all();
        $mainCategories = $allCategories->whereNull('parent_id');
        $subCategories = $allCategories->whereNotNull('parent_id');
        $products = Product::with('category')->get();
        return view('categories.index', compact('mainCategories', 'subCategories', 'allCategories', 'products'));
    }


    public function show(Category $category){
        return view('categories.show', compact('category'));
    }
    public function create(){
        $categories = Category::all();
        $mainCategories = $categories->whereNull('parent_id');
        $subCategories = $categories->whereNotNull('parent_id');
        return view('categories.create', compact('categories', 'mainCategories', 'subCategories'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $filename);
            $validated['image'] = 'categories/' . $filename;
        }

        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
    public function edit(Category $category){
        $categories = Category::all();
        $mainCategories = $categories->whereNull('parent_id');
        $subCategories = $categories->whereNotNull('parent_id');
        return view('categories.edit', compact('categories', 'mainCategories', 'subCategories', 'category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $filename);
            $validated['image'] = 'categories/' . $filename;
        }

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }


}
