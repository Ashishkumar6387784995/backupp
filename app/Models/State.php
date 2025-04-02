<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    const COUNTIES = '';
    protected $table = 'states';


    protected $fillable = [
        'id',
        'country_id',
        'name',
        'status'
    ];

    protected $casts = [
        'id' => 'integer',
        'country_id' => 'integer',
        'name' => 'string',
    ];

    public static $rules = [
        'name' => 'required|max:180|unique:states,name',
        'country_id' => 'required',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'state_id');
    }
}
