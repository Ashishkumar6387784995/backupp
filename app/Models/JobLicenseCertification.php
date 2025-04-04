<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLicenseCertification extends Model
{
    use HasFactory;
    protected $table = 'job_license_certification';
    protected $fillable = [
        'id',
        'name',
        'status'
    ];
}
