<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateAwards as Awards;
use App\Models\CandidateEducation  as Education;
use App\Models\CandidateCertification as Certification;
use App\Models\CandidateWorkExperience as WorkExperience;
use App\Models\State;
use App\Models\{City,Language,Skill,User};
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{

    public function index()
    { 

        try {
            $page_title = 'Candidates';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Candidates',
                    'url' => '',
                ]
            ];


            $fromDate = request('fromtodate');
            $cityId = request('city_id');

            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $customers = Candidate::with(['user'])->orderBy('id', 'desc')->get();
            $cities = City::get();
            // dd($customers);
            return view('admin.pages.customers.list', compact('page_title', 'page_description', 'breadcrumbs',  'customers', 'cities'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    // public function add(Request $request)
    // {
    //     try {
    //         if ($request->isMethod('post')) {
    //             // dd($request->all());
    //             $validator = Validator::make($request->all(), [
    //                 'first_name' => 'required',
    //                 'last_name' => 'required',
    //                 'mobile_no' => 'required',
    //                 'email_id' => 'required',
    //                 'dob' => 'required',
    //                 'dob' => 'date_format:Y-m-d|before:today',
    //                 'gender' => 'required',
    //                 'state_id' => 'required',
    //                 'city_id' => 'required',
    //             ], [
    //                 'first_name.required' => 'First name is required.',
    //                 'last_name.required' => 'Last name is required.',
    //                 'mobile_no.required' => 'Mobile no is required.',
    //                 'email_id.required' => 'Email id is required.',
    //                 'dob.required' => 'DOB is required.',
    //                 'gender.required' => 'Gender is required.',
    //                 'state_id.required' => 'Select state.',
    //                 'city_id.required' => 'Select city.',
    //             ]);
    //             if ($validator->fails()) {
    //                 return redirect()->back()->withErrors($validator)->withInput($request->all());
    //             }

    //             DB::beginTransaction();


    //             $array = [
    //                 'first_name' => $request->first_name,
    //                 'last_name' => $request->last_name,
    //                 'mobile_no' => $request->mobile_no,
    //                 'email_id' => $request->email_id,
    //                 'dob' => $request->dob,
    //                 'gender' => $request->gender,
    //                 'city_id' => $request->city_id,
    //                 'state_id' => $request->state_id,
    //                 'address_line1' => $request->address_line1,
    //                 'address_line2' => $request->address_line2,
    //                 'pincode' => $request->pincode,
    //                 'skills' => $request->skills,
    //                 'experience_years' => $request->experience_years,
    //                 'experience_months' => $request->experience_months,
    //                 'status' => 1,
    //                 'created_by' => auth()->user()->id,
    //                 'updated_by' => auth()->user()->id,

    //             ];

    //             $UserMobile = Candidate::where('mobile_no', $array['mobile_no'])->exists();
    //             if ($UserMobile) {
    //                 return redirect()->back()->withErrors(['Candidate mobile already exist.'])->withInput($request->all());
    //             }
    //             // dd(  $array );
    //             $response = Candidate::UpdateOrCreate(['id' => null], $array);
    //             if ($response) {
    //                 $work = [
    //                     'candidate_id' => $response->id,
    //                     'designation' => $request->designation,
    //                     'company' => $request->company,
    //                     'experience_years' => $request->experience_years,
    //                     'experience_months' => $request->experience_months,
    //                     'from_experience_years' => $request->from_experience_years,
    //                     'from_experience_months' => $request->from_experience_months,
    //                     'to_experience_years' => $request->to_experience_years,
    //                     'to_experience_months' => $request->to_experience_months,
    //                     'functional_area' => $request->functional_area,
    //                     'industry' => $request->industry,
    //                     'location' => $request->location,
    //                     'work_experience_description' => $request->work_experience_description,
    //                     'created_by' => auth()->user()->id,
    //                     'updated_by' => auth()->user()->id,
    //                 ];
    //                 $education = [
    //                     'candidate_id' => $response->id,
    //                     'qualification' => $request->qualification,
    //                     'school_college_university_name' => $request->school_college_university_name,
    //                     'from_education_years' => $request->from_education_years,
    //                     'from_education_months' => $request->from_education_months,
    //                     'to_education_years' => $request->to_education_years,
    //                     'to_education_months' => $request->to_education_months,
    //                     'status' => 1,
    //                     'education_location' => $request->education_location,
    //                     'created_by' => auth()->user()->id,
    //                     'updated_by' => auth()->user()->id,
    //                 ];
    //                 $certification = [
    //                     'candidate_id' => $response->id,
    //                     'certification_name' => $request->certification_name,
    //                     'issuing_organization' => $request->issuing_organization,
    //                     'from_certification_years' => $request->from_certification_years,
    //                     'from_certification_months' => $request->from_certification_months,
    //                     'to_certification_years' => $request->to_certification_years,
    //                     'to_certification_months' => $request->to_certification_months,
    //                     'status' => 1,
    //                     'created_by' => auth()->user()->id,
    //                     'updated_by' => auth()->user()->id,
    //                 ];
    //                 $awads = [
    //                     'candidate_id' => $response->id,
    //                     'title' => $request->recognition_title,
    //                     'rawarded_by' => $request->recognition_awarded_by,
    //                     'status' => 1,
    //                     'created_by' => auth()->user()->id,
    //                     'updated_by' => auth()->user()->id,
    //                 ];
    //                 $response1 = WorkExperience::UpdateOrCreate(['id' => null], $work);
    //                 $response2 = Education::UpdateOrCreate(['id' => null], $education);
    //                 $response3 = Certification::UpdateOrCreate(['id' => null], $certification);
    //                 $response4 = Awards::UpdateOrCreate(['id' => null], $awads);
    //             }
    //             DB::commit();
    //             return redirect('admin/customers/list')->with('success', 'Candidate details added successfully.');
    //         }

    //         $pageSettings = $this->pageSetting('add');

    //         $page_title =  $pageSettings['page_title'];
    //         $page_description = $pageSettings['page_description'];
    //         $breadcrumbs = $pageSettings['breadcrumbs'];
    //         $states = State::where('status', 1)->get();

    //         return view('admin.pages.customers.add', compact('page_title', 'page_description', 'breadcrumbs', 'states'));
    //     } catch (\Exception $e) {
    //         dd($e);
    //         DB::rollback();
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }
    public function edit(Request $request, $id)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'dob' => 'nullable|date',
                    'gender' => 'nullable|in:male,female,other',
                    'marital_status_id_' => 'nullable|integer',
                    'nationality' => 'nullable|string',
                    'national_id_card' => 'nullable|string',
                    'country_id' => 'required|integer',
                    'state_id' => 'required|integer',
                    'city_id' => 'required|integer',
                    'experience' => 'nullable|integer',
                    'career_level_id' => 'nullable|integer',
                    'industry_id' => 'nullable|integer',
                    'functional_area_id' => 'nullable|integer',
                    'current_salary' => 'nullable|numeric',
                    'company_name' => 'nullable|string',
                    'expected_salary' => 'nullable|numeric',
                    'facebook_url' => 'nullable|url',
                    'twitter_url' => 'nullable|url',
                    'linkedin_url' => 'nullable|url',
                    'google_plus_url' => 'nullable|url',
                    'pinterest_url' => 'nullable|url',
                    'profile_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'is_active' => 'nullable|boolean',
                    'is_verified' => 'nullable|boolean',
                    'immediate_available' => 'nullable|boolean',
                    'address' => 'nullable|string',
                ], [
                    'first_name.required' => 'User name is required.',
                    'email.required' => 'Email is required.',
                    'phone.required' => 'Mobile no is required.',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // Get Candidate
                $candidate = Candidate::where('id', $id)->first();

                if (!$candidate) {
                    return redirect()->back()->withErrors(['Candidate not found.']);
                }

                // Check if Email Already Exists
                $UserEmailExists = User::where('email', $request->email)
                    ->where('id', '!=', $candidate->user_id)
                    ->exists();

                if ($UserEmailExists) {
                    return redirect()->back()->withErrors(['User Email already exists.'])->withInput();
                }

                DB::beginTransaction();

                // Handle File Upload and Remove Old Profile Logo
                $profileLogo = $candidate->user->profile_logo ?? null;

                if ($request->hasFile('profile_logo')) {
                    $user = User::find($candidate->user_id);

                    if ($user && $user->profile_logo) {
                        $oldImagePath = public_path('uploads/customers/logo/' . $user->profile_logo);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }

                    $file = $request->file('profile_logo');
                    $profileLogo = time() . '_profile_logo.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/customers/logo'), $profileLogo);
                }

                // Update Candidate
                $candidate->update([
                    'marital_status_id' => $request->marital_status_id_,
                    'nationality' => $request->nationality,
                    'national_id_card' => $request->national_id_card,
                    'experience' => $request->experience,
                    'company_name' => $request->company_name,
                    'career_level_id' => $request->career_level_id,
                    'industry_id' => $request->industry_id,
                    'functional_area_id' => $request->functional_area_id,
                    'current_salary' => $request->current_salary,
                    'expected_salary' => $request->expected_salary,
                    'address' => $request->address,
                    'immediate_available' => $request->immediate_available,
                    'available_at' => now()->format('Y-m-d'),
                ]);

                // Update User
                if ($candidate->user_id) {
                    $user = User::find($candidate->user_id);
                    if ($user) {
                        $user->update([
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'country_id' => $request->country_id,
                            'state_id' => $request->state_id,
                            'city_id' => $request->city_id,
                            'dob' => $request->dob,
                            'gender' => $request->gender ?? 'other',
                            'facebook_url' => $request->facebook_url,
                            'twitter_url' => $request->twitter_url,
                            'linkedin_url' => $request->linkedin_url,
                            'google_plus_url' => $request->google_plus_url,
                            'pinterest_url' => $request->pinterest_url,
                            'is_active' => $request->is_active ?? 0,
                            'is_verified' => $request->is_verified ?? 0,
                            'profile_logo' => $profileLogo,
                        ]);
                    }
                }

                // Update Skills
                $skills = $request->skills;
                $userId = $candidate->user_id;

                if (!empty($skills)) {
                    DB::table('candidate_skills')->where('user_id', $userId)->delete();
                    $skillArray = [];

                    foreach ($skills as $skill) {
                        $skillArray[] = [
                            'user_id' => $userId,
                            'skill_id' => $skill,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }

                    DB::table('candidate_skills')->insert($skillArray);
                }

                // Update Languages
                $languageIds = $request->language_id;
                if (!empty($languageIds)) {
                    DB::table('candidate_language')->where('user_id', $userId)->delete();
                    $languageArray = [];

                    foreach ($languageIds as $lang) {
                        $languageArray[] = [
                            'user_id' => $userId,
                            'language_id' => $lang,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }

                    DB::table('candidate_language')->insert($languageArray);
                }

                DB::commit();
                return redirect('admin/customers/list')->with('success', 'User details updated successfully.');
            }

            $details = Candidate::with(['user'])->where('id', $id)->first();
            $candidate_skills = DB::table('candidate_skills')->select('skill_id')->where('user_id', $details->user_id)->pluck('skill_id')->toArray();
            
            $candidate_languages = DB::table('candidate_language')->select('language_id')->where('user_id', $details->user_id)->pluck('language_id')->toArray();
            if (!$details) {
                return redirect()->back()->withErrors(['Candidate details do not exist.']);
            }

            $pageSettings = $this->pageSetting('edit');

            return view('admin.pages.customers.edit', [
                'page_title' => $pageSettings['page_title'],
                'page_description' => $pageSettings['page_description'],
                'breadcrumbs' => $pageSettings['breadcrumbs'],
                'details' => $details,
                'candidate_skills' =>$candidate_skills,
                'candidate_languages' => $candidate_languages
            ]);
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
                $cat = Candidate::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Candidate deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Candidate details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function customerIsVerified($user_id, $status){
        try {
            if ($user_id) {
                DB::beginTransaction();
                $status = ($status == 1) ? $status = 0 : $status = 1;
                $updateArr = [
                    'is_verified' => $status,
                ];
                $response = User::UpdateOrCreate(['id' => $user_id], $updateArr);
                DB::commit();
                $message = 'User Unverified successfully.';
                if ($status == 1) {
                  $message = 'User Verified successfully.';
                }
                return redirect('admin/customers/list')->with('success', $message);
            } else {
                return redirect()->back()->with('error', 'Candidate details not found.');
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
                    'is_active' => $status,
                ];
                $response = User::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/customers/list')->with('success', 'Candidate status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Candidate details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function exportExcel()
    {
        $type = request('type');
        if ($type == 'excel')
            return Excel::download(new CustomerExport, 'Candidates.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }


    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Candidates List';
            $data['page_description'] = 'Edit Candidate';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Candidates',
                    'url' => url('admin/customers/list'),
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
            $data['page_title'] = 'Candidates List';
            $data['page_description'] = 'Add New Candidate';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Candidates',
                    'url' => url('admin/customers/list'),
                ],
                [
                    'title' => 'Add a New Candidate',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
