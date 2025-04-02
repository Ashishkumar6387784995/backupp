<?php

namespace App\Exports\Excel;

use App\Models\Faq;
use Maatwebsite\Excel\Concerns\FromCollection;

class FaqExport implements FromCollection
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
        $data = Faq::with(['faq_category'])->when($status, function ($faqs) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $faqs->where('status', '=', $status);
            }
        })->orderBy('id', 'desc')->get();
        $exportData[] = [
            'faq_category ' => 'Category',
            'title' => 'Title',
            'description' => 'Description ',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'faq_category' => $list->faq_category ? $list->faq_category->category : '',
                    'title' => $list->title,
                    'description' => $list->description,
                    'status' => ($list->status) ? 'Active' : 'InActive',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
