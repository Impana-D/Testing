<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStateRequest;
use App\Models\State;
use Illuminate\Support\Facades\Log;

class StateController extends Controller
{
public function store(StoreStateRequest $request)
{
    try {
        // Only 'name' comes from the request
        $state = State::create([
            'name' => $request->name,
            // 'status' will default to Active from the model
        ]);

        return response()->json([
            'status'  => true,
            'message' => config('messages.state.created'),
            'data'    => $state,
        ], 201);

    } catch (\Exception $e) {

        Log::error('State create failed', [
            'error' => $e->getMessage()
        ]);

        return response()->json([
            'status'  => false,
            'message' => config('messages.state.failed'),
        ], 500);
    }
}

}
