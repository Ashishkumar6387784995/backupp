<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobExperience extends Model
{
    use HasFactory;
    protected $table = 'job_experience';
    protected $fillable = [
        'id',
        'name',
        'status'
    ];

}
