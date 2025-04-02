<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;


class CareerLevel extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
   
    public $table = 'career_levels';

    public $fillable = [
        'id',
        'level_name',
        'is_default',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'level_name' => 'string',
        'is_default' => 'boolean',
    ];
}
