<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reviewer_id', 'reviewed_id', 'stars', 'review'
    ];

    public static function getReview($reviewer, $reviewed) {
        return Review::where('reviewer_id', $reviewer)->where('reviewed_id', $reviewed)->first();
    }
}
