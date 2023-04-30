<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pitch;
use App\Models\Club;
use App\Models\Court;
class PitchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's truncate our existing records to start from scratch.
        Pitch::truncate();
 
        $faker = \Faker\Factory::create();
 
        // And now, let's create a few articles in our database:
        $court_num = Court::count();
        $court = Court::first();

        for($i = 0 ; $i < $court_num ; $i++) {
            Pitch::create([
                'court_id' => $court->id,
                'pitch_num' => $i+1,
                'size' => 'small',
            ]);

            $court = Court::skip($i + 1)->take(1)->first();
        }
    }
}
