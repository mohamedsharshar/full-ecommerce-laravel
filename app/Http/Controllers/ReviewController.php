<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function reviews()
    {
        $reviews = Review::all();
        return view('reviews', compact('reviews'));
    }

    public function store(Request $request){
        $request->validate([
            'user_name' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'comment' => 'required|string|max:1000',
        ]);

        $review = new Review();
        $review->user_name = $request->user_name;
        $review->rating = $request->rating;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
            $review->image = '/storage/' . $imagePath;
        }

        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('reviews')->with('success', 'Review submitted successfully.');
    }

}
