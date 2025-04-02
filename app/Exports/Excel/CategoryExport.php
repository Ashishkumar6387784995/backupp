<?php

namespace App\Exports\Excel;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoryExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $stateId = request('state_id');
        $status = request('status');
        if ($status == '0') {
            $status = '2';
        }
        $data = Category::orderBy('id', 'DESC')->when($status, function ($cities) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $cities->where('status', '=', $status);
            }
        })->where('parent_id', 0)->get();
        $exportData[] = [
            'category_name' => 'Category Name',
            'category_slug ' => 'Category Slug ',
            'category_heading' => 'Category Heading ',
            'category_details' => 'Category Details ',
            'category_short_description' => 'Category Short Description ',
            'seo_title' => 'Seo Title ',
            'seo_description' => 'Seo Description ',
            'seo_kewords' => 'Seo Keywords ',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'name' => $list->category_name,
                    'category_slug' =>  $list->category_slug,
                    'category_heading' => $list->category_heading,
                    'category_short_description' => $list->category_short_description,
                    'category_details' => $list->category_details,
                    'seo_title' => $list->seo_title,
                    'seo_description' => $list->seo_description,
                    'seo_kewords' => $list->seo_kewords,
                    'status' => ($list->status) ? 'Active' : 'InActive',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
