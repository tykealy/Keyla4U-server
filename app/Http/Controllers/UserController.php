<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account_types;
use Session;
use Validator;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->sortBy('account_role_id');

        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_types = array();
        foreach(Account_types::all() as $user_type){
            $user_types[$user_type->role_id] = $user_type->role_name;
        }
        return view('user.create')->with('user_types',$user_types);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:30|min:3',
            'last_name' => 'required|max:30|min:3',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email',
            'account_role_id' => 'required',
            'password' => 'required|min:8'
        ]);

        foreach(User::all() as $user){
            if($user->email == $request->email){
                return redirect('user/create')
                ->withInput()
                ->withErrors(['email' => 'Email already exists.']);
            }
        }
          
        if ($validator->fails()) {
            return redirect('user/create')
                ->withInput()
                ->withErrors($validator);
        }
    
        // Create The user
    
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->account_role_id = $request->account_role_id;
        $user->password = Hash::make( $request->password);
        $user->save();
        Session::flash('user_create','New data is created.');
        return redirect('user/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.show')->with('user', User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $user_types = array();

        foreach(Account_types::all() as $user_type){
            $user_types[$user_type->role_id] = $user_type->role_name;
        }
                             
        return view('user.edit')->with('user',$user)->with('user_types', $user_types);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:30|min:3',
            'last_name' => 'required|max:30|min:3',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email',
            'account_role_id' => 'required',
        ]);
          
        foreach(User::all() as $user){

            if($user->email == $request->email && $user->id != $id){
                return redirect('user/update')
                ->withInput()
                ->withErrors(['email' => 'Email already exists.']);
            }
        }

        if ($validator->fails()) {
            return redirect('user/create')
                ->withInput()
                ->withErrors($validator);
        }

        $user = User::find($id);
		// Create The Post
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->account_role_id = $request->account_role_id;
        $user->save();
		Session::flash('user_update','Data is updated ('.$user->first_name.' '. $user->last_name.')');
		return redirect('user/'.$user->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('user_delete','Data is deleted ('.$user->first_name.' '.$user->last_name.')');
    	return redirect('user');
    }

    public function getBySearch(Request $request){
        
        $keyword = !empty($request->keyword) ? $request->keyword : "";

        if($keyword != ""){
            $users = User::where('first_name','LIKE','%'.$keyword.'%')->orWhere('last_name','LIKE','%'.$keyword.'%')->get()->sortBy('account_role_id');
        }else{
            $users = User::all()->sortBy('account_role_id');
        }                  

        return view('user.index')->with('users', $users);
    }
}           
