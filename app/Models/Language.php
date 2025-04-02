<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;


class Language extends Model
{
    public $table = 'languages';

    public $fillable = [
        'id',
        'language',
        'iso_code',
        'is_default',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'language' => 'string',
        'iso_code' => 'string',
        'is_default' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'language' => 'required|unique:languages,language|max:150',
        'iso_code' => 'required|unique:languages,iso_code|max:150',
    ];

    public function candidate(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'candidate_language');
    }
}
