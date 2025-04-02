<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\City;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\TestimonialExport;
use Maatwebsite\Excel\Facades\Excel;

class TestimonialController extends Controller
{

    public function index()
    {

        try {
            $page_title = 'Testimonials';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Testimonials',
                    'url' => '',
                ]
            ];


            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $testimonials = Testimonial::when($status, function ($customers) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $customers->where('status', '=', $status);
                }
            })->orderBy('id', 'desc')->get();
            return view('admin.pages.testimonials.list', compact('page_title', 'page_description', 'breadcrumbs',  'testimonials'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                // dd($request->all());/
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'testimonial_type' => 'required',
                    'comments' => 'required',
                    'content' => 'required',
                    // 'profile_image' => 'required',
                ], [
                    'name.required' => 'Name is required.',
                    'testimonial_type.required' => 'Type is required.',
                    'comments.required' => 'Comment is required.',
                    'content.required' => 'Testimonial content is required.',
                    // 'profile_image.required' => 'Profile image is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();


                $array = [
                    'name' => $request->name,
                    'testimonial_type' => $request->testimonial_type,
                    'segment' => $request->segment,
                    'comments' => $request->comments,
                    'content' => $request->content,
                    'status' => 0,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,

                ];
                if (!empty(request('video_url'))) {
                    $array['video_url'] = request('video_url');
                }

                if (isset($request['profile_image']) && !empty($request['profile_image'])) {
                    $icon = null;
                    $key = 0;
                    if ($request->hasFile('profile_image')) {
                        $pathString = 'uploads/testimonials/profile_images/';
                        $image = $request->file('profile_image');
                        $iconImageName = 'document' . $key . '-' . time() . '.' . $image->getClientOriginalExtension();
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
                        $array['profile_image']  = $iconImageName;
                    }
                }
                $response = Testimonial::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/testimonials/list')->with('success', 'Testimonial details added successfully.');
            }

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            return view('admin.pages.testimonials.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                // dd($request->all());/
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'testimonial_type' => 'required',
                    'comments' => 'required',
                    'content' => 'required',
                    // 'profile_image' => 'required',
                ], [
                    'name.required' => 'Name is required.',
                    'testimonial_type.required' => 'Type is required.',
                    'comments.required' => 'Comment is required.',
                    'content.required' => 'Testimonial content is required.',
                    // 'profile_image.required' => 'Profile image is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();


                $array = [
                    'name' => $request->name,
                    'segment' => $request->segment,
                    'testimonial_type' => $request->testimonial_type,
                    'comments' => $request->comments,
                    'content' => $request->content, 
                    'updated_by' => auth()->user()->id, 
                ];
                if (!empty(request('video_url'))) {
                    $array['video_url'] = request('video_url');
                }

                if (isset($request['profile_image']) && !empty($request['profile_image'])) {
                    $icon = null;
                    $key = 0;
                    if ($request->hasFile('profile_image')) {
                        $pathString = 'uploads/testimonials/profile_images/';
                        $image = $request->file('profile_image');
                        $iconImageName = 'document' . $key . '-' . time() . '.' . $image->getClientOriginalExtension();
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
                        $array['profile_image']  = $iconImageName;
                    }
                }
                $response = Testimonial::UpdateOrCreate(['id' => $id], $array);
                DB::commit();
                return redirect('admin/testimonials/list')->with('success', 'Testimonial details added successfully.');
            }

            $pageSettings = $this->pageSetting('edit');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            $details = Testimonial::where('id', $id)->first();
            if ($details) {
                return view('admin.pages.testimonials.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
            } else {
                return redirect('admin/testimonials/list')->withErrors(['Details not found.']);
            }
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
                $cat = Testimonial::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Testimonial deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Testimonial details not found.');
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
                $response = Testimonial::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/testimonials/list')->with('success', 'Testimonial status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Testimonials';
            $data['page_description'] = 'Edit Testimonial';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Testimonials',
                    'url' => url('admin/testimonials/list'),
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
            $data['page_title'] = 'Testimonials';
            $data['page_description'] = 'Add New Testimonial';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Testimonials',
                    'url' => url('admin/testimonials/list'),
                ],
                [
                    'title' => 'Add a New Testimonial',
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
            return Excel::download(new TestimonialExport, 'Testimonials.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
