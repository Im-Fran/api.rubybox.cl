<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\BusinessAssociatedProductResource;
use App\Models\Product\BusinessAssociatedProduct;
use Illuminate\Http\Request;

class BusinessAssociatedProductController extends Controller {
    public function index() {
        return BusinessAssociatedProductResource::collection(BusinessAssociatedProduct::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'business_id' => ['required'],
            'category_id' => ['nullable'],
            'product_id' => ['required'],
        ]);

        return new BusinessAssociatedProductResource(BusinessAssociatedProduct::create($data));
    }

    public function show(BusinessAssociatedProduct $businessAssociatedProduct) {
        return new BusinessAssociatedProductResource($businessAssociatedProduct);
    }

    public function update(Request $request, BusinessAssociatedProduct $businessAssociatedProduct) {
        $data = $request->validate([
            'business_id' => ['required'],
            'category_id' => ['nullable'],
            'product_id' => ['required'],
        ]);

        $businessAssociatedProduct->update($data);

        return new BusinessAssociatedProductResource($businessAssociatedProduct);
    }

    public function destroy(BusinessAssociatedProduct $businessAssociatedProduct) {
        $businessAssociatedProduct->delete();

        return response()->json();
    }
}
