<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Pitch;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's truncate our existing records to start from scratch.
        Order::truncate();
 
        $faker = \Faker\Factory::create();
 
        // And now, let's create a few articles in our database:
        for($i = 0 ; $i < 5 ; $i++) {
           $user = User::all()->random();
           $pitch = Pitch::all()->random();
           $play_date = $pitch->pitch_avalible_time()->first()->week_day;
           Order::create([
                'user_id' => $user->id,
                'pitch_id' => $pitch->id,
                'total_amount' => $faker->randomFloat(1, 20, 30),
                'order_status' => 'paid',
                'booked_date' => $faker->dateTime(),
                'play_date' => $play_date,
                'start_time' => $pitch->pitch_avalible_time()->first()->start_time,
                'end_time' => $pitch->pitch_avalible_time()->first()->end_time,
                'customer_name' => $user->last_name,
                'customer_phone' => $user->phone,
                'unit_price'=> $pitch->pitch_avalible_time()->first()->unit_price,
                'payment_method' => 'abaPayway',
            ]);
        }
    }
}
