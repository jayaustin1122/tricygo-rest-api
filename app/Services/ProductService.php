<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductService
{

    public function all()
    {
        $product = Product::orderBy('name', 'asc')->get();
        return response()->json($product, 200);
    }

    public function add($payload)
    {
        $payload->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string|max:255',

        ]);

        $product = Product::create([
            'name' => $payload->name,
            'price' => $payload->price,
            'description' => $payload->description,
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Product successfully created.',
                'data' => $product,
            ],
            201
        );
    }

    public function search($payload)
    {
        $product = Product::find($payload);

        if ($product) {
            return response()->json($product, 200);
        }
        return response()->json(
            [
                'success' => false,
                'message' => 'Product not found.',
            ],
            404
        );
    }

    public function edit($request, $payload)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|max:10',
            'description' => 'required|string|max:255',
        ]);
        $product = Product::find($payload);

        if ($product) {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);

            return response()->json($product, 200);
        }
        return response()->json(
            [
                'success' => false,
                'message' => 'Product not found.',
            ],
            404
        );
    }

    public function delete($payload)
    {
        if ($payload) {
            $product = Product::find($payload);
            $product->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Product deleted.',
                ],
                200
            );
        }
        return response()->json(
            [
                'success' => false,
                'message' => 'Product not found.',
            ],
            404
        );
    }
}
