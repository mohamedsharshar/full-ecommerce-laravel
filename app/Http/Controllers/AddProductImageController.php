<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImages;

class AddProductImageController extends Controller
{
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.add_images', compact('product'));
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($productId);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);
                ProductImages::create([
                    'product_id' => $product->id,
                    'image_path' => 'uploads/products/' . $imageName,
                ]);
            }
        }

        return redirect()->route('products.show', $product->id)->with('success', 'Images uploaded successfully.');
    }

    public function edit($productId)
    {
        $product = Product::with('images')->findOrFail($productId);
        return view('products.edit_images', compact('product'));
    }

    public function update(Request $request, $imageId)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = ProductImages::findOrFail($imageId);
        if (file_exists(public_path($image->image_path))) {
            @unlink(public_path($image->image_path));
        }
        $newImage = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $newImage->getClientOriginalExtension();
        $newImage->move(public_path('uploads/products'), $imageName);
        $image->update(['image_path' => 'uploads/products/' . $imageName]);
        return back()->with('success', __('messages.update') . ' ' . __('messages.image'));
    }

    public function destroy($imageId)
    {
        $image = ProductImages::findOrFail($imageId);
        $productId = $image->product_id;
        if (file_exists(public_path($image->image_path))) {
            @unlink(public_path($image->image_path));
        }
        $image->delete();
        return back()->with('success', __('messages.delete') . ' ' . __('messages.image'));
    }
}
