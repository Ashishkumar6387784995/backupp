<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\Faq;
use DB;
use Validator;
use Image;
use File;

class FaqCategoryController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Faq Categories';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Faq Categories',
                    'url' => '',
                ]
            ];


            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $faqs = FaqCategory::when($status, function ($faqs) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $faqs->where('status', '=', $status);
                }
            })->orderBy('id', 'desc')->get();
            return view('admin.pages.faqcategories.list', compact('page_title', 'page_description', 'breadcrumbs',  'faqs'));
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
                    'category' => 'required',
                ], [
                    'category.required' => 'Category is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'category' => $request->category,

                ];
                if (FaqCategory::where('category', $array['category'])->first()) {

                    return redirect()->back()->withErrors(['Faq Category already exist.'])->withInput($request->all());;
                }
                $response = FaqCategory::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/faqcategories/list')->with('success', 'Category details added successfully.');
            }



            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            return view('admin.pages.faqcategories.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                    'category' => 'required',
                ], [
                    'category.required' => 'Category is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'category' => $request->category,

                ];
                if (FaqCategory::where('category', $array['category'])->where('id', '<>', $id)->first()) {
                    return redirect()->back()->withErrors(['Faq Category already exist.'])->withInput($request->all());;
                }
                $response = FaqCategory::UpdateOrCreate(['id' => $id], $array);
                DB::commit();
                return redirect('admin/faqcategories/list')->with('success', 'Category details updated successfully.');
            }



            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            $details = FaqCategory::where('id', $id)->first();
            return view('admin.pages.faqcategories.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
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
                $cat = FaqCategory::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Category  deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Category details not found.');
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
                $response = FaqCategory::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/faqcategories/list')->with('success', 'Faq status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Faq details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Faq Category';
            $data['page_description'] = 'Add New Faq';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Faq Category',
                    'url' => url('admin/faqcategories/list'),
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
            $data['page_title'] = 'Faq Category';
            $data['page_description'] = 'Add New Faq Category';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Faq Category',
                    'url' => url('admin/faqcategories/list'),
                ],
                [
                    'title' => 'Add a New Faq Category',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
}
