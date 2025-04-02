<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\{Company,FavouriteCompany,ReportedToCompany,Job,User};
use DB;
use Validator;
use Carbon\Carbon;
use Auth;
// use Image;
// use File;
// use Auth;
// use Session;
// use Redirect;

class CompanyController extends Controller
{
  /**
   * Load admin login page
   * @method index
   * @param  null
   *
   */
  public function index()
  {
    try {
      $page_title = 'Company Management';
      $page_description = '';
      $breadcrumbs = [
        [
          'title' => 'Company Management',
          'url' => '',
        ]
      ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      $users = Company::with(['industry','user'])->paginate(10);
    
      return view('admin.pages.company.list', compact('page_title', 'page_description', 'breadcrumbs',  'users'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }



    // return view('admin.pages..list', compact('page_title', 'page_description', 'breadcrumbs'));
  }

  /**
   * Load admin add user
   * @method add user
   * @param null
   */
 
   public function editUser(Request $request, $id)
   {
       try {
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
                   'locaction' => 'nullable',
                   'locaction2' => 'nullable',
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
                   'is_active' => 'nullable|boolean',
               ], [
                   'name.required' => 'User name is required.',
                   'email.required' => 'Email is required.',
                   'phone.required' => 'Mobile no is required.',
               ]);
   
               if ($validator->fails()) {
                   return redirect()->back()->withErrors($validator)->withInput();
               }
               $company = Company::where('id', $id)->first();
               $UserEmail = User::where('email', $request->email)->where('id', '!=', $company->user_id)->exists();
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
                   'ceo' => $request->ceo_name,
                   'no_of_offices' => $request->no_of_offices,
                   'employees_count' => $request->employees_count,
                   'industry_id' => $request->industry_id,
                   'ownership_type_id' => $request->ownership_type_id,
                   'company_size_id' => $request->company_size_id,
                   'established_in' => $request->established_in,
                   'details' => $request->details,
                   'website' => $request->company_website,
                   'location' => $request->locaction,
                   'location2' => $request->locaction2,
                   'fax' => $request->fax,
                   'last_change' => $company->last_change + 1,
               ]);
   
               if ($company->user_id) {
                   $user = User::find($company->user_id);
                   if ($user) {
                       $user->update([
                           'first_name' => $request->name,
                           'email' => $request->email,
                           'phone' => $request->phone,
                           'country_id' => $request->country_id,
                           'state_id' => $request->state_id,
                           'city_id' => $request->city_id,
                           'pincode' => $request->pincode,
                           'is_active' => $request->is_active ?? 0,
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
               return redirect('admin/company/list')->with('success', 'User details updated successfully.');
           }
   
           $pageSettings = $this->pageSetting('edit');
           $page_title = $pageSettings['page_title'];
           $page_description = $pageSettings['page_description'];
           $breadcrumbs = $pageSettings['breadcrumbs'];
   
           $details = Company::with('user')->findOrFail($id);
           return view('admin.pages.company.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
   
       } catch (\Exception $e) {
           DB::rollback();
           return redirect()->back()->withErrors($e->getMessage());
       }
   }
   

  public function isCompanyAddedToFavourite($companyId)
  {
    return FavouriteCompany::where('user_id', Auth::id())
        ->where('company_id', $companyId)
        ->exists();
  }
  public function isReportedToCompany($companyId)
  {
      return ReportedToCompany::where('user_id', Auth::id())
          ->where('company_id', $companyId)
          ->exists();
  }



  public function delete($id)
  {
    try {
      if ($id) {
        DB::beginTransaction();
        $cat = User::find($id);
        if ($cat->delete()) {
          DB::commit();
          return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
          return redirect()->back()->with('error', 'Failed to delete try again.');
        }
      } else {
        return redirect()->back()->with('error', 'User details not found.');
      }
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function companyUserVerify($user_id, $status) {
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
        return redirect('admin/company/list')->with('success', $message);
      } else {
        return redirect()->back()->with('error', 'User details not found.');
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
        return redirect('admin/company/list')->with('success', 'User status updated successfully.');
      } else {
        return redirect()->back()->with('error', 'User details not found.');
      }
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->with('error', $e->getMessage());
    }
  }




  public function pageSetting($action, $dataArray = [])
  {
    if ($action == 'edit') {
      $data['page_title'] = 'Companies Management';
      $data['page_description'] = 'Edit Employer';
      $data['breadcrumbs'] = [
        [
          'title' => 'Company Management',
          'url' => url('admin/company/list'),
        ],
        [
          'title' => 'Edit Company',
          'url' => '',
        ],
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
      $data['page_title'] = 'Company Management';
      $data['page_description'] = 'Add a Company';
      $data['breadcrumbs'] = [
        [
          'title' => 'Company Management',
          'url' => url('admin/company/list'),
        ],
        [
          'title' => 'Add a Company',
          'url' => '',
        ],
      ];
      return $data;
    }
  }
}
