<?php

namespace App\Models\company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'company_role';
    protected $fillable = [
        'role',
        'permission', 
        'status'
    ];
}
