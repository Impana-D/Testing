<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users; 
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $user = Users::create([
            'name'   => $request->name,
            'email'  => $request->email,
            'mobile' => $request->mobile,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => config('messages.user.created'),
            'data'    => $user,
        ], 201);
    }
}
