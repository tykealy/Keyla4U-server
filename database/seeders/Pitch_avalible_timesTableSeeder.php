<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pitch_avalible_time;
use App\Models\Pitch;
use App\Models\Court;
use DateTime;

class Pitch_avalible_timesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Let's truncate our existing records to start from scratch.
         Pitch_avalible_time::truncate();
         $faker = \Faker\Factory::create();
         $court_num = Court::count();
         
         //get the first one

         $pitch =  Pitch::first();
         $court = Court::first();

         // And now, let's create a few articles in our database:
         for($i = 0 ; $i < $court_num ; $i++) {
            
            //get interval between start and end times
            //$interval = $court->open_time->diff($court->close_time);
            $openTime = DateTime::createFromFormat('H:i:s', $court->open_time);
            $closeTime = DateTime::createFromFormat('H:i:s', $court->close_time);
            $interval = $openTime->diff($closeTime);
           
            echo $interval->h;
            for($j = 0 ; $j < $interval->h ; $j++){
                $startTime = $openTime;

                //make the end time equal to the start time + 1hour
                $endTime = clone $startTime;
                $endTime->add(new \DateInterval('PT1H'));

                // create availble time for Pitch
                Pitch_avalible_time::create([
                    'pitch_id' => $pitch->id,
                    'week_day' => $faker->dateTimeBetween('now', '+1 week'),
                    'unit_price' => $faker->randomFloat(2,20,30),
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                ]);

                //udate start time to end time 
                $startTime = $endTime;
            }

            // update to next one
            $court = Court::skip($i + 1)->take(1)->first();
            $pitch = Pitch::skip($i + 1)->take(1)->first();
            
         }
    }
}
