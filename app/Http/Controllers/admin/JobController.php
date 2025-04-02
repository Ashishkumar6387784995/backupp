<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\JobsExport;
use Maatwebsite\Excel\Facades\Excel;

class JobController extends Controller
{
    public function index()
    {
        try {
            die('hii');
            $page_title = 'Jobs';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Jobs',
                    'url' => '',
                ]
            ];
            $fromDate = request('fromtodate');
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $jobs = Job::when($status, function ($jobs) use ($status) {
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
            return view('admin.pages.jobs.list', compact('page_title', 'page_description', 'breadcrumbs',  'jobs'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'job_title' => 'required',
                    'experience' => 'required',
                    'location' => 'required',
                    'role' => 'required',
                    'no_positions' => 'required',
                    'responsibilities' => 'required',
                    'skills' => 'required',
                    'jd' => '',
                ], [
                    'job_title.required' => 'Enter job title.',
                    'experience.required' => 'Enter experience.',
                    'location.required' => 'Enter job location.',
                    'role.required' => 'Enter job role.',
                    'no_positions.required' => 'Enter no positions.',
                    'responsibilities.required' => 'Enter no responsibilities.',
                    'skills.required' => 'Enter skills.',
                    'jd.required' => 'Enter JD.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'job_title' => $request->job_title,
                    'slug' => \Str::slug($request->job_title . ' ' . $request->location),
                    'experience' => $request->experience,
                    'location' => $request->location,
                    'role' => $request->role,
                    'no_positions' => $request->no_positions,
                    'responsibilities' => $request->responsibilities,
                    'skills' => $request->skills,
                    'jd' => $request->jd,
                    'expiry_date' => $request->expiry_date ? date('Y-m-d', strtotime($request->expiry_date)) :  date('Y-m-d', strtotime('+30 days')),
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'company_id' => $request->company_id,
                    'contact_no' => $request->contact_no,
                    'minimum_salary' => $request->minimum_salary,
                    'maximum_salary' => $request->maximum_salary,
                    'job_type' => $request->job_type,
                    'gender' => $request->gender,
                    'functional_area' => $request->functional_area,
                    'qualification' => $request->qualification,
                    'level' => $request->level,
                    'requirements' => $request->requirements,
                    'skills_tags' => $request->skills_tags,
                ];
                if (Job::where('slug', $array['slug'])->whereNull('deleted_at')->exists()) {
                    DB::rollback();
                    return redirect()->back()->withErrors('Job title or slug already exist.');
                }
                $response = Job::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/jobs/list')->with('success', 'Jobs details added successfully.');
            }

            // die('hii');

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            $jobs = Job::where('status', 1)->get();
        
            return view('admin.pages.jobs.add', compact('page_title', 'page_description', 'breadcrumbs', 'jobs'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            if ($id) {
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'job_title' => 'required',
                        'experience' => 'required',
                        'location' => 'required',
                        'role' => 'required',
                        'no_positions' => 'required',
                        'responsibilities' => 'required',
                        'skills' => 'required',
                        'jd' => '',
                    ], [
                        'job_title.required' => 'Enter job title.',
                        'experience.required' => 'Enter experience.',
                        'location.required' => 'Enter job location.',
                        'role.required' => 'Enter job role.',
                        'no_positions.required' => 'Enter no positions.',
                        'responsibilities.required' => 'Enter no responsibilities.',
                        'skills.required' => 'Enter skills.',
                        'jd.required' => 'Enter JD.',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();

                    $array = [
                        'job_title' => $request->job_title,
                        'slug' => \Str::slug($request->job_title . ' ' . $request->location),
                        'experience' => $request->experience,
                        'location' => $request->location,
                        'role' => $request->role,
                        'no_positions' => $request->no_positions,
                        'responsibilities' => $request->responsibilities,
                        'skills' => $request->skills,
                        'jd' => $request->jd,
                        'expiry_date' => $request->expiry_date ? date('Y-m-d', strtotime($request->expiry_date)) :  date('Y-m-d', strtotime('+30 days')),
                        'updated_by' => auth()->user()->id,

                        'company_id' => $request->company_id,
                        'contact_no' => $request->contact_no,
                        'minimum_salary' => $request->minimum_salary,
                        'maximum_salary' => $request->maximum_salary,
                        'job_type' => $request->job_type,
                        'gender' => $request->gender,
                        'functional_area' => $request->functional_area,
                        'qualification' => $request->qualification,
                        'level' => $request->level,
                        'requirements' => $request->requirements,
                        'skills_tags' => $request->skills_tags,


                    ];
                    if (Job::where('slug', $array['slug'])->where('id', '<>', $id)->whereNull('deleted_at')->exists()) {
                        DB::rollback();
                        return redirect()->back()->withErrors('Job title or slug already exist.');
                    }
                    $response = Job::UpdateOrCreate(['id' => $id], $array);
                    DB::commit();
                    return redirect('admin/jobs/list')->with('success', 'Job details added successfully.');
                }


                $details = Job::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit');

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];

                    return view('admin.pages.jobs.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
                } else {
                    return redirect()->back()->withErrors(['Job details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['Job details id is missing.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $cat = Job::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Job  deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Job details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function updateStatus($id, $status)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $status = ($status == 1) ? $status = 0 : $status = 1;
                $updateArr = [
                    'status' => $status,
                ];
                $response = Job::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/jobs/list')->with('success', 'Job status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Job details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Jobs';
            $data['page_description'] = 'Add New Job';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Jobs',
                    'url' => url('admin/jobs/list'),
                ]
            ];
            if (isset($dataArray['title']) && !empty($dataArray['title'])) {
                $data['breadcrumbs'][] =
                    [
                        'title' => $dataArray['title'],
                        'url' => '',

                    ];
            }
            return $data;
        }

        if ($action == 'add') {
            $data['page_title'] = 'Jobs';
            $data['page_description'] = 'Add New Job';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Jobs',
                    'url' => url('admin/jobs/list'),
                ],
                [
                    'title' => 'Add a New Job',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }



    function exportExcel()
    {
        $type = request('type');
        if ($type == 'excel')
            return Excel::download(new JobsExport, 'Jobs.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
