<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\CompanySponsor;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'no_of_offices',
        'user_id',
        'industry_id',
        'ownership_type_id',
        'company_size_id',
        'established_in',
        'details',
        'website',
        'cp_first_name',
        'cp_middle_name',
        'cp_last_name',
        'cp_designation',
        'cp_phone',
        'cp_email',
        'gst_no',
        'is_featured',
        'fax',
        'unique_id',
        'created_at',
        'updated_at',
        'last_change'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id','user_id');
    }
    public function industry(){
        return $this->hasOne('App\Models\Industry','id','industry_id');
    }
    public function ownerShipType()
    {
        return $this->belongsTo(OwnerShipType::class, 'ownership_type_id');
    }
    public function companySize()
    {
        return $this->belongsTo(CompanySize::class, 'company_size_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_id');
    }

    public function featured()
    {
        return $this->morphOne(FeaturedRecord::class, 'owner');
    }

    public function activeFeatured()
    {
        return $this->morphOne(FeaturedRecord::class, 'owner')->where('end_time', '>', \Carbon\Carbon::now());
    }

    public function getAllCompanySponsers()
    {
        return $this->hasMany(CompanySponsor::class, 'company_id')->take(4);
    }
}
