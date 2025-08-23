<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('coupons', compact('coupons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:coupons',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
            'expires_at' => 'nullable|date',
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully!');
    }
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:coupons,code'
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        if (!$coupon->isValid($total)) {
            return back()->with('error', 'Coupon is invalid or expired!');
        }

        $discount = $coupon->type === 'fixed'
            ? $coupon->value
            : ($total * ($coupon->value / 100));

        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount' => $discount,
        ]);

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function remove()
    {
        session()->forget('coupon');
        return back()->with('success', 'Coupon removed from cart!');
    }
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
            'expires_at' => 'nullable|date',
        ]);

        $coupon->update($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully!');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back()->with('success', 'Coupon deleted successfully!');
    }
}
