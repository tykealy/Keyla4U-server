<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Court_category;
use Session;
use File;
use Illuminate\Support\Facades\Validator;

class CourtCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Court_category::where('user_id', '=', Auth::id())->paginate('5');

        return view('court_category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('court_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|max:50|min:3',
            
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }


        $record = new Court_category();
        $record->category_name = $request->category_name;
        $record->user_id = Auth::id();
        $record->save();

        Session::flash('category_create', 'Successfully created category!');
        return redirect('court_category/create');
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
        $category = Court_category::find($id);
        return view('court_category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     * 
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|max:50|min:3',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }


        $record = Court_category::find($id);
        $record->category_name = $request->category_name;
        $record->user_id = Auth::id();
        $record->save();
        Session::flash('category_update', 'Successfully updated category!');
        return redirect('court_category/'.$record->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $record = Court_category::find($id);

        $record->delete();
        return back();
    }
}
