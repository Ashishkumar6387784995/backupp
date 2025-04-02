<?php

namespace App\Exports\Excel;

use App\Models\LeadCapture;
use Maatwebsite\Excel\Concerns\FromCollection;

class JDExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
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
            })->orderBy('id', 'desc')->get();
        $exportData[] = [
            'name ' => 'Customer Name',
            'mobile' => 'Customer Mobile ',
            'email' => 'Email ',
            'category' => 'Category',
            'city' => 'city',
            'brancharea' => 'brancharea',
            'created_at' => 'Created At',
        ];
        if ($lists) {
            foreach ($lists as $key => $data) {
                $list = json_decode($data->lead_data);
                $exportData[] = [
                    'name' => $list->name,
                    'mobile' => $list->mobile,
                    'email' => $list->email,
                    'category' => $list->category,
                    'city' => $list->city,
                    'brancharea' => $list->brancharea,
                    'datetime' => displayDateTime2($list->date . ' ' . $list->time),  
                ];
            }
        }
        return collect($exportData);
    }
}
