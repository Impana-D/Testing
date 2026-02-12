<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Models\City;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    public function store(StoreCityRequest $request)
    {
        try {
            // Create city
            $city = City::create([
                'state_id' => $request->state_id,
                'name'     => $request->name,
               // 'status'   => $request->status ?? null, // defaults to 'Active' from model
            ]);

            return response()->json([
                'status'  => true,
                'message' => config('messages.city.created'), // config message for success
                'data'    => $city,
            ], 201);

        } catch (\Exception $e) {

            Log::error('City create failed', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status'  => false,
                'message' => config('messages.city.failed'), // config message for failure
            ], 500);
        }
    }
}
