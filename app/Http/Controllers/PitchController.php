<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Court_category;
use App\Models\Pitch;
use App\Models\Court;
Use App\Models\Club;
Use App\Models\Pitch_avalible_time;
use File;
use Validator;
use Carbon\Carbon;
use Session;
class PitchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $club = Club::where('user_id', '=', Auth::id())->first();

        $pitches = DB::table('pitches')
            ->join('courts', 'pitches.court_id', '=', 'courts.id')
            ->join('court_categories', 'courts.court_category_id', '=', 'court_categories.id')
            ->where('courts.club_id', '=', $club->id)
            ->select(
                'pitches.*',
                'court_categories.category_name'
            )
            ->paginate(3);

        return view('pitch.index', ['pitches' => $pitches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $club = Club::where('user_id', '=', Auth::id())->first();
        $courts = Court::where('club_id', '=',$club->id)->get();
        return view('pitch.create')->with('courts', $courts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'court_id' => 'required|exists:courts,id',
            'pitch_num' => 'required|max:3|min:3',
            'size' => 'required|max:50'
        ]);
    
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }
         
        $record = new Pitch();
        $record->court_id = $request->court_id;
        $record->pitch_num = $request->pitch_num;
        $record->size = $request->size;
        $record->save();

        
        // retrieve court open and close time
        $court = Court::find($request->court_id);
        $openTime = Carbon::parse($court->open_time);
        $closeTime = Carbon::parse($court->close_time);

        // create available time for pitch record each day of the week starting from today
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->addDays($i);
            //$dayOfWeek = $date->dayOfWeek;
            $dayOfWeek = $date;
            for ($time = $openTime->copy(); $time->lessThan($closeTime); $time->addHour()) {
                // create available time slot for this day and time
                $availableTime = new Pitch_avalible_time();
                $availableTime->pitch_id = $record->id;
                $availableTime->week_day = $dayOfWeek;
                $availableTime->availability = true;
                $availableTime->start_time = $time->format('H:i:s');
                $availableTime->end_time = $time->copy()->addHour()->format('H:i:s');
                $availableTime->save();
            }
        }

        Session::flash('pitch_create', 'Successfully created pitch!');
        return redirect('pitch/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $club = Club::where('user_id', '=', Auth::id())->first();
        $courts = Court::where('club_id', '=',$club->id)->get();
        $pitch = Pitch::find($id);
        return view('pitch.edit')->with('pitch', $pitch)->with('courts', $courts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'court_id' => 'required|exists:courts,id',
            'pitch_num' => 'required|max:3|min:3',
            'size' => 'required|max:50'
        ]);
    
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }
         
        $record = Pitch::find($id);
        if ($request->has('court_id')) {
            $record->court_id = $request->input('court_id');
        }
        if ($request->has('pitch_num')) {
            $record->pitch_num = $request->input('pitch_num');
        }
        if ($request->has('size')) {
            $record->size = $request->input('size');
        }
        
        $record->save();

        Session::flash('pitch_update', 'Successfully updated pitch!');
        return redirect('pitch/'.$record->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pitch= Pitch::find($id);

        $time = Pitch_avalible_time::where('pitch_id', $pitch->id);
                    
        $time->delete();

        $pitch->delete();
        return back();
    }
}
