<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Company\ManageRoleUser;
use App\Models\Company\CompanySponsor;
use App\Models\{Company,User,CompanyLocation};
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use \Carbon\Carbon;
use App\Models\Company\DesignationCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;



class CompanyDashboardController extends Controller
{
    public function dashboard() {
        try {
            $page_title = 'Dashboard';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Dashboard',
                    'url' => '',
                ],
            ];
            
            return view('company.pages.dashboard.list', compact('page_title', 'page_description', 'breadcrumbs'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function companyprofile()  {
        $page_title = 'Profile';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Profile',
                    'url' => '',
                ],
            ];

        $id = auth()->guard('company')->user()->id;
        $details = Company::with('user')->where('user_id', $id)->first();

        // dd($details->id);
        $employees = ManageRoleUser::where('status', 1)->get();
        $company_locations = CompanyLocation::where('company_id', $id)->get();
        $company_sponsers = CompanySponsor::where('company_id', $details->id)->get();

        foreach ($company_locations as $location) {
            $location->manager_count = $location->managerCount();
            $location->employee_count = $location->employeeCount();
        }
     
        $designation_categories = DesignationCategory::with('designation')->where('status', 1)->get();

        $locationDetails = [];
        $locationedit = request()->has('edit-location') ? request('edit-location') : null;
        if ($locationedit) {
            $locationDetails =  CompanyLocation::where('id', $locationedit)->first() ?? [];
        }
        $locationQrDetails = []; 
        $locationQr = request()->has('location-qr') ? request('location-qr') : null;
        if ($locationQr) {
            $locationQrDetails =  CompanyLocation::where('id', $locationQr)->first() ?? [];
        }


        $sponsorDetails = [];
        $sponsoredit = request()->has('edit-sponsor') ? request('edit-sponsor') : null;
        if ($sponsoredit) {
            $sponsorDetails =  CompanySponsor::where('id', $sponsoredit)->where('company_id', $details->id)->first() ?? [];
        }
        // echo "<pre>";
        // print_r($designation_categories);die;
        return view('company.pages.profile.profile', compact('page_title', 'page_description', 'breadcrumbs','details','employees','company_locations','designation_categories','locationDetails','locationQrDetails', 'company_sponsers', 'sponsorDetails'));

    }

    public function companyprofileUpdate(Request $request) {
        try {
            $id = auth()->guard('company')->user()->id;
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'industry_id' => 'required',
                    'country_id' => 'required',
                    'state_id' => 'required',
                    'city_id' => 'required',
                    'pincode' => 'nullable',
                    'company_size_id' => 'nullable',
                    'established_in' => 'nullable',
                    'gst_no' => 'nullable',
                    'details' => 'nullable',
                    'no_of_offices' => 'nullable|integer',
                    'employees_count' => 'nullable|integer',
                    'company_website' => 'nullable|url',
                    'fax' => 'nullable',
                    'facebook_url' => 'nullable|url',
                    'twitter_url' => 'nullable|url',
                    'linkedin_url' => 'nullable|url',
                    'google_plus_url' => 'nullable|url',
                    'pinterest_url' => 'nullable|url',
                    'profile_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'cp_first_name' => 'required',
                    'cp_middle_name' => 'required',
                    'cp_last_name' => 'required',
                    'cp_designation' => 'required',
                    'cp_phone' => 'required',
                    'cp_email' => 'required',
                ], [
                    'name.required' => 'User name is required.',
                    'email.required' => 'Email is required.',
                    'phone.required' => 'Mobile no is required.',
                    'cp_first_name.required' => 'First Name is required.',
                    'cp_middle_name.required' => 'Middle Name is required.',
                    'cp_last_name.required' => 'Last Name is required.',
                    'cp_designation.required' => 'Designation is required.',
                    'cp_phone.required' => 'Phone Number is required.',
                    'cp_email.required' => 'Email is required.',
                ]);
    
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $company = Company::where('user_id', $id)->first();
                $UserEmail = User::where('email', $request->email)->where('id', '!=', $id)->exists();
                if ($UserEmail) {
                    return redirect()->back()->withErrors(['User Email already exists.'])->withInput();
                }
    
                DB::beginTransaction();
    
