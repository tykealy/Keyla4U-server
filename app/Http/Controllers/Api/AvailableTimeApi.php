<?php

namespace App\Http\Controllers\Api;

use App\Models\Pitch_avalible_time;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;


class availableTimeApi extends Controller
{
    public function index($pitchID, $WeekDay)
    {
        $avalibleTimes = Pitch_avalible_time::where('pitch_id', $pitchID)
            ->where('week_day', $WeekDay)
            ->select('id', "start_time", 'end_time', 'availability')->get();
        return response()->json($avalibleTimes);
    }

    public function book(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'pitch_id' => ['required', 'integer'],
            'week_day' => ['required', 'date_format:Y-m-d'],
            'id' => ['required', 'array'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors());
        }

        Pitch_avalible_time::where('pitch_id', $request->pitch_id)
            ->where('week_day', $request->week_day)
            ->whereIn('id', $request->id)
            ->update(['availability' => 0]);

        return response()->json($request->all(), 200);
    }
}
