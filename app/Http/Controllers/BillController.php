<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tariff;
use App\Models\TariffRange;
use App\Models\Purpose;

class BillController extends Controller
{
    public function index()
    {
        $tariffs = Tariff::all();
        $purposes = Purpose::where('name', 'Domestic')->get();
        return view('bill', compact('tariffs', 'purposes'));
    }

    public function calculate(Request $request)
    {
        $consumedUnits = $request->input('consumed_units');
        $tariffId = $request->input('tariff');
        $tariff = Tariff::find($tariffId);

        if (!$tariff) {
            return response()->json(['error' => 'Tariff not found'], 404);
        }

        $charge = $this->calculateCharge($consumedUnits, $tariff);

        return response()->json(['charge' => $charge]);
    }

    private function calculateCharge($units, $tariff)
    {
        $charge = 0;

        if ($units > 250) {
            // Non-Telescopic Billing for units greater than 250
            $charge = $units * $tariff->flat_rate;
        } else {
            // Telescopic Billing
            $ranges = TariffRange::where('tariff_id', $tariff->id)
                ->orderBy('start_units')
                ->get();

            $previousEnd = 0;

            foreach ($ranges as $range) {
                if ($units > $previousEnd) {
                    $currentStart = max($range->start_units, $previousEnd + 1);
                    $currentEnd = $range->end_units ?? $units;

                    if ($units <= $currentEnd) {
                        $charge += ($units - $currentStart + 1) * $range->rate;
                        break;
                    } else {
                        $charge += ($currentEnd - $currentStart + 1) * $range->rate;
                    }

                    $previousEnd = $currentEnd;
                }
            }
        }

        return $charge;
    }
}
