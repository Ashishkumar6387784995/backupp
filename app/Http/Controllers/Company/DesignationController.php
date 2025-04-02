<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Designation;
use App\Models\Company\DesignationCategory;
use Illuminate\Support\Str;
use Validator;
use DB;
use Auth;

class DesignationController extends Controller
{
    public function index() {
        try {
            $page_title = 'Designation Management';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Designation Management',
                    'url' => '',
                ],
            ];
            $loginUserId = Auth::guard('company')->user()->id;
            $status = request('status');
            $designations = Designation::with('category')->where('user_id', $loginUserId)->when($status, function ($designations) use ($status){
                $designations->where('status', $status);
            })->orderBy('id','DESC')->get();
            $categories = DesignationCategory::where('user_id', $loginUserId)->where('status', 1)->get();
            $details = [];

            $edit = request()->has('edit') ? request('edit') : null;
            
            if ($edit) {
                $details = Designation::find($edit) ?? [];
            }

            return view('company.pages.designation.list', compact('page_title', 'page_description', 'breadcrumbs', 'designations','categories','details'));
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
                    'cate_id' => 'required',
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
                    'cate_id' => $request->cate_id,
                    'status' => $request->status,
                    'user_id' => $loginUserId
                ];
               
                if (Designation::where('slug', $updateArr['slug'])->exists()) {
                    return redirect()->back()->withErrors(['Designation already exist.'])->withInput($request->all());
                }
                $response = Designation::UpdateOrCreate(['id' => null], $updateArr);
                DB::commit();
                return redirect()->route('company.designation.list')->with('success', 'Designation created successfully.');
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
                    'cate_id' => 'required',
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
                    'cate_id' => $request->cate_id,
                    'status' => $request->status,
                    'user_id' => $loginUserId
                ];
                
         
                if (Designation::where('slug', $updateArr['slug'])->where('id', '!=', $id)->exists()) {
                    return redirect()->back()->withErrors(['Designation already exist.'])->withInput($request->all());
                }
                // print_r($updateArr);die;
                $response = Designation::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect()->route('company.designation.list')->with('success', 'Designation details updated successfully.');
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
                $cat = Designation::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Designation deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Designation details not found.');
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
            $staff = Designation::find($id);
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
            $data['page_title'] = 'Designation';
            $data['page_description'] = 'Edit Designation';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Designation Management',
                    'url' => route('company.designation.list'),
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

                    'title' => 'Edit Designation',
                    'url' => '',

                ];
            }
            return $data;
        }

        if ($action == 'add') {
            $data['page_title'] = 'Designation';
            $data['page_description'] = 'Add a New Designation';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Designation Management',
                    'url' => route('company.designation.list'),
                ],
                [
                    'title' => 'Add Designation',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
