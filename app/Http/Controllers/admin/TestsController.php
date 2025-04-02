<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\PathologyTest as Tests;
use App\Models\PathologyTestImport as TestsImport;
use App\Models\Category;
use App\Models\City;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\TestExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class TestsController extends Controller
{
    public function index()
    {
        try {
            Paginator::useBootstrapThree();
            $page_title = 'Tests';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Tests',
                    'url' => '',
                ]
            ];
            $categoryId = request('category_id');
            $subCategoryId = request('sub_category_id');
            $departmentId = request('department_id');
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $searchTerm = request('test_name');
            $tests = Tests::with(['department_data'])->when($departmentId, function ($doctors) use ($departmentId) {
                $doctors->where('department_id', '=', $departmentId);
            })->when($status, function ($doctors) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $doctors->where('status', '=', $status);
                }
            })->when($categoryId, function ($doctors) use ($categoryId) {
                if ($categoryId) {
                    $doctors->whereRaw(DB::raw('(categories REGEXP "' . $categoryId . '")'));
                }
            })->when($subCategoryId, function ($doctors) use ($subCategoryId) {
                if ($subCategoryId) {
                    $doctors->whereRaw(DB::raw('(sub_categories REGEXP "' . $subCategoryId . '")'));
                }
            })->when($searchTerm, function ($data) use ($searchTerm) {
                $data->whereRaw("(test_name like '%" . $searchTerm . "%' OR test_code like '%" . $searchTerm . "%' )");
            })->orderBy('id', 'desc')->paginate(100);
            // dd(  $tests);
            $departments = Department::where('status', 1)->orderBy('id', 'desc')->get();
            $categories = Category::where('status', 1)->where('parent_id', 0)->orderBy('id', 'desc')->get();
            // dd($doctors);
            return view('admin.pages.tests.list', compact('page_title', 'page_description', 'breadcrumbs',  'tests',  'departments', 'categories'));
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
                    'test_code' => 'required',
                    'test_name' => 'required',
                    // 'lab_name' => 'required',
                    // 'component_count' => 'required',
                    'recommendation' => 'required',
                    // 'age_group' => 'required',
                    'mrp' => 'required',
                    'selling_price' => 'required',
                    'report_tat' => 'required',
                    // 'category_id' => 'required',
                    // 'sub_category_id' => 'required',
                    'department_id' => 'required',
                    // 'specialities' => 'required',
                ], [
                    'test_code.required' => 'Test code is required.',
                    'test_name.required' => 'Test name is required.',
                    // 'lab_name.required' => 'Lab name is required.',
                    // 'component_count.required' => 'Component count is required.',
                    'recommendation.required' => 'Recommendation is required.',
                    'age_group.required' => 'Age group is required.',
                    'selling_price.required' => 'Selling price is required.',
                    'mrp.required' => 'MRP is required.',
                    'report_tat.required' => 'Report Tat is required.',
                    'category_id.required' => 'Category is required.',
                    'sub_category_id.required' => 'Sub Category is required.',
                    'department_id.required' => 'Department is required.',
                    'specialities.required' => 'Speciality is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();






                $array = [
                    'test_name' => $request->test_name,
                    'test_code' => $request->test_code,
                    'slug' => \Str::slug($request->test_name . ' - ' . $request->test_code),
                    // 'category_id' => $request->category_id,
                    // 'department_id' => $request->department_id,
                    'recommendation' => $request->recommendation,
                    'age_group' => $request->age_group,
                    'report_tat' => $request->report_tat,
                    'technique' => $request->technique,
                    'specimen' => $request->specimen,
                    'temperature' => $request->temperature,
                    'cut_off' => $request->cut_off,
                    'description' => $request->description,
                    'remarks' => $request->remarks,
                    'mrp' => $request->mrp,
                    'selling_price' => $request->selling_price,
                    'profile' => $request->profile,
                    'container' => $request->container,
                    'volume' => $request->volume,
                    'method' => $request->method,
                    'schedule' => $request->schedule,
                    'gender' => $request->gender,
                    'instructions' => $request->instructions,

                ];
                if (isset($request->department_id) && count($request->department_id) > 0) {
                    $array['department_id'] = $request->department_id[0];
                    $array['other_departments'] = implode(',',$request->department_id);
                }
                if (isset($request->priority)) {
                    $array['priority_sequence'] = $request->prioritysequence;
                }
                if (isset($request->is_trending)) {
                    $array['is_trending'] = 1;
                }
                if (isset($request->category_id) && count($request->category_id) > 0) {
                    $array['categories'] = json_encode($request->category_id);
                }
                if (isset($request->sub_category_id) && count($request->sub_category_id) > 0) {
                    $array['sub_categories'] = json_encode($request->sub_category_id);
                }
                if (isset($request->specialities) && count($request->specialities) > 0) {
                    $array['specialities'] = json_encode($request->specialities);
                }
                if (isset($request->components) && count($request->components) > 0) {
                    $components = [];
                    foreach ($request->components as $sKey => $sList) {
                        if ($sList) {
                            $components[] = [
                                'title' => $sList,
                            ];
                        }
                    }
                    if ($component_count = count($components) > 0) {
                        $array['components'] = json_encode($components);
                        $array['component_count'] = $component_count;
                    }
                }

                if (isset($request->faqs_ids) && count($request->faqs_ids) > 0) {
                    $array['faqs_ids'] = json_encode($request->faqs_ids);
                }
                // dd($array);
                $TestCodeExist = Tests::where('test_code', $array['test_code'])->exists();
                if ($TestCodeExist) {
                    return redirect()->back()->withErrors(['Test code already exist.'])->withInput($request->all());
                }

                $response = Tests::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/tests/list')->with('success', 'Test details added successfully.');
            }

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            $departments = Department::where('status', 1)->orderBy('id', 'desc')->get();
            $categories = Category::where('status', 1)->where('parent_id', 0)->orderBy('id', 'desc')->get();
            return view('admin.pages.tests.add', compact('page_title', 'page_description', 'breadcrumbs', 'departments', 'categories'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage())->withInput($request->all());
        }
    }
    public function edit(Request $request, $id)
    {

        try {
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'test_code' => 'required',
                    'test_name' => 'required',
                    // 'lab_name' => 'required',
                    // 'component_count' => 'required',
                    'recommendation' => 'required',
                    // 'age_group' => 'required',
                    'mrp' => 'required',
                    'selling_price' => 'required',
                    'report_tat' => 'required',
                    // 'category_id' => 'required',
                    // 'sub_category_id' => 'required',
                    'department_id' => 'required',
                    // 'specialities' => 'required',
                ], [
                    'test_code.required' => 'Test code is required.',
                    'test_name.required' => 'Test name is required.',
                    // 'lab_name.required' => 'Lab name is required.',
                    // 'component_count.required' => 'Component count is required.',
                    'recommendation.required' => 'Recommendation is required.',
                    'age_group.required' => 'Age group is required.',
                    'selling_price.required' => 'Selling price is required.',
                    'mrp.required' => 'MRP is required.',
                    'report_tat.required' => 'Report Tat is required.',
                    'category_id.required' => 'Category is required.',
                    'sub_category_id.required' => 'Sub Category is required.',
                    'department_id.required' => 'Department is required.',
                    'specialities.required' => 'Speciality is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

              
                $array = [
                    'test_name' => $request->test_name,
                    'slug' => \Str::slug($request->test_name . ' - ' . $request->test_code),
                    'test_code' => $request->test_code,
                    // 'category_id' => $request->category_id,
                    // 'department_id' => $request->department_id,
                    'recommendation' => $request->recommendation,
                    'age_group' => $request->age_group,
                    'report_tat' => $request->report_tat,
                    'technique' => $request->technique,
                    'specimen' => $request->specimen,
                    'temperature' => $request->temperature,
                    'cut_off' => $request->cut_off,
                    'description' => $request->description,
                    'remarks' => $request->remarks,
                    'mrp' => $request->mrp,
                    'selling_price' => $request->selling_price,
                    'profile' => $request->profile,
                    'container' => $request->container,
                    'volume' => $request->volume,
                    'method' => $request->method,
                    'gender' => $request->gender,
                    'schedule' => $request->schedule,
                    'instructions' => $request->instructions,

                ];
                if (isset($request->department_id) && count($request->department_id) > 0) {
                    $array['department_id'] = $request->department_id[0];
                    $array['other_departments'] = implode(',',$request->department_id);
                }
                if (isset($request->priority)) {
                    $array['priority_sequence'] = $request->prioritysequence;
                }
                if (isset($request->is_trending)) {
                    $array['is_trending'] = 1;
                }
                if (isset($request->category_id) && count($request->category_id) > 0) {
                    $array['categories'] = json_encode($request->category_id);
                }
                if (isset($request->sub_category_id) && count($request->sub_category_id) > 0) {
                    $array['sub_categories'] = json_encode($request->sub_category_id);
                }
                if (isset($request->specialities) && count($request->specialities) > 0) {
                    $array['specialities'] = json_encode($request->specialities);
                }
                if (isset($request->components) && count($request->components) > 0) {
                    $components = [];
                    foreach ($request->components as $sKey => $sList) {
                        if ($sList) {
                            $components[] = [
                                'title' => $sList,
                            ];
                        }
                    }
                    if ($component_count = count($components) > 0) {
                        $array['components'] = json_encode($components);
                        $array['component_count'] = $component_count;
                    }
                }
                if (isset($request->city_wise_price) && count($request->city_wise_price) > 0) {
                    $cityWiseArr = [];
                    foreach ($request->city_wise_price as $cityId => $cityPrice) {

                        if ($cityPrice) {
                            $price = $cityPrice;
                        } else {
                            $price = 0;
                        }
                        if (isset($request['city_id'][$cityId]) && !empty($request['city_id'][$cityId])) {
                            $avail = 1;
                        } else {
                            $avail = 0;
                        }
                        $cityWiseArr[] = [
                            'city_id' => $cityId,
                            'availability' => $avail,
                            'city_price' => $price,
                        ];
                    }
                    if (count($cityWiseArr) > 0) {
                        $array['citywise_prices'] = json_encode($cityWiseArr);
                    }
                }

                if (isset($request->faqs_ids) && count($request->faqs_ids) > 0) {
                    $array['faqs_ids'] = json_encode($request->faqs_ids);
                }
                $TestCodeExist = Tests::where('test_code', $array['test_code'])->where('id', '<>', $id)->exists();
                if ($TestCodeExist) {
                    return redirect()->back()->withErrors(['Test code already exist.'])->withInput($request->all());
                }

                $TestCodeSlug = Tests::where('slug', $array['slug'])->where('id', '<>', $id)->exists();
                if ($TestCodeSlug) {
                    return redirect()->back()->withErrors(['Test or slug already exist.'])->withInput($request->all());
                }

                $response = Tests::UpdateOrCreate(['id' => $id], $array);
                DB::commit();
                return redirect('admin/tests/list')->with('success', 'Test details updated successfully.');
            }

            $pageSettings = $this->pageSetting('edit');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            $details = Tests::where('id', $id)->first();
            if ($details) {
                $departments = Department::where('status', 1)->orderBy('id', 'desc')->get();
                $cities = City::where('status', 1)->orderBy('name', 'asc')->get();
                $categories = Category::where('status', 1)->where('parent_id', 0)->orderBy('id', 'desc')->get();
                return view('admin.pages.tests.edit', compact('page_title', 'page_description', 'breadcrumbs', 'departments', 'cities', 'categories', 'details'));
            } else {

                return redirect('admin/tests/list')->withErrors(['Test details not found.'])->withInput($request->all());
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function import(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $file = $request->file('uploaded_file');
                if ($file) {
                    $validatedData = $request->validate([

                        'uploaded_file' => 'required',

                    ]);
                    $insertArr = [];
                    $rawData = Excel::toArray('', $request->file('uploaded_file'), null, \Maatwebsite\Excel\Excel::TSV)[0];
                    if (count($rawData) > 0) {

                        DB::beginTransaction();

                        DB::table('pathology_tests_import')->truncate();
                        foreach ($rawData as $key => $row) {

                            // note that these fields are completely different for you as your database fields and excel fields so replace them with your own database fields
                            if ($key > 0) {

                                //  dd($row);
                                $insertArr[] = [
                                    'test_code' => $row[0],
                                    'test_name' => $row[1],
                                    'slug' => null,
                                    'lab_name' => $row[2],
                                    'component_count' => $row[3] ?  $row[3] : 0,
                                    'recommendation' => $row[4],
                                    'age_group' => $row[5],
                                    'mrp' => $row[6] ? intval($row[6]) : 0,
                                    'selling_price' => $row[7] ? intval($row[7]) : 0,
                                    'technique' => $row[8],
                                    'specimen' => $row[9],
                                    'temperature' => $row[10],
                                    'instructions' => $row[11],
                                    'container' => $row[12],
                                    'volume' => $row[13],
                                    'method' => $row[14],
                                    'schedule' => $row[15],
                                    'test_type' => $row[16],
                                    'profile' => $row[17],
                                    'cut_off' => $row[18],
                                    'gender' => $row[19],
                                    'description' => $row[20],
                                    'categories' => $row[21] ? getcategoriesids($row[21]) : null,
                                    'sub_categories' => $row[22] ? getsubcategoriesids($row[22]) : null,
                                    'department' => (isset($row[23]) && $row[23]) ? getdepartmentidsfirst($row[23]) : null,
                                    'other_departments' => (isset($row[23]) && $row[23]) ?  getdepartmentids($row[23]) : null,
                                    'report_tat' => (isset($row[24]) && $row[24]) ? $row[24] : null,
                                    'status' => 1,
                                    'updated_at' => date('Y-m-d H:i:s'),
                                    'created_at' => date('Y-m-d H:i:s'),
                                ];
                            }
                        }
                        $inds = TestsImport::insert($insertArr);

                        DB::statement("UPDATE ocq_pathology_tests_import SET slug = lower(CONCAT(test_name,'-',test_code,'-',id)),slug = replace(slug, '.', ' '),slug = replace(slug, '', '-'),slug = replace(slug, '/', ''),slug = replace(slug, '!', ''),slug = replace(slug, '@', ''),slug = replace(slug, '#', ''),slug = replace(slug, '$', ''),slug = replace(slug, '%', ''),slug = replace(slug, '^', ''),slug = replace(slug, '&', ''),slug = replace(slug, '*', ''),slug = replace(slug, '(', ''),slug = replace(slug, ')', ''),slug = replace(slug, '_', ''),slug = replace(slug, '=', ''),slug = replace(slug, '+', ''),slug = replace(slug, '~', ''),slug = replace(slug, '`', ''),slug = replace(slug, '}', ''),slug = replace(slug, '{', ''),slug = replace(slug, '|', ''),slug = replace(slug, '?', ''),slug = replace(slug, '>', ''),slug = replace(slug, '<', ''),slug = replace(slug, '.', ''),slug = trim(slug),slug = replace(slug, ' ', '-'),slug = replace(slug, '--', '-') where slug is NULL");

                        DB::statement("SET sql_mode = ''");


                        $results =   DB::select("SELECT test_name,test_code,COUNT(test_code) as duplicates FROM ocq_pathology_tests_import group by test_code having count(*) >= 2");

                        if (count($results) > 0) {
                            $i = 1;
                            $html = '<h3>Followings are duplicate tests found.</h3> <br>';
                            foreach ($results as $key => $list) {
                                $html .=  $i++ . ') ' . $list->test_name . '[' . $list->test_code . '][duplicate counts - ' . $list->duplicates . ']<br> ';
                            }
                            return redirect()->back()->withErrors([$html]);
                        }








                        DB::statement("UPDATE ocq_pathology_tests as t JOIN ocq_pathology_tests_import itt ON itt.test_code = t.test_code SET t.test_name = itt.test_name, t.slug = itt.slug, t.lab_name = itt.lab_name, t.component_count = itt.component_count, t.recommendation = itt.recommendation, t.age_group = itt.age_group, t.mrp = itt.mrp, t.selling_price = itt.selling_price, t.technique = itt.technique, t.specimen = itt.specimen, t.temperature = itt.temperature, t.instructions = itt.instructions, t.container = itt.container, t.volume = itt.volume, t.method = itt.method, t.test_type = itt.test_type, t.profile = itt.profile, t.cut_off = itt.cut_off, t.gender = itt.gender, t.description = itt.description, t.categories = itt.categories, t.sub_categories = itt.sub_categories, t.department_id = (select d.id from ocq_departments d WHERE d.department_name Like CONCAT('%',itt.department,'%') limit 1), t.department = itt.department, t.schedule = itt.schedule,t.report_tat = itt.report_tat,t.other_departments = itt.other_departments WHERE t.test_code = itt.test_code AND t.deleted_at is NULL ");

                        DB::statement("INSERT INTO ocq_pathology_tests (test_code, test_name, slug, lab_name, component_count, recommendation, age_group, mrp, selling_price, technique, specimen, temperature, instructions, container, volume, method, test_type, profile, cut_off, gender, description, categories, sub_categories, department_id, department,schedule,report_tat,other_departments) SELECT test_code, test_name, slug, lab_name, component_count, recommendation, age_group, mrp, selling_price, technique, specimen, temperature, instructions, container, volume, method, test_type, profile, cut_off, gender, description, categories, sub_categories, department_id, department,schedule,report_tat,other_departments FROM ocq_pathology_tests_import as ft WHERE ft.test_code NOT IN (SELECT DISTINCT test_code FROM ocq_pathology_tests t WHERE t.test_code = ft.test_code AND t.deleted_at is NULL ) ");

                        DB::commit();
                        return redirect('admin/tests/list')->with('success', 'Test Imported successfully.');
                    }
                }
            }

            $pageSettings = $this->pageSetting('import');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            return view('admin.pages.tests.import', compact('page_title', 'page_description', 'breadcrumbs'));
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
                $cat = Tests::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Test deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Test details not found.');
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
                $response = Tests::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/tests/list')->with('success', 'Test status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Test details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Tests';
            $data['page_description'] = 'Edit Tests';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Tests',
                    'url' => url('admin/tests/list'),
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
            $data['page_title'] = 'Tests';
            $data['page_description'] = 'Add a Tests';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Tests',
                    'url' => url('admin/tests/list'),
                ],
                [
                    'title' => 'Add a Tests',
                    'url' => '',
                ],
            ];
            return $data;
        }
        if ($action == 'import') {
            $data['page_title'] = 'Import Tests';
            $data['page_description'] = 'Import Tests';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Tests',
                    'url' => url('admin/tests/list'),
                ],
                [
                    'title' => 'Import Tests',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }

    function searchTestsFrontend(Request $request)
    {
        try {

            $departments = Department::where('status', 1)->get();
            if ($request->isMethod('post')) {
                $globalSearch  = request('global_search');
                $searchTerm  = request('test_name');
                $department  = request('Department');
                $errorFlag = false;
                $error = 'Please enter test name or text code.';
                if ($globalSearch) {
                    $errorFlag = true;
                }
                if ($searchTerm) {
                    $errorFlag = true;
                    $globalSearch = false;
                }
                if (!$errorFlag) {
                    // return redirect('search-tests')->withErrors($error)->withInput();
                    $limit = 100;
                } else {
                    $limit = 100;
                }
                if ($globalSearch) {
                    $lists  = Tests::select(
                        '*',
                        'pathology_tests.id as test_id',
                        'pathology_tests.description as test_description'
                    )
                        ->leftJoin('departments as d', 'd.id', 'pathology_tests.department_id')
                        ->where('pathology_tests.status', 1)
                        ->when($globalSearch, function ($data) use ($globalSearch) {
                            $data->whereRaw('(test_name like "%' . $globalSearch . '%" OR test_code like "%' . $globalSearch . '%"  OR department_name like "%' . $globalSearch . '%"  OR department like "%' . $globalSearch . '%" )');
                        })
                        ->when($department, function ($data) use ($department) {
                            // dd($department);
                            $sqlStr = '(department_id = '. $department.' OR FIND_IN_SET("other_departments","'.$department.'"))';
                            // $data->where("pathology_tests.department_id", '=', $department);
                            $data->whereRaw($sqlStr);
                        })
                        ->when($limit, function ($data) use ($limit) {
                            $data->limit($limit);
                        })
                        ->get();
                } else {
                    $lists  = Tests::select(
                        '*',
                        'pathology_tests.id as test_id',
                        'pathology_tests.description as test_description'
                    )
                        ->leftJoin('departments as d', 'd.id', 'pathology_tests.department_id')
                        ->where('pathology_tests.status', 1)
                        ->when($searchTerm, function ($data) use ($searchTerm) {
                            $data->whereRaw('(test_name like "%' . $searchTerm . '%" OR test_code like "%' . $searchTerm . '%" )');
                        })
                        ->when($department, function ($data) use ($department) {
                            // $data->where("pathology_tests.department_id", '=', $department);
                            // dd($department);
                            $sqlStr = '(department_id = '. $department.' OR FIND_IN_SET("'.$department.'",other_departments))'; 
                            $data->whereRaw($sqlStr);
                        })
                        ->when($limit, function ($data) use ($limit) {
                            $data->limit($limit);
                        })
                        ->get();
                }
                $cityList = getCityListArray();
                return view('frontend.search-tests', compact('lists', 'departments', 'cityList'));
            }
            $lists  = [];
            return view('frontend.search-tests', compact('lists', 'departments'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function searchTestsAjax(Request $request)
    {
        try {
            $searchTerm  = request('query');
            if ($request->isMethod('post') && $searchTerm) {

                $errorFlag = false;
                $error = 'Please enter test name or text code.';

                $lists  = Tests::select(
                    '*',
                    'pathology_tests.id as test_id',
                    'pathology_tests.description as test_description'
                )->leftJoin('departments as d', 'd.id', 'pathology_tests.department_id')->where('pathology_tests.status', 1)->when($searchTerm, function ($data) use ($searchTerm) {
                    $data->whereRaw("(test_name like '%" . $searchTerm . "%' OR test_code like '%" . $searchTerm . "%' )");
                })->get();

                $result['Result'] =  $lists;
                $result['Success'] = 'True';
                $result['Message'] = '';
                return response()->json($result);
            } else {
                $result['Result'] = [];
                $result['Success'] = 'False';
                $result['Message'] = 'Search string is empty.';
                return response()->json($result);
            }
        } catch (\Exception $e) {
            dd($e);
            $result['Result'] = [];
            $result['Success'] = 'False';
            $result['Message'] = $e->getMessage();
            return response()->json($result);
        }
    }
    function exportExcel()
    {
        $type = request('type');
        if ($type == 'excel')
            return Excel::download(new TestExport, 'Tests.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
