<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClubUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Models\Club;
use File;
use Session;
use Illuminate\Support\Facades\Validator;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $club = Club::where('user_id', Auth::id())->latest()->first();

        // Pass the record to the view
        return view('club.club', ['club' => $club]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect('/club');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|min:3',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'map' => 'required|min:3',
            'location' => 'required|min:3|max:50|',
            'description' => 'required',
        ]);


        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }


        $image = $request->file('image');
        $upload = 'img/';
        $filename = time() . $image->getClientOriginalName();
        move_uploaded_file($image->getPathName(), $upload . $filename);

        // Create a new record in the database
        $record = new Club();
        $record->name = $request->name;
        $record->image = $filename;
        $record->map = $request->map;
        $record->description = $request->description;
        $record->location = $request->location;
        $record->user_id = Auth::id();
        $record->save();

        Session::flash('club_create', 'Club successfully created!');

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
        return view('club.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'max:50|min:3',
            'image' => 'mimes:jpg,jpeg,png,gif',
            'map' => 'min:3',
            'location' => 'min:3|max:50|',
            'description' => '',
        ]);


        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $club = Club::where('user_id', $id)->first();

        if ($request->hasFile('image')) {
            // Handle file upload
            $image = $request->file('image');
            $upload = 'img/';
            $filename = time() . $image->getClientOriginalName();
            move_uploaded_file($image->getPathName(), $upload . $filename);
            $club->image = $filename;
        }

       
        if ($request->has('name')) {
            $club->name = $request->input('name');
        }

        if ($request->hasFile('image')) {
            // Handle file upload
            $club->image = $filename;
        }

        if ($request->has('map')) {
            $club->map = $request->input('map');
        }

        if ($request->has('location')) {
            $club->location = $request->input('location');
        }

        if ($request->has('description')) {
            $club->description = $request->input('description');
        }

        $club->user_id = Auth::id();
        $club->save();

        Session::flash('club_create', 'Club successfully updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
