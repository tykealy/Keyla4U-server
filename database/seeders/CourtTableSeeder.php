<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Court;
use App\Models\Club;
use App\Models\Court_category;

class CourtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's truncate our existing records to start from scratch.
        Court::truncate();
 
        $faker = \Faker\Factory::create();
 
        // And now, let's create a few articles in our database:
        for($i = 0 ; $i < 5 ; $i++) {
            Court::create([
                'court_category_id' => Court_category::all()->random()->id,
                'club_id' => Club::all()->random()->id,
                'open_time' => $faker->dateTimeBetween('04:00:00', '6:00:00'),
                'close_time' => $faker->dateTimeBetween('15:00:00', '19:00:00'),
            ]);
        }
    }
}
