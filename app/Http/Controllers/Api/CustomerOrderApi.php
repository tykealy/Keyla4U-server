<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Pitch;

class CustomerOrderApi extends Controller
{
    public function index($userID)
    {
        $orders = Order::join('pitches', 'orders.pitch_id', '=', 'pitches.id')
            ->join('courts', 'pitches.court_id', '=', 'courts.id')
            ->join('clubs', 'courts.club_id', '=', 'clubs.id')
            ->join('court_categories', 'courts.court_category_id', '=', 'court_categories.id')
            ->where('orders.user_id', $userID)
            ->where('orders.order_status', 'Paid')
            ->select('orders.id', 'orders.booked_date', 'orders.play_date', 'orders.start_time', 'orders.end_time', 'orders.total_amount', 'pitches.pitch_num', 'clubs.name', 'clubs.map', 'clubs.image', 'court_categories.category_name')
            ->orderByDesc('orders.id')
            ->get();
        return  response()->json($orders);
    }
}
