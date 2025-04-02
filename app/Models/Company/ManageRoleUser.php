<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Companydepartment;
use App\Models\Department;
use App\Models\Company\Rotas;

class ManageRoleUser extends Model
{
    use HasFactory;

    protected $table = 'subusers';

    protected $fillable = [
        'admin_user_id','role_id','name','email','mobile','department_id','password','permission','last_login','last_login_ip','is_online','city','state','address','status','profile_photo','created_at','updated_at'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [];

    public function role()
    {
        return $this->hasOne('App\Models\Company\Role', 'id', 'role_id')->select(['id','role']);
    }
    /**
     * Get the user associated with the ManageRoleUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function companyDepartment()
    {
        return $this->hasOne(Companydepartment::class, 'id', 'department_id');
    }

    public function rotas() {
        /**
         * Get the user associated with the ManageRoleUser
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        return $this->hasMany(Rotas::class, 'user_id', 'id')->orderBy('id', 'DESC');
    }

    public function department()
    {
        return $this->hasOneThrough(
            Department::class,
            Companydepartment::class,
            'id',            // Foreign key on Companydepartment table
            'id',            // Foreign key on Department table
            'department_id', // Local key on the current model
            'department_id'  // Local key on Companydepartment table
        );
    }

}
