<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Query;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\QueryExport;
use Maatwebsite\Excel\Facades\Excel;

class QueryController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Queries';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Queries',
                    'url' => '',
                ]
            ];
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $queries = Query::when($status, function ($doctors) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $doctors->where('status', '=', $status);
                }
            })->where('type', '1')->orderBy('id', 'desc')->get();
            // dd($doctors);
            return view('admin.pages.queries.list', compact('page_title', 'page_description', 'breadcrumbs',  'queries'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $cat = Query::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Query deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Query details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function updateStatus($id, $status)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $status = ($status == 1) ? $status = 0 : $status = 1;
                $updateArr = [
                    'status' => $status,
                ];
                $response = Query::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/queries/list')->with('success', 'Query status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Query details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function exportExcel()
    {
        $type = request('type');
        if ($type == 'excel')
            return Excel::download(new QueryExport, 'Queries.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
