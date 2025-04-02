<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use DB;
use Validator;
use Image;
use File;

class FacilityController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Facility Master';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Facility Master',
                    'url' => '',
                ]
            ];
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $facility = Facility::when($status, function ($events) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $events->where('status', '=', $status);
                }
            })->get();
            // dd($facility);
            return view('admin.pages.facilities.list', compact('page_title', 'page_description', 'breadcrumbs',  'facility'));
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
                    'facility_name' => 'required',
                    'icon' => 'required',
                ], [
                    'facility_name.required' => 'Speciality name is required.',
                    'icon.required' => 'Please choose icon.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'facility_name' => $request->facility_name,

                ];
                if ($request->hasFile('icon')) {
                    $pathString = 'uploads/facility/';
                    $image = $request->file('icon');
                    $iconImageName = \Str::slug($request->department_name) . rand(123456, 999999) . '-' . time() . '.' . $image->getClientOriginalExtension();
                    $image_resize = Image::make($image->getRealPath());

                    $height = Image::make($image)->height();
                    $width = Image::make($image)->width();
                    $path = public_path($pathString);

                    if (!File::isDirectory($path)) {
                        File::makeDirectory($path, 0777, true, true);
                    }
                    if ($width > $height) {
                        $image_resize->resize(692, null, function ($constraint) use ($image_resize) {
                            $constraint->aspectRatio();
                        })->save(public_path($pathString . $iconImageName));
                    } else {
                        $image_resize->resize(null, 274, function ($constraint) use ($image_resize) {
                            $constraint->aspectRatio();
                        })->save(public_path($pathString . $iconImageName));
                    }
                    $array['facility_icon'] = $iconImageName;
                }


                // dd($array);

                if (Facility::where('facility_name', $array['facility_name'])->exists()) {
                    return redirect()->back()->withErrors(['Facility already exist.'])->withInput($request->all());
                }
                $response = Facility::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/facility/list')->with('success', 'Facility details added successfully.');
            }



            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            return view('admin.pages.facilities.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                        'facility_name' => 'required',
                        // 'icon' => 'required',
                    ], [
                        'facility_name.required' => 'PG Option is required.',
                        // 'icon.required' => 'Please choose icon.'
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();

                    $array = [
                        'facility_name' => $request->facility_name,

                    ];
                    if ($request->hasFile('icon')) {
                        $pathString = 'uploads/facility/';
                        $image = $request->file('icon');
                        $iconImageName = \Str::slug($request->department_name) . rand(123456, 999999) . '-' . time() . '.' . $image->getClientOriginalExtension();
                        $image_resize = Image::make($image->getRealPath());

                        $height = Image::make($image)->height();
                        $width = Image::make($image)->width();
                        $path = public_path($pathString);

                        if (!File::isDirectory($path)) {
                            File::makeDirectory($path, 0777, true, true);
                        }
                        if ($width > $height) {
                            $image_resize->resize(692, null, function ($constraint) use ($image_resize) {
                                $constraint->aspectRatio();
                            })->save(public_path($pathString . $iconImageName));
                        } else {
                            $image_resize->resize(null, 274, function ($constraint) use ($image_resize) {
                                $constraint->aspectRatio();
                            })->save(public_path($pathString . $iconImageName));
                        }
                        $array['facility_icon'] = $iconImageName;
                    }




                    if (Facility::where('facility_name', $array['facility_name'])->where('id', '!=', $id)->exists()) {
                        return redirect()->back()->withErrors(['Facility name already exist.'])->withInput($request->all());
                    }
                    $response = Facility::UpdateOrCreate(['id' => $id], $array);
                    DB::commit();
                    return redirect('admin/facility/list')->with('success', 'Facility details updated successfully.');
                }


                $details = Facility::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit', ['title' => $details->department_name]);

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];
                    // dd($details);
                    return view('admin.pages.facilities.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
                } else {
                    return redirect()->back()->withErrors(['Facility details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['Facility details id is missing.']);
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
                $cat = Facility::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Facility  deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Facility details not found.');
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
                $response = Facility::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/facility/list')->with('success', 'Facility status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Facility details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Facility Master';
            $data['page_description'] = 'Edit  Facility Master';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Facility Master',
                    'url' => url('admin/facility/list'),
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
            $data['page_title'] = 'Facility Master';
            $data['page_description'] = 'Add New Facility';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Facility Master',
                    'url' => url('admin/facility/list'),
                ],
                [
                    'title' => 'Add a New Facility',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
