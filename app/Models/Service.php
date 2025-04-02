<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'job_services';
    protected $fillable = [
        'name',
        'slug',
        'short_tittle',
        'icon',
        'status',
        'created_at',
        'updated_at'
    ];
}
