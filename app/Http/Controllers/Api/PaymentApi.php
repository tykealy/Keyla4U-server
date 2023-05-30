<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Session;

use App\Models\Order;
use App\Models\Club;
use App\Models\Pitch;
use App\Models\Court;
use App\Models\Pitch_avalible_time;
use App\Models\User;
use Illuminate\Routing\Controller;

class PaymentApi extends Controller
{
    public function payment($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order_status = $order->order_status;
        $attempt = 1;
        while ($order_status !== 'Paid' && $attempt <= 10) {
            sleep(2);
            $order_status = $order->refresh()->order_status;
            $attempt++;
        }

        return response()->json($order_status);
    }

    public function order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'pitch' => 'required|numeric|exists:pitches,id',
            'play_date' => 'required|exists:pitch_avalible_times,week_day',
            'start_time' => 'required',
            'end_time' => 'required',
            'payment_method' => 'required',
            'order_status' => 'required',
        ]);
        // return 'hello';

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }


        $user_id = User::where('email', '=', $request->email)->value('id');
        $pitch = Pitch::findOrFail($request->pitch);
        $court = $pitch->court;
        $unit_price = $court->unit_price;
        $customer = User::where('id', $user_id)->first(['first_name', 'last_name', 'phone']);

        $order = new Order();
        $order->user_id = $user_id;
        $order->pitch_id = $request->pitch;
        $order->total_amount = $unit_price;
        $order->order_status = $request->order_status;
        $order->booked_date = Carbon::now()->toDateString();
        $order->play_date = $request->play_date;
        $order->start_time = $request->start_time;
        $order->end_time = $request->end_time;
        $order->customer_name = $customer->first_name . ' ' . $customer->last_name;
        $order->customer_phone = $customer->phone;
        $order->unit_price = $unit_price;
        $order->payment_method = $request->payment_method;

        $order->save();
        return response()->json($order, 201);
    }
}
