<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\CreateBusinessRequest;
use App\Http\Requests\Business\UpdateBusinessRequest;
use App\Http\Resources\Admin\BusinessResource;
use App\Models\Business\Business;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class BusinessController extends Controller {

    public function index(Request $request)
    {
        return QueryBuilder::for(Business::class)
            ->allowedFilters(['name', 'description'])
            ->allowedSorts(['name', 'created_at', 'updated_at'])
            ->jsonPaginate();
    }

    public function store(CreateBusinessRequest $request) {
        $data = $request->validated();
        $business = Business::create($data);

        return new BusinessResource($business);
    }

    public function show(Business $business) {
        return new BusinessResource($business);
    }

    public function update(UpdateBusinessRequest $request, Business $business) {
        $data = $request->validated();
        $business->update($data);

        return new BusinessResource($business);
    }

    public function destroy(Business $business) {
        $business->delete();

        return response()->noContent();
    }
}
