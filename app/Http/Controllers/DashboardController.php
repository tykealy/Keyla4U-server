<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Models\Club;
use App\Models\Court;
use App\Models\Pitch;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function adminDashboard(){
        $club_id = Club::where('user_id', '=', Auth::id())->select('id')->first();
        if ($club_id) {
            $courts = Court::where('club_id','=',$club_id->id)->get();
    
            //get number of courts 
            $court_count = $courts->count();
    
            //get number of pitchs
            $pitch_count = 0;
            foreach($courts as $court){
                $pitchs = Pitch::where('court_id','=',$court->id)->count();
                $pitch_count += $pitchs;
            }
    
            //get order count
            $order_count = 0;
            foreach($courts as $court){
                $pitchs = Pitch::where('court_id','=',$court->id)->get();
                foreach($pitchs as $pitch){
                    $orders = Order::where('pitch_id','=',$pitch->id)->count(); 
                    $order_count += $orders;
                }
            }
    
            //get order list
            $order_list = DB::table('orders')
            ->join('pitches', 'orders.pitch_id', '=', 'pitches.id')
            ->join('courts', 'pitches.court_id', '=', 'courts.id')
            ->join('court_categories', 'courts.court_category_id', '=', 'court_categories.id')
            ->where('courts.club_id', '=', $club_id->id)
            ->select(
                'orders.*',
                'court_categories.category_name',
                'pitches.pitch_num'
            )
            ->paginate(4);
    
            return view('admin.dashboard')
                ->with('court_count',$court_count)
                ->with('order_count',$order_count)
                ->with('pitch_count',$pitch_count)
                ->with('order_list',$order_list);
        } else {
            return view('club.club');
        }
    }
    


    public function superAdminDashboard(){
        //get number of orders 
        $orders = Order::count();
        //get number of clubs
        $clubs = Club::count();
        //get number of users
        $users = User::count();
        //get user list
        $users_list = User::orderBy('account_role_id')->paginate(4);

        return view('super_admin.superDashboard')
            ->with('orders',$orders)
            ->with('clubs',$clubs)
            ->with('users',$users)
            ->with('users_list',$users_list);
    }


}
