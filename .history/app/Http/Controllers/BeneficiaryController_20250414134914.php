<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Beneficiary;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function getActiveBeneficiariesSansCache()
    {
        DB::enableQueryLog();

        $start = microtime(true);

        $beneficiaries = Beneficiary::where('status', 'active')->paginate(1000);

        $duration = microtime(true) - $start;

        $queries = DB::getQueryLog();
        return response()->json([
            'duration_ms' => $duration * 1000,
            'count' => $beneficiaries->count(),
            'queries' => $queries,
            'data' => $beneficiaries

        ]);
    }

    public function getActiveBeneficiariesWithCache()
    {
        DB::enableQueryLog();
        $start = microtime(true);

        $beneficiaries = Cache::remember('active_beneficiaries', 600, function () {
            return Beneficiary::where('status', 'active')->paginate(1000);
        });

        $duration = microtime(true) - $start;
        $queries = DB::getQueryLog();
        return response()->json([
            'duration_ms' => $duration * 1000,
            'count' => $beneficiaries->count(),
            'queries' => $queries,
            'data' => $beneficiaries

        ]);
    }

    public function updateBeneficiaryInvalidateCache(Request $request, $id)
    {
        $beneficiary = Beneficiary::findOrFail($id);

        $beneficiary->update($request->only(['name', 'status', 'registration_date']));

        // Invalidate the cache
        Cache::forget('active_beneficiaries');

        return response()->json([
            'message' => 'Beneficiary updated and cache cleared.',
            'beneficiary' => $beneficiary
        ]);
    }
}