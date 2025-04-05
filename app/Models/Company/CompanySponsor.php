<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class CompanySponsor extends Model
{
    
    public $table = 'company_sponsors';

    public $fillable = [
        'id',
        'company_id',
        'company_name',
        'company_description',
        'company_logo',
    ];
}

