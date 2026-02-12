<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRolesRequest;
use App\Models\Roles;

class RolesController extends Controller
{
    public function store(StoreRolesRequest $request)
    {
        $role = Roles::create($request->validated());

        return response()->json([
            'status'  => true,
            'message' => config('messages.role.created'),
            'data'    => $role,
        ], 201);
    }
}
