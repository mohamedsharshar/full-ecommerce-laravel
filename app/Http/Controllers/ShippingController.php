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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
        ]);

        // Update or create shipping information
        Shipping::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ]
        );

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $shippingInfo = Shipping::where('user_id', Auth::id())->first();

        $shipping_cost = 0;
        if ($shippingInfo) {
            switch (strtolower($shippingInfo->city)) {
                case 'united arab emirates':
                    $shipping_cost = 10;
                    break;
                case 'saudi arabia':
                    $shipping_cost = 15;
                    break;
                default:
                    $shipping_cost = 5;
            }
        } else {
            $shipping_cost = 5;
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
        $finalTotal = $totalAfterDiscount + $shipping_cost;

        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_id' => $shippingInfo->id,
            'subtotal' => $total,
            'discount' => $discount,
            'total' => $finalTotal,
            'status' => 'pending',
            'coupon_id' => session()->has('coupon') && isset(session('coupon')['id']) ? session('coupon')['id'] : null,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

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
