<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industry;
use DB;
use Validator;

class IndustryController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Industry';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Industry',
                    'url' => '',
                ]
            ];


            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $industries = Industry::when($status, function ($industries) use ($status) {
                $industries->where('status', '=', $status);
            })->orderBy('id', 'desc')->get();
            return view('admin.pages.industries.list', compact('page_title', 'page_description', 'breadcrumbs',  'industries'));
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
                    'status' => 'required',
                    'name' => 'required',
                    'description' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'name' => $request->name,
                    'status' => $request->status,
                    'description' => $request->description,

                ];

                $response = Industry::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/industries/list')->with('success', 'Industry details added successfully.');
            }



            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            return view('admin.pages.industries.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                        'status' => 'required',
                        'name' => 'required',
                        'description' => 'required',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();

                    $array = [
                        'status' => $request->status,
                        'name' => $request->name,
                        'description' => $request->description,

                    ];

                    $response = Industry::UpdateOrCreate(['id' => $id], $array);
                    DB::commit();
                    return redirect('admin/industries/list')->with('success', 'Industry details added successfully.');
                }


                $details = Industry::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit');

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];
                    return view('admin.pages.industries.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
                } else {
                    return redirect()->back()->withErrors(['Faq details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['Faq details id is missing.']);
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
                $cat = Industry::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Industry  deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Industry details not found.');
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
                $status = ($status == 1) ? $status = 2 : $status = 1;
                $updateArr = [
                    'status' => $status,
                ];
                $response = Industry::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/industries/list')->with('success', 'Industry status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Industry details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Industry Master';
            $data['page_description'] = 'Add Industry Faq';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Faq Master',
                    'url' => url('admin/industries/list'),
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
            $data['page_title'] = 'Industry Master';
            $data['page_description'] = 'Add New Industry';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Industry Master',
                    'url' => url('admin/industries/list'),
                ],
                [
                    'title' => 'Add a New Faq',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
