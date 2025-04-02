<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityDetails;
use App\Models\State;
use DB;
use Validator;

use App\Exports\Excel\CityExport;
use Maatwebsite\Excel\Facades\Excel;
class CityController extends Controller
{
    public function index()
    {
        $page_title = 'City';
        $page_description = '';
        $breadcrumbs = [
            [
                'title' => 'City Management',
                'url' => '',
            ]
        ];
        $stateId = request('state_id');
        $status = request('status');
        if ($status == '0') {
            $status = '2';
        }
        $cities = City::with(['state'])
            ->when($stateId, function ($cities) use ($stateId) {
                if (!empty($stateId)) {
                    $cities->where('state_id', '=', $stateId);
                }
            })
            ->when($status, function ($cities) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $cities->where('status', '=', $status);
                }
            })
            ->orderBy('name', 'asc')->paginate(10);
        return view('admin.pages.city.list', compact('page_title', 'page_description', 'breadcrumbs', 'cities'));
    }
    public function add(Request $request)
    {
        try {

            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'state_id' => 'required',
                    'name' => 'required',
                ], [
                    'state_id.required' => 'Select state.',
                    'name.required' => 'City name is required.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $state = explode(',', $request->state_id);
                $insertArr = [
                    'state_id' => $state[0],
                    'state_name' => $state[1],
                    'name' => $request->name,
                    'country_id' => 1,
                    'slug' => \Str::slug($state[1] . ' ' . $request->name),
                    'description' => $request->description,
                ];
                if (!City::where('slug', $insertArr['slug'])->exists()) {
                    $response = City::Create($insertArr);
                    DB::commit();
                    return redirect('admin/city/list')->with('success', 'City details updated successfully.');
                } else {
                    return redirect()->back()->withErrors(['City name or slug already exist.'])->withInput($request->all());
                }
            }


            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            $states = State::where('status', 1)->get();
            return view('admin.pages.city.add', compact('page_title', 'page_description', 'breadcrumbs', 'states'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect('admin/create-offer')->with('error', $e->getMessage())->withInput($request->all());
        }
    }
    public function edit(Request $request, $cityId)
    {
        try {
            if ($cityId) {
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'state_id' => 'required',
                        'name' => 'required',
                    ], [
                        'state_id.required' => 'Select state.',
                        'name.required' => 'City name is required.'
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();

                    $state = explode(',', $request->state_id);
                    $updateArr = [
                        'state_id' => $state[0],
                        'state_name' => $state[1],
                        'slug' => \Str::slug($state[1] . ' ' . $request->name),
                        'name' => $request->name,
                        'description' => $request->description,
                    ];
                    if (City::where('slug', $updateArr['slug'])->exists()) {
                        $insertArr['slug'] = \Str::slug($updateArr['state_name'] . ' ' . $updateArr['name']);
                    }

                    $response = City::UpdateOrCreate(['id' => $cityId], $updateArr);
                    DB::commit();
                    return redirect('admin/city/list')->with('success', 'City details updated successfully.');
                }

                $pageSettings = $this->pageSetting('edit');



                $page_title =  $pageSettings['page_title'];
                $page_description = $pageSettings['page_description'];
                $breadcrumbs = $pageSettings['breadcrumbs'];

                $states = State::where('status', 1)->get();
                $cityDetail = City::where('id', $cityId)->first();
                if ($cityDetail) {
                    return view('admin.pages.city.edit', compact('page_title', 'page_description', 'breadcrumbs', 'cityDetail', 'states'));
                } else {
                    return redirect()->back()->with('error', 'City details not found.');
                }
            } else {
                return redirect()->back()->with('error', 'City details not found.');
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect('admin/create-offer')->with('error', $e->getMessage())->withInput($request->all());
        }
    }
    public function updateStatus($cityId, $status)
    {
        try {
            if ($cityId) {

                DB::beginTransaction();
                $status = ($status == 1) ? $status = 0 : $status = 1;
                $updateArr = [
                    'status' => $status,
                ];
                $response = City::UpdateOrCreate(['id' => $cityId], $updateArr);
                DB::commit();
                return redirect('admin/city/list')->with('success', 'City status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'City details not found.');
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect('admin/create-offer')->with('error', $e->getMessage())->withInput($request->all());
        }
    }

    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'City';
            $data['page_description'] = 'Edit City';
            $data['breadcrumbs'] = [
                [
                    'title' => 'City Management',
                    'url' => url('admin/city/list'),
                ],
                [
                    'title' => 'Edit City',
                    'url' => '',
                ],
            ];
            return $data;
        }

        if ($action == 'add') {
            $data['page_title'] = 'City';
            $data['page_description'] = 'Add a New City';
            $data['breadcrumbs'] = [
                [
                    'title' => 'City Management',
                    'url' => url('admin/city/list'),
                ],
                [
                    'title' => 'Add City',
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
            return Excel::download(new CityExport, 'Cities.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
