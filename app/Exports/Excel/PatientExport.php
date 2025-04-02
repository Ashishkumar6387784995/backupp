<?php

namespace App\Exports\Excel;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;

class PatientExport implements FromCollection
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
        $data = Patient::orderBy('id', 'desc')->when($status, function ($patients) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $patients->where('status', '=', $status);
            }
        })->get();
        $exportData[] = [
            'First Name',
            'Last Name',
            'Mobile',
            'Gender',
            'DOB',
            'Relation',
            'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    $list->first_name,
                    $list->last_name,
                    $list->mobile_no,
                    $list->gender,
                    $list->dob,
                    $list->relation,
                    $list->email_id,
                    ($list->status) ? 'Active' : 'InActive',
                    $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
