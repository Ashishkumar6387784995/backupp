<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\OffersExport;
use Maatwebsite\Excel\Facades\Excel;

class CouponController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Coupons Master';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Coupons Master',
                    'url' => '',
                ]
            ];
            $coupon_type = request('coupon_type');
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $coupons = Coupon::when($status, function ($coupons) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $coupons->where('status', '=', $status);
                }
            })->when($coupon_type, function ($coupons) use ($coupon_type) {
                if ($coupon_type) {
                    $coupons->where('coupon_type', '=', $coupon_type);
                }
            })->orderBy('id', 'desc')->get();

            return view('admin.pages.coupons.list', compact('page_title', 'page_description', 'breadcrumbs',  'coupons'));
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
                    'coupon_code' => 'required',
                    'coupon_type' => 'required',
                    'coupon_title' => 'required',
                    // 'short_desc' => 'required',
                    // 'valid_from' => 'required',
                    // 'valid_to' => 'required',
                    // 'min_value' => 'required',
                    // 'max_off' => 'required',
                    // 'max_usage' => 'required',
                    // 'max_per_user' => 'required',
                    'coupon_icon' => 'required',
                ], [
                    'coupon_code.required' => 'Coupon code is required.',
                    'coupon_type.required' => 'Coupon type is required.',
                    'coupon_title.required' => 'Coupon title is required.',
                    'short_desc.required' => 'Short description is required.',
                    'valid_from.required' => 'Select offer start date.',
                    'valid_to.required' => 'Select offer end date.',
                    'min_value.required' => 'Enter minimum value applied on.',
                    'max_usage.required' => 'Enter maximum no. of uses.',
                    'max_per_user.required' => 'Enter maximum no. of uses per user.',
                    'coupon_icon.required' => 'Choose offer display banner.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'coupon_code' => $request->coupon_code,
                    'coupon_type' => $request->coupon_type,
                    'coupon_title' => $request->coupon_title,
                    'short_desc' => $request->short_desc,
                    'valid_from' => $request->valid_from,
                    'valid_to' => $request->valid_to,
                    'min_value' => $request->min_value,
                    'max_usage' => $request->max_usage,
                    'max_per_user' => $request->max_per_user,
                    'description' => $request->description,
                    'landing_page' => $request->landing_page,
                ];

                if ($request->coupon_type == 3 && count($request->conditions) > 0) {
                    $conditions = [];
                    foreach ($request->conditions as $c_key => $c_val) {
                        $conditions[] = [
                            'id' => $c_val,
                            'title' => ($c_val == 1) ? 'Home Collection Fees Free' : ''
                        ];
                    }
                    if (count($conditions) > 0) {
                        $array['conditions'] = json_encode($conditions);
                    }
                }
                $contractDocuments = [];
                if (isset($request['coupon_icon']) && !empty($request['coupon_icon'])) {

                    $icon = null;
                    if ($request->hasFile('coupon_icon')) {
                        $pathString = 'uploads/coupons/icons/';
                        $image = $request->file('coupon_icon');
                        $iconImageName = 'icon' . rand(111, 999) . '-' . time() . '.' . $image->getClientOriginalExtension();
                        $image_resize = Image::make($image->getRealPath());

                        $height = Image::make($image)->height();
                        $width = Image::make($image)->width();
                        $path = public_path($pathString);

                        if (!File::isDirectory($path)) {
                            File::makeDirectory($path, 0777, true, true);
                        }
                        $image_resize->save(public_path($pathString . $iconImageName));
                        // if ($width > $height) {
                        // $image_resize->resize(692, null, function ($constraint) use ($image_resize) {
                        //     $constraint->aspectRatio();
                        // })->save(public_path($pathString . $iconImageName));
                        // } else {
                        //     $image_resize->resize(null, 274, function ($constraint) use ($image_resize) {
                        //         $constraint->aspectRatio();
                        //     })->save(public_path($pathString . $iconImageName));
                        // }
                        $icon = $iconImageName;
                    }
                    $contractDocuments = $icon;


                    ($contractDocuments) ? $array['coupon_icon'] =  ($contractDocuments) : null;
                }



                $centreImages = [];
                if (isset($request['coupon_banners']) && count($request['coupon_banners']) > 0) {
                    foreach ($request->coupon_banners as $key => $list) {
                        if ($list) {
                            $icon = null;
                            if ($request->hasFile('coupon_banners')) {
                                $pathString = 'uploads/coupons/images/';
                                $image = $request->file('coupon_banners')[$key];
                                $iconImageName = 'banner' . $key . '-' . time() . '.' . $image->getClientOriginalExtension();
                                $image_resize = Image::make($image->getRealPath());

                                $height = Image::make($image)->height();
                                $width = Image::make($image)->width();
                                $path = public_path($pathString);

                                if (!File::isDirectory($path)) {
                                    File::makeDirectory($path, 0777, true, true);
                                }
                                // if ($width > $height) {
                                $image_resize->save(public_path($pathString . $iconImageName));
                                // } else {
                                //     $image_resize->resize(null, 274, function ($constraint) use ($image_resize) {
                                //         $constraint->aspectRatio();
                                //     })->save(public_path($pathString . $iconImageName));
                                // }
                                $icon = $iconImageName;
                                $centreImages[] =  $icon;
                            }
                        }
                    }
                    if (count($centreImages) > 0) {

                        $array['coupon_banners'] =  json_encode($centreImages);
                    }
                }
                if (Coupon::where('coupon_code', $array['coupon_code'])->exists()) {
                    return redirect()->back()->withErrors(['Coupon code already exist.'])->withInput($request->all());
                }
                $response = Coupon::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/offers/list')->with('success', 'Coupon details added successfully.');
            }

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            return view('admin.pages.coupons.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                    'coupon_code' => 'required',
                    'coupon_type' => 'required',
                    'coupon_title' => 'required',
                    'short_desc' => 'required',
                    // 'valid_from' => 'required',
                    // 'valid_to' => 'required',
                    // 'min_value' => 'required',
                    // 'max_off' => 'required',
                    // 'max_usage' => 'required',
                    // 'max_per_user' => 'required',
                ], [
                    'coupon_code.required' => 'Coupon code is required.',
                    'coupon_type.required' => 'Coupon type is required.',
                    'coupon_title.required' => 'Coupon title is required.',
                    'short_desc.required' => 'Short description is required.',
                    'valid_from.required' => 'Select offer start date.',
                    'valid_to.required' => 'Select offer end date.',
                    'min_value.required' => 'Enter minimum value applied on.',
                    'max_usage.required' => 'Enter maximum no. of uses.',
                    'max_per_user.required' => 'Enter maximum no. of uses per user.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'coupon_code' => $request->coupon_code,
                    'coupon_type' => $request->coupon_type,
                    'coupon_title' => $request->coupon_title,
                    'short_desc' => $request->short_desc,
                    'valid_from' => $request->valid_from,
                    'valid_to' => $request->valid_to,
                    'min_value' => $request->min_value,
                    'max_usage' => $request->max_usage,
                    'max_per_user' => $request->max_per_user,
                    'description' => $request->description,
                    'landing_page' => $request->landing_page,
                ];
                if ($request->coupon_type == 3 && !empty($request->conditions) && count($request->conditions) > 0) {
                    $conditions = [];
                    foreach ($request->conditions as $c_key => $c_val) {
                        $conditions[] = [
                            'id' => $c_val,
                            'title' => ($c_val == 1) ? 'Home Collection Fees Free' : ''
                        ];
                    }
                    if (count($conditions) > 0) {
                        $array['conditions'] = json_encode($conditions);
                    }
                }
                $contractDocuments = [];
                if (isset($request['coupon_icon']) && !empty($request['coupon_icon'])) {

                    $icon = null;
                    if ($request->hasFile('coupon_icon')) {
                        $pathString = 'uploads/coupons/icons/';
                        $image = $request->file('coupon_icon');
                        $iconImageName = 'icon' . rand(111, 999) . '-' . time() . '.' . $image->getClientOriginalExtension();
                        $image_resize = Image::make($image->getRealPath());

                        $height = Image::make($image)->height();
                        $width = Image::make($image)->width();
                        $path = public_path($pathString);

                        if (!File::isDirectory($path)) {
                            File::makeDirectory($path, 0777, true, true);
                        }
                        // if ($width > $height) {
                        $image_resize->save(public_path($pathString . $iconImageName));
                        // } else {
                        //     $image_resize->resize(null, 274, function ($constraint) use ($image_resize) {
                        //         $constraint->aspectRatio();
                        //     })->save(public_path($pathString . $iconImageName));
                        // }
                        $icon = $iconImageName;
                    }
                    $contractDocuments = $icon;


                    ($contractDocuments) ? $array['coupon_icon'] =  ($contractDocuments) : null;
                }



                $centreImages = [];
                if (isset($request['coupon_banners']) && count($request['coupon_banners']) > 0) {
                    foreach ($request->coupon_banners as $key => $list) {
                        if ($list) {
                            $icon = null;
                            if ($request->hasFile('coupon_banners')) {
                                $pathString = 'uploads/coupons/images/';
                                $image = $request->file('coupon_banners')[$key];
                                $iconImageName = 'banner' . $key . '-' . time() . '.' . $image->getClientOriginalExtension();
                                $image_resize = Image::make($image->getRealPath());

                                $height = Image::make($image)->height();
                                $width = Image::make($image)->width();
                                $path = public_path($pathString);

                                if (!File::isDirectory($path)) {
                                    File::makeDirectory($path, 0777, true, true);
                                }
                                // if ($width > $height) {
                                $image_resize->save(public_path($pathString . $iconImageName));
                                // } else {
                                //     $image_resize->resize(null, 274, function ($constraint) use ($image_resize) {
                                //         $constraint->aspectRatio();
                                //     })->save(public_path($pathString . $iconImageName));
                                // }
                                $icon = $iconImageName;
                                $centreImages[] =  $icon;
                            }
                        }
                    }
                    if (count($centreImages) > 0) {
                        $centre = Coupon::where('id', '=', $id)->first();
                        if ($centre) {
                            $existCouponImages = ($centre->coupon_banners) ? json_decode($centre->coupon_banners, true) : [];
                            if ($existCouponImages)
                                $newCouponImages = array_merge($existCouponImages, $centreImages);
                            else
                                $newCouponImages = $centreImages;
                            $array['coupon_banners'] =  json_encode($newCouponImages);
                        } else {
                            $array['coupon_banners'] =  json_encode($centreImages);
                        }
                    }
                }

                if (Coupon::where('coupon_code', $array['coupon_code'])->where('id', '<>', $id)->exists()) {
                    return redirect()->back()->withErrors(['Coupon code already exist.'])->withInput($request->all());
                }
                $response = Coupon::UpdateOrCreate(['id' => $id], $array);
                DB::commit();
                return redirect('admin/offers/list')->with('success', 'Coupon details updated successfully.');
            }

            $pageSettings = $this->pageSetting('edit');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            $details = Coupon::where('id', $id)->first();
            if ($details)
                return view('admin.pages.coupons.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
            else
                return redirect()->back()->withErrors(['Details not found.']);
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
                $cat = Coupon::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Coupon deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Coupon details not found.');
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
                $response = Coupon::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/offers/list')->with('success', 'Coupon status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Coupon details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Coupon Master';
            $data['page_description'] = 'Edit Coupon Master';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Coupon Master',
                    'url' => url('admin/offers/list'),
                ],
                [
                    'title' => 'Edit Coupon',
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
            $data['page_title'] = 'Coupon Master';
            $data['page_description'] = 'Add a Coupon';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Coupon Master',
                    'url' => url('admin/offers/list'),
                ],
                [
                    'title' => 'Add a Coupon',
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
            return Excel::download(new OffersExport, 'Offers.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
