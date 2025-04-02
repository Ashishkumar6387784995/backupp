<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use Redirect;
use Validator;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Load admin login page
     * @method index
     * @param  null
     *
     */
    public function index()
    {
        return view('admin.pages.auth.login');
    }

    /**
     * Admin login and their employee
     * @method login
     * @param null
     */
    public function login(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect("admin/login")->withErrors($validator);
        }
        $userData = array(
            'email' => $req->get('email'),
            'password' => $req->get('password')
        ); 
 
        if (Auth::guard('admin')->attempt($userData)) {
            $user = Auth::guard('admin')->user();
          
            if ($user->is_active == 1 && $user->is_verified == 1) {
                return redirect("admin/dashboard");
            } else {
                Auth::guard('admin')->logout();
                return redirect("admin/login")->withError(['error' => 'This user has been deactivated.']);
            }
        } else {
            Auth::guard('admin')->logout();
            return redirect("admin/")->withErrors(['error' => 'Invalid Email and Password.']);
        }
    }

    public function userLogin(Request $req) {
        if($req->method() == 'POST') {
            // Validation for email and password
            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            // Check if validation fails
            if ($validator->fails()) {
                return redirect("user/login")
                    ->withErrors($validator)
                    ->withInput();  // Optional: Keep input values after redirect
            }
    
            // User login attempt
            $userData = array(
                'email' => $req->get('email'),
                'password' => $req->get('password')
            );
    
            // Authenticate the user with the 'company' guard
            if (Auth::guard('user')->attempt($userData)) {
                $user = Auth::guard('user')->user();
               
    
                // Check user status
                if ($user->is_active == 1 && $user->is_verified == 1) {
                    // Redirect to dashboard
                    return redirect("user/dashboard");
                } else {
                    // Logout if user is deactivated
                    Auth::guard('user')->logout();
                    Session::flush();
    
                    // Flash message and redirect back
                    Session::flash('status', "This user account has been deactivated.");
                    return redirect("company/login")->withErrors(['error' => 'This user account has been deactivated.']);
                }
            } else {
                // If authentication fails, logout and redirect with error message
                Auth::guard('user')->logout();
                Session::flush();
                Session::flash('status', "Invalid Login");
                return redirect("user/login")->withErrors(['error' => 'Invalid Email or Password.']);
            }
        } else {
            // Return the login view when it's not a POST request
            return view('admin.pages.auth.user.login');
        }
    }

    public function companyLogin(Request $req) {
        if($req->method() == 'POST') {
            // Validation for email and password
            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            // Check if validation fails
            if ($validator->fails()) {
                return redirect("company/login")
                    ->withErrors($validator)
                    ->withInput();  // Optional: Keep input values after redirect
            }
    
            // User login attempt
            $userData = array(
                'email' => $req->get('email'),
                'password' => $req->get('password')
            );
    
            // Authenticate the user with the 'company' guard
            if (Auth::guard('company')->attempt($userData)) {
                $user = Auth::guard('company')->user();
               
    
                // Check user status
                if ($user->is_active == 1 && $user->is_verified == 1) {
                    // Redirect to dashboard
                    return redirect("company/dashboard");
                } else {
                    // Logout if user is deactivated
                    Auth::guard('company')->logout();
                    Session::flush();
    
                    // Flash message and redirect back
                    Session::flash('status', "This user account has been deactivated.");
                    return redirect("company/login")->withErrors(['error' => 'This user account has been deactivated.']);
                }
            } else {
                // If authentication fails, logout and redirect with error message
                Auth::guard('company')->logout();
                Session::flush();
                Session::flash('status', "Invalid Login");
                return redirect("company/login")->withErrors(['error' => 'Invalid Email or Password.']);
            }
        } else {
            // Return the login view when it's not a POST request
            return view('admin.pages.auth.company.login');
        }
    }
    

    public function logout()
    {

        Auth::logout();
        Session::flush();
        return Redirect::to('admin/');
    }
    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    function authenticated($request, $user)
    {
        $user->update([
            'last_login' => date('Y-m-d H:i:s'),
            'last_login_ip' => $request->getClientIp()
        ]);
    }   
}
