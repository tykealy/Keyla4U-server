<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use File;
use Validator;

use App\Models\Court;
use App\Models\Club;
use App\Models\Pitch;
use App\Models\Pitch_avalible_time;

class availableTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $club = Club::where('user_id', '=', Auth::id())->first();
        $courts = Court::where('club_id', '=',$club->id)->get();
        return view('available_pitch.pitch_available_time')->with('courts', $courts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getPitch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'court' => 'required|exists:court,id',
        ]);

        $court = $request->input('court');
        // Query the database to get the available pitches for the selected court
        $pitches = Pitch::where('court_id','=', $court)->pluck('pitch_num', 'id');

        return response()->json($pitches);
    }


    public function getDate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pitch' => 'required|exists:pitch,id',
        ]);

        // Query the database to get the date for the selected pitch
        $date = Pitch_avalible_time::where('pitch_id', '=', $request->pitch)
                ->select('week_day')
                ->distinct()
                ->pluck('week_day','week_day');

        return response()->json($date);

    }

    public function getAvailableTime(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|exists:Pitch_avalible_time,week_day',
            'pitch' => 'required|exists:Pitch,id',
        ]);

        
        $availableTime = Pitch_avalible_time::where('week_day', '=', $request->date)
            ->where('pitch_id', '=', $request->pitch)
            ->select('start_time','end_time','availability')
            ->get();

        return response()->json(['availableTime' => $availableTime]);
    }
    
}
