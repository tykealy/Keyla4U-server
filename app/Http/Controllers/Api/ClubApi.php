<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Court_category;


class ClubApi extends Controller
{
    public function index()
    {
        $clubs = Club::join('users', 'clubs.user_id', '=', 'users.id')
            ->select('clubs.id', 'clubs.name', 'clubs.map', 'clubs.image', 'users.phone', 'clubs.description', 'clubs.location', "user_id")
            ->get();

        foreach ($clubs as $club) {
            $categries =  Court_category::where('user_id', "=", $club->user_id)->pluck('category_name');
            $club->categories = $categries;
        };
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
