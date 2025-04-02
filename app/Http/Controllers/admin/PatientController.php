<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Customer;
use App\Models\State;
use App\Models\City;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\PatientExport;
use Maatwebsite\Excel\Facades\Excel;

class PatientController extends Controller
{

    public function index($customerId = null)
    {

        try {
            $page_title = 'Patients';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Patients',
                    'url' => '',
                ]
            ];


            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $patients = Patient::with(['customer'])->when($status, function ($patients) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $patients->where('status', '=', $status);
                }
            })->when($customerId, function ($patients) use ($customerId) {
                if ($customerId != '-1') {
                    $patients->where('customer_id', '=', $customerId);
                }
            })->orderBy('id', 'desc')->get();
            // dd($patients);
            return view('admin.pages.patients.list', compact('page_title', 'page_description', 'breadcrumbs',  'patients',  'customerId'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function add(Request $request, $customerId = null)
    {
        try {
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'customer_id' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'mobile_no' => 'required',
                    'email_id' => 'required',
                    'dob' => 'required',
                    'gender' => 'required',
                    'relation' => 'required',
                ], [
                    'customer_id.required' => 'Select customer.',
                    'first_name.required' => 'First name is required.',
                    'last_name.required' => 'Last name is required.',
                    'mobile_no.required' => 'Mobile no is required.',
                    'email_id.required' => 'Email id is required.',
                    'dob.required' => 'DOB is required.',
                    'gender.required' => 'Gender is required.',
                    'relation.required' => 'Select booking for.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();


                $array = [
                    'customer_id' => $request->customer_id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'mobile_no' => $request->mobile_no,
                    'email_id' => $request->email_id,
                    'dob' => $request->dob,
                    'gender' => $request->gender,
                    'relation' => $request->relation,
                    'status' => 1,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,

                ];
                $UserMobile = Patient::where('mobile_no', $array['mobile_no'])->exists();
                if ($UserMobile) {
                    return redirect()->back()->withErrors(['Patient mobile already exist.'])->withInput($request->all());
                }
                // dd(  $array );
                $response = Patient::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/patients/list/' . $customerId)->with('success', 'Patient details added successfully.');
            }

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            if (Customer::where('id', $customerId)->first()) {
                $customers = [];
            } else {
                $customers = Customer::where('status', 1)->get();
            }
            //dd($customers);
            return view('admin.pages.patients.add', compact('page_title', 'page_description', 'breadcrumbs', 'customerId', 'customers'));
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
                    'customer_id' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'mobile_no' => 'required',
                    'email_id' => 'required',
                    'dob' => 'required',
                    'gender' => 'required',
                    'relation' => 'required',
                ], [
                    'customer_id.required' => 'Select customer.',
                    'first_name.required' => 'First name is required.',
                    'last_name.required' => 'Last name is required.',
                    'mobile_no.required' => 'Mobile no is required.',
                    'email_id.required' => 'Email id is required.',
                    'dob.required' => 'DOB is required.',
                    'gender.required' => 'Gender is required.',
                    'relation.required' => 'Select booking for.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();


                $array = [
                    'customer_id' => $request->customer_id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'mobile_no' => $request->mobile_no,
                    'email_id' => $request->email_id,
                    'dob' => $request->dob,
                    'gender' => $request->gender,
                    'relation' => $request->relation,
                    'status' => 1,
                    'updated_by' => auth()->user()->id,

                ];
                $UserEmail = Patient::where('mobile_no', $array['mobile_no'])->where('id', '<>', $id)->exists();
                 
                if ($UserEmail) {
                    return redirect()->back()->withErrors(['Patient mobile already exist.'])->withInput($request->all());
                }

                // dd(  $array );
                $response = Patient::UpdateOrCreate(['id' => $id], $array);
                DB::commit();
                return redirect('admin/patients/list')->with('success', 'Patient details updated successfully.');
            }

            $details = Patient::where('id',   $id)->first();
            if ($details) {
                if ($details->customer_id) {
                    $customerId = $details->customer_id;
                    $customers = [];
                } else {
                    $customers = Customer::where('status', 1)->get();
                    $customerId = false;
                }
                $pageSettings = $this->pageSetting('edit');

                $page_title =  $pageSettings['page_title'];
                $page_description = $pageSettings['page_description'];
                $breadcrumbs = $pageSettings['breadcrumbs']; 


                return view('admin.pages.patients.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details', 'customerId', 'customers'));
            } else {
                return redirect('admin/patients/list')->withErrors(['Patient details not exist.']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect('admin/patients/list')->withErrors($e->getMessage());
        }
    }



    public function delete($id)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $cat = Patient::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Patient deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Patient details not found.');
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
                $response = Patient::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect()->back()->with('success', 'Patient status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Patient details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Patients List';
            $data['page_description'] = 'Edit Patient';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Patients',
                    'url' => url('admin/patients/list'),
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
            $data['page_title'] = 'Patients List';
            $data['page_description'] = 'Add New Patient';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Patients',
                    'url' => url('admin/patients/list'),
                ],
                [
                    'title' => 'Add a New Patient',
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
            return Excel::download(new PatientExport, 'Patients.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
