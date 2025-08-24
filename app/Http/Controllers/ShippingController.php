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

        // Get cart
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->firstOrFail();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'عربة التسوق فارغة!');
        }

        // Calculate shipping cost based on city
        $shipping_cost = match (strtolower($request->city)) {
            'united arab emirates' => 10,
            'saudi arabia' => 15,
            default => 5,
        };

        // Calculate final total
        $finalTotal = $cart->discounted_total + $shipping_cost;

        // Create order first
        $order = Order::create([
            'user_id' => Auth::id(),
            'subtotal' => $cart->total,
            'discount' => $cart->total - $cart->discounted_total,
            'total' => $finalTotal,
            'status' => 'pending',
            'coupon_id' => $cart->coupon_id
        ]);

        // Create order items
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->unit_price
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
        $cart->items()->delete();
        $cart->delete();

        // Redirect to success page or order confirmation
        return redirect()->route('orders.show', $order->id)->with('success', 'تم إنشاء الطلب بنجاح!');

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
