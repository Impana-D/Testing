<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProspectPurchaseRequest;
use App\Models\ProspectPurchase;
use App\Models\ProspectPurchaseDay;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
 
class ProspectPurchaseController extends Controller
{
    public function create()
    {
        if (!session()->has('prospect_id')) {
            return redirect()->route('prospect.personal.create')
                ->with('error', 'Please complete previous steps first.');
        }

        return view('prospect.purchase');
    }

    public function store(StoreProspectPurchaseRequest $request)
    {
        $isApi = $request->is('api/*');

        DB::beginTransaction();

        try {
            $validated = $request->validated();

            // Attach prospect_id from session ONLY for web
            if (!$isApi) {
                $validated['prospect_id'] = session('prospect_id');
            }

            $purchase = ProspectPurchase::create($validated);

            if ($request->has('days')) {
                foreach ($request->days as $day) {
                    ProspectPurchaseDay::create([
                        'prospect_purchase_id' => $purchase->id,
                        'day' => $day,
                    ]);
                }
            }

            DB::commit();

            // ✅ WEB RESPONSE
            if (!$isApi) {
                return redirect()->route('prospect.personal.create')
                    ->with('success', 'Prospect completed successfully!');
            }

            // ✅ API RESPONSE (unchanged)
            return response()->json([
                'status' => true,
                'message' => config('messages.prospect_purchase.created'),
                'data' => $purchase->load('days'),
            ], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Prospect purchase create failed', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'file'  => $e->getFile(),
            ]);

            // Web error
            if (!$isApi) {
                return back()->withInput()
                    ->with('error', 'Something went wrong.');
            }

            // API error
            return response()->json([
                'status' => false,
                'message' => config('messages.prospect_purchase.failed'),
            ], 500);
        }
    }
}
