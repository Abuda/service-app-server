<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            [
                'reviewer_id' => 1,
                'reviewed_id' => 2,
                'stars' => 3,
                'review' => 'Lorem Ipsum'
            ],
            [
                'reviewer_id' => 3,
                'reviewed_id' => 2,
                'stars' => 5,
                'review' => 'Lorem Ipsum'
            ]
        ]);
    }
}
