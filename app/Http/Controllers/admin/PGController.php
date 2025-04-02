<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PgOptions;
use DB;
use Validator;
use Image;
use File;

class PGController extends Controller
{
    public function index()
    {
        try {

            $page_title = 'PG Options';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'PG Options',
                    'url' => '',
                ]
            ];
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $pgoptions = PgOptions::when($status, function ($patients) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $patients->where('status', '=', $status);
                }
            })->get();
            return view('admin.pages.pgoptions.list', compact('page_title', 'page_description', 'breadcrumbs',  'pgoptions'));
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
                    'option_name' => 'required',
                    'icon' => 'required',
                ], [
                    'option_name.required' => 'Speciality name is required.',
                    'icon.required' => 'Please choose icon.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'option_name' => $request->option_name,

                ];
                if ($request->hasFile('icon')) {
                    $pathString = 'uploads/pgoptions/';
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
                    $array['option_icon'] = $iconImageName;
                }


                // dd($array);

                if (PgOptions::where('option_name', $array['option_name'])->exists()) {
                    return redirect()->back()->withErrors(['PG Option already exist.'])->withInput($request->all());
                }
                $response = PgOptions::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/pgoptions/list')->with('success', 'PG Option details added successfully.');
            }



            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            return view('admin.pages.pgoptions.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                        'option_name' => 'required',
                        // 'icon' => 'required',
                    ], [
                        'option_name.required' => 'PG Option is required.',
                        // 'icon.required' => 'Please choose icon.'
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();

                    $array = [
                        'option_name' => $request->option_name,

                    ];
                    if ($request->hasFile('icon')) {
                        $pathString = 'uploads/pgoptions/';
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
                        $array['option_icon'] = $iconImageName;
                    }




                    if (PgOptions::where('option_name', $array['option_name'])->where('id', '!=', $id)->exists()) {
                        return redirect()->back()->withErrors(['PG Option already exist.'])->withInput($request->all());
                    }
                    $response = PgOptions::UpdateOrCreate(['id' => $id], $array);
                    DB::commit();
                    return redirect('admin/pgoptions/list')->with('success', 'PG Options details updated successfully.');
                }

                $page_title = 'PG Options';
                $page_description = 'Edit PG Option';
                $details = PgOptions::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit', ['title' => $details->department_name]);

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];
                    // dd($details);
                    return view('admin.pages.pgoptions.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
                } else {
                    return redirect()->back()->withErrors(['PG Options details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['PG Options id is missing.']);
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
                $cat = PgOptions::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'PG Options  deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'PG Options  details not found.');
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
                $response = PgOptions::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/pgoptions/list')->with('success', 'PG Options  status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'PG Options  details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'PG Options';
            $data['page_description'] = 'Edit PG Option';
            $data['breadcrumbs'] = [
                [
                    'title' => 'PG Options',
                    'url' => url('admin/pgoptions/list'),
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
            $data['page_title'] = 'PG Options';
            $data['page_description'] = 'Add PG Option';
            $data['breadcrumbs'] = [
                [
                    'title' => 'PG Options',
                    'url' => url('admin/pgoptions/list'),
                ],
                [
                    'title' => 'Add a PG Options',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
