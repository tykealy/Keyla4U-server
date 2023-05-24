<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use File;
use Validator;
use Carbon\Carbon;
use Session;

use App\Models\Order;
use App\Models\Club;
use App\Models\Pitch;
use App\Models\Court;
use App\Models\Pitch_avalible_time;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $club_id = Club::where('user_id', '=', Auth::id())->select('id')->first();
        $courts = Court::where('club_id','=',$club_id->id)->get();

        //get order list
        $order_list = collect();
        foreach($courts as $court){
            $pitchs = Pitch::where('court_id','=',$court->id)->get();
            foreach($pitchs as $pitch){
                $orders = Order::where('pitch_id','=',$pitch->id)->get();
                $order_list = $order_list->push($orders);
            }
        }
        $order_list = $order_list->flatten();

        
        return view('order.index')->with('order_list', $order_list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $club_id = Club::where('user_id','=',Auth::id())->select('id')->first();
        $courts = Court::where('club_id','=',$club_id->id)->get();
        return view('order.create')->with('courts', $courts);
    }

    // get the pitch for form
    public function orderPitch(Request $request){
        $validator = Validator::make($request->all(),[
            'court' => 'required|numeric|exists:courts,id',
        ]);

        $court = $request->input('court');

        // Query the database to get the available pitches for the selected court
        $pitches = Pitch::where('court_id','=', $court)->pluck('pitch_num', 'id');

        return response()->json($pitches);
    }

    // get the Play date for form
    public function orderDate(Request $request){
        $validator = Validator::make($request->all(),[
            'pitch' => 'required|numeric|exists:pitches,id',
        ]);

        $pitch_id = $request->input('pitch');

        // Query the database to get the available date for the selected pitch
        $date = Pitch_avalible_time::where('pitch_id', '=', $pitch_id)
                ->select('week_day')
                ->distinct()
                ->pluck('week_day', 'week_day');

        return response()->json($date);
    }

    // get the Play date for form
    public function orderStartTime(Request $request){
        $validator = Validator::make($request->all(), [
            'date' => 'required|exists:Pitch_avalible_time,week_day',
            'pitch' => 'required|exists:Pitch,id',
        ]);
        
        // Query the database to get the available time for the selected date
        $pitch_id = $request->input('pitch');
        $week_day = $request->input('date');
        $availableTime = Pitch_avalible_time::where('week_day', '=', $week_day)
            ->where('availability', '=', 1)
            ->where('pitch_id', '=', $pitch_id)
            ->pluck('start_time', 'start_time');

        return response()->json($availableTime);
    }

    /**
     * Store a newly created resource in storage.
     */
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            'court' => 'required|numeric|exists:courts,id',
            'pitch' => 'required|numeric|exists:pitches,id',
            'play_date' => 'required|exists:pitch_avalible_times,week_day',
            'start_time' => 'required',
            'status' => 'required',
            'payment_method' => 'required',
        ]);

        // $data = $request->all();
        // return $data;

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $user_id = User::where('email','=',$request->email)->value('id');
        $unit_price = Court::where('id',$request->court)->value('unit_price');
        $customer = User::where('id',$user_id)->first(['first_name','last_name','phone']);
       
        // find available time 
        $availableTime = Pitch_avalible_time::where('pitch_id','=', $request->pitch)
                                              ->where('week_day','=',$request->play_date)
                                              ->where('start_time','=',$request->start_time)
                                              ->value('id');
        $availableTime_flag = Pitch_avalible_time::find($availableTime);
        
        //return $availableTime_flag;
        
        $order = new Order();
        $order->user_id = $user_id;
        $order->pitch_id = $request->pitch;
        $order->total_amount = $unit_price;
        $order->order_status = $request->status;
        $order->booked_date = Carbon::now()->toDateString();
        $order->play_date = $request->play_date;
        $order->start_time = $request->start_time;
        $start_time = Carbon::parse($request->start_time);
        $end_time = $start_time->copy()->addHour();
        $order->end_time = $end_time->toTimeString();
        $order->customer_name = $customer->first_name . ' ' . $customer->last_name;
        $order->customer_phone = $customer->phone;
        $order->unit_price = $unit_price;
        $order->payment_method = $request->payment_method;

        //save change to unavailable time 
        $availableTime_flag->availability = false;
        $availableTime_flag->save();
        //save order record 
        $order->save();

        Session::flash('order_create', 'Successfully created order!');
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
