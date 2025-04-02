<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Staff;
use App\Models\Company\Role;

class CompanyLocation extends Model
{
    use HasFactory;

    protected $table = 'company_locations';

    protected $fillable = [
        'company_id',
        'location_name',
        'address',
        'fence_radius',
        'support_email',
        'support_contact',
        'email',
        'notes',
        'employee', // Assuming this stores employee IDs as JSON
        'qr_code',
        'login_url',
        'status'
    ];

    /**
     * Get the count of managers for this location.
     */
    public function managerCount() {
        $employeeIds = json_decode($this->employee, true); 

        if (!is_array($employeeIds) || empty($employeeIds)) {
            return 0; // Return 0 if no employees
        }

        return Staff::whereIn('id', $employeeIds)
                    ->whereHas('role', function ($query) {
                        $query->where('id', '1');
                    })
                    ->count();
    }

    /**
     * Get the count of employees for this location.
     */
    public function employeeCount() {
        $employeeIds = json_decode($this->employee, true); 

        if (!is_array($employeeIds) || empty($employeeIds)) {
            return 0;
        }

        return Staff::whereIn('id', $employeeIds)
                    ->whereHas('role', function ($query) {
                        $query->where('id', '!=', 1);
                    })
                    ->count();
    }
}
