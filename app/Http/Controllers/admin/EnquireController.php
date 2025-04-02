<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Query;
use App\Models\City;
use App\Models\Centre;
use App\Models\Customer;
use App\Models\Patient;
use App\Models\Address;
use App\Models\Order;
use DB;
use Validator;
use Image;
use File;

use App\Exports\Excel\EnquireExport;
use Maatwebsite\Excel\Facades\Excel;

class EnquireController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Enquiry';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Enquiry',
                    'url' => '',
                ]
            ];
            $status = request('status');
            $fromDate = request('from_date');
            $fromTo = request('to_date');

            $queries = Query::with(['city'])
                ->when($status, function ($queries) use ($status) {
                    if ($status == '-1') {
                        $status = '0';
                    }
                    $queries->where('is_lead_converted', '=', $status);
                })
                ->where('type', '2')
                ->when($fromDate, function ($queries) use ($fromDate) {
                    $fromDate = request('from_date');
                    $fromTo = request('to_date');
                    if ($fromDate && $fromTo) {
                        $queries->whereBetween('created_at', [$fromDate, $fromTo]);
                    }
                }) 
                ->orderBy('id', 'desc')->get();
            // echo '<pre>'; print_r($queries); die;
            // dd($queries);
            return view('admin.pages.enquiry.list', compact('page_title', 'page_description', 'breadcrumbs',  'queries'));
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
                $cat = Query::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Enquiry deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Enquiry details not found.');
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
                // $status = ($status == 1) ? $status = 0 : $status = 1;
                // if($status == 2){

                // }elseif($status == 1){

                // }else{

                // }
                $updateArr = [
                    'is_lead_converted' => $status,
                ];
                $response = Query::UpdateOrCreate(['id' => $id], $updateArr);
                if ($status == 2) {
                    /**
                     * Convert Lead into Order
                     */
                    $enquiry = Query::where('id', $id)->first();

                    $this->convertLead($enquiry);
                }
                DB::commit();
                return redirect('admin/enquires/list')->with('success', 'Enquiry status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Enquiry details not found.');
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'customer_name' => 'required',
                    'customer_mobile' => 'required',
                    'customer_email' => 'required',
                    'city_id' => 'required',
                    'centre_id' => 'required',
                ], [
                    'customer_name.required' => 'Name is required.',
                    'customer_mobile.required' => 'Mobile no is required.',
                    'customer_email.required' => 'Email id is required.',
                    'city_id.required' => 'City is required.',
                    'centre_id.required' => 'Centre is required.',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();


                $array = [
                    'customer_name' => $request->customer_name,
                    'customer_mobile' => $request->customer_mobile,
                    'customer_email' => $request->customer_email,
                    'city_id' => $request->city_id,
                    'centre_id' => $request->centre_id,
                    'is_lead_converted' => $request->is_lead_converted,
                    'address' => $request->address,
                    'message' => $request->message,
                    'last_follow_up_comment' => $request->last_follow_up_comment,
                    'next_follow_up_date' => $request->next_follow_up_date,
                    'last_follow_up_date' => date('Y-m-d'),
                    'updated_by' => auth()->user()->id,

                ];
                $attachmentPath = [];
                if ($request->has('prescriptions')) {

                    $i = 0;
                    foreach ($request->file('prescriptions') as $fKey => $fVal) {
                        $uploadedFile = $request->file('prescriptions')[$fKey];
                        $fileName =    'prescription_' . $fKey . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();
                        $path = '/uploads/bookings/prescriptions/';
                        $destinationPath = public_path('.' . $path);

                        $isValid = $uploadedFile->isValid();
                        if ($isValid) {
                            $uploadedFile->move($destinationPath, $fileName);
                            $attachmentPath[] =  $fileName;
                        }
                    }
                    $details = Query::where('id',   $id)->first();
                    if (isset($details->prescriptions) && !empty($details->prescriptions) && $oldPrescriptions = json_decode($details->prescriptions)) {
                        if (count($oldPrescriptions) > 0) {
                            $array['prescriptions'] = array_merge($oldPrescriptions, $attachmentPath);
                        } else {
                            $array['prescriptions'] = $attachmentPath;
                        }
                    } else {
                        $array['prescriptions'] = $attachmentPath;
                    }
                }
                /**
                 * Generate enquire history
                 */
                $hArray = [
                    'created_by' =>  auth()->user()->id,
                    'query_id' =>  $id,
                    'comment' => $request->last_follow_up_comment,
                    'status' => $request->is_lead_converted,
                    'next_followup_date' => $request->next_follow_up_date
                ];
                $response = Query::UpdateOrCreate(['id' => $id], $array);
                GenerateEnquireHistory($hArray);
                DB::commit();
                if ($request->is_lead_converted == 2) {
                    DB::beginTransaction();
                    /**
                     * Convert Lead into Order
                     */
                    $enquiry = Query::where('id', $id)->first();
                    $this->convertLead($enquiry);
                    DB::commit();
                }

                return redirect('admin/enquires/list')->with('success', 'Details updated successfully.');
            }

            $details = Query::with(['enquire_history'])->where('id',   $id)->first();
            // dd(  $details );
            if ($details) {
                $pageSettings = $this->pageSetting('edit', ['title' => 'Edit Enquiry']);

                $page_title =  $pageSettings['page_title'];
                $page_description = $pageSettings['page_description'];
                $breadcrumbs = $pageSettings['breadcrumbs'];
                $cities = City::where('status', 1)->get();
                $centres = Centre::where('status', 1)->get();


                return view('admin.pages.enquiry.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details', 'cities', 'centres'));
            } else {
                return redirect()->back()->withErrors(['details not exist.']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Enquiry List';
            $data['page_description'] = 'Edit Enquiry';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Enquiry',
                    'url' => url('admin/enquires/list'),
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

        // if ($action == 'add') {
        //     $data['page_title'] = 'Customers List';
        //     $data['page_description'] = 'Add New Customer';
        //     $data['breadcrumbs'] = [
        //         [
        //             'title' => 'Customers',
        //             'url' => url('admin/customers/list'),
        //         ],
        //         [
        //             'title' => 'Add a New Customer',
        //             'url' => '',
        //         ],
        //     ];
        //     return $data;
        // }
    }
    function convertLead($enquiry)
    {
        $stateId = getStateIdByCityId($enquiry->city_id);
        $customerName = explode(' ', $enquiry->customer_name);
        $customerDetails = Customer::where('mobile_no', $enquiry->customer_mobile)->first();
        if (!$customerDetails) {
            /**
             * Add Customer
             */

            $customerArr = [
                'mobile_no' => $enquiry->customer_mobile,
                'email_id' => $enquiry->customer_email,
                'first_name' => $customerName[0],
                'last_name' => (isset($customerName[1])) ? $customerName[1] : null,
                'dob' => $enquiry->dob ? date('Y-m-d', strtotime($enquiry->dob)) : null,
                'gender' => strtolower($enquiry->gender),
                'city_id' => $enquiry->city_id,
                'state_id' => $stateId,
                'created_by' => auth()->user()->id,
            ];
            $customerDetails = Customer::UpdateOrCreate(['id' => null], $customerArr);
        }
        /**
         * Add Patient
         */
        $patientArray = [
            'customer_id' => $customerDetails->id,
            'first_name' => $customerName[0],
            'last_name' => (isset($customerName[1])) ? $customerName[1] : null,
            'mobile_no' => $enquiry->customer_mobile,
            'gender' => $enquiry->gender ? strtolower($enquiry->gender) : 'other',
            'dob' => $enquiry->dob ? date('Y-m-d', strtotime($enquiry->dob)) : null,
            'relation' => 1,
            'email_id' => $enquiry->customer_email,
        ];

        $patientDetails = Patient::where('id', $patientArray['mobile_no'])->first();
        if ($patientDetails) {
            $patientDetails = Patient::UpdateOrCreate(['id' => $patientDetails->id], $patientArray);
        } else {
            $patientDetails = Patient::UpdateOrCreate(['id' => null], $patientArray);
        }
        /**
         * Add Address
         */
        $addressArray = [
            'customer_id' => $customerDetails->id,
            'flat_no' => $enquiry->address,
            'house_no' => null,
            'locality_name' => null,
            'pincode' => null,
            'locality_id' => null,
            'city_id' => $enquiry->city_id,
            'state_id' =>  $stateId,
            'address_tag' => null,
            'landmark' => null,
            'sector' => null,
            'relation' => 1,
        ];
        $addressDetails = Address::UpdateOrCreate(['id' => null], $addressArray);
        $array = [
            'booking_type' => 1,
            'order_type' => 2,
            'schedule_date' => null,
            'schedule_time' => null,
            'centre_id' => $enquiry->centre_id,
            'customer_id' => $customerDetails->id,
            'patient_id' => $patientDetails->id,
            'patient_firstname' => $customerName[0],
            'patient_lastname' => (isset($customerName[1])) ? $customerName[1] : null,
            'patient_number' => $enquiry->customer_mobile,
            'patient_dob' => $enquiry->dob ? date('Y-m-d', strtotime($enquiry->dob)) : null,
            'patient_email' => $enquiry->customer_email,
            'patient_relation' => 1,
            'patient_age' => getAge($enquiry->dob),
            'gender' =>  strtolower($enquiry->gender),
            'address' =>  $enquiry->address,
            'address_id' => $addressDetails->id,
            'city_id' => $enquiry->city_id,
            'actual_order_details' => json_encode([]),
            'updated_order_details' => json_encode([]),
            'hc_charges' => 0,
            'order_items_total' => 0,
            'order_discount' => 0,
            'order_total' => 0,
            'advance_paid' => 0,
            'prescription_status' => 1,
            'prescription_comments' => '',
            'payment_type' => 'cod',
            'order_status ' => 1,
            'prescription' => $enquiry->prescriptions,
            'last_follow_up_date' => $enquiry->last_follow_up_date,
            'last_follow_up_comment' => $enquiry->last_follow_up_comment,
            'next_follow_up_date' => $enquiry->next_follow_up_date,
        ];

        $orderDetails = Order::UpdateOrCreate(['id' => null], $array);
        /**
         * Generate history
         */
        generateHistory(['order_id' => $orderDetails->id, 'order_status' => 1, 'comments' => 'Lead converted', 'updated_fields' => json_encode([]), 'updated_by' => auth()->user()->id]);
        return $orderDetails;
    }


    function exportExcel()
    {
        $type = request('type');
        if ($type == 'excel')
            return Excel::download(new EnquireExport, 'LeadEnquires.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
