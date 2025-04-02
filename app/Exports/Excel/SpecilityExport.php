<?php

namespace App\Exports\Excel;

use App\Models\Speciality;
use Maatwebsite\Excel\Concerns\FromCollection;

class SpecilityExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Speciality::with(['department'])->orderBy('id', 'DESC')->get();
        $exportData[] = [
            'name' => 'Speciality Name',
            'slug' => 'Slug',
            'department' => 'Department',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'name' => $list->speciality_name,
                    'slug' => $list->slug,
                    'department' => $list->department ?  $list->department->department_name : '',
                    'status' => ($list->status) ? 'Active' : 'InActive',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
