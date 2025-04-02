<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class City extends Model
{
    protected $table = 'cities';
    const STATE = '';

    protected $fillable = [
        'state_id',
        'name',
    ];

    public static $rules = [
        'name' => 'required|max:180|unique:cities,name',
        'state_id' => 'required',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'state_id' => 'integer',
        'name' => 'string',
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'city_id');
    }
}
