<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Rotas extends Model
{
    protected $table = 'rotas';
    protected $fillable = [
        'user_id',
        'issued_by',
        'rotas_date',
        'start_time',
        'end_time',
        'break_time',
        'time_diff_in_minut',
        'role_id',
        'location_id',
        'note',
        'publish',
        'shift_status',
        'shift_cancel_employee_msg',
        'shift_cancel_owner_msg',
        'create_by'
    ];
}
