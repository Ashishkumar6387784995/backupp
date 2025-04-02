<?php

namespace App\Exports\Excel;

use App\Models\Query;
use Maatwebsite\Excel\Concerns\FromCollection;

class EnquireExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $status = request('status');
        $fromDate = request('from_date');
        $fromTo = request('to_date');

        $data = Query::with(['city', 'centre'])->when($status, function ($queries) use ($status) {
            if ($status == '-1') {
                $status = '0';
            }
            $queries->where('is_lead_converted', '=', $status);
        })->where('type', 2)
            ->when($fromDate, function ($queries) use ($fromDate) {
                $fromDate = request('from_date');
                $fromTo = request('to_date');
                if ($fromDate && $fromTo) {
                    $queries->whereBetween('created_at', [$fromDate, $fromTo]);
                }
            })

            ->get();
        $exportData[] = [
            'customer_name ' => 'Customer Name',
            'customer_mobile' => 'Customer Mobile ',
            'customer_email' => 'Email ',
            'message' => 'Message',
            'city_id' => 'City',
            'centre_id' => 'Centre Name',
            'dob' => 'DOB',
            'address' => 'Address',
            'gender' => 'Gender',
            'is_lead_converted' => 'Convert Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'customer_name' => $list->customer_name,
                    'customer_mobile' => $list->customer_mobile,
                    'customer_email' => $list->customer_email,
                    'message' => $list->message,
                    'city_id' => $list->city ? $list->city->name : '',
                    'centre_id' => $list->centre ? $list->centre->centre_name : '',
                    'dob' => $list->dob,
                    'address' => $list->address,
                    'gender' => $list->gender,
                    'is_lead_converted' => ($list->is_lead_converted == 1) ? 'Pending' : ($list->is_lead_converted == 2) ? 'Converted' : 'NEW',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
