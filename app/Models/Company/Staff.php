<?php

namespace App\Models\company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Role;
class Staff extends Model
{
    use HasFactory;
    protected $table = 'subusers';

    protected $fillable = [
        'admin_user_id','role_id','name','email','mobile','password','permission','last_login','last_login_ip','is_online','city','state','address','status','profile_photo','created_at','updated_at'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [];

    public function role()
    {
        return $this->hasOne('App\Models\Company\Role', 'id', 'role_id')->select(['id','role']);
    }

}
