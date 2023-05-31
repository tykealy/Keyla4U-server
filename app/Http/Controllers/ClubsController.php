<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\User;
use Session;
use Validator;
use File;

class ClubsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clubs = Club::orderBy('name')->paginate(4);

        return view('clubs.index', [
            'clubs' => $clubs,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $users = array();
        $admins = User::where('account_role_id','1')->get()->sortBy('first_name');

        foreach($admins as $user){
      
            $users[$user->id] = $user->first_name . ' ' . $user->last_name;
        }

        return view('clubs.create',['users' => $users]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'club_name' => 'required|max:30|min:3',
            'map' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
        ]);
          
        if ($validator->fails()) {
            return redirect('clubs/create')
                ->withInput()
                ->withErrors($validator);
        }
    
        // Create The club
        $image = $request->file('image');
        $upload = 'img/';
        $filename = time().$image->getClientOriginalName();
        move_uploaded_file($image->getPathName(), $upload. $filename);
    
        $club = new Club();
        $club->name = $request->club_name;
	    $club->user_id = $request->user_id;
        $club->map = $request->map;
        $club->image = $filename;
        $club->save();
        Session::flash('clubs_create','New data is created.');
        return redirect('clubs/create');
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
        $club = Club::find($id);
        $admins = User::where('account_role_id','1')->get()->sortBy('first_name');

        foreach($admins as $user){
            $users[$user->id] = $user->first_name . ' ' . $user->last_name;
        }

        return view('clubs.edit')->with('club', $club)->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        

        $validator = Validator::make($request->all(), [
            'club_name' => 'required|max:30|min:3',
            'image' => 'mimes:jpg,jpeg,png,gif',
            'map' => 'required',
        ]);

		if ($validator->fails()) {
			return redirect('clubs/'.$id.'/edit')
				->withInput()
				->withErrors($validator);
		}

        $club = Club::find($id);
        
		if($request->file('image') != ""){
            $image = $request->file('image');
            $upload = 'img/';
            $filename = time().$image->getClientOriginalName();
            move_uploaded_file($image->getPathName(), $upload . $filename);
		}
		
		$club->name = $request->club_name;
		$club->map = $request->map;
        $club->user_id = $request->user_id;

		if(isset($filename)){
		    $club->image = $filename;
		}

		$club->save();

		Session::flash('clubs_update','Data is updated ('.$club->name.')');
		return redirect('clubs/'.$club->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $club = Club::find($id);
        $image_path = 'img/'.$club->image;
        File::delete($image_path);
        $club->delete();
        Session::flash('club_delete','Data is deleted ('.$club->name.')');
    	return redirect('clubs');
    }

    public function getBySearch(Request $request) {

        $keyword = !empty($request->keyword) ? $request->keyword : "";

        if($keyword !=""){

            $clubs = Club::where('name', 'LIKE', '%'.$keyword.'%')->get();
            return view('clubs.index')->with('clubs', $clubs);

        }else{

            return view('clubs.index')->with('clubs', Club::all());

        }
    }

    public function createWithUserId(Request $request){
        
        $users = array();
        $admins = User::where('account_role_id','1')->get()->sortBy('first_name');

        foreach($admins as $user){

            $users[$user->id] = $user->first_name . ' ' . $user->last_name;
        }

        return view('clubs.create')->with('users', $users)->with('user_id', $request->user_id);
    }

}



