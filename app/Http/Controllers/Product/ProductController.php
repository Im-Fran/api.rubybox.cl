<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index() {
        return ProductResource::collection(Product::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'business_id' => ['nullable'],
            'barcode' => ['nullable'],
            'name' => ['required'],
            'description' => ['required'],
            'bill_name' => ['required'],
            'estimated_product_duration' => ['nullable', 'integer'],
        ]);

        return new ProductResource(Product::create($data));
    }

    public function show(Product $product) {
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'business_id' => ['nullable'],
            'barcode' => ['nullable'],
            'name' => ['required'],
            'description' => ['required'],
            'bill_name' => ['required'],
            'estimated_product_duration' => ['nullable', 'integer'],
        ]);

        $product->update($data);

        return new ProductResource($product);
    }

    public function destroy(Product $product) {
        $product->delete();

        return response()->json();
    }
}
