<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Club;

class LocationApi extends Controller
{
    public function index()
    {
        $locations = Club::select('location')->distinct()->get();
        return response()->json($locations);
    }
}
