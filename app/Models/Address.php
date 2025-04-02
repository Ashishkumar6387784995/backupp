<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    // use SoftDeletes;
    protected $table = 'customer_addresses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'flat_no',
        'house_no',
        'locality_name',
        'pincode',
        'locality_id',
        'city_id',
        'state_id',
        'address_tag',
        'landmark',
        'sector',
         
        'created_by',
        'updated_by',
        'status',
        'deleted_at',
        'updated_at',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    // public function state()
    // {
    //     return $this->hasOne('App\Models\State', 'id','state_id');
    // }
    
    // public function SubCategory()
    // {
    //     return $this->hasMany('App\Models\Category', 'parent_id','id');
    // }
}
