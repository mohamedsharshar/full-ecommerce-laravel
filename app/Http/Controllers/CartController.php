<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $shippingInfo = Shipping::where('user_id', Auth::id())->first();

        $shipping = 0;
        if ($shippingInfo) {
            switch (strtolower($shippingInfo->city)) {
                case 'united arab emirates':
                    $shipping = 10;
                    break;
                case 'saudi arabia':
                    $shipping = 15;
                    break;
                default:
                    $shipping = 5;
            }
        } else {
            $shipping = 5;
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $discount = 0;
        if (session()->has('coupon')) {
            $coupon = session('coupon');
            if ($coupon['code']) {
                $discount = $coupon['discount'];
            }
        }

        $totalAfterDiscount = $total - $discount;

        return view('cart', compact('cartItems', 'shipping', 'total', 'discount', 'totalAfterDiscount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }

    public function checkout()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $shippingInfo = Shipping::where('user_id', Auth::id())->first();

        $shipping = 0;
        if ($shippingInfo) {
            switch (strtolower($shippingInfo->city)) {
                case 'united arab emirates':
                    $shipping = 10;
                    break;
                case 'saudi arabia':
                    $shipping = 15;
                    break;
                default:
                    $shipping = 5;
            }
        } else {
            $shipping = 5;
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $discount = 0;
        if (session()->has('coupon')) {
            $coupon = session('coupon');
            if ($coupon['code']) {
                $discount = $coupon['discount'];
            }
        }

        $totalAfterDiscount = $total - $discount;

        return view('checkout', compact('cartItems', 'shipping', 'total', 'discount', 'totalAfterDiscount', 'shippingInfo'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_state' => 'required|string',
            'shipping_zip' => 'required|string',
            'payment_method' => 'required|string'
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }


        return redirect()->route('orders.show')->with('success', 'Order placed successfully!');
    }
}
