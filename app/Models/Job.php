<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JobCategory;
use App\Models\JobType;


class Job extends Model
{
    use SoftDeletes;
    protected $table = 'jobs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'job_title',
        'slug',
        'job_type',
        'job_category',
        'description',
        'no_of_workers',
        'license_required',
        'experience',
        'qualification_required',
        'location',
        'pay_type_required',
        'price_from',
        'price_to',
        'employer_question_status',
        'employer_questions',
        'company_payment_status',
        'payment_plan_type',
        'payment_plane',
        'contact_company_name',
        'contact_email',
        'contact_phone',
        'contact_country',
        'contact_state',
        'contact_city',
        'contact_zip',
        'contact_website',
        'contact_address',
        'status',
        'logo',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function company()
    {
        return $this->hasOne('App\Models\User', 'id', 'company_id');
    }
    public function functionalArea()
    {
        return $this->hasOne('App\Models\FunctionalArea', 'id', 'functional_area');
    }

    public function category(){
        
        return $this->hasOne(JobCategory::class, 'id', 'job_category');
    }


    public function jobType() {
        return $this->hasOne(JobType::class, 'id', 'job_type');
    }

    
    public function jobExperience() {
        return $this->hasOne(JobExperience::class, 'id', 'experience');
    }
}
