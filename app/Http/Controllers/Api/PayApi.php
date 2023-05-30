<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;

class PayApi extends Controller
{

    public function pay($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->order_status = "Paid";
        $order->save();

        return response()->json($order);
    }
}
