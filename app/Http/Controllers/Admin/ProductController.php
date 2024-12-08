<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller {
    public function index(Request $request) {
        return QueryBuilder::for(Product::class)
            ->allowedFilters(['name', 'barcode'])
            ->allowedSorts(['name', 'created_at', 'updated_at'])
            ->jsonPaginate();
    }

    public function store(CreateProductRequest $request) {
        $product = Product::create($request->validated());

        return new ProductResource($product);
    }

    public function show(Product $product) {
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product) {
        $data = $request->validated();
        $product->update($data);

        return new ProductResource($product);
    }

    public function destroy(Product $product) {
        $product->delete();

        return response()->noContent();
    }
}
