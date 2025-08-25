<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $catid = null)
    {
        $query = Product::query();

        if ($catid) {
            $query->where('category_id', $catid);
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(8);
        $mainCategories = \App\Models\Category::whereNull('parent_id')->get();
        $subCategories = \App\Models\Category::whereNotNull('parent_id')->get();

        return view('product', compact('products', 'mainCategories', 'subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
        }
        $mainCategories = \App\Models\Category::whereNull('parent_id')->get();
        $subCategories = \App\Models\Category::whereNotNull('parent_id')->get();
        $products = Product::all();
        $categories = \App\Models\Category::all();
        return view('products.addproducts', compact('mainCategories', 'subCategories', 'products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'quantity'       => 'required|integer|min:1',
            'category_id'    => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'desc'           => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'image'          => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $filename);
            $validated['image'] = 'products/' . $filename;
        }
        Product::create($validated);
        return redirect()->route('products.create')->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = \App\Models\Category::whereNull('parent_id')->with('children')->get();
        $categories = \App\Models\Category::all();
        $mainCategories = $categories->whereNull('parent_id');
        $subCategories = $categories->whereNotNull('parent_id');
        return view('products.edit', compact('product', 'categories', 'mainCategories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'quantity'       => 'nullable|integer|min:1',
            'category_id'    => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $filename);
            $data['image'] = 'products/' . $filename;
        }
        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $products = Product::findOrFail($product->id);
        $products->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function trashed()
    {
        $products = Product::onlyTrashed()->paginate(10);
        return view('products.trashed', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.trashed')->with('success', 'Product restored successfully.');
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        return redirect()->route('products.trashed')->with('success', 'Product permanently deleted.');
    }
}
