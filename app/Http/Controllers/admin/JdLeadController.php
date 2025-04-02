<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\LeadCapture;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\JDExport;
use Maatwebsite\Excel\Facades\Excel;



class JdLeadController extends Controller
{

    function exportExcel()
    {
        $type = request('type');
        if ($type == 'excel')
            return Excel::download(new JDExport, 'just-dial.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
    public function index()
    {
        try {
            $page_title = 'JD Lead';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'JD Lead',
                    'url' => '',
                ]
            ];
            $fromDate = request('from_date');
            $fromTo = request('to_date');
            $city = request('city');
            //$lists = LeadCapture::orderBy('id', 'desc')->get();
            $lists = LeadCapture::with(['orderStatus'])
                ->when($fromDate, function ($queries) use ($fromDate) {
                    $fromDate = request('from_date');
                    $fromTo = request('to_date');
                    if ($fromDate && $fromTo) {
                        $queries->whereBetween('created_at', [$fromDate, $fromTo]);
                    }
                })->when($city, function ($queries) use ($city) {
                    if ($city) {
                        $queries->where('lead_data', 'like', '%' . $city . '%');
                    }
                })->orderBy('id', 'desc')->paginate(100);
            return view('admin.pages.jdlead.list', compact('page_title', 'page_description', 'breadcrumbs', 'lists'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function edit(Request $request, $id)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'status' => 'required',
                ], [
                    'status.required' => 'Status is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'status' => $request->status,
                    'comment' => $request->comment,
                ];

                //dd($array );
                $response = LeadCapture::UpdateOrCreate(['id' => $id], $array);
                //dd($response);
                DB::commit();
                return redirect('admin/jd-lead/list')->with('success', 'JD Lead details updated successfully.');
            }

            $details = LeadCapture::where('id',   $id)->first();
            if ($details) {
                $page_title = 'JD Lead';
                $page_description = 'Edit JD Lead';
                $breadcrumbs = [
                    [
                        'title' => 'JD Lead',
                        'url' => '',
                    ],
                    [
                        'title' => 'Edit JD Lead',
                        'url' => '',
                    ],
                ];

                return view('admin.pages.jdlead.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
            } else {
                return redirect()->back()->withErrors(['JD Lead details not exist.']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
