<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\Company;
use App\Models\Service;
use App\Models\Post;
use App\Models\Job;
use App\Models\SavedJobs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
// use Intervention\Image\Facades\Image; // Uncomment this if you are using Intervention Image
// use Illuminate\Support\Facades\File; // Uncomment this if you are using the File facade
// use Illuminate\Support\Facades\Redirect; // Uncomment this if you are using Redirect

class HomeController extends Controller
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

      $page_title = 'Connecting Reliable Staff to Businesses';
      $page_description = '';
      $breadcrumbs = '';
      $blogs = Post::where('is_active', 1)->paginate(15);
      // echo "<pre>";
      // print_r($blogs);die;
      $categories = Category::where('is_home_display', 0)->where('status', 1)->orderby('updated_at', 'DESC')->get()->take('12');
      $services = Service::where('status', 1)->get();

      // return view('frontend.index', compact('categories','services'));
      return view('frontend.index', compact('page_title', 'page_description', 'breadcrumbs', 'blogs', 'categories', 'services'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function blogDetails($slug)
  {
    try {
      $details = Post::where('is_active', 1)->where('slug', $slug)->first();
      $page_title = $details->title;
      $page_description = '';
      $breadcrumbs = '';

      return view('frontend.blogdetails', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function postTask()
  {
    try {

      $page_title = 'Post Tasks';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.posttask', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function categories()
  {
    try {

      $page_title = 'Categories';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.categories', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function jobs()
  {
    try {

      $page_title = 'Jobs';
      $page_description = '';
      $breadcrumbs = '';
      $jobs = Job::where('status', 1)->get();
      // dd($jobs);
      return view('frontend.jobs', compact('page_title', 'page_description', 'breadcrumbs', 'jobs'));
    } catch (\Exception $e) {
      // dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }


  public function jobsListApi()
  {
    try {
      $jobs = Job::with('jobType', 'jobExperience')->where('status', 1)->orderby('created_at', 'desc')->get();

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


  public function jobDetailsApi($slug)
  {
    try {
      $jobs = Job::with('jobType', 'jobExperience')->where('status', 1)->where('slug', $slug)->first();

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


  public function jobSaveApi(Request $request)
  {
    try {
      $request->validate([
        'job_slug' => 'required|string'
      ]);

      $slug = $request->get('job_slug');
      $jobs = Job::with('jobType', 'jobExperience')->where('status', 1)->where('slug', $slug)->first();


      if ($jobs) {
        $user = auth()->guard('user')->user();

        $checkAlreadySavedJobs = SavedJobs::where('user_id', $user->id)->where('job_id', $jobs->id)->first();
        if (!$checkAlreadySavedJobs) {
          $data = new SavedJobs();
          $data->user_id = $user->id;
          $data->job_id = $jobs->id;
          $data->save();
        }

        return response()->json([
          'success' => true,
          'message' => 'Jobs saves successfully.',
          'data' => $jobs
        ], 200);
      } else {
        return response()->json([
          'success' => false,
          'message' => 'Could not find job details.',
        ], 200);
      }
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Failed to fetch jobs.',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function companies()
  {
    try {
      $page_title = 'Companies';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.companies', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }


  public function companyListApi()
  {
    try {
      $companies = Company::select('companies.*')
        ->with(['getAllCompanySponsers', 'user'])
        ->join('users', 'users.id', '=', 'companies.user_id')
        ->where('users.is_active', '1')
        ->where('users.is_verified', '1')
        ->get();
      // dd($companies);

      return response()->json([
        'success' => true,
        'message' => 'Company fetched successfully.',
        'data' => $companies
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Failed to fetch jobs.',
        'error' => $e->getMessage()
      ], 500);
    }
  }


  public function companyDetailsApi($id)
  {
    try {
      $companies = Company::select('companies.*')
        ->with(['getAllCompanySponsers', 'user'])
        ->join('users', 'users.id', '=', 'companies.user_id')
        ->where('users.is_active', '1')
        ->where('users.is_verified', '1')
        ->where('companies.id', $id)
        ->get();
      // dd($companies);

      return response()->json([
        'success' => true,
        'message' => 'Company fetched successfully.',
        'data' => $companies
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Failed to fetch jobs.',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  public function companyDetails($id)
  {
    try {
      $page_title = 'Company Details';
      $page_description = '';
      $breadcrumbs = '';

      $company = Company::select('companies.*')
        ->with(['getAllCompanySponsers', 'user'])
        ->join('users', 'users.id', '=', 'companies.user_id')
        ->where('users.is_active', '1')
        ->where('users.is_verified', '1')
        ->where('companies.id', $id)
        ->get();

      return view('frontend.companies-details', compact('page_title', 'page_description', 'breadcrumbs', 'company'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function services()
  {
    try {
      $page_title = 'Services';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.services', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function development()
  {
    try {
      $page_title = 'Development ';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.development', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function business()
  {
    try {
      $page_title = 'Business';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.business', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function techIt()
  {
    try {
      $page_title = 'Tech It';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.techIt', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function finance()
  {
    try {
      $page_title = 'Finance';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.finance', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function networking()
  {
    try {
      $page_title = 'Networking';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.networking', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function blogs()
  {
    try {
      $page_title = 'Blogs';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.blogs', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
  public function contactus()
  {
    try {
      $page_title = 'About Us';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.contact-us', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function aboutus()
  {
    try {
      $page_title = 'About Us';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.aboutus', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function career()
  {
    try {
      $page_title = 'Career';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.career', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function employeeHome()
  {
    try {
      $page_title = 'Employee Home';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.employee-home', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function sitemap()
  {
    try {
      $page_title = 'Sitemap';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.sitemap', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function helpCenter()
  {
    try {
      $page_title = 'Help Center';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.help-center', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function summonsNotices()
  {
    try {
      $page_title = 'Summons/Notices';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.summons-notices', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function grievances()
  {
    try {
      $page_title = 'Grievances';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.grievances', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function reportIssues()
  {
    try {
      $page_title = 'Report Issues';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.report-issues', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function privacyPolicy()
  {
    try {
      $page_title = 'Privacy Policy';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.privacy-policy', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function termsConditions()
  {
    try {
      $page_title = 'Terms & Conditions';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.terms-conditions', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function fraudAlert()
  {
    try {
      $page_title = 'Fraud Alert';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.fraud-alert', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function trustSafety()
  {
    try {
      $page_title = 'Trust & Safety';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.trust-safety', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function testimonials()
  {
    try {
      $page_title = 'Testimonials';
      $page_description = '';
      $breadcrumbs = '';
      return view('frontend.testimonials', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function getPassword()
  {
    $password = '12345678';
    echo Hash::make($password);
  }
  /**
   * Load admin add user
   * @method add user
   * @param null
   */


  // public function login(Request $req)
  // {
  //   if ($req->method() == 'POST') {
  //     // Validation for email and password
  //     $validator = Validator::make($req->all(), [
  //       'email' => 'required|email',
  //       'password' => 'required',
  //     ]);

  //     // Check if validation fails
  //     if ($validator->fails()) {
  //       return redirect("login")
  //         ->withErrors($validator)
  //         ->withInput();  // Optional: Keep input values after redirect
  //     }

  //     // User login attempt
  //     $userData = array(
  //       'email' => $req->get('email'),
  //       'password' => $req->get('password')
  //     );

  //     // Retrieve the user based on email
  //     $checkUser = User::where('email', $req->get('email'))->first();

  //     if ($checkUser) {
  //       // Set the role and user type
  //       $role = $checkUser->role_id;
  //       switch ($role) {
  //         case 1:
  //           $userType = 'admin';
  //           break;
  //         case 2:
  //           $userType = 'company';
  //           break;
  //         case 3:
  //           $userType = 'user';
  //           break;
  //         default:
  //           return redirect('login')->withErrors(['error' => 'Invalid role.']);
  //       }
  //     } else {
  //       return redirect("registration")->withErrors(['error' => 'Register first.']);
  //     }

  //     // Authenticate the user with the respective guard
  //     if (Auth::guard($userType)->attempt($userData)) {
  //       $user = Auth::guard($userType)->user();

  //       // Check user status: if active and verified
  //       if ($user->is_active == 1 && $user->is_verified == 1) {
  //         // Redirect to dashboard
  //         return redirect($userType . "/dashboard");
  //       } else {
  //         // If user is deactivated or not verified
  //         Auth::guard($userType)->logout();
  //         Session::flush();

  //         // Flash message and redirect
  //         Session::flash('status', "This user account has been deactivated.");
  //         return redirect("login")->withErrors(['error' => 'This user account has been deactivated.']);
  //       }
  //     } else {
  //       // If authentication fails, logout and redirect with error message
  //       Auth::guard($userType)->logout();
  //       Session::flush();
  //       Session::flash('status', "Invalid Login");
  //       return redirect("login")->withErrors(['error' => 'Invalid Email or Password.']);
  //     }
  //   } else {

  //     // check if allready login then redirect on it's Dashboard 
  //     $company = auth()->guard('company')->user();
  //     if ($company) {
  //       return redirect("company/dashboard");
  //     }

  //     $admin = auth()->guard('admin')->user();
  //     if ($admin) {
  //       return redirect("admin/dashboard");
  //     }

  //     $user = auth()->guard('user')->user();
  //     if ($user) {
  //       return redirect("user/dashboard");
  //     }

  //     // Return the login view for GET request
  //     return view('auth.login');
  //   }
  // }


  public function login(Request $req)
  {
    if ($req->method() == 'POST') {
      // Validation for email and password
      $validator = Validator::make($req->all(), [
        'email' => 'required|email',
        'password' => 'required',
      ]);

      // Check if validation fails
      if ($validator->fails()) {
        return redirect("login")
          ->withErrors($validator)
          ->withInput();  // Optional: Keep input values after redirect
      }

      // User login attempt
      $userData = array(
        'email' => $req->get('email'),
        'password' => $req->get('password')
      );

      // Retrieve the user based on email
      $checkUser = User::where('email', $req->get('email'))->first();

      if ($checkUser) {
        // Set the role and user type
        $role = $checkUser->role_id;
        switch ($role) {
          case 1:
            $userType = 'admin';
            break;
          case 2:
            $userType = 'company';
            break;
          case 3:
            $userType = 'user';
            break;
          default:
            return redirect('login')->withErrors(['error' => 'Invalid role.']);
        }
      } else {
        // return redirect("registration")->withErrors(['error' => 'Register first.']);
        return redirect("login")->withErrors(['error' => 'Invalid User']);
      }

      // Authenticate the user with the respective guard
      if (Auth::guard($userType)->attempt($userData)) {
        $user = Auth::guard($userType)->user();

        // Check user status: if active and verified
        if ($user->is_active == 1 && $user->is_verified == 1) {
          // Redirect to dashboard
          return redirect($userType . "/dashboard");
        } else {
          // If user is deactivated or not verified
          Auth::guard($userType)->logout();
          Session::flush();

          // Flash message and redirect
          Session::flash('status', "This user account has been deactivated.");
          return redirect("login")->withErrors(['error' => 'This user account has been deactivated.']);
        }
      } else {
        // If authentication fails, logout and redirect with error message
        Auth::guard($userType)->logout();
        Session::flush();
        Session::flash('status', "Invalid Login");
        return redirect("login")->withErrors(['error' => 'Invalid Email or Password.']);
      }
    } else {

      // check if allready login then redirect on it's Dashboard 
      $company = auth()->guard('company')->user();
      if ($company) {
        return redirect("company/dashboard");
      }

      $admin = auth()->guard('admin')->user();
      if ($admin) {
        return redirect("admin/dashboard");
      }

      $user = auth()->guard('user')->user();
      if ($user) {
        return redirect("user/dashboard");
      }

      // Return the login view for GET request
      return view('auth.login');
    }
  }

  public function registration(Request $request)
  {
    try {
      if ($request->isMethod('post')) {
        $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required',
          'mobile' => 'required',
          'password' => 'required',
        ], [
          'name.required' => 'User name is required.',
          'email.required' => 'Email is required.',
          'mobile.required' => 'Mobile no is required.',
          'password.required' => 'Password is required.',
        ]);
        if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        DB::beginTransaction();

        $nameArr = explode(' ', $request->name);

        $array = [
          'first_name' =>  $nameArr[0],
          'last_name' =>  isset($nameArr[1]) ? $nameArr[1] : '',
          'email_id' => $request->email,
          'mobile_no' => $request->mobile,
          'status' => 1,
          'password' => bcrypt($request->password)

        ];
        $UserEmail = Customer::where('email_id', $array['email_id'])->exists();
        if ($UserEmail) {
          return redirect()->back()->withErrors(['email' => 'User Email already exist.'])->withInput($request->all());
        }

        $response = Customer::UpdateOrCreate(['id' => null], $array);
        DB::commit();
        $userData = array(
          'email_id' =>  $array['email_id'],
          'password' =>  $request->password
        );
        $attemp = Auth::guard('candidate')->attempt($userData);
        if ($attemp) {
          $user =  Auth::guard('candidate')->user();
          $id = $user->id;
          $email = $user->email_id;
          $name = $user->name;
          if ($user->status == 1) {
            Session::put('id', $id);
            Session::put('name', $name);
            Session::put('email', $email);
            Session::put('access_name', 'candidate');
          }

          return redirect("account/dashboard");
        }
        return redirect()->back()->withErrors(['Something went wrong, please try again.']);
      }

      $pageSettings = $this->pageSetting('registration');

      $page_title =  $pageSettings['page_title'];
      $page_description = $pageSettings['page_description'];
      $breadcrumbs = $pageSettings['breadcrumbs'];
      // print_r($breadcrumbs);die;
      return view('frontend.auth.register', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      DB::rollback();
      return redirect()->back()->withErrors($e->getMessage());
    }
  }
  public function signin(Request $request)
  {
    try {
      if ($request->isMethod('post')) {
        $validator = Validator::make($request->all(), [
          'email' => 'required',
          'password' => 'required',
        ], [
          'email.required' => 'Email is required.',
          'password.required' => 'Password is required.',
        ]);
        if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        DB::beginTransaction();
        // echo bcrypt($request->get('password')); die;

        $userData = array(
          'email_id' => $request->get('email'),
          'password' => $request->get('password')
        );
        $attemp = Auth::guard('candidate')->attempt(['email_id' => $request->email, 'password' => ($request->password)]);
        if ($attemp) {
          $user =  Auth::guard('candidate')->user();
          $id = $user->id;
          $email = $user->email_id;
          $name = $user->name;
          if ($user->status == 1) {
            Session::put('id', $id);
            Session::put('name', $name);
            Session::put('email', $email);
            Session::put('access_name', 'candidate');
            /**
             * Update last login and last login IP
             */
            // $this->authenticated($req, $user);
            return redirect("account/dashboard");
          } else {
            Auth::logout();

            Session::flash('status', "This user has been deactivated.");
            return redirect("admin?error=This user has been deactivated.")->withError(['error' => 'This user has been deactivated.']);
          }
        } else {

          Auth::logout();
          Session::flush();
          Session::flash('status', "Invalid Login");
          return redirect("admin/")->withErrors(['error' => 'Invalid Email and Password.']);
        }

        // dd(  $array );
        DB::commit();
        return redirect('admin/users/list')->with('success', 'User details added successfully.');
      }

      $pageSettings = $this->pageSetting('signin');

      $page_title =  $pageSettings['page_title'];
      $page_description = $pageSettings['page_description'];
      $breadcrumbs = $pageSettings['breadcrumbs'];

      return view('frontend.auth.login', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      DB::rollback();
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
    if ($action == 'registration') {
      $data['page_title'] = 'Registration';
      $data['page_description'] = 'Registration';
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
    if ($action == 'signin') {
      $data['page_title'] = 'Signin';
      $data['page_description'] = 'Signin';
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

  public function userRegistrationNew(Request $request)
  {
    try {
      // Remove dd() to allow execution
      // dd($request->all());

      // Validate Input
      $validator = Validator::make($request->all(), [
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone_number' => 'required|digits_between:7,15',
        'password' => 'required|min:6',
      ], [
        'full_name.required' => 'User name is required.',
        'email.required' => 'Email is required.',
        'phone_number.required' => 'Mobile no is required.',
        'password.required' => 'Password is required.',
      ]);

      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
      }

      // Start Transaction
      DB::beginTransaction();

      // Create User
      $user = new User();
      $user->first_name = $request->full_name;
      $user->email = $request->email;
      $user->phone = $request->phone_number;
      $user->password = Hash::make($request->password);
      $user->is_verified = 0;
      $user->role_id = 3;
      $user->created_at = now();
      $user->updated_at = now();
      $user->save();

      // Ensure user is created before proceeding
      if ($user->id) {
        $customer = new Candidate();
        $customer->user_id = $user->id;
        $customer->unique_id = 'USER-' . strtoupper(Str::random(8));
        $customer->save();
      }

      // Commit Transaction
      DB::commit();

      return redirect()->back()->with('success', 'New Registration successfully completed.');
    } catch (\Exception $e) {
      dd($e);
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }


  public function userRegistration(Request $request)
  {
    try {

      $pageSettings = $this->pageSetting('registration');

      $page_title =  $pageSettings['page_title'];
      $page_description = $pageSettings['page_description'];
      $breadcrumbs = $pageSettings['breadcrumbs'];
      // print_r($breadcrumbs);die;
      return view('frontend.auth.user_register', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      DB::rollback();
      return redirect()->back()->withErrors($e->getMessage());
    }
  }

  public function companyRegistrationNew(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|digits_between:7,15',
        'password' => 'required|min:6',
      ], [
        'full_name.required' => 'User name is required.',
        'email.required' => 'Email is required.',
        'phone.required' => 'Mobile no is required.',
        'password.required' => 'Password is required.',
      ]);

      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
      }

      // Start Transaction
      DB::beginTransaction();

      // Create User
      $user = new User();
      $user->first_name = $request->full_name;
      $user->email = $request->email;
      $user->phone = $request->phone;
      $user->password = Hash::make($request->password);
      $user->is_verified = 0;
      $user->role_id = 2;
      $user->created_at = now();
      $user->updated_at = now();
      $user->save();

      // Ensure user is created before proceeding
      if ($user->id) {
        $company = new Company();
        $company->user_id = $user->id;
        $company->industry_id = $request->industry_id;
        $company->unique_id = 'USER-' . strtoupper(Str::random(8));
        $company->save();
      }

      // Commit Transaction
      DB::commit();

      return redirect()->back()->with('success', 'New Registration successfully completed.');
    } catch (\Exception $e) {
      dd($e);
      DB::rollback();
      return redirect()->back()->withErrors($e->getMessage());
    }
  }

  public function comapnyRegistration(Request $request)
  {
    try {


      $pageSettings = $this->pageSetting('registration');

      $page_title =  $pageSettings['page_title'];
      $page_description = $pageSettings['page_description'];
      $breadcrumbs = $pageSettings['breadcrumbs'];
      // print_r($breadcrumbs);die;
      return view('frontend.auth.company_register', compact('page_title', 'page_description', 'breadcrumbs'));
    } catch (\Exception $e) {
      dd($e);
      DB::rollback();
      return redirect()->back()->withErrors($e->getMessage());
    }
  }

  public function jobsDetais(Request $request, $slug)
  {
    try {

      $page_title =  "job";
      $page_description = "";
      $breadcrumbs = "";
      $slug = $slug;
      // print_r($breadcrumbs);die;
      return view('frontend.job-details', compact('page_title', 'page_description', 'breadcrumbs', 'slug'));
    } catch (\Exception $e) {
      // dd($e);
      DB::rollback();
      return redirect()->back()->withErrors($e->getMessage());
    }
  }
}
