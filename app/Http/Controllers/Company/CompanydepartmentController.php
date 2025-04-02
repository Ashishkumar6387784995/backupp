<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Companydepartment;
use App\Models\Department;
use Auth;
use Validator;
use DB;

class CompanydepartmentController extends Controller
{
    public function index() {
        try {
            $page_title = 'Department Management';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Department Management',
                    'url' => '',
                ],
            ];
            $loginId = auth()->guard('company')->user()->id;
            $status = request('status');
            $companydepartments = Companydepartment::when(isset($status), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->where('user_id', $loginId)
            ->with(['department'])
            ->get();
            $departments = Department::where('is_active', 1)->get();
            return view('company.pages.company-department.list', compact('page_title', 'page_description', 'breadcrumbs', 'departments','companydepartments'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }

    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'department' => 'required|array',
                ], [
                    'department.required' => 'Department is required.'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                $loginUserId = Auth::guard('company')->user()->id;
                DB::beginTransaction();
                $departments = $request->department ?? [];

                foreach ($departments as $department) {
                    // Check if the department is already assigned to the user
                    $exists = Companydepartment::where('department_id', $department)
                        ->where('user_id', $loginUserId)
                        ->exists();

                    if (!$exists) {
                        Companydepartment::create([
                            'department_id' => $department,
                            'user_id' => $loginUserId
                        ]);
                    }
                }

                DB::commit();
                return redirect()->route('company.department.list')->with('success', 'Department added successfully.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
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
            $data['page_title'] = 'Department';
            $data['page_description'] = 'Edit Department';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Department Management',
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

                    'title' => 'Edit Department',
                    'url' => '',

                ];
            }
            return $data;
        }

        if ($action == 'add') {
            $data['page_title'] = 'Department';
            $data['page_description'] = 'Add a New Department';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Department Management',
                    'url' => route('company.staff.list'),
                ],
                [
                    'title' => 'Add Department',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
