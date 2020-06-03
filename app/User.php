<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'description', 'password', 'professional', 'profession_id', 'hourly_rate', 'phone', 'address', 'address_visible', 'country_id', 'state_id', 'division_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['reviews', 'average_stars'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'professional' => 'boolean'
    ];

    // value accessor
    public function getReviewsAttribute()
    {
        return Review::where('reviewed_id', $this->id)->get();
    }

    // value accessor
    public function getAverageStarsAttribute()
    {
        return Review::where('reviewed_id', $this->id)->get()->pluck('stars')->avg();
    }
}
