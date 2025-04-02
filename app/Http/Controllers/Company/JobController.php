<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\JobsExport;
use Maatwebsite\Excel\Facades\Excel;
use Str;

class JobController extends Controller
{
    public function index()
    {
        try {
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
            })->with(['category', 'jobType'])->orderBy('id', 'desc')->get();

            return view('company.pages.jobs.list', compact('page_title', 'page_description', 'breadcrumbs',  'jobs'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function add(Request $request)
    {
        // dd('hellow');
        try {
            if ($request->isMethod('post')) {
                // Validation rules
                $validator = Validator::make($request->all(), [
                    // 'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'job_title' => 'required|string|max:255',
                    'job_type' => 'required|string',
                    'job_category' => 'required|string',
                    'description' => 'required|string',
                    'No_of_Workers' => 'required|integer|min:1',
                    'license_required' => 'nullable|string',
                    'experience' => 'nullable|integer|min:0',
                    'qualification_required' => 'nullable|string',
                    'location' => 'nullable|string',
                    'pay_type_required' => 'required|string',
                    'price_from' => 'required|numeric|min:0',
                    'price_to' => 'required|numeric|min:0|gte:price_from',
                    'employer_question_status' => 'nullable|string',
                    'employer_questions' => 'nullable|string',
                    'contact_company_name' => 'required|string|max:255',
                    'contact_email' => 'nullable|email',
                    'contact_phone' => 'nullable|string',
                    'contact_country' => 'required|string',
                    'contact_state' => 'required|string',
                    'contact_city' => 'required|string',
                    'contact_zip' => 'required|string',
                    'contact_website' => 'nullable|url',
                    'contact_address' => 'required|string',
                    'paymentPlanType' => 'nullable|string',
                    'paymentPlane' => 'nullable|string',
                ]);

                // Handle validation failure
                if ($validator->fails()) {
                    return response()->json(['success' => false, 'errors' => $validator->errors()]);
                }

                try {
                    DB::beginTransaction();

                    // Handle file upload
                    $logoPath = null;
                    if ($request->hasFile('logo')) {
                        // Get the file
                        $file = $request->file('logo');

                        // Generate a unique name
                        $logoPath = time() . '.' . $file->getClientOriginalExtension();

                        // Move the file to the public folder
                        $file->move(public_path('uploads/jobs/logos'), $logoPath);
                    }

                    // Prepare data for insertion
                    $jobData = [
                        'logo' => $logoPath,
                        'user_id' => auth()->guard('company')->user()->id,
                        'job_title' => $request->job_title,
                        'slug' => Str::slug($request->job_title . ' ' . $request->location),
                        'job_type' => $request->job_type,
                        'job_category' => $request->job_category,
                        'description' => $request->description,
                        'no_of_workers' => $request->No_of_Workers,
                        'license_required' => $request->license_required,
                        'experience' => $request->experience,
                        'qualification_required' => $request->qualification_required,
                        'location' => $request->location,
                        'pay_type_required' => $request->pay_type_required,
                        'price_from' => $request->price_from,
                        'price_to' => $request->price_to,
                        'employer_question_status' => $request->employer_question_status,
                        'employer_questions' => $request->employer_questions,
                        'contact_company_name' => $request->contact_company_name,
                        'contact_email' => $request->contact_email,
                        'contact_phone' => $request->contact_phone,
                        'contact_country' => $request->contact_country,
                        'contact_state' => $request->contact_state,
                        'contact_city' => $request->contact_city,
                        'contact_zip' => $request->contact_zip,
                        'contact_website' => $request->contact_website,
                        'contact_address' => $request->contact_address,
                        'company_payment_status' => $request->company_payment_status,
                        'payment_plan_type' => $request->paymentPlanType,
                        'payment_plane' => $request->paymentPlane,
                    ];

                    // Check for duplicate slug
                    if (Job::where('slug', $jobData['slug'])->whereNull('deleted_at')->exists()) {
                        DB::rollback();
                        return response()->json(['success' => false, 'message' => 'Job title or slug already exists.']);
                    }

                    // Insert or update the job record
                    Job::updateOrCreate(['id' => null], $jobData);

                    DB::commit();
                    return response()->json(['success' => true, 'message' => 'Job details added successfully!']);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['success' => false, 'message' => 'Failed to add job: ' . $e->getMessage()]);
                }
            }

            // die('hii');

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            $jobs = Job::where('status', 1)->get();

            return view('company.pages.jobs.add-new', compact('page_title', 'page_description', 'breadcrumbs', 'jobs'));
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

                $details = Job::where('id', $id)->first();

                if ($details) {
                    $pageSettings = $this->pageSetting('edit');

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];

                    return view('company.pages.jobs.edit-new', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
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

    public function update(Request $request, $id)
    {
        try {
            if ($id) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'job_title' => 'required|string|max:255',
                    'job_type' => 'required|string',
                    'job_category' => 'required|string',
                    'description' => 'required|string',
                    'No_of_Workers' => 'required|integer|min:1',
                    'license_required' => 'required|string',
                    'experience' => 'required|integer|min:0',
                    'qualification_required' => 'required|string',
                    'location' => 'required|string',
                    'pay_type_required' => 'required|string',
                    'price_from' => 'required|numeric|min:0',
                    'price_to' => 'required|numeric|min:0|gte:price_from',
                    'employer_question_status' => 'nullable|string',
                    'employer_questions' => 'nullable|string',
                    'contact_company_name' => 'required|string|max:255',
                    'contact_email' => 'nullable|email',
                    'contact_phone' => 'nullable|string',
                    'contact_country' => 'required|string',
                    'contact_state' => 'required|string',
                    'contact_city' => 'required|string',
                    'contact_zip' => 'required|string',
                    'contact_website' => 'nullable|url',
                    'contact_address' => 'required|string',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                // Handle file upload
                $logoPath = null;
                if ($request->hasFile('logo')) {
                    // Get the file
                    $file = $request->file('logo');

                    // Generate a unique name
                    $logoPath = time() . '.' . $file->getClientOriginalExtension();

                    // Move the file to the public folder
                    $file->move(public_path('uploads/jobs/logos'), $logoPath);
                }

                $array = [
                    'logo' => $logoPath,
                    'user_id' => auth()->guard('company')->user()->id,
                    'job_title' => $request->job_title,
                    'slug' => Str::slug($request->job_title . ' ' . $request->location),
                    'job_type' => $request->job_type,
                    'job_category' => $request->job_category,
                    'description' => $request->description,
                    'no_of_workers' => $request->No_of_Workers,
                    'license_required' => $request->license_required,
                    'experience' => $request->experience,
                    'qualification_required' => $request->qualification_required,
                    'location' => $request->location,
                    'pay_type_required' => $request->pay_type_required,
                    'price_from' => $request->price_from,
                    'price_to' => $request->price_to,
                    'employer_question_status' => $request->employer_question_status,
                    'employer_questions' => $request->employer_questions,
                    'contact_company_name' => $request->contact_company_name,
                    'contact_email' => $request->contact_email,
                    'contact_phone' => $request->contact_phone,
                    'contact_country' => $request->contact_country,
                    'contact_state' => $request->contact_state,
                    'contact_city' => $request->contact_city,
                    'contact_zip' => $request->contact_zip,
                    'contact_website' => $request->contact_website,
                    'contact_address' => $request->contact_address,
                    'company_payment_status' => $request->company_payment_status,
                    'payment_plan_type' => $request->plan_name,
                    'payment_plane' => $request->payment_plan,
                ];
                if (Job::where('slug', $array['slug'])->where('id', '<>', $id)->exists()) {
                    DB::rollback();
                    return redirect()->back()->withErrors('Job title or slug already exist.');
                }
                $response = Job::UpdateOrCreate(['id' => $id], $array);
                DB::commit();
                return redirect('company/jobs/list')->with('success', 'Job details added successfully.');
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
                return redirect('company/jobs/list')->with('success', 'Job status updated successfully.');
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
                    'url' => url('company/jobs/list'),
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
                    'url' => url('company/jobs/list'),
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
