<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\Category\CreateBusinessCategoryRequest;
use App\Http\Requests\Business\Category\UpdateBusinessCategoryRequest;
use App\Http\Resources\Business\BusinessCategoryResource;
use App\Models\Business\Business;
use App\Models\Business\BusinessCategory;

class BusinessCategoryController extends Controller {
    public function index(Business $business) {
        if (!$business->isOwnedBy(auth()->user())) {
            abort(403);
        }

        return BusinessCategoryResource::collection($business->categories);
    }

    public function store(Business $business, CreateBusinessCategoryRequest $request) {
        return new BusinessCategoryResource($business->categories()->create($request->validated()));
    }

    public function show(Business $business, BusinessCategory $category) {
        if (!$business->isOwnedBy(auth()->user())) {
            abort(403);
        }

        return new BusinessCategoryResource($category);
    }

    public function update(Business $business, BusinessCategory $category, UpdateBusinessCategoryRequest $request) {
        $category->update($request->validated());

        return new BusinessCategoryResource($category);
    }

    public function destroy(Business $business, BusinessCategory $category) {
        if (!$business->isOwnedBy(auth()->user())) {
            abort(403);
        }

        $category->delete();

        return response()->noContent();
    }
}
