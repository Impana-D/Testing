<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProspectPersonalRequest;
use App\Models\ProspectPersonal;
use Illuminate\Support\Facades\Log;
use App\Enums\Status;

class ProspectPersonalController extends Controller
{
    /**
     * Show the Prospect Personal form (Web only)
     */
    public function create()
    {
        $customers = \App\Models\User::all();
        $communities = \App\Models\Community::all();

        return view('prospect.personal', compact('customers', 'communities'));
    }

    /**
     * Store Prospect Personal data (Web + API)
     */
    public function store(StoreProspectPersonalRequest $request)
    {
        try {
            // Detect if this is API request
            $isApi = $request->is('api/*');

            // Check if user with same mobile exists
            $latestUser = ProspectPersonal::where('mobile', $request->mobile)
                ->orderBy('version', 'desc')
                ->first();

            $version = 1;
            $status  = Status::Active->value;

            if ($latestUser) {
                $version = $latestUser->version + 1;
                $status = $isApi ? Status::Inactive->value : Status::Active->value;
            }

            // Create ProspectPersonal record
            $prospect = ProspectPersonal::create([
                'name'          => $request->name,
                'mobile'        => $request->mobile,
                'customer_id'   => $request->customer_id,
                'flat_no'       => $request->flat_no ?: '-',
                'floor'         => $request->floor ?: '-',
                'block_street'  => $request->block_street ?: '-',

                // Web → NULL for numeric, API → use API values
                'gps_location'  => $isApi ? $request->gps_location : '-',
                'latitude'      => $isApi ? $request->latitude : null,
                'longitude'     => $isApi ? $request->longitude : null,

                // Remarks → Web uses "-" if empty
                'remarks'       => $isApi ? $request->remarks : ($request->remarks ?: '-'),

                'version'       => $version,
                'status'        => $status,
                'community_id'  => $request->community_id,
            ]);

            // ✅ For Web → save prospect_id in session and redirect to household
            if (!$isApi) {
                session(['prospect_id' => $prospect->id]);

                return redirect()->route('prospect.household.create')
                    ->with('success', config('messages.prospect_personal.created'));
            }

            // ✅ For API → return JSON
            return response()->json([
                'status'  => true,
                'message' => config('messages.prospect_personal.created'),
                'data'    => $prospect,
            ], 201);

        } catch (\Exception $e) {
            Log::error('ProspectPersonal create failed', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'file'  => $e->getFile(),
            ]);

            if (!$request->expectsJson()) {
                return back()->withInput()->withErrors([
                    'error' => config('messages.prospect_personal.failed')
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => config('messages.prospect_personal.failed'),
            ], 500);
        }
    }
}
