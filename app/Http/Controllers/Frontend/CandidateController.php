<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CandidateWorkExperience as WorkExperience;
use App\Models\CandidateEducation as Education;
use App\Models\CandidateCertification as Certification;
use App\Models\CandidateAwards as Awards;
use App\Models\CVTemplate;
use App\Models\User;
use DB;
use Validator;
// use Image;
// use File;
// use Auth;
// use Session;
// use Redirect;

class CandidateController extends Controller
{
  /**
   * Load admin login page
   * @method index
   * @param  null
   *
   */
  public function dashboard()
  {
    try {
      // $page_title = 'User Management';
      // $page_description = '';
      // $breadcrumbs = [
      //   [
      //     'title' => 'User Management',
      //     'url' => '',
      //   ]
      // ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      $users = Customer::with(['city', 'state', 'work', 'work.functionalArea', 'education', 'certification', 'awards'])->where('id', Auth()->guard('candidate')->user()->id)->first();
      // dd($users);
      return view('frontend.candidate.dashboard', compact('users'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function workexperience()
  {
    try {
      // $page_title = 'User Management';
      // $page_description = '';
      // $breadcrumbs = [
      //   [
      //     'title' => 'User Management',
      //     'url' => '',
      //   ]
      // ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      $users = Customer::with(['city', 'state'])->where('id', Auth()->guard('candidate')->user()->id)->first();
      $workexperience = WorkExperience::with(['functionalArea', 'IndustryType'])->where('candidate_id', Auth()->guard('candidate')->user()->id)->get();
      // dd( $workexperience);
      return view('frontend.candidate.workexperience', compact('users', 'workexperience'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function skills()
  {
    try {
      // $page_title = 'User Management';
      // $page_description = '';
      // $breadcrumbs = [
      //   [
      //     'title' => 'User Management',
      //     'url' => '',
      //   ]
      // ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      $users = Customer::with(['city', 'state'])->where('id', Auth()->guard('candidate')->user()->id)->first();
      // dd( $users);
      return view('frontend.candidate.skills', compact('users'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function education()
  {
    try {
      // $page_title = 'User Management';
      // $page_description = '';
      // $breadcrumbs = [
      //   [
      //     'title' => 'User Management',
      //     'url' => '',
      //   ]
      // ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      $users = Customer::with(['city', 'state'])->where('id', Auth()->guard('candidate')->user()->id)->first();
      $education = Education::with(['QualificationType', 'CollegeUniversityName'])->where('candidate_id', Auth()->guard('candidate')->user()->id)->get();

      // dd( $education);
      return view('frontend.candidate.educations', compact('users', 'education'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function certifications()
  {
    try {
      // $page_title = 'User Management';
      // $page_description = '';
      // $breadcrumbs = [
      //   [
      //     'title' => 'User Management',
      //     'url' => '',
      //   ]
      // ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      $users = Customer::with(['city', 'state'])->where('id', Auth()->guard('candidate')->user()->id)->first();
      $certifications = Certification::where('candidate_id', Auth()->guard('candidate')->user()->id)->get();

      // dd( $certifications);
      return view('frontend.candidate.certifications', compact('users', 'certifications'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function recognition()
  {
    try {
      // $page_title = 'User Management';
      // $page_description = '';
      // $breadcrumbs = [
      //   [
      //     'title' => 'User Management',
      //     'url' => '',
      //   ]
      // ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      $users = Customer::with(['city', 'state'])->where('id', Auth()->guard('candidate')->user()->id)->first();
      $rewards = Awards::where('candidate_id', Auth()->guard('candidate')->user()->id)->get();

      // dd( $users);
      return view('frontend.candidate.recognition', compact('users', 'rewards'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function settings()
  {
    try {
      // $page_title = 'User Management';
      // $page_description = '';
      // $breadcrumbs = [
      //   [
      //     'title' => 'User Management',
      //     'url' => '',
      //   ]
      // ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      $users = Customer::with(['city', 'state'])->where('id', Auth()->guard('candidate')->user()->id)->first();
      // dd( $users);
      return view('frontend.candidate.settings', compact('users'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function onboarding()
  {
    try {
      // $page_title = 'User Management';
      // $page_description = '';
      // $breadcrumbs = [
      //   [
      //     'title' => 'User Management',
      //     'url' => '',
      //   ]
      // ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      $users = Customer::with(['city', 'state'])->where('id', Auth()->guard('candidate')->user()->id)->first();
      // dd( $users);
      return view('frontend.candidate.onboarding', compact('users'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function cvPreview(Request $request)
  {
    try {
      $currentURI =  $request->segment(1);

      $template = $request->template;

      // $page_title = 'User Management';
      // $page_description = '';
      // $breadcrumbs = [
      //   [
      //     'title' => 'User Management',
      //     'url' => '',
      //   ]
      // ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      if (Auth()->guard('candidate')->user())
        $users = Customer::with(['city', 'state'])->where('id', Auth()->guard('candidate')->user()->id)->first();
      else
        $users = null;
      $template = CVTemplate::where('id',  $template)->first();
      // dd( $users);
      return view('frontend.candidate.cvPreview', compact('users', 'template', 'currentURI'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function download()
  {
    try {

      // $page_title = 'User Management';
      // $page_description = '';
      // $breadcrumbs = [
      //   [
      //     'title' => 'User Management',
      //     'url' => '',
      //   ]
      // ];
      $status = request('status');
      if ($status == '0') {
        $status = '2';
      }
      if (Auth()->guard('candidate')->user())
        $users = Customer::with(['city', 'state'])->where('id', Auth()->guard('candidate')->user()->id)->first();
      else
        $users = null;
      // dd( $users);
      return view('frontend.candidate.cvDownload', compact('users'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  /**
   * Load admin add user
   * @method add user
   * @param null
   */
  public function details($companyurl, Request $request)
  {
    try {

      $pageSettings = $this->pageSetting('add');

      $page_title =  $pageSettings['page_title'];
      $page_description = $pageSettings['page_description'];
      $breadcrumbs = $pageSettings['breadcrumbs'];
      $users = User::with(['city', 'state', 'industry', 'jobs'])
        ->where('status', '=', 1)
        ->where('role_id', '=', 3)
        ->orderBy('id', 'desc')
        ->first();
      // dd($users->toArray());
      return view('frontend.employers-details', compact('page_title', 'page_description', 'breadcrumbs', 'users'));
    } catch (\Exception $e) {
      return redirect()->back()->withErrors($e->getMessage());
    }
  }



  public function pageSetting($action, $dataArray = [])
  {
    if ($action == 'edit') {
      $data['page_title'] = 'User Management';
      $data['page_description'] = 'Edit User';
      $data['breadcrumbs'] = [
        [
          'title' => 'User Management',
          'url' => url('admin/users/list'),
        ],
        [
          'title' => 'Edit User',
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
      $data['page_title'] = 'User Management';
      $data['page_description'] = 'Add a User';
      $data['breadcrumbs'] = [
        [
          'title' => 'User Management',
          'url' => url('admin/users/list'),
        ],
        [
          'title' => 'Add a User',
          'url' => '',
        ],
      ];
      return $data;
    }
  }
}
