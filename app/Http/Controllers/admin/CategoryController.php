<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\CategoryExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            
            $page_title = 'Category Management';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Category Management',
                    'url' => '',
                ],
            ];
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $categories = Category::orderBy('id','desc')->get();
            return view('admin.pages.category.list', compact('page_title', 'page_description', 'breadcrumbs', 'categories'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'category_name' => 'required',
                ], [
                    'category_name.required' => 'Category name is required.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }
                $updateArr = [];
                DB::beginTransaction();
                $updateArr = [
                    'parent_id' => 0,
                    'category_name' => $request->category_name,
                    'category_short_description' => $request->category_short_description ?? '',
                    'category_slug' => \Str::slug($request->category_name),
                ];
                if ($request->hasFile('icon')) {
                    // Validate the image
                    $request->validate([
                        'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Adjust max size as needed
                    ]);
                
                    // Get the uploaded image file
                    $image = $request->file('icon');
                    
                    // Create a unique file name
                    $iconImageName = Str::slug($request->category_name) . time() . '.' . $image->getClientOriginalExtension();
                
                    // Define the directory path (public disk)
                    $pathString = 'uploads/category/icons/';
                
                    // Ensure the directory exists (on public disk)
                    if (!Storage::exists($pathString)) {
                        Storage::makeDirectory($pathString);
                    }
                    $request->icon->move(public_path($pathString), $iconImageName);
              
                    // Optionally, store the icon name in the database
                    $icon = $iconImageName;
                    $updateArr['category_icon'] = $icon;
                } 
                
                if (Category::where('category_name', $updateArr['category_name'])->where('parent_id', 0)->whereNull('deleted_at')->exists()) {
                    return redirect()->back()->withErrors(['Category name already exist.'])->withInput($request->all());
                }
                $response = Category::create($updateArr);
                DB::commit();
                return redirect('admin/categories/list')->with('success', 'Category details updated successfully.');
            }

            $page_title = 'Category Management';
            $page_description = 'Add Category';

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            return view('admin.pages.category.add', compact('page_title', 'page_description', 'breadcrumbs'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            if ($id) {
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'category_name' => 'required',
                    ], [
                        'category_name.required' => 'Category name is required.'
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();   
                    $icon = '';
                    if ($request->hasFile('icon')) {
                        // Validate the image
                        $request->validate([
                            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Adjust max size as needed
                        ]);
                    
                        // Get the uploaded image file
                        $image = $request->file('icon');
                        
                        // Create a unique file name
                        $iconImageName = Str::slug($request->category_name) . time() . '.' . $image->getClientOriginalExtension();
                    
                        // Define the directory path (public disk)
                        $pathString = 'uploads/category/icons/';
                    
                        // Ensure the directory exists (on public disk)
                        if (!Storage::exists($pathString)) {
                            Storage::makeDirectory($pathString);
                        }
                        $request->icon->move(public_path($pathString), $iconImageName);
                  
                        // Optionally, store the icon name in the database
                        $icon = $iconImageName;
                    } 
                    

                    $updateArr = [
                        'parent_id' => 0,
                        'category_name' => $request->category_name,
                        'category_short_description' => $request->category_short_description,
                        'category_slug' => \Str::slug($request->category_name),
                    ];
                    if($icon) {
                        $updateArr['category_icon'] = $icon;
                    }
             
                    if (Category::where('category_name', $updateArr['category_name'])->where('parent_id', 0)->where('id', '!=', $id)->exists()) {
                        return redirect()->back()->withErrors(['Category name already exist.'])->withInput($request->all());
                    }
                    // print_r($updateArr);die;
                    $response = Category::UpdateOrCreate(['id' => $id], $updateArr);
                    DB::commit();
                    return redirect('admin/categories/list')->with('success', 'Category details updated successfully.');
                }

                $page_title = 'Category Management';
                $page_description = 'Edit Category';
                $details = Category::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit', ['title' => $details->category_name]);

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];
                    return view('admin.pages.category.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
                } else {
                    return redirect()->back()->withErrors(['Category details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['Category id is missing.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $cat = Category::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Category deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Category details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function updateStatus($cityId, $status)
    {
        try {
            if ($cityId) {

                DB::beginTransaction();
                $status = ($status == 1) ? $status = 0 : $status = 1;
                $updateArr = [
                    'status' => $status,
                ];
                $response = Category::UpdateOrCreate(['id' => $cityId], $updateArr);
                DB::commit();
                return redirect('admin/categories/list')->with('success', 'City status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'City details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
    }
    public function addHomePage(Request $request){
        try {
            $id = $request->id;
            $is_home_display = $request->is_home_display;
            DB::beginTransaction();
            $is_home_display = $is_home_display == 1 ? 0 : 1;

            $updateArr = [
                'is_home_display' => $is_home_display,
            ];
            // print_r($id);
            // print_r($updateArr);die;
            $categories = Category::where(['id' => $id])->first();
            $categories->is_home_display = $is_home_display;
            $categories->save();
            DB::commit();
            return redirect('admin/categories/list')->with('success', 'City status updated successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
    }
    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'City';
            $data['page_description'] = 'Edit City';
            $data['breadcrumbs'] = [
                [
                    'title' => 'City Management',
                    'url' => url('admin/city/list'),
                ]
            ];
            if (isset($dataArray['title']) && !empty($dataArray['title'])) {
                $data['breadcrumbs'][] =
                    [
                        'title' => $dataArray['title'],
                        'url' => '',

                    ];
            } else {
                $data['breadcrumbs'][] = [

                    'title' => 'Edit Category',
                    'url' => '',

                ];
            }
            return $data;
        }

        if ($action == 'add') {
            $data['page_title'] = 'City';
            $data['page_description'] = 'Add a New City';
            $data['breadcrumbs'] = [
                [
                    'title' => 'City Management',
                    'url' => url('admin/city/list'),
                ],
                [
                    'title' => 'Add City',
                    'url' => '',
                ],
            ];
            return $data;
        }
    }
    function exportExcel()
    {
        $type = request('type');
        if ($type == 'excel')
            return Excel::download(new CategoryExport, 'Categories.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
