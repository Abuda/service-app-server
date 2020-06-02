<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'profession_id' => 1,
                'professional' => true,
                'name' => 'Abuda',
                'description' => 'lorem ipsum',
                'email' => 'a@a.com',
                'phone' => '123456789',
                'hourly_rate' => 15,
                'password' => bcrypt('111111')
            ],
            [
                'profession_id' => 2,
                'professional' => true,
                'name' => 'Thaer',
                'description' => null,
                'email' => 'b@a.com',
                'phone' => '123456789',
                'hourly_rate' => 25,
                'password' => bcrypt('111111')
            ],
            [
                'profession_id' => null,
                'professional' => false,
                'name' => 'Safi',
                'description' => null,
                'email' => 'c@a.com',
                'phone' => '123456789',
                'hourly_rate' => null,
                'password' => bcrypt('111111')
            ],
        ]);
    }
}