                $profileLogo = null;
                if ($request->hasFile('profile_logo')) {
                  // Get the existing company record
                  $user = User::find($company->user_id);
                   
                   if ($user && $user->profile_logo) {
                       // Delete the previous image from storage
                       $oldImagePath = public_path('uploads/company/logo/' . $user->profile_logo);
                       if (file_exists($oldImagePath)) {
                           unlink($oldImagePath);
                       }
                   }
                    $file = $request->file('profile_logo');
                    $profileLogo = time() . '_profile_logo.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/company/logo'), $profileLogo);
                }
    
                
                if (!$company) {
                    return redirect()->back()->withErrors(['Company not found.']);
                }
    
                $company->update([
                    'no_of_offices' => $request->no_of_offices,
                    'industry_id' => $request->industry_id,
                    'ownership_type_id' => $request->ownership_type_id,
                    'company_size_id' => $request->company_size_id,
                    'established_in' => $request->established_in,
                    'details' => $request->details,
                    'website' => $request->company_website,
                    'gst_no' => $request->gst_no,
                    'fax' => $request->fax,
                    'last_change' => $company->last_change + 1,
                    'cp_first_name' => $request->cp_first_name,
                    'cp_middle_name' => $request->cp_middle_name,
                    'cp_last_name' => $request->cp_last_name,
                    'cp_designation' => $request->cp_designation,
                    'cp_phone' => $request->cp_phone,
                    'cp_email' => $request->cp_email,
                    'updated_at' => Carbon::now()
                ]);
    
                if ($company->user_id) {
                    $user = User::find($id);
                    if ($user) {
                        $user->update([
                            'first_name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'country_id' => $request->country_id,
                            'state_id' => $request->state_id,
                            'city_id' => $request->city_id,
                            'pincode' => $request->pincode,
                            'facebook_url' => $request->facebook_url,
                            'twitter_url' => $request->twitter_url,
                            'linkedin_url' => $request->linkedin_url,
                            'google_plus_url' => $request->google_plus_url,
                            'pinterest_url' => $request->pinterest_url,
                            'profile_logo' => $profileLogo,
                        ]);
                    }
                }
    
                DB::commit();
                return redirect('company/dashboard')->with('success', 'Profile updated successfully.');
            }
    
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function changePassword(Request $request) {
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
                $user = Auth::guard('company')->user();
                if (!Hash::check($request->old_password, $user->password)) {
                    return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
                }
    
                // Update the password in the database
                $user->password = Hash::make($request->password);
                $user->save();
    
                return redirect()->back()->with('success', 'Password updated successfully.');
            }
            return view('company.pages.profile.changePassword');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function createCompanyLocation(Request $request) {
        DB::beginTransaction(); // Start transaction
    
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'location_name'   => 'required|string|max:255',
                'address'         => 'required|string',
                'fence_radius'    => 'required|numeric',  // Make sure this matches your DB column name
                'support_email'   => 'required|email',
                'support_contact' => 'required|string',
                'email'           => 'nullable|email',
                'notes'           => 'nullable|string',
                'employee'        => 'required|array',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            // Create new company location
            $location = new CompanyLocation();
            $location->company_id = auth()->guard('company')->user()->id ?? 1; // Assuming company_id is linked to the logged-in user
            $location->location_name = $request->location_name;
            $location->address = $request->address;
            $location->fence_radius = $request->fence_radius; // Ensure this matches DB column
            $location->support_email = $request->support_email;
            $location->support_contact = $request->support_contact;
            $location->email = $request->email;
            $location->notes = $request->notes;
            $location->employee = json_encode($request->employee);
            $location->login_url = url('/company/location/' . uniqid()); // Example login URL
    
            // Generate QR Code Data
            $qrData = json_encode([
                'CompanyID'    => $location->company_id,
                'Location'     => $location->location_name,
                'Address'      => $location->address,
                'SupportEmail' => $location->support_email,
                'LoginURL'     => $location->login_url
            ]);
           
            // Save QR Code Path in Database
            $location->qr_code = $qrData; // Store relative path in DB
    
            $location->save(); // Save to database
    
            DB::commit(); // Commit transaction
    
            return redirect()->back()->with('success', 'Company location created successfully with QR Code!');
    
        } catch (\Exception $e) {
            DB::rollback(); // Rollback on failure
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function updateCompanyLocation(Request $request, $id)
    {
        DB::beginTransaction(); // Start transaction

        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'location_name'   => 'required|string|max:255',
                'address'         => 'required|string',
                'fence_radius'    => 'required|numeric',  // Ensure this matches DB column name
                'support_email'   => 'required|email',
                'support_contact' => 'required|string',
                'email'           => 'nullable|email',
                'notes'           => 'nullable|string',
                'employee'        => 'required|array',  // Ensure employee is an array
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Ensure location exists
            $location = CompanyLocation::find($id);

            if (!$location) {
                return redirect()->back()->withErrors('Location not found.')->withInput();
            }

            // Update the location fields
            $location->company_id = auth()->guard('company')->user()->id ?? 1; // Assuming company_id is linked to the logged-in user
            $location->location_name = $request->location_name;
            $location->address = $request->address;
            $location->fence_radius = $request->fence_radius; // Ensure this matches DB column
            $location->support_email = $request->support_email;
            $location->support_contact = $request->support_contact;
            $location->email = $request->email;
            $location->notes = $request->notes;
            $location->employee = json_encode($request->employee);
            $location->login_url = url('/staff-login?department=' . $id); // Example login URL

            // Generate QR Code Data
            $qrData = json_encode([
                'CompanyID'    => $location->company_id,
                'Location'     => $location->location_name,
                'Address'      => $location->address,
                'SupportEmail' => $location->support_email,
                'LoginURL'     => $location->login_url
            ]);

            // Save QR Code Path in Database (if you want to generate an actual QR code image, you would use a package like `endroid/qr-code`)
            $location->qr_code = $qrData; // Store QR code data as JSON string (you can replace this with an image path if needed)

            $location->save(); // Save to database

            DB::commit(); // Commit transaction

            return redirect()->route('company.profile')->with('success', 'Company location updated successfully with QR Code!');
        } catch (\Exception $e) {
            DB::rollback(); // Rollback on failure
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function deleteLocation($id)
    {
        DB::beginTransaction();  // Start transaction

        try {
            // Find the company location by ID
            $location = CompanyLocation::find($id);

            // Check if the location exists
            if (!$location) {
                return redirect()->back()->withErrors('Location not found.');
            }
            // Delete the location from the database
            $location->delete();

            DB::commit();  // Commit transaction

            return redirect()->route('company.profile')->with('success', 'Location deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();  // Rollback on failure
            return redirect()->back()->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    public function createCompanySponsor(Request $request) {
        DB::beginTransaction(); // Start transaction
        // dd($request->all());
    
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'sponsor_company_name'   => 'required|string|max:255',
                'sponsor_company_description'         => 'required|string|max:255',
                'sponsor_company_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $companyLogo = null;
            if ($request->hasFile('sponsor_company_logo')) {

                // Get the existing company record
                $file = $request->file('sponsor_company_logo');
                $companyLogo = time() . '_sponser_logo.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/company/sponsor'), $companyLogo);
            }


    
            // Create new company sponser
            $sponser = new CompanySponsor();

            $user_id = auth()->guard('company')->user()->id;
            $company_id = Company::where('user_id', $user_id)->first()->id;

            if ($company_id) {
                $sponser->company_id = $company_id; // Assuming company_id is linked to the logged-in user
                $sponser->company_name = $request->sponsor_company_name;
                $sponser->company_description = $request->sponsor_company_description;
                $sponser->company_logo = $companyLogo;
                $sponser->save();  // Save to database
        
                DB::commit(); // Commit transaction
        
                return redirect()->back()->with('success', 'Sponsors company created successfully!');
            }else {
                return redirect()->back()->withErrors(['error' => 'Company details not found.']);
            }

        } catch (\Exception $e) {
            DB::rollback(); // Rollback on failure
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function updateCompanySponsor(Request $request, $id)
    {
        DB::beginTransaction(); // Start transaction
        // dd($request->all());
    
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'sponsor_company_name'   => 'required|string|max:255',
                'sponsor_company_description' => 'required|string|max:255',
                'sponsor_company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Ensure sponser exists
            $sponser = CompanySponsor::find($id);

            if (!$sponser) {
                return redirect()->back()->withErrors('sponser not found.')->withInput();
            }

                
            $companyLogo = $sponser->company_logo;
            if ($request->hasFile('sponsor_company_logo')) {

                // Get the existing company record
                $file = $request->file('sponsor_company_logo');
                $companyLogo = time() . '_sponser_logo.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/company/sponsor'), $companyLogo);
            }

            $sponser->company_name = $request->sponsor_company_name;
            $sponser->company_description = $request->sponsor_company_description;
            $sponser->company_logo = $companyLogo;
            $sponser->save(); // Save to database

            DB::commit(); // Commit transaction

            return redirect()->route('company.profile')->with('success', 'Company sponser updated successfully with QR Code!');
        } catch (\Exception $e) {
            DB::rollback(); // Rollback on failure
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function deleteSponsor($id)
    {
        DB::beginTransaction();  // Start transaction

        try {
            // Find the company Sponsor by ID
            $Sponsor = CompanySponsor::find($id);

            // Check if the Sponsor exists
            if (!$Sponsor) {
                return redirect()->back()->withErrors('Sponsor not found.');
            }
            // Delete the Sponsor from the database
            $Sponsor->delete();

            DB::commit();  // Commit transaction

            return redirect()->route('company.profile')->with('success', 'Sponsor deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();  // Rollback on failure
            return redirect()->back()->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    public function logout() {
        auth()->guard('company')->logout();
        return redirect('company/login');
    }
}

