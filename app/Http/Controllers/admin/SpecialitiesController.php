<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Speciality;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\SpecilityExport;
use Maatwebsite\Excel\Facades\Excel;

class SpecialitiesController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Specialities';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Specialities',
                    'url' => '',
                ]
            ];
            $departments = Department::all();
            $specialities = Speciality::all();
            return view('admin.pages.specialites.list', compact('page_title', 'page_description', 'breadcrumbs', 'departments', 'specialities'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'department_id' => 'required',
                    'speciality_name' => 'required',
                ], [
                    'department_id.required' => 'Please select department.',
                    'speciality_name.required' => 'Speciality name is required.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();


                $array = [
                    'department_id' => $request->department_id,
                    'speciality_name' => $request->speciality_name,
                    'slug' => \Str::slug($request->department_name . ' ' . $request->speciality_name),
                ];
                // dd($array);

                if (Speciality::where('speciality_name', $array['speciality_name'])->where('department_id', $array['department_id'])->exists()) {
                    return redirect()->back()->withErrors(['Speciality name already exist.'])->withInput($request->all());
                }
                $response = Speciality::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/specialities/list')->with('success', 'Speciality details added successfully.');
            }

            $page_title = 'Specialities';
            $page_description = 'Add Speciality';

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            $departments = Department::all();

            return view('admin.pages.specialites.add', compact('page_title', 'page_description', 'breadcrumbs', 'departments'));
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
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'department_id' => 'required',
                        'speciality_name' => 'required',
                    ], [
                        'department_id.required' => 'Please select department.',
                        'speciality_name.required' => 'Speciality name is required.'
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();


                    $array = [
                        'department_id' => $request->department_id,
                        'speciality_name' => $request->speciality_name,
                        'slug' => \Str::slug($request->department_name . ' ' . $request->speciality_name),
                    ];

                    if (Speciality::where('speciality_name', $array['speciality_name'])->where('id', '!=', $id)->where('department_id', $array['department_id'])->exists()) {
                        return redirect()->back()->withErrors(['Speciality name already exist.'])->withInput($request->all());
                    }
                    $response = Speciality::UpdateOrCreate(['id' => $id], $array);
                    DB::commit();
                    return redirect('admin/specialities/list')->with('success', 'Speciality details updated successfully.');
                }

                $page_title = 'Specialities Management';
                $page_description = 'Edit Specialities';
                $departments = Department::all();
                $details = Speciality::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit', ['title' => $details->department_name]);

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];
                    // dd($details);
                    return view('admin.pages.specialites.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details', 'departments'));
                } else {
                    return redirect()->back()->withErrors(['Specialities details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['Specialities id is missing.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $cat = Speciality::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Speciality deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Speciality details not found.');
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
                    'status' => $status,
                ];
                $response = Speciality::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/specialities/list')->with('success', 'Speciality status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Speciality details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Speciality Management';
            $data['page_description'] = 'Speciality';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Speciality Management',
                    'url' => url('admin/specialities/list'),
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
            $data['page_title'] = 'Speciality Management';
            $data['page_description'] = 'Add a New Speciality';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Speciality Management',
                    'url' => url('admin/specialities/list'),
                ],
                [
                    'title' => 'Add Speciality',
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
            return Excel::download(new SpecilityExport, 'Specilities.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
