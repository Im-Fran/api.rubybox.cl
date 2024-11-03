<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Resources\Business\BusinessCategoryResource;
use App\Models\Business\BusinessCategory;
use Illuminate\Http\Request;

class BusinessCategoryController extends Controller {
    public function index() {
        return BusinessCategoryResource::collection(BusinessCategory::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'parent_id' => ['nullable'],
            'business_id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
        ]);

        return new BusinessCategoryResource(BusinessCategory::create($data));
    }

    public function show(BusinessCategory $businessCategory) {
        return new BusinessCategoryResource($businessCategory);
    }

    public function update(Request $request, BusinessCategory $businessCategory) {
        $data = $request->validate([
            'parent_id' => ['nullable'],
            'business_id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
        ]);

        $businessCategory->update($data);

        return new BusinessCategoryResource($businessCategory);
    }

    public function destroy(BusinessCategory $businessCategory) {
        $businessCategory->delete();

        return response()->json();
    }
}
