<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('checkout');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        return view('orders.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['items.product', 'shipping'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function invoice(string $id)
    {
        $order = Order::with(['items.product', 'shipping'])->findOrFail($id);
        return view('orders.invoice', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $orders = Order::findOrFail($id);
        $orders->update(
            [
                'status' => $request->input('status')
            ]
        );

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orders = Order::findOrFail($id);
        $orders->delete();

        return redirect()->back()->with('success', 'Order deleted successfully!');
    }
}
