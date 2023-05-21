<?php

namespace App\Http\Controllers\Api;

use App\Models\Pitch;
use App\Models\Pitch_avalible_time;
use Illuminate\Routing\Controller;
use Ramsey\Collection\Sort;

class PitchApi extends Controller
{
    public function index($courtID)
    {
        $pitches = Pitch::where('court_id', $courtID)->get();

        foreach ($pitches as $pitch) {
            $availableDays = Pitch_avalible_time::where('pitch_id', $pitch->id)->select('week_day')->distinct()->orderBy('week_day', 'desc')->limit(7)->pluck('week_day')->toArray();
            sort($availableDays);
            $pitch->availableDays = $availableDays;
        }
        return response()->json($pitches);
    }
}
