<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductPricesResource;
use App\Models\Product\ProductPrices;
use Illuminate\Http\Request;

class ProductPricesController extends Controller {
    public function index() {
        return ProductPricesResource::collection(ProductPrices::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'product_id' => ['required'],
            'business_id' => ['required'],
            'price' => ['required', 'numeric'],
            'currency' => ['required'],
        ]);

        return new ProductPricesResource(ProductPrices::create($data));
    }

    public function show(ProductPrices $productPrices) {
        return new ProductPricesResource($productPrices);
    }

    public function update(Request $request, ProductPrices $productPrices) {
        $data = $request->validate([
            'product_id' => ['required'],
            'business_id' => ['required'],
            'price' => ['required', 'numeric'],
            'currency' => ['required'],
        ]);

        $productPrices->update($data);

        return new ProductPricesResource($productPrices);
    }

    public function destroy(ProductPrices $productPrices) {
        $productPrices->delete();

        return response()->json();
    }
}
