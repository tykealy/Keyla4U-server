<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Court_category;
use App\Models\Court;
Use App\Models\Club;
use File;
use Validator;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $club = Club::where('user_id', '=', Auth::id())->first();
        $courts = Court::where('club_id', '=',$club->id)->get();
        return view('court.index')->with('courts',$courts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Court_category::where('user_id', '=', Auth::id())->get();
        return view('court.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:court_categories,id',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:start_time',
            'unit_price' => 'required|numeric'
        ]);
    
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }
         
        $record = new Court();
        $record->court_category_id = $request->category_id;
        $record->open_time = $request->open_time;
        $record->close_time = $request->close_time;
        $record->unit_price = $request->unit_price;
        $club = Club::where('user_id', '=',Auth::id())->first();
        $record->club_id = $club['id'];
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
        //
        $court = Court::find($id);
        $categories = Court_category::where('user_id', '=', Auth::id())->get();
        return view('court.edit')->with('court', $court)->with('categories', $categories);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'category_id' => 'sometimes|exists:court_categories,id',
            'open_time' => 'sometimes|date_format:H:i',
            'close_time' => 'sometimes|date_format:H:i|after:start_time',
            'unit_price' => 'sometimes|numeric'
        ]);
    
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }
         
        $record = Court::find($id);
        if ($request->has('category_id')) {
            $record->court_category_id = $request->input('category_id');
        }

	    if ($request->has('open_time')) {
            $record->open_time = $request->input('open_time');
        }
    
        if ($request->has('close_time')) {
            $record->close_time = $request->input('close_time');
        }

        if ($request->has('unit_price')) {
            $record->close_time = $request->input('unit_price');
        }
        
        $club = Club::where('user_id', '=',Auth::id())->first();
        $record->club_id = $club['id'];
        $record->save();

        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $court = Court::find($id);
        $court->delete();
        return back();
    }
}
