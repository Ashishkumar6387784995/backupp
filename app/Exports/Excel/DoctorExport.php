<?php

namespace App\Exports\Excel;

use App\Models\Doctor;
use Maatwebsite\Excel\Concerns\FromCollection;

class DoctorExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $status = request('status');
        $department_id = request('department_id');
        if ($status == '0') {
            $status = '2';
        }
        $data = Doctor::with(['department'])

            ->when($status, function ($data) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $data->where('status', '=', $status);
                }
            })
            ->when($department_id, function ($data) use ($department_id) {
                if ($department_id) {
                    $data->where('department_id', '=', $department_id);
                }
            })
            ->get();
        $exportData[] = [
            'doctor_code ' => 'Doctor Code',
            'name' => 'Name ',
            'email' => 'Email ',
            'mobile' => 'Mobile',
            'dob' => 'DOB',
            'gender' => 'Gender ',
            'address_line2' => 'Address',
            'department_id' => 'Department',
            'qualification' => 'Qualification',
            'area_of_interest' => 'Area of Interest',
            'expertise' => 'Expertise',
            'is_verified' => 'Verified',

            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'doctor_code' => $list->doctor_code,
                    'name' => $list->name,
                    'email' => $list->email,
                    'mobile' => $list->mobile,
                    'dob' => $list->dob,
                    'gender' => $list->gender,
                    'address_line2' => $list->address_line2,
                    'department_id' => $list->department ? $list->department->department_name : '',
                    'qualification' => $list->qualification,
                    'area_of_interest' => $list->area_of_interest,
                    'expertise' => $list->expertise,
                    'is_verified' => ($list->is_verified == 1) ? 'Verified' : 'Pending',

                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
