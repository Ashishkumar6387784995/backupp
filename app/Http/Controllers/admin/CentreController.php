<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Centre;
use App\Models\City;
use App\Models\State;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\CentreExport;
use Maatwebsite\Excel\Facades\Excel;

class CentreController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Centre Master';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Centre Master',
                    'url' => '',
                ]
            ];
            $status = request('status');
            $city_id = request('city_id');
            if ($status == '0') {
                $status = '2';
            }
            $centres = Centre::when($status, function ($centres) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $centres->where('status', '=', $status);
                }
            })->when($city_id, function ($centres) use ($city_id) {
                $centres->where('city_id', '=', $city_id);
            })->orderBy('id', 'desc')->get();
            $cities = City::where('status', 1)->orderBy('name', 'asc')->get();
            return view('admin.pages.centres.list', compact('page_title', 'page_description', 'breadcrumbs',  'centres',  'cities'));
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
                    'centre_name' => 'required',
                    // 'phone' => 'required',
                    // 'email' => 'required',
                    'address_line1' => 'required',
                    'state_id' => 'required',
                    'city_id' => 'required',
                    'pincode' => 'required',
                    // 'head_name' => 'required',
                    // 'head_mobile' => 'required',
                    // 'head_email' => 'required',
                ], [
                    'centre_name.required' => 'Centre name is required.',
                    'phone.required' => 'Centre phone is required.',
                    'email.required' => 'Centre email is required.',
                    'address_line1.required' => 'Mention centre address.',
                    'state_id.required' => 'Select state.',
                    'city_id.required' => 'Select city.',
                    'pincode.required' => 'Enter pincode.',
                    // 'head_name.required' => 'Enter centre head name.',
                    // 'head_mobile.required' => 'Enter centre mobile name.',
                    // 'head_email.required' => 'Enter centre email.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();
                $contractDocuments = [];
                if (isset($request['contract_document']) && count($request['contract_document']) > 0) {
                    foreach ($request->contract_document as $sKey => $sList) {
                        if ($sList) {
                            $icon = null;
                            if ($request->hasFile('contract_document')) {
                                $pathString = 'uploads/centres/documents/';
                                $image = $request->file('contract_document')[$sKey];
                                $iconImageName = 'document' . $sKey . '-' . time() . '.' . $image->getClientOriginalExtension();
                                $image_resize = Image::make($image->getRealPath());

                                $height = Image::make($image)->height();
                                $width = Image::make($image)->width();
                                $path = public_path($pathString);

                                if (!File::isDirectory($path)) {
                                    File::makeDirectory($path, 0777, true, true);
                                }

                                $image_resize->save(public_path($pathString . $iconImageName));
                                // if ($width > $height) {
                                //     $image_resize->resize(692, null, function ($constraint) use ($image_resize) {
                                //         $constraint->aspectRatio();
                                //     })->save(public_path($pathString . $iconImageName));
                                // } else {
                                //     $image_resize->resize(null, 274, function ($constraint) use ($image_resize) {
                                //         $constraint->aspectRatio();
                                //     })->save(public_path($pathString . $iconImageName));
                                // }
                                $icon = $iconImageName;
                            }
                            $contractDocuments[] = [
                                'contract_document' => $icon,
                                'contract_details' => $request['contract_details'][$sKey],
                                'contract_document_type' => $request['contract_document_type'][$sKey],
                            ];
                        }
                    }
                }



                $centreImages = [];
                if (isset($request['centre_images']) && count($request['centre_images']) > 0) {
                    foreach ($request->centre_images as $key => $list) {
                        if ($list) {
                            $icon = null;
                            if ($request->hasFile('centre_images')) {
                                $pathString = 'uploads/centres/centre_images/';
                                $image = $request->file('centre_images')[$key];
                                $iconImageName = 'document' . $key . '-' . time() . '.' . $image->getClientOriginalExtension();
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
                }

                $array = [
                    'centre_name' => $request->centre_name,
                    'display_name' => $request->display_name,
                    'slug' => \Str::slug($request->centre_name . ' in ' . $request->locality),
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address_line1' => $request->address_line1,
                    'address_line2' => $request->address_line2,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'locality' => $request->locality,
                    'landmark' => $request->landmark,
                    'pincode' => $request->pincode,
                    'centre_lat' => $request->centre_lat,
                    'centre_lng' => $request->centre_lng,
                    'head_name' => $request->head_name,
                    'head_mobile' => $request->head_mobile,
                    'head_email' => $request->head_email,
                    'seo_title' => $request->seo_title,
                    'seo_description' => $request->seo_description,
                    'seo_keywords' => $request->seo_keywords,
                    'lead_flow' => $request->lead_flow,
                    'created_by' => auth()->user()->id,
                    'country_id' => 1,
                    'about_us' => $request->about_us,
                    'centre_type' => $request->centre_type,
                    'state_name' => getStateName($request->state_id),
                    'city_name' =>  getCityName($request->city_id),
                    'contract_documents' => (count($contractDocuments) > 0) ? json_encode($contractDocuments) : null,
                    'centre_images' => (count($centreImages) > 0) ? json_encode($centreImages) : null,
                    'centre_facilities' => (isset($request->centre_facilities) && count($request->centre_facilities) > 0) ? json_encode($request->centre_facilities) : null,
                ];
                // if (Centre::where('email', $array['email'])->exists()) {
                //     return redirect()->back()->withErrors(['Centre email already exist.'])->withInput($request->all());
                // }
                if (Centre::where('slug', $array['slug'])->exists()) {
                    return redirect()->back()->withErrors(['Centre or slug already exist.'])->withInput($request->all());
                }
                $response = Centre::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/centres/list')->with('success', 'Centre details added successfully.');
            }

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            $states = State::where('status', 1)->get();
            $facilities = getFacilities();

            return view('admin.pages.centres.add', compact('page_title', 'page_description', 'breadcrumbs', 'states', 'facilities'));
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
                    'centre_name' => 'required',
                    'display_name' => 'required',
                    // 'phone' => 'required',
                    // 'email' => 'required',
                    'address_line1' => 'required',
                    'state_id' => 'required',
                    'city_id' => 'required',
                    'pincode' => 'required',
                    // 'head_name' => 'required',
                    // 'head_mobile' => 'required',
                    // 'head_email' => 'required',
                ], [
                    'centre_name.required' => 'Centre name is required.',
                    'phone.required' => 'Centre phone is required.',
                    'email.required' => 'Centre email is required.',
                    'address_line1.required' => 'Mention centre address.',
                    'state_id.required' => 'Select state.',
                    'city_id.required' => 'Select city.',
                    'pincode.required' => 'Enter pincode.',
                    // 'head_name.required' => 'Enter centre head name.',
                    // 'head_mobile.required' => 'Enter centre mobile name.',
                    // 'head_email.required' => 'Enter centre email.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'centre_name' => $request->centre_name,
                    'display_name' => $request->display_name,
                    'slug' => \Str::slug($request->centre_name . ' in ' . $request->locality),
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address_line1' => $request->address_line1,
                    'address_line2' => $request->address_line2,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'locality' => $request->locality,
                    'landmark' => $request->landmark,
                    'pincode' => $request->pincode,
                    'centre_lat' => $request->centre_lat,
                    'centre_lng' => $request->centre_lng,
                    'head_name' => $request->head_name,
                    'head_mobile' => $request->head_mobile,
                    'head_email' => $request->head_email,
                    'seo_title' => $request->seo_title,
                    'seo_description' => $request->seo_description,
                    'seo_keywords' => $request->seo_keywords,
                    'created_by' => auth()->user()->id,
                    'country_id' => 1,
                    'state_name' => getStateName($request->state_id),
                    'city_name' =>  getCityName($request->city_id),
                    'lead_flow' => $request->lead_flow,
                    'about_us' => $request->about_us,
                    'centre_type' => $request->centre_type,
                    // 'contract_documents' => (count($contractDocuments) > 0) ? json_encode($contractDocuments) : null,
                    // 'centre_images' => (count($centreImages) > 0) ? json_encode($centreImages) : null,
                    // 'centre_facilities' => $centre_facilities,
                ];
                if (isset($request->centre_facilities)  && count($request->centre_facilities) > 0) {
                    $centre_facilities =  json_encode($request->centre_facilities);
                    $array['centre_facilities'] = $centre_facilities;
                }
                $contractDocuments = [];
                if (isset($request['contract_document']) && count($request['contract_document']) > 0) {
                    foreach ($request->contract_document as $sKey => $sList) {
                        if ($sList) {
                            $icon = null;
                            if ($request->hasFile('contract_document')) {
                                $pathString = 'uploads/centres/documents/';
                                $image = $request->file('contract_document')[$sKey];
                                $iconImageName = 'document' . $sKey . '-' . time() . '.' . $image->getClientOriginalExtension();
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
                            $contractDocuments[] = [
                                'contract_document' => $icon,
                                'contract_details' => $request['contract_details'][$sKey],
                                'contract_document_type' => $request['contract_document_type'][$sKey],
                            ];
                        }
                    }

                    (count($contractDocuments) > 0) ? $array['contract_documents'] =  json_encode($contractDocuments) : null;
                }



                $centreImages = [];
                if (isset($request['centre_images']) && count($request['centre_images']) > 0) {
                    foreach ($request->centre_images as $key => $list) {
                        if ($list) {
                            $icon = null;
                            if ($request->hasFile('centre_images')) {
                                $pathString = 'uploads/centres/centre_images/';
                                $image = $request->file('centre_images')[$key];
                                $iconImageName = 'document' . $key . '-' . time() . '.' . $image->getClientOriginalExtension();
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
                        $centre = Centre::where('id', '=', $id)->first();
                        if ($centre) {
                            $existCentreImages = ($centre->centre_images) ? json_decode($centre->centre_images, true) : [];
                            $newCentreImages = array_merge($existCentreImages, $centreImages);
                            $array['centre_images'] =  json_encode($newCentreImages);
                        } else {
                            $array['centre_images'] =  json_encode($centreImages);
                        }
                    }
                }
                /**
                 * Centre Timings
                 */
                $centreTiming = [];
                $weekDaysArray = weekDaysArray();
                if (isset($weekDaysArray) && count($weekDaysArray) > 0) {
                    foreach ($weekDaysArray as $dKey => $dList) {
                        $timings = [];
                        if (isset($request['open'][$dKey]) && !empty($request['open'][$dKey])) {
                            foreach ($request['open'][$dKey] as $ocKey => $ocList) {
                                $timings[] = [
                                    'open' => $request['open'][$dKey][$ocKey],
                                    'close' => $request['close'][$dKey][$ocKey],
                                ];
                            }
                        }
                        $centreTiming[] = [
                            'day' => $dList,
                            'is_active' => isset($request['day'][$dKey]) ? 1 : 0,
                            'timings' => $timings,
                        ];
                    }
                    if (count($centreTiming) > 0) {
                        $array['centre_timings'] =  json_encode($centreTiming);
                    }
                }
                // if (Centre::where('email', $array['email'])->where('id', '<>', $id)->exists()) {
                //     return redirect()->back()->withErrors(['Centre email already exist.'])->withInput($request->all());
                // }
                if (Centre::where('slug', $array['slug'])->where('id', '<>', $id)->exists()) {
                    return redirect()->back()->withErrors(['Centre or slug already exist.'])->withInput($request->all());
                }
                $response = Centre::UpdateOrCreate(['id' => $id], $array);
                DB::commit();
                return redirect('admin/centres/list')->with('success', 'Centre details updated successfully.');
            }

            $pageSettings = $this->pageSetting('edit');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            $states = State::where('status', 1)->get();
            $facilities = getFacilities();
            $details = Centre::where('id', $id)->first();
            return view('admin.pages.centres.edit', compact('page_title', 'page_description', 'breadcrumbs', 'states', 'facilities', 'details'));
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
                $cat = Centre::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Centre deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Centre details not found.');
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
                $response = Centre::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/centres/list')->with('success', 'Centre status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Centre details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function exportExcel()
    {
        $type = request('type');
        if ($type == 'excel')
            return Excel::download(new CentreExport, 'Centres.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }

    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Centre Master';
            $data['page_description'] = 'Edit Centre Master';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Centre Master',
                    'url' => url('admin/centres/list'),
                ],
                [
                    'title' => 'Edit Centre',
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
            $data['page_title'] = 'Centre Master';
            $data['page_description'] = 'Add a Centre';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Centre Master',
                    'url' => url('admin/centres/list'),
                ],
                [
                    'title' => 'Add a Centre',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
