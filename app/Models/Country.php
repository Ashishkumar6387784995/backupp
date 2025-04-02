<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'short_code',
        'name',
        'phone_code',
    ];

    public static $rules = [
        'name' => 'required|max:180|unique:countries,name',
        'short_code' => 'required|unique:countries,short_code',
        'phone_code' => 'nullable|numeric|unique:countries,phone_code',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'short_code' => 'string',
        'name' => 'string',
        'phone_code' => 'string',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'country_id');
    }
}
