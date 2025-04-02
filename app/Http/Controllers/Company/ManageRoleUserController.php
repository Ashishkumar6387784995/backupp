<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Companydepartment;
use App\Models\Company\Role;
use App\Models\Company\ManageRoleUser;
use Auth;
use Validator;
use DB;
use Hash;

class ManageRoleUserController extends Controller
{
    public function index() {
        try {
            $page_title = 'Manage Role & User';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Manage Role & User',
                    'url' => '',
                ],
            ];
            $loginId = auth()->guard('company')->user()->id;
            $status = request('status');
            $users = ManageRoleUser::when(isset($status), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->where('admin_user_id', $loginId)
            ->with(['department','role'])
            ->get();
          
            return view('company.pages.company-role.list', compact('page_title', 'page_description', 'breadcrumbs','users'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }

    public function add(Request $request)
    {
        try {
            $loginUserId = Auth::guard('company')->user()->id;
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required',
                    'mobile' => 'required',
                    'password' => 'required',
                    'role_id' => 'required',
                    'department_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }
                $loginUserId = Auth::guard('company')->user()->id;
                DB::beginTransaction();
                $updateArr = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => Hash::make($request->password),
                    'role_id' => $request->role_id,
                    'department_id' => $request->department_id,
                    'admin_user_id' => $loginUserId,
                    'status' => $request->status
                ];
               
                if (ManageRoleUser::where('email', $updateArr['email'])->exists()) {
                    return redirect()->back()->withErrors(['User already exist.'])->withInput($request->all());
                }
                $response = ManageRoleUser::UpdateOrCreate(['id' => null], $updateArr);
                DB::commit();
                return redirect()->route('company.manageroleanduser.list')->with('success', 'User added successfully.');
            } else {
                $page_title = 'Add Manage Role & User';
                $page_description = '';
                $breadcrumbs = [
                    [
                        'title' => 'Add Manage Role & User',
                        'url' => '',
                    ],
                ];
                
                $departments = Companydepartment::with('department')->where('user_id', $loginUserId)->get();
                $roles = Role::where('status', 1)->get();
                return view('company.pages.company-role.add', compact('page_title', 'page_description', 'breadcrumbs','departments','roles'));
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            if ($id) {
                $loginUserId = Auth::guard('company')->user()->id;
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'email' => 'required',
                        'mobile' => 'required',
                        'role_id' => 'required',
                        'department_id' => 'required',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();   
                  
                    $updateArr = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'mobile' => $request->mobile,
                        'role_id' => $request->role_id,
                        'department_id' => $request->department_id,
                        'admin_user_id' => $loginUserId,
                        'status' => $request->status
                    ];
                    
             
                    if (ManageRoleUser::where('email', $updateArr['email'])->where('id', '!=', $id)->exists()) {
                        return redirect()->back()->withErrors(['User already exist.'])->withInput($request->all());
                    }
                    // print_r($updateArr);die;
                    $response = ManageRoleUser::UpdateOrCreate(['id' => $id], $updateArr);
                    DB::commit();
                    return redirect()->route('company.manageroleanduser.list')->with('success', 'User details updated successfully.');
                }

                $page_title = 'Manage Role & User';
                $page_description = 'Edit Manage Role & User';
                $details = ManageRoleUser::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit', ['title' => $details->category_name]);

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];
                    $departments = Companydepartment::with('department')->where('user_id', $loginUserId)->get();
                    $roles = Role::where('status', 1)->get();
                    return view('company.pages.company-role.edit', compact('page_title', 'page_description', 'breadcrumbs','departments','roles','details'));
                } else {
                    return redirect()->back()->withErrors(['User details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['User id is missing.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function assign(Request $request, $id) {
        try {
            // Ensure ID is provided
            if (!$id) {
                return redirect()->back()->withErrors(['User ID is missing.']);
            }
    
            // Ensure the authenticated user exists
            $loginUser = Auth::guard('company')->user();
            if (!$loginUser) {
                return redirect()->back()->withErrors(['Unauthorized access.']);
            }
    
            $loginUserId = $loginUser->id;
            
            // Retrieve the user
            $user = ManageRoleUser::where('id', $id)->where('admin_user_id', $loginUserId)->first();
            if (!$user) {
                return redirect()->back()->withErrors(['User does not exist.']);
            }
    
            if ($request->isMethod('post')) {
                // Start Transaction
                DB::beginTransaction();
    
                // Assign Permissions
                $user->permission = json_encode($request->permission ?? []);
                $user->save();
    
                // Commit Transaction
                DB::commit();
    
                return redirect()->route('company.manageroleanduser.list')
                    ->with('success', 'User assigned responsibilities successfully.');
            } else {
                // Fetch Permissions
                $permissions = json_decode($user->permission, true) ?? [];
    
                // Page Data
                $page_title = 'User Assign Responsibilities';
                $page_description = '';
                $breadcrumbs = [['title' => 'User Assign Responsibilities', 'url' => '']];
    
                return view('company.pages.company-role.assign', compact('page_title', 'page_description', 'breadcrumbs', 'permissions'));
            }
        } catch (\Exception $e) {
            // Rollback Transaction in case of failure
            DB::rollback();
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $loginUserId = Auth::guard('company')->user()->id;

            // Find the department and ensure it belongs to the logged-in user
            $cat = Companydepartment::where('id', $id)
                ->where('user_id', $loginUserId)
                ->first();

            if (!$cat) {
                return redirect()->back()->with('error', 'Department not found or unauthorized to delete.');
            }

            $cat->delete();

            return redirect()->back()->with('success', 'Department deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request)
    {
        try {
           
            $id = $request->id;
            $loginUserId = Auth::guard('company')->user()->id;

            // Find the department assigned to the logged-in user
            $department = Companydepartment::where('id', $id)
                ->where('user_id', $loginUserId)
                ->first();

            if (!$department) {
                return redirect()->back()->with('error', 'Department not found or unauthorized.');
            }

            // Toggle status
            $department->update(['status' => !$department->status]);

            return redirect()->back()->with('success', 'Status updated successfully.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput($request->all());
        }
    }



    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Manage Role & User';
            $data['page_description'] = 'Edit Manage Role & User';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Manage Role & User',
                    'url' => route('company.staff.list'),
                ]
            ];
            if (isset($dataArray['title']) && !empty($dataArray['title'])) {
                $data['breadcrumbs'][] =
                    [
                        'title' => $dataArray['title'],
                        'url' => '',

                    ];
            } else {
                $data['breadcrumbs'][] = [

                    'title' => 'Edit Manage Role & User',
                    'url' => '',

                ];
            }
            return $data;
        }

        if ($action == 'add') {
            $data['page_title'] = 'Manage Role & User';
            $data['page_description'] = 'Add a New Manage Role & User';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Department Manage Role & User',
                    'url' => route('company.staff.list'),
                ],
                [
                    'title' => 'Add Manage Role & User',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
