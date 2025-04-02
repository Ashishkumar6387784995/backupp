<?php

namespace App\Exports\Excel;

use App\Models\Coupon;
use Maatwebsite\Excel\Concerns\FromCollection;

class OffersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $coupon_type = request('coupon_type');
        $status = request('status');
        if ($status == '0') {
            $status = '2';
        }
        $data = Coupon::when($status, function ($data) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $data->where('status', '=', $status);
            }
        })->when($coupon_type, function ($data) use ($coupon_type) {
            if ($coupon_type) {
                $data->where('coupon_type', '=', $coupon_type);
            }
        })->orderBy('id', 'desc')->get();
        $exportData[] = [
            'coupon_code' => 'Coupon Code',
            'coupon_type' => 'Coupon Type',
            'coupon_title' => 'Coupon Title',
            'short_desc' => 'Short Description',
            'description' => 'Description',
            'valid_from' => 'Valid From',
            'valid_to' => 'Valid To',
            'min_value' => 'Min Value',
            'max_off' => 'Max Off',
            'max_usage' => 'Max Usage',
            'max_per_user' => 'Max Per User',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'coupon_code' => ($list->coupon_code == 1) ? 'Percentage' : 'Fix',
                    'coupon_type' => $list->coupon_type,
                    'coupon_title' => $list->coupon_title,
                    'short_desc' => $list->short_desc,
                    'description' => $list->description,
                    'valid_from' => $list->valid_from,
                    'valid_to' => $list->valid_to,
                    'min_value' => $list->min_value,
                    'max_off' => $list->max_off,
                    'max_usage' => $list->max_usage,
                    'max_per_user' => $list->max_per_user,
                    'status' => ($list->status) ? 'Active' : 'InActive',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
