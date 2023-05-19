<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\User;

class ClubApi extends Controller
{
    public function index()
    {
        // $clubs = Club::select('id', 'name', 'map', 'image')->get();

        $clubs = Club::join('users', 'clubs.user_id', '=', 'users.id')
            ->select('clubs.id', 'clubs.name', 'clubs.map', 'clubs.image', 'users.phone', 'clubs.description', 'clubs.location')
            ->get();
        return response()->json($clubs);
    }

    public function show($id)
    {
        $club = Club::join('users', 'clubs.user_id', '=', 'users.id')
            ->select('clubs.id', 'clubs.name', 'clubs.map', 'clubs.image', 'users.phone')
            ->where('clubs.id', $id)
            ->first();
        return response()->json($club);
    }
}
