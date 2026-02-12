<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProspectPreferenceRequest;
use App\Models\ProspectPreference;
use App\Models\ProspectPreferencesCuisine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProspectPreferenceController extends Controller
{
    /**
     * Show the Web form for prospect preferences
     */
public function create()
{
    if (!session()->has('prospect_id')) {
        return redirect()->route('prospect.personal.create')
            ->with('error', 'Please complete Step 1 first.');
    }

    $cuisines = \App\Models\Cuisine::all();

    return view('prospect.preference', compact('cuisines'));
}


    /**
     * Store Preferences (Web + API)
     */
    public function store(StoreProspectPreferenceRequest $request)
    {
        // Detect if request is API
        $isApi = $request->is('api/*');

        DB::beginTransaction(); // Start transaction

        try {
            // 1️⃣ Create main prospect preference record
            $preference = ProspectPreference::create($request->validated());

            // 2️⃣ Insert cuisines if provided
            if ($request->has('cuisine_id') && is_array($request->cuisine_id)) {
                $cuisines = [];
                foreach ($request->cuisine_id as $cuisineId) {
                    $cuisines[] = [
                        'prospect_preferences_id' => $preference->id,
                        'cuisine_id' => $cuisineId,
                    ];
                }
                ProspectPreferencesCuisine::insert($cuisines);
            }

            DB::commit(); // Commit transaction

            if (!$isApi) {
                // Web → redirect to next step (or success page)
               return redirect()->route('prospect.purchase.create')
                ->with('success', 'Preferences saved successfully.');
            }

            // API → return JSON
            return response()->json([
                'status'  => true,
                'message' => config('messages.prospect_preferences.created'),
                'data'    => $preference,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack(); // rollback on error

            Log::error('Prospect preference create failed', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'file'  => $e->getFile(),
            ]);

            if (!$isApi) {
                return back()->withInput()->with('error', config('messages.prospect_preferences.failed'));
            }

            return response()->json([
                'status'  => false,
                'message' => config('messages.prospect_preferences.failed'),
            ], 500);
        }
    }
}
