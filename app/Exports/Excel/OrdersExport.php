<?php

namespace App\Exports\Excel;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $status = request('status');
        $fromDate = request('fromtodate');
        $cityId = request('city_id');
        if ($status == '0') {
            $status = '2';
        }
        $data = Order::with(['centre', 'customer', 'city', 'state', 'orderStatus'])
            ->when($status, function ($orders) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
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
        $exportData[] = [
            'Order Id',
            'Order Type',
            'Schedule Date',
            'Schedule Time',
            'Centre',
            'customer',
            'Patient Name  ',
            'Patient Number  ',
            'Patient Age  ',
            'Patient DOB  ',
            'Patient Email  ',
            'Patient Relation  ',
            'Address',
            'Locality',
            'Pincode',
            'City',
            'State',
            'Address Type',
            'Order Discount',
            'Order Total',
            'Advance Paid',
            'Order Status',
            'Last Follow up Date',
            'Last Follow up Comment',
            'Next Follow up Date',
            'Created At',
        ];
        if ($data) {

            foreach ($data as $key => $list) {
                $exportData[] = [
                    'ORD' . $list->id,
                    ($list->order_type == 1) ? 'Normal Order' : 'Lead Converted',
                    $list->schedule_date,
                    $list->schedule_time,
                    $list->centre ? $list->centre->centre_name : '',
                    $list->customer ? $list->first_name . ' ' . $list->last_name : '',
                    $list->patient_firstname . ' ' . $list->patient_lastname,
                    $list->patient_number,
                    $list->patient_age,
                    $list->patient_dob,
                    $list->patient_email,
                    $list->patient_relation,
                    $list->address,
                    $list->locality,
                    $list->pincode,
                    $list->city ? $list->city->name : '',
                    $list->state ? $list->state->name : '',
                    $list->address_tag,
                    $list->order_discount,
                    $list->order_total,
                    $list->advance_paid,
                    $list->orderStatus ?  $list->orderStatus->status_title : '',
                    $list->last_follow_up_date,
                    $list->last_follow_up_comment,
                    $list->next_follow_up_date,
                    $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
