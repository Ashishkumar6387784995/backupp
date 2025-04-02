<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Patient;
use App\Models\Centre;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index()
    {
        try { 
            $page_title = 'Orders';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Orders',
                    'url' => '',
                ]
            ];
            $status = request('status');
            $fromDate = request('fromtodate');
            $cityId = request('city_id');
            if ($status == '0') {
                $status = '2';
            }
            $orders = Order::with(['city', 'orderStatus'])
                ->when($status, function ($orders) use ($status) {
                    if ($status != '-1') {
                        // $status = conditionalStatus($status);
                        $orders->where('order_status', '=', $status);
                    }
                })
                ->when($cityId, function ($orders) use ($cityId) {
                    if ($cityId) {
                        $orders->where('city_id', '=', $cityId);
                    }
                })
                ->when($fromDate, function ($customers) use ($fromDate) {
                    if ($fromDate) {
                        $dateArr = explode(' - ', $fromDate);
                        $From = date('Y-m-d 00:00:00', strtotime($dateArr[0]));
                        $To = date('Y-m-d 23:59:59', strtotime($dateArr[1]));
                        $customers->whereBetween('created_at', [$From, $To]);
                    }
                })
                ->orderBy('id', 'desc')->get();
            // $departments = Department::where('status', 1)->orderBy('id', 'desc')->get();
            //  dd($orders);
            return view('admin.pages.orders.list', compact('page_title', 'page_description', 'breadcrumbs',  'orders'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    // public function add(Request $request)
    // {
    //     try {
    //         if ($request->isMethod('post')) {
    //             // dd($request->all());
    //             $validator = Validator::make($request->all(), [
    //                 'doctor_code' => 'required',
    //                 'name' => 'required',
    //                 'email' => 'required',
    //                 'mobile' => 'required',
    //                 'dob' => 'required',
    //                 'gender' => 'required',
    //                 'department_id' => 'required',
    //             ], [
    //                 'doctor_code.required' => 'Order code is required.',
    //                 'name.required' => 'Order name is required.',
    //                 'email.required' => 'Order email is required.',
    //                 'mobile.required' => 'Order mobile is required.',
    //                 'dob.required' => 'Order DOB is required.',
    //                 'gender.required' => 'Select gender.',
    //                 'department_id.required' => 'Select doctor department.',
    //             ]);
    //             if ($validator->fails()) {
    //                 return redirect()->back()->withErrors($validator)->withInput($request->all());
    //             }

    //             DB::beginTransaction();






    //             $array = [
    //                 'doctor_code' => $request->doctor_code,
    //                 'name' => $request->name,
    //                 'email' => $request->email,
    //                 'mobile' => $request->mobile,
    //                 'dob' => $request->dob,
    //                 'gender' => $request->gender,
    //                 'department_id' => $request->department_id,
    //                 'qualification' => $request->qualification,
    //                 'area_of_interest' => $request->area_of_interest,
    //                 'expertise' => $request->expertise,
    //                 'details' => $request->details,

    //             ];
    //             if (isset($request->awards) && count($request->awards) > 0) {
    //                 $awards = [];
    //                 foreach ($request->awards as $sKey => $sList) {
    //                     if ($sList) {
    //                         $awards[] = [
    //                             'title' => $sList,
    //                         ];
    //                     }
    //                 }
    //                 if (count($awards) > 0)
    //                     $array['awards'] = json_encode($awards);
    //             }
    //             if (isset($request['profile_image']) && !empty($request['profile_image'])) {
    //                 // foreach ($request->images as $sKey => $sList) {
    //                 // if ($sList) {
    //                 $sKey = rand(111, 999);
    //                 $icon = null;
    //                 if ($request->hasFile('profile_image')) {
    //                     $pathString = 'uploads/orders/profiles/';
    //                     $image = $request->file('profile_image');
    //                     $iconImageName = 'document' . $sKey . '-' . time() . '.' . $image->getClientOriginalExtension();
    //                     $image_resize = Image::make($image->getRealPath());

    //                     $height = Image::make($image)->height();
    //                     $width = Image::make($image)->width();
    //                     $path = public_path($pathString);

    //                     if (!File::isDirectory($path)) {
    //                         File::makeDirectory($path, 0777, true, true);
    //                     }
    //                     if ($width > $height) {
    //                         $image_resize->resize(692, null, function ($constraint) use ($image_resize) {
    //                             $constraint->aspectRatio();
    //                         })->save(public_path($pathString . $iconImageName));
    //                     } else {
    //                         $image_resize->resize(null, 274, function ($constraint) use ($image_resize) {
    //                             $constraint->aspectRatio();
    //                         })->save(public_path($pathString . $iconImageName));
    //                     }
    //                     $icon = $iconImageName;
    //                 }
    //                 $image = $icon;

    //                 // }
    //                 // }
    //                 if ($image) {
    //                     $array['profile_image'] =  $image;
    //                 }
    //             }
    //             $main_video = [];
    //             if ($request->has('main_video')) {
    //                 // foreach ($request->videos as $vkey => $vvalue) {
    //                 $i = 0;
    //                 $uploadedFile = $request->file('main_video');
    //                 $fileName =   \Str::slug($request['main_video']) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

    //                 $destinationPath = public_path('./uploads/orders/videos/');
    //                 $isValid = $uploadedFile->isValid();
    //                 if ($isValid) {
    //                     $uploadedFile->move($destinationPath, $fileName);

    //                     $main_video =  $fileName;
    //                 }
    //                 // }
    //                 ($main_video) ? $array['main_video'] =  $main_video : null;
    //             }
    //             $videos = [];
    //             if ($request->has('left_video')) {
    //                 foreach ($request->left_video as $vkey => $vvalue) {
    //                     $i = 0;
    //                     $uploadedFile = $request->file('left_video')[$vkey];
    //                     //dd($uploadedFile);
    //                     $fileName =   \Str::slug($request['left_video'][$vkey]) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

    //                     $destinationPath = public_path('./uploads/orders/videos/');
    //                     $isValid = $uploadedFile->isValid();
    //                     if ($isValid) {
    //                         $uploadedFile->move($destinationPath, $fileName);

    //                         $videos[] = [
    //                             'video' => $fileName,
    //                         ];
    //                     }
    //                 }
    //                 (count($videos) > 0) ? $array['other_videos'] =  json_encode($videos) : null;
    //             }
    //             // dd($array);
    //             $doctorMobileExist = Order::where('mobile', $array['mobile'])->exists();
    //             if ($doctorMobileExist) {
    //                 return redirect()->back()->withErrors(['Order mobile already exist.'])->withInput($request->all());
    //             }
    //             $doctorCodeExist = Order::where('doctor_code', $array['doctor_code'])->exists();
    //             if ($doctorCodeExist) {
    //                 return redirect()->back()->withErrors(['Order code already exist.'])->withInput($request->all());
    //             }
    //             $response = Order::UpdateOrCreate(['id' => null], $array);
    //             DB::commit();
    //             return redirect('admin/orders/list')->with('success', 'Order details added successfully.');
    //         }

    //         $pageSettings = $this->pageSetting('add');

    //         $page_title =  $pageSettings['page_title'];
    //         $page_description = $pageSettings['page_description'];
    //         $breadcrumbs = $pageSettings['breadcrumbs'];

    //         $departments = Department::where('status', 1)->orderBy('id', 'desc')->get();
    //         return view('admin.pages.orders.add', compact('page_title', 'page_description', 'breadcrumbs', 'departments'));
    //     } catch (\Exception $e) {
    //         dd($e);
    //         DB::rollback();
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }
    public function edit(Request $request, $id)
    {
        try {
            if ($request->isMethod('post')) {

                DB::beginTransaction();
                $array = [
                    'schedule_date' => $request->schedule_date,
                    'schedule_time' => $request->schedule_time,
                    'next_follow_up_date' => $request->next_follow_up_date,
                    'last_follow_up_date' => date('Y-m-d H:i:s'),
                    'last_follow_up_comment' => $request->last_follow_up_comment,
                    'order_status' => $request->order_status,
                ];

                if (!$request->last_follow_up_comment) {
                    unset($array['last_follow_up_comment']);
                }
                $response = Order::UpdateOrCreate(['id' => $id], $array);
                /**
                 * Generate history
                 */
                generateHistory(['order_id' => $id, 'order_status' => $request->order_status, 'comments' => 'Order details updated', 'updated_fields' => json_encode($array), 'updated_by' => auth()->user()->id]);
                DB::commit();
                return redirect('admin/orders/list')->with('success', 'Order details updated successfully.');
            }

            $pageSettings = $this->pageSetting('edit');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            $details = Order::with(['customer', 'patient', 'city', 'orderStatus', 'orderHistory', 'customerAddress', 'centre'])->where('id', $id)->first();
            if ($details) {
                $states = State::all();
                $centres = Centre::where('status', 1)->where('city_id', $details->city_id)->get();
                return view('admin.pages.orders.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details', 'states', 'centres'));
            } else {

                DB::rollback();
                return redirect('admin/orders/list')->withErrors(['Booking details not found.']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function updateCustomer(Request $request, $id)
    {
        try {
            if ($id) {
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        // 'address_id' => 'required',
                        'customer_id' => 'required',
                    ], [
                        'address_id.required' => 'Address Id is missing.',
                        'customer_id.required' => 'Customer id is required.',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }
                    DB::beginTransaction();
                    // $address_id = $request->address_id;
                    $customer_id = $request->customer_id;
                    $arrayCustomer = [
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                    ];
                    $arrayOrder = [
                        'address' => $request->flat_no,
                        'locality' => $request->locality_name,
                        'pincode' => $request->pincode,
                        'state_id' => $request->state_id,
                        'city_id' => $request->city_id,
                        'address_tag' => $request->address_tag,
                    ];

                    $response = Customer::UpdateOrCreate(['id' => $customer_id], $arrayCustomer);
                    $response = Order::UpdateOrCreate(['id' => $id], $arrayOrder);
                    /**
                     * Generate history
                     */
                    generateHistory(['order_id' => $id, 'order_status' => $request->order_status, 'comments' => 'Customer & address details updated', 'updated_fields' => json_encode(array_merge($arrayCustomer, $arrayOrder)), 'updated_by' => auth()->user()->id]);
                    DB::commit();
                    return redirect('admin/orders/list')->with('success', 'Customer address updated successfully.');
                } else {

                    return redirect()->back()->withErrors(['Order details not found']);
                }
            } else {

                return redirect()->back()->withErrors(['Order details not found']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function updatePatient(Request $request, $id)
    {
        try {
            if ($id) {
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        // 'patient_id' => 'required',
                        'customer_id' => 'required',
                    ], [
                        'patient_id.required' => 'Patient Id is missing.',
                        'customer_id.required' => 'Customer id is required.',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }
                    // dd($request->all());
                    DB::beginTransaction();
                    // $patient_id = $request->patient_id;
                    $customer_id = $request->customer_id;

                    $arrayOrder = [
                        'patient_number' => $request->mobile_no,
                        'patient_firstname' => $request->patient_firstname,
                        'patient_lastname' =>   $request->patient_lastname,

                        'gender' => $request->gender,
                        'patient_dob' => $request->dob,
                        'patient_age' => getAge($request->dob),
                        'patient_email' => $request->email_id,
                        'patient_relation' => $request->relation,
                    ];
                    // $response = Patient::UpdateOrCreate(['id' => $patient_id], $arrayCustomerPatient);
                    $response = Order::UpdateOrCreate(['id' => $id], $arrayOrder);
                    /**
                     * Generate history
                     */
                    generateHistory(['order_id' => $id, 'order_status' => $request->order_status, 'comments' => 'Patient details updated', 'updated_fields' => json_encode($arrayOrder), 'updated_by' => auth()->user()->id]);
                    DB::commit();
                    return redirect('admin/orders/list')->with('success', 'Patient details updated successfully.');
                } else {

                    return redirect()->back()->withErrors(['Order details not found']);
                }
            } else {

                return redirect()->back()->withErrors(['Order details not found']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function centreAllocation(Request $request, $id)
    {
        try {
            if ($id) {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $arrayOrder = [
                        'centre_id' => $request->centre_id,
                        'order_status' => 3,
                    ];
                    $response = Order::UpdateOrCreate(['id' => $id], $arrayOrder);
                    /**
                     * Generate history
                     */
                    generateHistory(['order_id' => $id, 'order_status' => 3, 'comments' => 'Centre Allocation successfully.', 'updated_fields' => json_encode($arrayOrder), 'updated_by' => auth()->user()->id]);
                    DB::commit();
                    return redirect('admin/orders/list')->with('success', 'Centre allocation updated successfully.');
                } else {
                    return redirect()->back()->withErrors(['Order details not found']);
                }
            } else {
                return redirect()->back()->withErrors(['Order details not found']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    // public function delete($id)
    // {
    //     try {
    //         if ($id) {
    //             DB::beginTransaction();
    //             $cat = Order::find($id);
    //             if ($cat->delete()) {
    //                 DB::commit();
    //                 return redirect()->back()->with('success', 'Order deleted successfully.');
    //             } else {
    //                 return redirect()->back()->with('error', 'Failed to delete try again.');
    //             }
    //         } else {
    //             return redirect()->back()->with('error', 'Order details not found.');
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }


    public function updateStatus($id, $status)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $status = ($status == 1) ? $status = 0 : $status = 1;
                $updateArr = [
                    'status' => $status,
                ];
                $response = Order::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/orders/list')->with('success', 'Order status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Order details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Orders';
            $data['page_description'] = 'Edit Orders';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Orders',
                    'url' => url('admin/orders/list'),
                ],
                [
                    'title' => 'Edit Order',
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
            $data['page_title'] = 'Orders';
            $data['page_description'] = 'Add a Order';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Orders',
                    'url' => url('admin/centres/list'),
                ],
                [
                    'title' => 'Add a Order',
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
            return Excel::download(new OrdersExport, 'Orders.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
