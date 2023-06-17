<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;

class CustomerOrderApi extends Controller
{
    public function index($userID)
    {
        $orders = Order::where('user_id', $userID)->get();
        return  response()->json($orders);
    }
}
