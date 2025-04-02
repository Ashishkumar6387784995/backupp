<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\DoctorExport;
use Maatwebsite\Excel\Facades\Excel;

class DoctorController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Doctors';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Doctors',
                    'url' => '',
                ]
            ];
            $status = request('status');
            $department_id = request('department_id');
            if ($status == '0') {
                $status = '2';
            }
            $doctors = Doctor::with(['department'])
                ->when($status, function ($doctors) use ($status) {
                    if ($status != '-1') {
                        $status = conditionalStatus($status);
                        $doctors->where('status', '=', $status);
                    }
                })
                ->when($department_id, function ($doctors) use ($department_id) {
                    if ($department_id) {
                        $doctors->where('department_id', '=', $department_id);
                    }
                })
                ->orderBy('id', 'desc')->get();
            $departments = Department::where('status', 1)->orderBy('id', 'desc')->get();
            // dd($doctors);
            return view('admin.pages.doctors.list', compact('page_title', 'page_description', 'breadcrumbs',  'doctors',  'departments'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function exportExcel()
    {
        $type = request('type');
        if ($type == 'excel')
            return Excel::download(new DoctorExport, 'Doctors.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'doctor_code' => 'required',
                    'name' => 'required',
                    // 'email' => 'required',
                    // 'mobile' => 'required',
                    // 'dob' => 'required',
                    // 'gender' => 'required',
                    'department_id' => 'required',
                    'profile_image' => 'file|mimes:jpg,JPG,png|max:2048',
                ], [
                    'doctor_code.required' => 'Doctor code is required.',
                    'name.required' => 'Doctor name is required.',
                    'email.required' => 'Doctor email is required.',
                    'mobile.required' => 'Doctor mobile is required.',
                    'dob.required' => 'Doctor DOB is required.',
                    'gender.required' => 'Select gender.',
                    'department_id.required' => 'Select doctor department.',
                    'profile_image.max' => 'Max file upload size is 2MB.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();






                $array = [
                    'doctor_code' => $request->doctor_code,
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'dob' => $request->dob,
                    'gender' => $request->gender,
                    'department_id' => $request->department_id,
                    'qualification' => $request->qualification,
                    'area_of_interest' => $request->area_of_interest,
                    'expertise' => $request->expertise,
                    'details' => $request->details,
                    'research_publication' => $request->research_publication,
                    'city_id' => $request->city_id,
                    'city_name' => getCityName($request->city_id),
                    'main_video_youtube_link' => $request->main_video_youtube_link,
                    'designation' => $request->designation,

                ];
                if (isset($request->awards) && count($request->awards) > 0) {
                    $awards = [];
                    foreach ($request->awards as $sKey => $sList) {
                        if ($sList) {
                            $awards[] = [
                                'title' => $sList,
                            ];
                        }
                    }
                    if (count($awards) > 0)
                        $array['awards'] = json_encode($awards);
                }
                if (isset($request['profile_image']) && !empty($request['profile_image'])) {
                    // foreach ($request->images as $sKey => $sList) {
                    // if ($sList) {
                    $sKey = rand(111, 999);
                    $icon = null;
                    if ($request->hasFile('profile_image')) {
                        $pathString = 'uploads/doctors/profiles/';
                        $image = $request->file('profile_image');
                        $iconImageName = 'document' . $sKey . '-' . time() . '.' . $image->getClientOriginalExtension();
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
                        $icon = $iconImageName;
                    }
                    $image = $icon;

                    // }
                    // }
                    if ($image) {
                        $array['profile_image'] =  $image;
                    }
                }
                $main_video = [];
                if ($request->has('main_video')) {
                    // foreach ($request->videos as $vkey => $vvalue) {
                    $i = 0;
                    $uploadedFile = $request->file('main_video');
                    $fileName =   \Str::slug($request['main_video']) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

                    $destinationPath = public_path('./uploads/doctors/videos/');
                    $isValid = $uploadedFile->isValid();
                    if ($isValid) {
                        $uploadedFile->move($destinationPath, $fileName);

                        $main_video =  $fileName;
                    }
                    // }
                    ($main_video) ? $array['main_video'] =  $main_video : null;
                }
                $videos = [];
                if ($request->has('left_video')) {
                    foreach ($request->left_video as $vkey => $vvalue) {
                        $i = 0;
                        $uploadedFile = $request->file('left_video')[$vkey];
                        //dd($uploadedFile);
                        $fileName =   \Str::slug($request['left_video'][$vkey]) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

                        $destinationPath = public_path('./uploads/doctors/videos/');
                        $isValid = $uploadedFile->isValid();
                        if ($isValid) {
                            $uploadedFile->move($destinationPath, $fileName);

                            $videos[] = [
                                'video' => $fileName,
                            ];
                        }
                    }
                    (count($videos) > 0) ? $array['other_videos'] =  json_encode($videos) : null;
                }
                // dd($array);
                // $doctorMobileExist = Doctor::where('mobile', $array['mobile'])->exists();
                // if ($doctorMobileExist) {
                //     return redirect()->back()->withErrors(['Doctor mobile already exist.'])->withInput($request->all());
                // }
                $doctorCodeExist = Doctor::where('doctor_code', $array['doctor_code'])->exists();
                if ($doctorCodeExist) {
                    return redirect()->back()->withErrors(['Doctor code already exist.'])->withInput($request->all());
                }
                $response = Doctor::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/doctors/list')->with('success', 'Doctor details added successfully.');
            }

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            $departments = Department::where('status', 1)->orderBy('id', 'desc')->get();
            return view('admin.pages.doctors.add', compact('page_title', 'page_description', 'breadcrumbs', 'departments'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'doctor_code' => 'required',
                    'name' => 'required',
                    // 'email' => 'required',
                    // 'mobile' => 'required',
                    // 'dob' => 'required',
                    // 'gender' => 'required',
                    'department_id' => 'required',
                    'profile_image' => 'file|mimes:jpg,JPG,png|max:2048',
                ], [
                    'doctor_code.required' => 'Doctor code is required.',
                    'name.required' => 'Doctor name is required.',
                    'email.required' => 'Doctor email is required.',
                    'mobile.required' => 'Doctor mobile is required.',
                    'dob.required' => 'Doctor DOB is required.',
                    'gender.required' => 'Select gender.',
                    'department_id.required' => 'Select doctor department.',
                    'profile_image.max' => 'Max file upload size is 2MB.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();
                $array = [
                    'doctor_code' => $request->doctor_code,
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'dob' => $request->dob,
                    'gender' => $request->gender,
                    'department_id' => $request->department_id,
                    'qualification' => $request->qualification,
                    'area_of_interest' => $request->area_of_interest,
                    'expertise' => $request->expertise,
                    'details' => $request->details,
                    'research_publication' => $request->research_publication,
                    'main_video_youtube_link' => $request->main_video_youtube_link,
                    'designation' => $request->designation,
                    'city_id' => $request->city_id,
                    'city_name' => getCityName($request->city_id),

                ];
                if (isset($request->awards) && count($request->awards) > 0) {
                    $awards = [];
                    foreach ($request->awards as $sKey => $sList) {
                        if ($sList) {
                            $awards[] = [
                                'title' => $sList,
                            ];
                        }
                    }
                    if (count($awards) > 0)
                        $array['awards'] = json_encode($awards);
                }
                if (isset($request['profile_image']) && !empty($request['profile_image'])) {
                    // foreach ($request->images as $sKey => $sList) {
                    // if ($sList) {
                    $sKey = rand(111, 999);
                    $icon = null;
                    if ($request->hasFile('profile_image')) {
                        $pathString = 'uploads/doctors/profiles/';
                        $image = $request->file('profile_image');
                        $iconImageName = 'document' . $sKey . '-' . time() . '.' . $image->getClientOriginalExtension();
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
                        $icon = $iconImageName;
                    }
                    $image = $icon;

                    // }
                    // }
                    if ($image) {
                        $array['profile_image'] =  $image;
                    }
                }
                $main_video = [];
                if ($request->has('main_video')) {
                    // foreach ($request->videos as $vkey => $vvalue) {
                    $i = 0;
                    $uploadedFile = $request->file('main_video');
                    $fileName =   \Str::slug($request['main_video']) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

                    $destinationPath = public_path('./uploads/doctors/videos/');
                    $isValid = $uploadedFile->isValid();
                    if ($isValid) {
                        $uploadedFile->move($destinationPath, $fileName);

                        $main_video =  $fileName;
                    }
                    // }
                    ($main_video) ? $array['main_video'] =  $main_video : null;
                }
                $videos = [];
                if ($request->has('left_video')) {
                    foreach ($request->left_video as $vkey => $vvalue) {
                        $i = 0;
                        $uploadedFile = $request->file('left_video')[$vkey];
                        //dd($uploadedFile);
                        $fileName =   \Str::slug($request['left_video'][$vkey]) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

                        $destinationPath = public_path('./uploads/doctors/videos/');
                        $isValid = $uploadedFile->isValid();
                        if ($isValid) {
                            $uploadedFile->move($destinationPath, $fileName);

                            $videos[] = [
                                'video' => $fileName,
                            ];
                        }
                    }
                    (count($videos) > 0) ? $array['other_videos'] =  json_encode($videos) : null;
                }
                // dd($array);
                // $doctorMobileExist = Doctor::where('mobile', $array['mobile'])->where('id', '!=', $id)->exists();
                // if ($doctorMobileExist) {
                //     return redirect()->back()->withErrors(['Doctor mobile already exist.'])->withInput($request->all());
                // }
                $doctorCodeExist = Doctor::where('doctor_code', $array['doctor_code'])->where('id', '!=', $id)->exists();
                if ($doctorCodeExist) {
                    return redirect()->back()->withErrors(['Doctor code already exist.'])->withInput($request->all());
                }
                $response = Doctor::UpdateOrCreate(['id' => $id], $array);
                DB::commit();
                return redirect('admin/doctors/list')->with('success', 'Doctor details updated successfully.');
            }

            $pageSettings = $this->pageSetting('edit');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            $departments = Department::where('status', 1)->orderBy('id', 'desc')->get();
            $details = Doctor::where('id', $id)->first();
            return view('admin.pages.doctors.edit', compact('page_title', 'page_description', 'breadcrumbs', 'departments', 'details'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $cat = Doctor::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Doctor deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Doctor details not found.');
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
                $response = Doctor::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/doctors/list')->with('success', 'Doctor status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Doctor details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Doctors';
            $data['page_description'] = 'Edit Doctors';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Centre Master',
                    'url' => url('admin/doctors/list'),
                ],
                [
                    'title' => 'Edit Doctor',
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
            $data['page_title'] = 'Doctors';
            $data['page_description'] = 'Add a Doctor';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Doctors',
                    'url' => url('admin/centres/list'),
                ],
                [
                    'title' => 'Add a Doctor',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
