<?php

namespace App\Exports\Excel;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;

class DepartmentExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $status = request('status');
        if ($status == '0') {
            $status = '2';
        }
        $data = Department::orderBy('id', 'DESC')->when($status, function ($data) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $data->where('is_active', '=', $status);
            }
        })->get();
        $exportData[] = [
            'department_name ' => 'Department Name',
            'slug' => 'Slug ',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $lists) {
                $instruments =  json_decode($lists->instruments, 1);
                $structure =  json_decode($lists->structure, 1);
                $structureString = '';
                $instrumentsString = '';
                if ($structure) {
                    foreach ($structure as $key => $list) {
                        if ($key > 0) {
                            $common = ', ';
                        } else {
                            $common = ' ';
                        }
                        $structureString .=   $common . $list['title'] . ':' . $list['value'];
                    }
                }
                if ($instruments) {
                    foreach ($instruments as $key => $list) {
                        if ($key > 0) {
                            $common = '][';
                        } else {
                            $common = '[';
                        }
                        $instrumentsString .=   $common . 'instrument name: ' . $list['instrument_name'] . ', heading: ' . $list['heading'] . ', Sub heading: ' . $list['sub_heading'] . ', Description: ' . $list['description'];
                    }
                }
                $exportData[] = [
                    'name' => $lists->department_name,
                    'slug' =>  $lists->slug,
                    'status' => ($lists->is_active) ? 'Active' : 'InActive',
                    'created_at' => $lists->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
