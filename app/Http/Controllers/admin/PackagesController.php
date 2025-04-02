<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PathologyPackages as Packages;

use App\Models\Category;
use App\Models\State;
use App\Models\City;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\PackageExport;
use Maatwebsite\Excel\Facades\Excel;

class PackagesController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Packages';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Packages',
                    'url' => '',
                ]
            ];
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $packages = Packages::when($status, function ($doctors) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $doctors->where('status', '=', $status);
                }
            })->orderBy('id', 'desc')->get();
            // $cities = City::where('status', 1)->orderBy('name', 'asc')->get();
            // dd($doctors);
            return view('admin.pages.packages.list', compact('page_title', 'page_description', 'breadcrumbs',  'packages'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $cat = Packages::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Package deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Package details not found.');
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
                $response = Packages::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/packages/list')->with('success', 'Package status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Package details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function add(Request $request)
    {

        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'package_name' => 'required',
                    'recommendation' => 'required',
                    // 'age_group' => 'required',
                    'mrp' => 'required',
                    'selling_price' => 'required',
                    'report_tat' => 'required',
                    // 'state_id' => 'required',
                    // 'city_id' => 'required',
                    'package_code' => 'required',
                ], [
                    'package_name.required' => 'Package name is required.',
                    'package_code.required' => 'Package code is required.',
                    'test_name.required' => 'Test name is required.',
                    // 'city_id.required' => 'Component count is required.',
                    'recommendation.required' => 'Recommendation is required.',
                    // 'age_group.required' => 'Age group is required.',
                    'selling_price.required' => 'Selling price is required.',
                    'mrp.required' => 'MRP is required.',
                    'report_tat.required' => 'Report Tat is required.',
                    // 'state_id.required' => 'Category is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();
                $array = [
                    'package_name' => $request->package_name,
                    'package_code' => $request->package_code,
                    'slug' => \Str::slug($request->package_name),
                    'recommendation' => $request->recommendation,
                    'age_group' => $request->age_group,
                    'report_tat' => $request->report_tat,
                    'description' => $request->description,
                    'mrp' => $request->mrp,
                    'selling_price' => $request->selling_price,
                    'state_id' => $request->state_id,
                    'state_name' => getStateName($request->state_id),
                    'city_id' => $request->city_id,
                    'gender' => $request->gender,
                    'sample_type' => $request->sample_type,
                    'component_count' => $request->component_count,
                    'city_name' => getCityName($request->city_id),

                ];

                $PackageSlug = Packages::where('slug', $array['slug'])->exists();
                if ($PackageSlug) {
                    return redirect()->back()->withErrors(['Package or slug already exist.'])->withInput($request->all());
                }
                $PackageCode = Packages::where('package_code', $array['package_code'])->exists();
                if ($PackageCode) {
                    return redirect()->back()->withErrors(['Package code already exist.'])->withInput($request->all());
                }

                if (isset($request->priority)) {
                    $array['priority_sequence'] = $request->prioritysequence;
                }


                $array['tests'] = null;
                if (isset($request->selected_test_id) && count($request->selected_test_id) > 0) {
                    $selectedTests = [];
                    foreach ($request->selected_test_id as $sKey => $sList) {
                        if ($sList) {
                            $selectedTests[] = [
                                'test_id' => $sList,
                                'test_name' => (isset($request['selected_test_name'][$sList])) ? $request['selected_test_name'][$sList] : null,
                            ];
                        }
                    }
                    if (count($selectedTests) > 0)
                        $array['tests'] = json_encode($selectedTests);
                }


                if (isset($request->faqs_ids) && count($request->faqs_ids) > 0) {
                    $array['faqs_ids'] = json_encode($request->faqs_ids);
                }
                if (isset($request->sub_category_ids) && count($request->sub_category_ids) > 0) {
                    $array['sub_category_ids'] = implode(',', $request->sub_category_ids);
                }
                $response = Packages::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/packages/list')->with('success', 'Package details added successfully.');
            }

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            return view('admin.pages.packages.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                // dd($_FILES);
                $validator = Validator::make($request->all(), [
                    'package_name' => 'required',
                    'package_code' => 'required',
                    'recommendation' => 'required',
                    // 'age_group' => 'required',
                    'mrp' => 'required',
                    'selling_price' => 'required',
                    'report_tat' => 'required',
                    // 'state_id' => 'required',
                    // 'city_id' => 'required',
                ], [
                    'package_name.required' => 'Package name is required.',
                    'package_code.required' => 'Package code is required.',
                    'test_name.required' => 'Test name is required.',
                    // 'city_id.required' => 'Component count is required.',
                    'recommendation.required' => 'Recommendation is required.',
                    // 'age_group.required' => 'Age group is required.',
                    'selling_price.required' => 'Selling price is required.',
                    'mrp.required' => 'MRP is required.',
                    'report_tat.required' => 'Report Tat is required.',
                    // 'state_id.required' => 'Category is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();
                $array = [
                    'package_name' => $request->package_name,
                    'package_code' => $request->package_code,
                    'slug' => \Str::slug($request->package_name),
                    'recommendation' => $request->recommendation,
                    'age_group' => $request->age_group,
                    'report_tat' => $request->report_tat,
                    'description' => $request->description,
                    'mrp' => $request->mrp,
                    'selling_price' => $request->selling_price,
                    'state_id' => $request->state_id,
                    'state_name' => getStateName($request->state_id),
                    'component_count' => $request->component_count,
                    'city_id' => $request->city_id,
                    'gender' => $request->gender,
                    'sample_type' => $request->sample_type,
                    'city_name' => getCityName($request->city_id),

                ];

                $PackageSlug = Packages::where('slug', $array['slug'])->where('id', '<>', $id)->exists();
                if ($PackageSlug) {
                    return redirect()->back()->withErrors(['Package or slug already exist.'])->withInput($request->all());
                }

                $PackageCode = Packages::where('package_code', $array['package_code'])->where('id', '<>', $id)->exists();
                if ($PackageCode) {
                    return redirect()->back()->withErrors(['Package code already exist.'])->withInput($request->all());
                }

                if ($request->has('sample_report')) {
                    $uploadedFile = $request->file('sample_report');
                    $fileName =   \Str::slug($_FILES['sample_report']['name']) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();
                    $destinationPath = public_path('./uploads/sample/');
                    $isValid = $uploadedFile->isValid();
                    if ($isValid) {
                        $uploadedFile->move($destinationPath, $fileName);
                        $array['sample_report'] = $fileName;
                    }
                }
                if (isset($request->priority)) {
                    $array['priority_sequence'] = $request->prioritysequence;
                    $array['show_ontop'] = 1;
                }else{
                    $array['priority_sequence'] =null;
                    $array['show_ontop'] =null;
                }
                /**
                 * Upload Banner
                 */
                if ($request->hasFile('banner')) {
                    $pathString = 'uploads/packages/';
                    $image = $request->file('banner');
                    $iconImageName = \Str::slug($request->package_name) . time() . '.' . $image->getClientOriginalExtension();
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
                    $array['banner'] =  $icon;
                }
                /**
                 * Upload Banner
                 */
                $array['tests'] = null;
                if (isset($request->selected_test_id) && count($request->selected_test_id) > 0) {
                    $selectedTests = [];
                    foreach ($request->selected_test_id as $sKey => $sList) {
                        if ($sList) {
                            $selectedTests[] = [
                                'test_id' => $sList,
                                'test_name' => (isset($request['selected_test_name'][$sList])) ? $request['selected_test_name'][$sList] : null,
                            ];
                        }
                    }
                    if (count($selectedTests) > 0)
                        $array['tests'] = json_encode($selectedTests);
                }



                if (isset($request->faqs_ids) && count($request->faqs_ids) > 0) {
                    $array['faqs_ids'] = json_encode($request->faqs_ids);
                } else {
                    $array['faqs_ids'] = null;
                }
                if (isset($request->sub_category_ids) && count($request->sub_category_ids) > 0) {
                    $array['sub_category_ids'] = implode(',', $request->sub_category_ids);
                }
                // dd($array);
                $response = Packages::UpdateOrCreate(['id' => $id], $array);
                DB::commit();
                return redirect('admin/packages/list')->with('success', 'Package details added successfully.');
            }

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            $details = Packages::where('id', $id)->first();
            return view('admin.pages.packages.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Packages';
            $data['page_description'] = 'Edit Package';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Tests',
                    'url' => url('admin/packages/list'),
                ],
                [
                    'title' => 'Edit Tests',
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
            $data['page_title'] = 'Packages';
            $data['page_description'] = 'Add a Package';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Packages List',
                    'url' => url('admin/packages/list'),
                ],
                [
                    'title' => 'Add a Package',
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
            return Excel::download(new PackageExport, 'Packages.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
