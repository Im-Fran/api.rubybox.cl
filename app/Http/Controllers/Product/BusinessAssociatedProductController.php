<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\AssociatedProduct\CreateAssociatedProductRequest;
use App\Http\Requests\Business\AssociatedProduct\UpdateAssociatedProductRequest;
use App\Http\Resources\Product\BusinessAssociatedProductResource;
use App\Models\Business\Business;
use App\Models\Product\BusinessAssociatedProduct;
use Illuminate\Http\Request;

class BusinessAssociatedProductController extends Controller {

    public function index(Business $business) {
        if(!$business->isOwnedBy(auth()->user())) {
            abort(403);
        }

        return BusinessAssociatedProductResource::collection(BusinessAssociatedProduct::whereBusinessIdId($business->id)->get());
    }

    public function store(CreateAssociatedProductRequest $request) {
        return new BusinessAssociatedProductResource(BusinessAssociatedProduct::create($request->validated()));
    }

    public function show(Business $business, BusinessAssociatedProduct $businessAssociatedProduct) {
        if (!$business->isOwnedBy(auth()->user())) {
            abort(403);
        }

        return new BusinessAssociatedProductResource($businessAssociatedProduct);
    }

    public function update(Business $business, BusinessAssociatedProduct $businessAssociatedProduct, UpdateAssociatedProductRequest $request) {
        $businessAssociatedProduct->update($request->validated());
        return new BusinessAssociatedProductResource($businessAssociatedProduct);
    }

    public function destroy(BusinessAssociatedProduct $businessAssociatedProduct) {
        $businessAssociatedProduct->delete();

        return response()->json();
    }
}
