<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use DB;
use Validator;
use Image;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'Job Service Management';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Job Service Management',
                    'url' => '',
                ],
            ];
            $status = request('status');
           
            // Initialize the query
            $servicesQuery = Service::orderBy('id', 'desc');

            // Apply the status filter if it's present in the request
            if ($status != '') {
                $servicesQuery->where('status', $status);
            }
            // Get the filtered services
            $services = $servicesQuery->get();
            return view('admin.pages.services.list', compact('page_title', 'page_description', 'breadcrumbs', 'services'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'service_name' => 'required',
                ], [
                    'service_name.required' => 'Service name is required.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();
                $updateArr = [
                    'name' => $request->service_name,
                    'short_tittle' => $request->short_tittle,
                    'slug' => \Str::slug($request->service_name),
                ];
                $icon = '';
                if ($request->hasFile('icon')) {
                    // Validate the image
                    $request->validate([
                        'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Adjust max size as needed
                    ]);
                
                    // Get the uploaded image file
                    $image = $request->file('icon');
                    
                    // Create a unique file name
                    $iconImageName = Str::slug($request->service_name) . time() . '.' . $image->getClientOriginalExtension();
                
                    // Define the directory path (public disk)
                    $pathString = 'uploads/services/icons/';
                
                    // Ensure the directory exists (on public disk)
                    if (!Storage::exists($pathString)) {
                        Storage::makeDirectory($pathString);
                    }
                    $request->icon->move(public_path($pathString), $iconImageName);
              
                    // Optionally, store the icon name in the database
                    $icon = $iconImageName;
                    $updateArr['icon'] = $icon;
                } 
                
                if (Service::where('name', $updateArr['name'])->exists()) {
                    return redirect()->back()->withErrors(['Service name already exist.'])->withInput($request->all());
                }
                $response = Service::UpdateOrCreate(['id' => null], $updateArr);
                DB::commit();
                return redirect('admin/services/list')->with('success', 'Service details updated successfully.');
            }

            $page_title = 'Service Management';
            $page_description = 'Add Service';

            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];

            return view('admin.pages.services.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                        'service_name' => 'required',
                    ], [
                        'service_name.required' => 'Service name is required.'
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
                        $iconImageName = Str::slug($request->service_name) . time() . '.' . $image->getClientOriginalExtension();
                    
                        // Define the directory path (public disk)
                        $pathString = 'uploads/services/icons/';
                    
                        // Ensure the directory exists (on public disk)
                        if (!Storage::exists($pathString)) {
                            Storage::makeDirectory($pathString);
                        }
                        $request->icon->move(public_path($pathString), $iconImageName);
                  
                        // Optionally, store the icon name in the database
                        $icon = $iconImageName;
                    } 
                    

                    $updateArr = [
                        'name' => $request->service_name,
                        'short_tittle' => $request->short_tittle,
                        'slug' => \Str::slug($request->service_name),
                    ];
                    if($icon) {
                        $updateArr['icon'] = $icon;
                    }
             
                    if (Service::where('name', $updateArr['name'])->where('id', '!=', $id)->exists()) {
                        return redirect()->back()->withErrors(['Service name already exist.'])->withInput($request->all());
                    }
                    // print_r($updateArr);die;
                    $response = Service::UpdateOrCreate(['id' => $id], $updateArr);
                    DB::commit();
                    return redirect('admin/services/list')->with('success', 'Service details updated successfully.');
                }

                $page_title = 'Service Management';
                $page_description = 'Edit Service';
                $details = Service::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit', ['title' => $details->category_name]);

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];
                    return view('admin.pages.services.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
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
                $cat = Service::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Service deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Service details not found.');
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
                $response = Service::UpdateOrCreate(['id' => $cityId], $updateArr);
                DB::commit();
                return redirect('admin/services/list')->with('success', 'Service status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Service details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
    }
    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Services';
            $data['page_description'] = 'Edit Services';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Services Management',
                    'url' => url('admin/services/list'),
                ]
            ];
            if (isset($dataArray['title']) && !empty($dataArray['title'])) {
                $data['breadcrumbs'][] =
                    [
                        'title' => $dataArray['title'],
                        'url' => url('admin/services/list'),

                    ];
            } else {
                $data['breadcrumbs'][] = [

                    'title' => 'Edit Services',
                    'url' => url('admin/services/list'),

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
}
