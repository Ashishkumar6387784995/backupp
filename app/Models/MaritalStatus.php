<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MaritalStatus extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'marital_status' => 'required|unique:marital_status,marital_status|max:150',
    ];

    public $table = 'marital_status';

    public $fillable = [
        'id',
        'marital_status',
        'description',
        'is_default',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'marital_status' => 'string',
        'description' => 'string',
        'is_default' => 'boolean',
    ];
}
