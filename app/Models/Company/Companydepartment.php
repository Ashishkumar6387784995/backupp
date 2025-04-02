<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Companydepartment extends Model
{
    use HasFactory;
    protected $table = 'company_departments';

    protected $fillable = [
        'user_id',
        'department_id',
        'status'
    ];

    /**
     * Get the user associated with the Companydepartment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
