<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplicants;
use DB;
use App\Exports\Excel\JobsApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;

class JobApplicationController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Job Applications';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Job Applications',
                    'url' => '',
                ]
            ];
            $fromDate = request('fromtodate');
            $job_id = request('job_id');
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $lists = JobApplicants::with(['Job'])->when($status, function ($lists) use ($status) {
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
            $jobs = Job::where('status', 1)->get();
            // dd(    $lists);
            return view('admin.pages.applications.list', compact('page_title', 'page_description', 'breadcrumbs', 'lists', 'jobs'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function view($id)
    {
        $page_title = 'Applications';
        $page_description = 'View Application';
        $breadcrumbs = [
            [
                'title' => 'Job Applications',
                'url' => url('admin/job-applications/list'),
            ],
            [
                'title' => 'View Job Application',
                'url' => '',
            ],
        ];
        $details = JobApplicants::with(['Job'])->where('id', $id)->first();
        $jobs = Job::where('status', 1)->get();
        if ($details) {
            return view('admin.pages.applications.view', compact('page_title', 'page_description', 'breadcrumbs', 'details', 'jobs'));
        } else {
            return redirect()->back()->withErrors(['Application details not found.']);
        }
    }

    function exportExcel()
    {
        $type = request('type');
        if ($type == 'excel')
            return Excel::download(new JobsApplicationsExport, 'JobsApplications.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }

    public function updateStatus($id, $status)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $updateArr = [
                    'application_status' => $status,
                ]; 
                $response = JobApplicants::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/job-applications/list')->with('success', 'Application status updated successfully.');
            } else {
                return redirect('admin/job-applications/list')->withErrors(['Application details not found.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    // public function edit()
    // {
    //     $page_title = 'Applications';
    //     $page_description = 'Edit Application';
    //     $breadcrumbs = [
    //         [
    //             'title' => 'Applications',
    //             'url' => url('admin/applications/list'),
    //         ],
    //         [
    //             'title' => 'Edit Application',
    //             'url' => '',
    //         ],
    //     ];

    //     return view('admin.pages.applications.edit', compact('page_title', 'page_description', 'breadcrumbs'));
    // }
}
