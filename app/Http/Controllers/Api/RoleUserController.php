<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleUserRequest;
use App\Models\RoleUser;

class RoleUserController extends Controller
{
    public function store(StoreRoleUserRequest $request)
    {
        $roleUser = RoleUser::create($request->validated());

        return response()->json([
            'status'  => true,
            'message' => config('messages.role_user.assigned'),
            'data'    => $roleUser,
        ], 201);
    }
}
