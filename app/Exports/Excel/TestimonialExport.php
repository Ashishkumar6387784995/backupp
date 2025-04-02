<?php

namespace App\Exports\Excel;

use App\Models\Testimonial;
use Maatwebsite\Excel\Concerns\FromCollection;

class TestimonialExport implements FromCollection
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
        $data = Testimonial::when($status, function ($data) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $data->where('status', '=', $status);
            }
        })->orderBy('id', 'DESC')->get();
        $exportData[] = [
            'name' => 'Customer Name',
            'rating' => 'rating ',
            'comments' => 'Comments ',
            'message' => 'Message',
            'testimonial_type' => 'testimonial_type',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'name' => $list->name,
                    'rating' => $list->rating,
                    'comments' => $list->comments,
                    'content' => $list->content,
                    'testimonial_type' => ($list->testimonial_type == 1) ? 'Text' : 'Video',
                    'status' => ($list->status) ? 'Active' : 'InActive',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
