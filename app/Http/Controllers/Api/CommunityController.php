<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommunityRequest;
use App\Models\Community;
use Illuminate\Support\Facades\Log;

class CommunityController extends Controller
{
    public function store(StoreCommunityRequest $request)
    {
        try {
            $community = Community::create([
                'city_id'        => $request->city_id,
                'community_name' => $request->community_name,
                'status'         => $request->status ?? \App\Enums\Status::Active->value, // default
            ]);

            return response()->json([
                'status'  => true,
                'message' => config('messages.community.created'), // add this key in config/messages.php
                'data'    => $community,
            ], 201);

        } catch (\Exception $e) {
            Log::error('Community create failed', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'file'  => $e->getFile()
            ]);

            return response()->json([
                'status'  => false,
                'message' => config('messages.community.failed'), // add this key in config/messages.php
            ], 500);
        }
    }
}
