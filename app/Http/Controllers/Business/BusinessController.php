<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\CreateBusinessRequest;
use App\Http\Requests\Business\UpdateBusinessRequest;
use App\Http\Resources\Business\BusinessResource;
use App\Models\Business\Business;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class BusinessController extends Controller {
    /* Solicita los negocios del usuario */
    public function index(Request $request) {
        $user = $request->user();

        return QueryBuilder::for($user->businesses())
            ->allowedFilters(['name', 'description'])
            ->allowedSorts(['name', 'created_at', 'updated_at'])
            ->jsonPaginate();
    }

    /* Crea un nuevo negocio. Por ahora solo puede ser uno por usuario. */
    public function store(CreateBusinessRequest $request) {
        $user = $request->user();
        if ($user->businesses()->count() > 0) {
            return response()->json([
                'message' => __('Lo sentimos, pero ya tienes un negocio registrado.'),
            ], 400);
        }

        $data = $request->validated();

        $business = tap(Business::create(array_merge($data['business'], [
            'user_id' => $user->id,
        ])), fn (Business $business) => $business->address()->create($data['address']));

        return new BusinessResource($business);
    }

    /* Muestra el negocio, pero primero verifica que sea del usuario. */
    public function show(Request $request, Business $business) {
        $user = $request->user();
        if (!$business->isOwnedBy($user)) {
            return response()->json([
                'message' => __('No tienes permisos para ver este negocio.'),
            ], 403);
        }

        return new BusinessResource($business);
    }

    /* Actualiza el negocio, pero primero verifica que sea del usuario. */
    public function update(UpdateBusinessRequest $request, Business $business) {
        $user = $request->user();
        if (!$business->isOwnedBy($user)) {
            return response()->json([
                'message' => __('No tienes permisos para ver este negocio.'),
            ], 403);
        }

        $data = $request->validated();
        if (isset($data['address'])) {
            $business->address()->update($data['address']);
        }

        if (isset($data['business'])) {
            $business->update($data['business']);
        }

        return new BusinessResource($business);
    }

    /* Destruye el negocio si le pertenece al usuario que realizó la solicitud */
    public function destroy(Request $request, Business $business) {
        $user = $request->user();
        if (!$business->isOwnedBy($user)) {
            return response()->json([
                'message' => __('No tienes permisos para ver este negocio.'),
            ], 403);
        }

        $business->delete();

        return response()->noContent();
    }
}
