<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Job;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Skill extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:skills,name|max:150',
    ];

    public $table = 'skills';

    public $fillable = [
        'id',
        'name',
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
        'name' => 'string',
        'description' => 'string',
        'is_default' => 'boolean',
    ];

    public function candidate(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'candidate_skills');
    }

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'jobs_skill');
    }

    public function jobsSkill(): HasMany
    {
        return $this->hasMany(Job::class, 'jobs_skill', 'job_id', 'skill_id');
    }
}
