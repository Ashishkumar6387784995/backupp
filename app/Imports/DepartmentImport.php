<?php
namespace App\Imports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class DepartmentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip duplicate records by checking if the department already exists
        $departMent = isset($row['department']) ? $row['department'] : '';
        // echo $departMent;die;
        if ($departMent != '') {
            $existingDepartment = Department::where('department_name', $departMent)->first();

            if (!$existingDepartment) {
                return new Department([
                    'department_name' => $departMent, // Correct column name
                    'slug' => Str::slug($departMent),  // Generate a slug based on department name
                    'is_active' => 1,
                ]);
            }
        }
        

        return null;
    }

}
