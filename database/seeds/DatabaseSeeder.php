<?php

use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(ProfessionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
