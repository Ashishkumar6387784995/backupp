<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedJobs extends Model
{
    
    public $table = 'saved_jobs';

    public $fillable = [
        'id',
        'user_id',
        'job_id',
    ];
}
