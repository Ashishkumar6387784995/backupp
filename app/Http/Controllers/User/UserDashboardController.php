<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Candidate, User};
use App\Models\Job;
use DB;
use Validator;
use Auth;
use Hash;

class UserDashboardController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Dashboard';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Dashboard',
                    'url' => '',
                ],
            ];
            // die('hi');
            return view('user.pages.dashboard.list', compact('page_title', 'page_description', 'breadcrumbs'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function savedJobs()
    {
        try {
            $page_title = 'Saved Jobs';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Saved Jobs',
                    'url' => '',
                ],
            ];
            // die('hi');
            return view('user.pages.savedJobs.list', compact('page_title', 'page_description', 'breadcrumbs'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function jobsListApi()
    {
        try {
            $user = auth()->guard('user')->user();

            // Ensure the user is logged in before fetching jobs
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated.'
                ], 401);
            }

            // Fetch jobs with the necessary relationships and conditions
            $jobs = Job::with('jobType', 'jobExperience')
                ->select('jobs.*')
                ->join('saved_jobs', 'saved_jobs.job_id', '=', 'jobs.id')
                ->where('saved_jobs.user_id', $user->id)
                ->where('jobs.status', 1)
                ->orderBy('jobs.created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Jobs fetched successfully.',
                'data' => $jobs
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch jobs.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function savedJobsDetails($slug)
    {
        try {
            $page_title = 'Saved Jobs Details';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'saved Jobs Details',
                    'url' => '',
                ],
            ];
            // die('hi');
            return view('user.pages.savedJobs.details', compact('page_title', 'page_description', 'breadcrumbs', 'slug'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function userprofile()
    {
        $page_title = 'Profile';
        $page_description = '';
        $breadcrumbs = [
            [
                'title' => 'Profile',
                'url' => '',
            ],
        ];
        $id = auth()->guard('user')->user()->id;
        $details = Candidate::with('user')->where('user_id', $id)->first();
        $candidate_skills = DB::table('candidate_skills')->select('skill_id')->where('user_id', $details->user_id)->pluck('skill_id')->toArray();

        $candidate_languages = DB::table('candidate_language')->select('language_id')->where('user_id', $details->user_id)->pluck('language_id')->toArray();
        return view('user.pages.profile.profile', compact('page_title', 'page_description', 'breadcrumbs', 'details', 'candidate_skills', 'candidate_languages'));
    }

    public function userprofileUpdate(Request $request)
    {
        try {
            $id = auth()->guard('user')->user()->id;
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
                    'immediate_available' => 'nullable',
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
                $candidate = Candidate::where('user_id', $id)->first();

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
                return redirect('user/dashboard')->with('success', 'Profile updated successfully.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'old_password' => 'required',
                    'password' => 'required|min:8|confirmed',
                ], [
                    'old_password.required' => 'Current password is required.',
                    'password.required' => 'New password is required.',
                    'password.min' => 'New password must be at least 8 characters.',
                    'password.confirmed' => 'New password confirmation does not match.',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // Check if current password matches the one in the database
                $user = Auth::guard('user')->user();
                if (!Hash::check($request->old_password, $user->password)) {
                    return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
                }

                // Update the password in the database
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('success', 'Password updated successfully.');
            }
            return view('user.pages.profile.changePassword');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function logout()
    {
        auth()->guard('user')->logout();
        return redirect('user/login');
    }
}
