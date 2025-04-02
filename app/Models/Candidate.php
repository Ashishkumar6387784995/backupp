<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;


class Candidate extends Model
{

    public $table = 'candidates';


    const ALL = 2;
    const ACTIVE = 1;
    const DEACTIVE = 0;

    const STATUS = [
        self::ALL => 'all',
        self::ACTIVE => 'active',
        self::DEACTIVE => 'deactive',
    ];

    const IMMEDIATE_AVAILABLE = 1;
    const Not_IMMEDIATE_AVAILABLE = 0;
    const IMMEDIATE = [
        self::ALL => 'all',
        self::IMMEDIATE_AVAILABLE => 'immediate_available',
        self::Not_IMMEDIATE_AVAILABLE => 'not_immediate_available',
    ];

    public $fillable = [
        'user_id',
        'unique_id',
        'father_name',
        'company_name',
        'marital_status_id',
        'nationality',
        'national_id_card',
        'experience',
        'career_level_id',
        'industry_id',
        'functional_area_id',
        'current_salary',
        'expected_salary',
        'salary_currency',
        'address',
        'immediate_available',
        'available_at',
        'last_change',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'unique_id' => 'string',
        'father_name' => 'string',
        'marital_status_id' => 'integer',
        'nationality' => 'string',
        'national_id_card' => 'string',
        'experience' => 'integer',
        'career_level_id' => 'integer',
        'industry_id' => 'integer',
        'functional_area_id' => 'integer',
        'current_salary' => 'double',
        'expected_salary' => 'double',
        'salary_currency' => 'string',
        'address' => 'string',
        'immediate_available' => 'boolean',
        'available_at' => 'date',
        'last_change' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
   

    protected $appends = ['country_name', 'state_name', 'city_name', 'full_location', 'candidate_url'];

    protected $with = ['user'];

    public function getCountryNameAttribute()
    {
        if (! empty($this->user->country)) {
            return $this->user->country->name;
        }
    }

    public function getStateNameAttribute()
    {
        if (! empty($this->user->state)) {
            return $this->user->state->name;
        }
    }

    public function getCityNameAttribute()
    {
        if (! empty($this->user->city)) {
            return $this->user->city->name;
        }
    }

    public function getFullLocationAttribute()
    {
        $location = '';
        if (! empty($this->user->country)) {
            $location = $this->user->country->name;
        }
        if (! empty($this->user->state)) {
            $location = $location.','.$this->user->state->name;
        }
        if (! empty($this->user->city)) {
            $location = $location.','.$this->user->city->name;
        }

        return (! empty($location)) ? $location : '' ;
    }

    /**
     * @return mixed
     */
    public function getCandidateUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->user->getMedia(User::PROFILE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/img/employer-image.png');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function city()
    {
        return $this->belongsTo(User::class,'id', 'city_id');
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'last_change');
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    public function careerLevel()
    {
        return $this->belongsTo(CareerLevel::class, 'career_level_id');
    }

    public function functionalArea()
    {
        return $this->belongsTo(FunctionalArea::class, 'functional_area_id');
    }

    public function jobAlerts()
    {
        return $this->belongsToMany(JobType::class, 'jobs_alerts', 'candidate_id', 'job_type_id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'candidate_id');
    }

    public function penddingJobApplications()
    {
        return $this->hasMany(JobApplication::class, 'candidate_id')->where('status', JobApplication::STATUS_APPLIED);
    }
}
