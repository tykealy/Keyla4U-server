<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\User;
use App\Models\Club_category;

class ClubApi extends Controller
{
    public function index()
    {
        $location = request()->location;

        if ($location == 'all') {
            $clubs = Club::join('users', 'clubs.user_id', '=', 'users.id')
                ->select('clubs.id', 'clubs.name', 'clubs.map', 'clubs.image', 'users.phone', 'clubs.description', 'clubs.location')
                ->get();
            return response()->json($clubs);
        } else {
            $clubs = Club::join('users', 'clubs.user_id', '=', 'users.id')
                ->select('clubs.id', 'clubs.name', 'clubs.map', 'clubs.image', 'users.phone', 'clubs.description', 'clubs.location')
                ->where('clubs.location', 'like', '%' . $location . '%')
                ->get();
            return response()->json($clubs);
        }
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
