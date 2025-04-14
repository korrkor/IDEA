<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function getActiveBeneficiariesSansCache()
    {
        $start = microtime(true);

        $beneficiaries = Beneficiary::where('status', 'active')->get();

        $duration = microtime(true) - $start;

        return response()->json([
            'duration_ms' => $duration * 1000,
            'count' => $beneficiaries->count(),
            'data' => $beneficiaries
        ]);
    }
}