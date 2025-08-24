<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
        ]);

        // Get cart items
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'عربة التسوق فارغة!');
        }

        // Calculate shipping cost based on city
        $shipping_cost = 0;
        switch (strtolower($request->city)) {
            case 'united arab emirates':
                $shipping_cost = 10;
                break;
            case 'saudi arabia':
                $shipping_cost = 15;
                break;
            default:
                $shipping_cost = 5;
        }

        // Calculate totals
        $subtotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $discount = 0;
        if (session()->has('coupon')) {
            $coupon = session('coupon');
            if ($coupon['code']) {
                $discount = $coupon['discount'];
            }
        }

        $totalAfterDiscount = $subtotal - $discount;
        $finalTotal = $totalAfterDiscount + $shipping_cost;

        // Create order first
        $order = Order::create([
            'user_id' => Auth::id(),
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $finalTotal,
            'status' => 'pending',
            'coupon_id' => session()->has('coupon') && isset(session('coupon')['id']) ? session('coupon')['id'] : null,
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // Create shipping information
        Shipping::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
        ]);

        // Clear cart after successful order
        Cart::where('user_id', Auth::id())->delete();

        // Redirect to success page or order confirmation
        return redirect()->route('orders.show', $order->id)->with('success', 'تم إنشاء الطلب بنجاح!');

        Cart::where('user_id', Auth::id())->delete();

        session()->forget('coupon');

        return redirect('/')->with('success', 'تم إتمام الطلب بنجاح!');
    }

    public function update(Request $request, Shipping $shipping)
    {
        if ($shipping->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
        ]);

        $shipping->update($request->all());

        return redirect()->back()->with('success', 'Shipping information updated successfully!');
    }
}
