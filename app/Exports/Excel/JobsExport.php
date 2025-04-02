<?php

namespace App\Exports\Excel;

use App\Models\Job;
use Maatwebsite\Excel\Concerns\FromCollection;

class JobsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $fromDate = request('fromtodate');
        $status = request('status');
        if ($status == '0') {
            $status = '2';
        }
        $data = Job::when($status, function ($jobs) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $jobs->where('status', '=', $status);
            }
        })->when($fromDate, function ($jobs) use ($fromDate) {
            if ($fromDate) {
                $dateArr = explode(' - ', $fromDate);
                $From = date('Y-m-d', strtotime($dateArr[0]));
                $To = date('Y-m-d', strtotime($dateArr[1]));
                $jobs->whereBetween('expiry_date', [$From, $To]);
            }
        })->orderBy('id', 'desc')->get();
        $exportData[] = [
            'job_title ' => 'Job Title',
            'slug  ' => 'Slug  ',
            'experience' => 'Experience',
            'location' => 'Location ',
            'role' => 'Role',
            'responsibilities' => 'Responsibilities',
            'skills' => 'Skills',
            'jd' => 'JD',
            'no_positions' => 'No Positions',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'job_title' => $list->job_title,
                    'slug' => $list->slug,
                    'experience' => $list->experience,
                    'location' => $list->location,
                    'role' => $list->role,
                    'responsibilities' => $list->responsibilities,
                    'skills' => $list->skills,
                    'jd' => $list->jd,
                    'no_positions' => $list->no_positions,
                    'status' => ($list->status) ? 'Active' : 'InActive',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
