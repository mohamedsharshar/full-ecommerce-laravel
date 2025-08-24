<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Shipping;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with(['items.product', 'coupon'])
            ->firstOrCreate(['user_id' => Auth::id()]);

        $shippingInfo = Shipping::where('user_id', Auth::id())->first();

        $shipping = match (strtolower($shippingInfo->city ?? '')) {
            'united arab emirates' => 10,
            'saudi arabia' => 15,
            default => 5,
        };

        return view('cart', [
            'cart' => $cart,
            'cartItems' => $cart->items,
            'shipping' => $shipping,
            'total' => $cart->total ?? 0,
            'discount' => ($cart->total ?? 0) - ($cart->discounted_total ?? 0),
            'totalAfterDiscount' => $cart->discounted_total ?? 0
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $product = Product::findOrFail($request->product_id);

        $cartItem = $cart->items()->where('product_id', $request->product_id)->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'unit_price' => $product->price,
                'subtotal' => $product->price * $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update([
            'quantity' => $request->quantity,
            'subtotal' => $cartItem->unit_price * $request->quantity
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }

    public function checkout()
    {
        $cart = Cart::with(['items.product', 'coupon'])
            ->firstOrCreate(['user_id' => Auth::id()]);

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $shippingInfo = Shipping::where('user_id', Auth::id())->first();

        $shipping = match (strtolower($shippingInfo->city ?? '')) {
            'united arab emirates' => 10,
            'saudi arabia' => 15,
            default => 5,
        };

        return view('checkout', [
            'cart' => $cart,
            'cartItems' => $cart->items,
            'shipping' => $shipping,
            'total' => $cart->total ?? 0,
            'discount' => ($cart->total ?? 0) - ($cart->discounted_total ?? 0),
            'totalAfterDiscount' => $cart->discounted_total ?? 0,
            'shippingInfo' => $shippingInfo
        ]);
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

        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'subtotal' => $cart->total,
                'discount' => $cart->total - $cart->discounted_total,
                'total' => $cart->discounted_total,
                'status' => 'pending',
                'coupon_id' => $cart->coupon_id
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->unit_price
                ]);
            }

            Shipping::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'address' => $request->shipping_address,
                'city' => $request->shipping_city,
                'state' => $request->shipping_state,
                'zip' => $request->shipping_zip,
            ]);

            // Clear the cart
            $cart->items()->delete();
            $cart->delete();

            DB::commit();
            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }
}
