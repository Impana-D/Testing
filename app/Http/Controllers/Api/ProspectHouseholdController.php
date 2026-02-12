<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProspectHouseholdRequest;
use App\Models\ProspectHousehold;
use Illuminate\Support\Facades\Log;

class ProspectHouseholdController extends Controller
{
    /**
     * Show the Household form (Web)
     */
    public function create()
    {
        return view('prospect.household'); // your household blade
    }

    /**
     * Store Household data (Web + API)
     */
    public function store(StoreProspectHouseholdRequest $request)
    {
        try {
            $isApi = $request->is('api/*');

            // Get validated data from the FormRequest
            $data = $request->validated();

            // Add auto_tags for household
            $data['auto_tags'] = $request->autoTags();

            // For Web, you can ensure numeric defaults if needed
            if (!$isApi) {
                foreach (['household_size','male_count','female_count','infants','children','adults','seniors'] as $field) {
                    $data[$field] = $data[$field] ?? 0;
                }
            }

            // Insert into DB
            $household = ProspectHousehold::create($data);

            // Web → redirect to next step
            if (!$isApi) {
                return redirect()->route('prospect.preferences.create') // blade for next step
                    ->with('success', config('messages.prospect_household.created'));
            }

            // API → return JSON
            return response()->json([
                'status'  => true,
                'message' => config('messages.prospect_household.created'),
                'data'    => $household,
            ], 201);

        } catch (\Exception $e) {
            Log::error('ProspectHousehold create failed', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'file'  => $e->getFile(),
            ]);

            if (!$request->expectsJson()) {
                return back()->withInput()->withErrors([
                    'error' => config('messages.prospect_household.failed')
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => config('messages.prospect_household.failed'),
            ], 500);
        }
    }
}
