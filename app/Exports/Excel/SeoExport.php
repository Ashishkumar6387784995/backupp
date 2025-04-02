<?php

namespace App\Exports\Excel;

use App\Models\SeoPage;
use Maatwebsite\Excel\Concerns\FromCollection;

class SeoExport implements FromCollection
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
        $data = SeoPage::when($status, function ($pages) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $pages->where('status', '=', $status);
            }
        })->orderBy('id', 'desc')->get();
        $exportData[] = [
            'page_name ' => 'Page Name',
            'slug ' => 'Slug ',
            'seo_title' => 'Seo Title ',
            'seo_description' => 'Seo Description ',
            'seo_keywords' => 'Seo Keywords ',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'page_name' => $list->page_name,
                    'slug' => $list->slug,
                    'seo_title' => $list->seo_title,
                    'seo_description' => $list->seo_description,
                    'seo_keywords' => $list->seo_keywords,
                    'status' => ($list->status) ? 'Active' : 'InActive',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
