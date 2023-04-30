<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account_type;
class Account_typeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's truncate our existing records to start from scratch.
        Account_type::truncate();
 
        $faker = \Faker\Factory::create();
 
        // And now, let's create a few articles in our database:
        Account_type::create([
            'role_name' => 'superAdmin',
            'role_id' => 0
        ]);

        Account_type::create([
            'role_name' => 'Admin',
            'role_id' => 1
        ]);

        Account_type::create([
            'role_name' => 'User',
            'role_id' => 2
        ]);
    }
}
