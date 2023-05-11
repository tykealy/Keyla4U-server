<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Court_category;
use App\Models\Pitch;
use App\Models\Court;
Use App\Models\Club;
use File;
use Validator;

class PitchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $club = Club::where('user_id', '=', Auth::id())->first();
        $courts = Court::where('club_id', '=', $club->id)->get();
        $pitches = [];
        for ($i = 0; $i < count($courts); $i++) {
            $pitches[] = Pitch::where('court_id', '=', $courts[$i]->id)->get();
        }
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
        return back();
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
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pitch= Pitch::find($id);
        $pitch->delete();
        return back();
    }
}
