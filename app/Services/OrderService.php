<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderService
{

    public function all()
    {
        $order = Order::orderBy('id', 'asc')->get();
        return response()->json($order, 200);
    }

    public function add($payload)
    {
        $payload->validate([
            'status' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);

        $order = Order::create([
            'status' => $payload->status,
            'user_id' => $payload->user_id,
            'product_id' => $payload->product_id,
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Order successfully created.',
                'data' => $order,
            ],
            201
        );
    }

    public function search($payload)
    {
        $order = Order::find($payload);

        if ($order) {
            return response()->json($order, 200);
        }
        return response()->json(
            [
                'success' => false,
                'message' => 'Order not found.',
            ],
            404
        );
    }

    public function edit($request, $payload)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);
        $order = Order::find($payload);

        if ($order) {
            $order->update([
                'status' => $request->status,
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
            ]);

            return response()->json($order, 200);
        }
        return response()->json(
            [
                'success' => false,
                'message' => 'Order not found.',
            ],
            404
        );
    }

    public function delete($payload)
    {
        if ($payload) {
            $order = Order::find($payload);
            $order->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Order deleted.',
                ],
                200
            );
        }
        return response()->json(
            [
                'success' => false,
                'message' => 'Order not found.',
            ],
            404
        );
    }
}
