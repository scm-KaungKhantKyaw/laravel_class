<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select(['id', 'name', 'price', 'created_at'])
                             ->latest('id')
                             ->paginate(5);

        $products = $products->map(function($p) {
            $p->price = number_format($p->price);
            return $p;
        });

        return response()->json(compact('products'));
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->only(['name', 'price']));

        return response()->json(compact('product'), 201);
    }

    public function show($id)
    {
        $product = Product::select(['id', 'name', 'price', 'created_at'])->find($id);

        if(! $product) {
            return response()->json([], 404);
        }

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'created_at' => $product->created_at->diffForHumans(),
        ], 200);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        if(! $product) {
            // return response()->json([], 404);
            return response()->json([], Response::HTTP_NOT_FOUND);
        }

        $product->update($request->only(['name', 'price']));
        // return response()->json([], 200);
        return response()->json([], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if(! $product) {
            return response()->json([], 404);
        }
        // return response()->json([], 200);
        return response()->json([], Response::HTTP_OK);
    }
}
