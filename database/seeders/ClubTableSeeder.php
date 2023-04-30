<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Club;
use App\Models\User;

class ClubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's truncate our existing records to start from scratch.
        Club::truncate();
 
        $faker = \Faker\Factory::create();
 
        // And now, let's create a few articles in our database:
        for($i = 0 ; $i < 10 ; $i++) {
            Club::create([
                'user_id' => User::all()->random()->id,
                'name' => $faker->name,
                'map' =>  $faker->sentence,
                'image' => $faker->image(storage_path('images'), 300, 300),
            ]);
        }
    }
}
