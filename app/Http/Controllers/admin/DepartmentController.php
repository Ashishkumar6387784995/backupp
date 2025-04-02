<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\DepartmentExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DepartmentImport;

class DepartmentController extends Controller
{
    public function index()
    {



        try {
            $page_title = 'Departments Management';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Departments',
                    'url' => '',
                ],
            ];
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $query = Department::query();

            // Ensure status is not null or empty before filtering
            if (!is_null($status) && $status !== '') { 
                $query->where('is_active', $status);
            }

            $departments = $query->get();
            return view('admin.pages.departments.list', compact('page_title', 'page_description', 'breadcrumbs', 'departments'));
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
                    'department_name' => 'required',
                ], [
                    'department_name.required' => 'Department name is required.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();
            
                $array = [
                    'department_name' => $request->department_name,
                    'is_active' => $request->is_active,
                    'slug' => \Str::slug($request->department_name),
                ];
                
                if (Department::where('department_name', $array['department_name'])->exists()) {
                    return redirect()->back()->withErrors(['Department name already exist.'])->withInput($request->all());
                }
                $response = Department::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/departments/list')->with('success', 'Department details added successfully.');
            }

            $page_title = 'Category Management';
            $page_description = 'Add Category';

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            return view('admin.pages.departments.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                // echo $id;die;
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'department_name' => 'required',
                        // 'brochures' => 'nullable|mimes:application/pdf|max:10000',
                    ], [
                        'department_name.required' => 'Department name is required.'
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();
                    $instruments = [];

                    $array = [
                        'department_name' => $request->department_name,
                        'is_active' => $request->is_active,
                        'slug' => \Str::slug($request->department_name),
                    ];
                 
                    if (Department::where('slug', $array['slug'])->where('id', '!=', $id)->exists()) {
                        $array['slug'] = \Str::slug($request->department_name . '-' . time());
                    }

                    $response = Department::UpdateOrCreate(['id' => $id], $array);
                    DB::commit();
                    return redirect('admin/departments/list')->with('success', 'Department details updated successfully.');
                }

                $page_title = 'Department Management';
                $page_description = 'Edit Department';
                $details = Department::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit', ['title' => $details->department_name]);

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];
                    // dd($details);
                    return view('admin.pages.departments.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
                } else {
                    return redirect()->back()->withErrors(['Department details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['Department id is missing.']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $cat = Department::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Department deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Department details not found.');
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
                $response = Department::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/departments/list')->with('success', 'Department status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Department details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Department Management';
            $data['page_description'] = 'Department';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Department Management',
                    'url' => url('admin/departments/list'),
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
            $data['page_title'] = 'Department Management';
            $data['page_description'] = 'Add a New Department';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Department Management',
                    'url' => url('admin/departments/list'),
                ],
                [
                    'title' => 'Add Department',
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
            return Excel::download(new DepartmentExport, 'Departments.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }

    public function showImportForm()
    {
        $page_title = 'Departments Import';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Departments',
                    'url' => '',
                ],
            ];
        return view('admin.pages.departments.import',  compact('page_title', 'page_description', 'breadcrumbs'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new DepartmentImport, $request->file('file'));

        return back()->with('success', 'Data imported successfully!');
    }
}
