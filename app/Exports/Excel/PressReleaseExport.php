<?php

namespace App\Exports\Excel;

use App\Models\PressRelease;
use Maatwebsite\Excel\Concerns\FromCollection;

class PressReleaseExport implements FromCollection
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
        $data = PressRelease::orderBy('id', 'DESC')->when($status, function ($data) use ($status) {
            if ($status != '-1') {
                $status = conditionalStatus($status);
                $data->where('status', '=', $status);
            }
        })->get();
        $exportData[] = [
            'title' => 'Title',
            'slug ' => 'Slug  ',
            'short_details' => 'Short Details ',
            'details' => 'Details',
            'date' => 'Date',
            'time' => 'Time',
            'location' => 'Location',
            'posted_by' => 'Posted By',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        if ($data) {
            foreach ($data as $key => $list) {
                $exportData[] = [
                    'title' => $list->title,
                    'slug' => $list->slug,
                    'short_details' => $list->short_details,
                    'details' => $list->details,
                    'date' => $list->date,
                    'time' => $list->time,
                    'location' => $list->location,
                    'posted_by' => $list->posted_by,
                    'status' => ($list->status) ? 'Active' : 'InActive',
                    'created_at' => $list->created_at,
                ];
            }
        }
        return collect($exportData);
    }
}
