<?php

namespace App\Exports\Excel;

use App\Models\Query;
use Maatwebsite\Excel\Concerns\FromCollection;

class QueryExport implements FromCollection
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
        $data = Query::when($status, function ($doctors) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $doctors->where('status', '=', $status);
            }
        })->where('type', 1)->get();
        $exportData[] = [
            'customer_name ' => 'Customer Name',
            'customer_mobile' => 'Customer Mobile ',
            'customer_email' => 'Email ',
            'message' => 'Message',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'customer_name' => $list->customer_name,
                    'customer_mobile' => $list->customer_mobile,
                    'customer_email' => $list->customer_email,
                    'message' => $list->message,
                    'status' => ($list->status) ? 'Solved' : 'Pending',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
