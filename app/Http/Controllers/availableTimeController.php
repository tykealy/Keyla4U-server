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
            'court_id' => 'required|exists:court,id',
        ]);

        $club = Club::where('user_id', '=', Auth::id())->first();
        $courts = Court::where('club_id', '=',$club->id)->get();

        $pitches = Pitch::where('court_id', '=', $request->court_id)->get();
        return view('available_pitch.pitch_available_time')->with('courts', $courts)->with('pitches', $pitches);
    }


    public function getDate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pitch_id' => 'required|exists:pitch,id',
        ]);

        $club = Club::where('user_id', '=', Auth::id())->first();
        $courts = Court::where('club_id', '=',$club->id)->get();

        $court_id = Pitch::where('id', '=', $request->pitch_id)->first();
        $pitches = Pitch::where('court_id', '=', $court_id->court_id)->get();

        $date = Pitch_avalible_time::where('pitch_id', '=', $request->pitch_id)
                ->select('week_day')
                ->distinct()
                ->get();
        
        return view('available_pitch.pitch_available_time')
            ->with('courts', $courts)
            ->with('pitches', $pitches)
            ->with('dates', $date)
            ->with('pitch_id', $request->pitch_id);
    }

    public function getAvailableTime(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|exists:Pitch_avalible_time,week_day',
            'pitch_id' => 'required|exists:Pitch,id',
        ]);

        //get all courts
        $club = Club::where('user_id', '=', Auth::id())->first();
        $courts = Court::where('club_id', '=',$club->id)->get();

        //get all pitches
        $court_id = Pitch::where('id', '=',$request->pitch_id)->select('court_id')->first();
        $pitches = Pitch::where('court_id', '=', $court_id)->get();


        //get all date that relate to the pitch
        $date = Pitch_avalible_time::where('pitch_id', '=', $request->pitch_id)
                ->select('week_day')
                ->distinct()
                ->get();
        
        $availableTime = Pitch_avalible_time::where('week_day', '=', $request->date)
            ->where('availability', '=', 1)
            ->where('pitch_id', '=', $request->pitch_id)
            ->select('start_time','end_time')
            ->get();

        $unavailableTime = Pitch_avalible_time::where('week_day', '=', $request->date)
            ->where('availability', '=', 0)
            ->where('pitch_id', '=', $request->pitch_id)
            ->select('start_time','end_time')
            ->get();
        
        return view('available_pitch.pitch_available_time')
            ->with('courts', $courts)
            ->with('pitches', $pitches)
            ->with('dates', $date)
            ->with('availableTimes', $availableTime)
            ->with('unavailableTimes', $unavailableTime)
            ->with('pitch_id', $request->pitch_id);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
