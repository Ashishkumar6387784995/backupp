<?php

namespace App\Exports\Excel;

use App\Models\JobApplicants;
use Maatwebsite\Excel\Concerns\FromCollection;

class JobsApplicationsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $fromDate = request('fromtodate');
        $job_id = request('job_id');
        $status = request('status');
        if ($status == '0') {
            $status = '2';
        }
        $data = JobApplicants::with(['Job'])
            ->when($status, function ($lists) use ($status) {
                $lists->where('application_status', '=', $status);
            })->when($job_id, function ($lists) use ($job_id) {
                $lists->where('job_id', '=', $job_id);
            })->when($fromDate, function ($customers) use ($fromDate) {
                if ($fromDate) {
                    $dateArr = explode(' - ', $fromDate);
                    $From = date('Y-m-d', strtotime($dateArr[0]));
                    $To = date('Y-m-d', strtotime($dateArr[1]));
                    $customers->whereBetween('created_at', [$From, $To]);
                }
            })
            ->orderBy('id', 'desc')->get();
        $exportData[] = [
            'job_profile' => 'Job Profile',
            'name ' => 'Name',
            'mobile  ' => 'Mobile  ',
            'email' => 'Email',
            'experience' => 'Experience ',
            'role' => 'Role',
            'location' => 'Location',
            'resume' => 'Resume',
            'experience_details' => 'Experience ',
            'other_details' => 'Other Details',
            'remark' => 'Remark',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'job_profile' => $list->Job->job_title,
                    'name' => $list->name,
                    'mobile' => $list->mobile,
                    'email' => $list->email,
                    'experience' => $list->experience,
                    'responsibilities' => $list->responsibilities,
                    'location' => $list->location,
                    'resume' => $list->resume,
                    'experience_details' => $list->exp_details,
                    'other_details' => $list->other_details,
                    'remark' => $list->remark,
                    'status' => ($list->status) ? 'Active' : 'InActive',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
