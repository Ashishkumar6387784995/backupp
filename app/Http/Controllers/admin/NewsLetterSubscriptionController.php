<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsLetterSubscription;
use DB;
use Validator;
use App\Exports\Excel\NewsLetterSubscriptionExport;
use Maatwebsite\Excel\Facades\Excel;

class NewsLetterSubscriptionController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'News Letter Subscription Master';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'News Letter Subscription Master',
                    'url' => '',
                ]
            ];


            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $lists = NewsLetterSubscription::when($status, function ($lists) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $lists->where('status', '=', $status);
                }
            })->orderBy('id', 'desc')->get();
            return view('admin.pages.newslettersubscription.list', compact('page_title', 'page_description', 'breadcrumbs',  'lists'));
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
                    'faq_category_id' => 'required',
                    'title' => 'required',
                    'description' => 'required',
                ], [
                    'faq_category_id.required' => 'Select category.',
                    'title.required' => 'Enter faq title.',
                    'description.required' => 'Enter faq description.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'faq_category_id' => $request->faq_category_id,
                    'title' => $request->title,
                    'description' => $request->description,

                ];

                $response = NewsLetterSubscription::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/newslettersubscription/list')->with('success', 'faqs details added successfully.');
            }



            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            $faqCategories = FaqCategory::where('status', 1)->get();
            return view('admin.pages.newslettersubscription.add', compact('page_title', 'page_description', 'breadcrumbs', 'faqCategories'));
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
                        'faq_category_id' => 'required',
                        'title' => 'required',
                        'description' => 'required',
                    ], [
                        'faq_category_id.required' => 'Select category.',
                        'title.required' => 'Enter faq title.',
                        'description.required' => 'Enter faq description.'
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();

                    $array = [
                        'faq_category_id' => $request->faq_category_id,
                        'title' => $request->title,
                        'description' => $request->description,

                    ];

                    $response = NewsLetterSubscription::UpdateOrCreate(['id' => $id], $array);
                    DB::commit();
                    return redirect('admin/newslettersubscription/list')->with('success', 'News Letter Subscription details added successfully.');
                }


                $details = NewsLetterSubscription::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit');

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];
                    $faqCategories = FaqCategory::where('status', 1)->get();

                    return view('admin.pages.newslettersubscription.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details', 'faqCategories'));
                } else {
                    return redirect()->back()->withErrors(['News Letter Subscription details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['News Letter Subscription details id is missing.']);
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
                $cat = NewsLetterSubscription::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'News Letter Subscription  deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'News Letter Subscription details not found.');
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
                $response = NewsLetterSubscription::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/newslettersubscription/list')->with('success', 'News Letter Subscription status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'News Letter Subscription details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'News Letter Subscription Master';
            $data['page_description'] = 'Add NewSubscription';
            $data['breadcrumbs'] = [
                [
                    'title' => 'News Letter Subscription Master',
                    'url' => url('admin/newslettersubscription/list'),
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
            $data['page_title'] = 'News Letter Subscription Master';
            $data['page_description'] = 'Add NewSubscription';
            $data['breadcrumbs'] = [
                [
                    'title' => 'News Letter Subscription Master',
                    'url' => url('admin/newslettersubscription/list'),
                ],
                [
                    'title' => 'Add a NewSubscription',
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
            return Excel::download(new NewsLetterSubscriptionExport, 'NewsLetterSubscriptions.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
