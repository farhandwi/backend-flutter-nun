<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        // 'transaction_number',
        // 'cashier_id',
        // 'total_price',
        // 'total_item',
        // 'payment_method',
        $validatedData = $request->validate([
            'cashier_id' => 'required',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order = \App\Models\Order::create([
            'transaction_number' => 'TRX-' . strtoupper(uniqid()),
            'cashier_id' => $validatedData['cashier_id'],
            'total_price' => collect($validatedData['items'])->sum(function ($item) {
                return \App\Models\Product::find($item['product_id'])->price * $item['quantity'];
            }),
            'total_item' => collect($validatedData['items'])->sum('quantity'),
            'payment_method' => $request->input('payment_method', 'cash'), // Default to 'cash' if not provided
        ]);

        foreach ($validatedData['items'] as $item) {
            $order->orderItems()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total_price' => \App\Models\Product::find($item['product_id'])->price * $item['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Order created successfully',
            'data' => $order->load('orderItems.product'),
        ], 201);
    }

    // get all orders
    public function index(Request $request)
    {
        $orders = \App\Models\Order::with('orderItems.product')->get();
        return response()->json([
            'data' => $orders,
        ]);
    }
}
