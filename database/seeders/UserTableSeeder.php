<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's truncate our existing records to start from scratch.
        User::truncate();
 
        $faker = \Faker\Factory::create();
 
        // And now, let's create a few articles in our database:
        User::create([
            'first_name' => 'ko',
            'last_name' => 'ka',
            'email' => 'superAdmin@gmail.com',
            'password' => bcrypt(12345678),
            'phone' => $faker->phoneNumber,
            'Account_role_id' => 0
        ]);

        User::create([
            'first_name' => 'ma',
            'last_name' => 'mi',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(12345678),
            'phone' => $faker->phoneNumber,
            'Account_role_id' => 1
        ]);

        User::create([
            'first_name' => 'ko',
            'last_name' => 'kaka',
            'email' => 'user@gmail.com',
            'password' => bcrypt(12345678),
            'phone' => $faker->phoneNumber,
            'Account_role_id' => 2
        ]);
    }
}
