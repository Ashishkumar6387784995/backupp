<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Company\DesignationCategory;
use Validator;
use DB;
use Auth;


class DesignationCategoryController extends Controller
{
    public function index() {
        try {
            $page_title = 'Designation Category';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Designation Category',
                    'url' => '',
                ],
            ];
            $loginUserId = Auth::guard('company')->user()->id;
            $status = request('status');
            $designationCategories = DesignationCategory::where('user_id', $loginUserId)->when($status, function($designationCategories) use($status){
                $designationCategories->where('status',$status); 
            })->get();
            $details = [];

            $edit = request()->has('edit') ? request('edit') : null;
            
            if ($edit) {
                $details = DesignationCategory::where('id', $edit)->first() ?? [];
            }
            return view('company.pages.designation-category.list', compact('page_title', 'page_description', 'breadcrumbs','designationCategories','details'));
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
                    'name' => 'required',
                    'status' => 'required',
                ], [
                    'name.required' => 'name is required.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }
                $loginUserId = Auth::guard('company')->user()->id;
                DB::beginTransaction();
                $updateArr = [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'status' => $request->status,
                    'user_id' => $loginUserId
                ];
               
                if (DesignationCategory::where('slug', $updateArr['slug'])->exists()) {
                    return redirect()->back()->withErrors(['Category already exist.'])->withInput($request->all());
                }
                $response = DesignationCategory::UpdateOrCreate(['id' => null], $updateArr);
                DB::commit();
                return redirect()->route('company.designation_cate.list')->with('success', 'Category created successfully.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'status' => 'required',
                ], [
                    'name.required' => 'name is required.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();   
              
                $loginUserId = Auth::guard('company')->user()->id;

                $updateArr = [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'status' => $request->status,
                    'user_id' => $loginUserId
                ];
                
         
                if (DesignationCategory::where('slug', $updateArr['slug'])->where('id', '!=', $id)->exists()) {
                    return redirect()->back()->withErrors(['Category already exist.'])->withInput($request->all());
                }
                // print_r($updateArr);die;
                $response = DesignationCategory::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect()->route('company.designation_cate.list')->with('success', 'Category details updated successfully.');
            }
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
                $cat = DesignationCategory::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Category deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Category details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            
            if (!$id) {
                return redirect()->back()->with('error', 'Staff ID is required.');
            }

            // Check if staff exists
            $staff = DesignationCategory::find($id);
            if (!$staff) {
                return redirect()->back()->with('error', 'Staff details not found.');
            }

            DB::beginTransaction();

            // Toggle status
            $status = ($staff->status == 1) ? 0 : 1;
            $staff->update(['status' => $status]);

            DB::commit();

            return redirect()->back()->with('success', 'Status updated successfully.');
            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
    }


    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Designation Category';
            $data['page_description'] = 'Edit Designation Category';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Designation Category Management',
                    'url' => route('company.designation_cate.list'),
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

                    'title' => 'Edit Designation Category',
                    'url' => '',

                ];
            }
            return $data;
        }

        if ($action == 'add') {
            $data['page_title'] = 'Designation Category';
            $data['page_description'] = 'Add a New Designation Category';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Designation Category Management',
                    'url' => route('company.designation_cate.list'),
                ],
                [
                    'title' => 'Add Designation Category',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
