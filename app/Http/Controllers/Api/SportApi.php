<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Court_category;

class SportApi extends Controller
{
    public function index()
    {
        $sports = Court_category::select('category_name')->distinct()->get();
        return response()->json($sports);
    }
}
