<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SeoPage;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\SeoExport;
use Maatwebsite\Excel\Facades\Excel;

class SeoController extends Controller
{
    public function index()
    {

        try {
            $page_title = 'Page Master';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Page Master',
                    'url' => '',
                ]
            ];


            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $pages = SeoPage::when($status, function ($pages) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $pages->where('status', '=', $status);
                }
            })->orderBy('id', 'desc')->get();
            return view('admin.pages.seo.list', compact('page_title', 'page_description', 'breadcrumbs',  'pages'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'page_name' => 'required',
                    'seo_title' => 'required',
                    'seo_description' => 'required',
                    // 'seo_keywords' => 'required',
                ], [
                    'page_name.required' => 'Page name is required.',
                    'seo_title.required' => 'Reference  title is required.',
                    'seo_description.required' => 'Reference  description is required.',
                    'seo_keywords.required' => 'Reference  keywords is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();


                $array = [
                    'page_name' => $request->page_name,
                    'seo_title' => $request->seo_title,
                    'seo_description' => $request->seo_description,
                    'seo_keywords' => $request->seo_keywords,
                    'status' => 0,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'slug' => \Str::slug($request->page_name)

                ];
                $UserEmail = SeoPage::where('slug', $array['slug'])->exists();
                if ($UserEmail) {
                    return redirect()->back()->withErrors(['Page and page slug already exist.'])->withInput($request->all());
                }
                // dd(  $array );
                $response = SeoPage::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/seo/list')->with('success', 'Page details added successfully.');
            }

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            return view('admin.pages.seo.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                $validator = Validator::make($request->all(), [
                    'page_name' => 'required',
                    'seo_title' => 'required',
                    'seo_description' => 'required',
                    // 'seo_keywords' => 'required',
                ], [
                    'page_name.required' => 'Page name is required.',
                    'seo_title.required' => 'Reference  title is required.',
                    'seo_description.required' => 'Reference  description is required.',
                    'seo_keywords.required' => 'Reference  keywords is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();


                $array = [
                    'page_name' => $request->page_name,
                    'seo_title' => $request->seo_title,
                    'seo_description' => $request->seo_description,
                    'seo_keywords' => $request->seo_keywords,
                    'status' => 0,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'slug' => \Str::slug($request->page_name)

                ];
                $UserEmail = SeoPage::where('slug', $array['slug'])->where('id', '!=', $id)->exists();
                if ($UserEmail) {
                    return redirect()->back()->withErrors(['Page and page slug already exist.'])->withInput($request->all());
                }
                // dd(  $array );
                $response = SeoPage::UpdateOrCreate(['id' => $id], $array);
                DB::commit();
                return redirect('admin/seo/list')->with('success', 'Page details updated successfully.');
            }

            $details = SeoPage::where('id',   $id)->first();
            if ($details) {
                $pageSettings = $this->pageSetting('edit');

                $page_title =  $pageSettings['page_title'];
                $page_description = $pageSettings['page_description'];
                $breadcrumbs = $pageSettings['breadcrumbs'];

                return view('admin.pages.seo.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
            } else {
                return redirect()->back()->withErrors(['Page details not exist.']);
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
                $cat = SeoPage::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Page deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Page details not found.');
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
                $response = SeoPage::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/seo/list')->with('success', 'Page status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Page details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Page Master';
            $data['page_description'] = 'Edit Page';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Page Master',
                    'url' => url('admin/seo/list'),
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
            $data['page_title'] = 'Page Master';
            $data['page_description'] = 'Add New Page';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Page Master',
                    'url' => url('admin/seo/list'),
                ],
                [
                    'title' => 'Add a New Page',
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
            return Excel::download(new SeoExport, 'SeoPages.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
