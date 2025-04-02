<?php

namespace App\Exports\Excel;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $fromDate = request('fromtodate');
        $cityId = request('city_id');

        $status = request('status');
        if ($status == '0') {
            $status = '2';
        }
        $data = Customer::with(['city'])->when($status, function ($customers) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $customers->where('status', '=', $status);
            }
        })->when($cityId, function ($customers) use ($cityId) { 
            $customers->where('city_id', '=', $cityId);
        })->when($fromDate, function ($customers) use ($fromDate) {
            if ($fromDate) {
                $dateArr = explode(' - ', $fromDate);
                $From = date('Y-m-d 00:00:00', strtotime($dateArr[0]));
                $To = date('Y-m-d 23:59:59', strtotime($dateArr[1]));
                $customers->whereBetween('created_at', [$From, $To]);
            }
        })->get();
        $exportData[] = [
            'mobile_no' => 'Mobile',
            'email_id' => 'Email',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'dob' => 'DOB',
            'gender' => 'Gender',
            'locality' => 'Locality',
            'pincode' => 'Pincode',
            'city' => 'City',
            'state' => 'State',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'mobile_no' => $list->mobile_no,
                    'email_id' => $list->email_id,
                    'first_name' => $list->first_name,
                    'last_name' => $list->last_name,
                    'dob' => $list->dob,
                    'gender' => $list->gender,
                    'locality' => $list->locality,
                    'pincode' => $list->pincode,
                    'city' => $list->city ? $list->city->name : '',
                    'state' => $list->state ? $list->state->name : '',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
