<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'role_id',
        'password',
        'email_verified_at',
        'dob',
        'is_active',
        'is_verified',
        'country_id',
        'state_id',
        'city_id',
        'pincode',
        'gender',
        'language', 
        'profile_views',
        'remember_token',
        'theme_mode',
        'created_at',
        'updated_at',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'google_plus_url',
        'pinterest_url',
        'is_default',
        'stripe_id',
        'profile_logo',
        'region_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }
    public function city()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }
    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }
    public function industry()
    {
        return $this->hasOne('App\Models\Industry', 'id', 'industry_id');
    }
    public function jobs()
    {
        return $this->hasMany('App\Models\Job', 'company_id', 'id');
    }
}
