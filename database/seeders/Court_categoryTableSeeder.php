<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Court_category;
class Court_categoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's truncate our existing records to start from scratch.
        Court_category::truncate();
 
        $faker = \Faker\Factory::create();
 
        // And now, let's create a few articles in our database:
        Court_category::create([
            'category_name' => 'football'
        ]);

        Court_category::create([
            'category_name' => 'badminton'
        ]);

        Court_category::create([
            'category_name' => 'volleyball'
        ]);
    }
}
