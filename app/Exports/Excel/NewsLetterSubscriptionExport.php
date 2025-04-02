<?php

namespace App\Exports\Excel;

use App\Models\NewsLetterSubscription;
use Maatwebsite\Excel\Concerns\FromCollection;

class NewsLetterSubscriptionExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $status = request('status');
        if ($status == '0') {
            $status = '2';
        }
        $data = NewsLetterSubscription::when($status, function ($lists) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $lists->where('status', '=', $status);
            }
        })->orderBy('id', 'desc')->get();
        $exportData[] = [
            'Email',
            'Status',
            'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'email' => $list->email,
                    'status' => ($list->status) ? 'Active' : 'InActive',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
