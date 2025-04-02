<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ECME;
use DB;
use Validator;
use Image;
use File;
use App\Exports\Excel\CMEExport;
use Maatwebsite\Excel\Facades\Excel;


class CMEController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'ECME Master';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'ECME Master',
                    'url' => '',
                ]
            ];


            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $events = ECME::when($status, function ($events) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $events->where('status', '=', $status);
                }
            })->orderBy('id', 'desc')->get();
            return view('admin.pages.cme.list', compact('page_title', 'page_description', 'breadcrumbs', 'events'));
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
                    'title' => 'required',
                    'short_details' => 'required',
                    'date' => 'required',
                    'time' => 'required',
                    'location' => 'required',
                    'youtube_link' => '',
                ], [
                    'title.required' => 'Enter cme title.',
                    'date.required' => 'Enter cme date.',
                    'time.required' => 'Enter cme time.',
                    'location.required' => 'Enter cme venue.',
                    'short_details.required' => 'Enter short description.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                DB::beginTransaction();

                $array = [
                    'short_details' => $request->short_details,
                    'slug' => \Str::slug($request->title),
                    'title' => $request->title,
                    'details' => $request->description,
                    'date' => $request->date,
                    'time' => $request->time,
                    // 'posted_by' => $request->posted_by,
                    'location' => $request->location,
                    'youtube_link' => $request->youtube_link,

                ];
                $images = [];
                if (isset($request['images']) && count($request['images']) > 0) {
                    foreach ($request->images as $sKey => $sList) {
                        if ($sList) {
                            $icon = null;
                            if ($request->hasFile('images')) {
                                $pathString = 'uploads/cme/images/';
                                $image = $request->file('images')[$sKey];
                                $iconImageName = 'document' . $sKey . '-' . time() . '.' . $image->getClientOriginalExtension();
                                $image_resize = Image::make($image->getRealPath());

                                $height = Image::make($image)->height();
                                $width = Image::make($image)->width();
                                $path = public_path($pathString);

                                if (!File::isDirectory($path)) {
                                    File::makeDirectory($path, 0777, true, true);
                                }
                                if ($width > $height) {
                                    $image_resize->resize(692, null, function ($constraint) use ($image_resize) {
                                        $constraint->aspectRatio();
                                    })->save(public_path($pathString . $iconImageName));
                                } else {
                                    $image_resize->resize(null, 274, function ($constraint) use ($image_resize) {
                                        $constraint->aspectRatio();
                                    })->save(public_path($pathString . $iconImageName));
                                }
                                $icon = $iconImageName;
                            }
                            $images[] = [
                                'image' => $icon,
                            ];
                        }
                    }

                    (count($images) > 0) ? $array['images'] =  json_encode($images) : null;
                }
                $videos = [];
                if ($request->has('videos')) {
                    foreach ($request->videos as $vkey => $vvalue) {
                        $i = 0;
                        $uploadedFile = $request->file('videos')[$vkey];
                        //dd($uploadedFile);
                        $fileName =   \Str::slug($request['videos'][$vkey]) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

                        $destinationPath = public_path('./uploads/cme/videos/');
                        $isValid = $uploadedFile->isValid();
                        if ($isValid) {
                            $uploadedFile->move($destinationPath, $fileName);

                            $videos[] = [
                                'video' => $fileName,
                            ];
                        }
                    }
                    (count($videos) > 0) ? $array['videos'] =  json_encode($videos) : null;
                }
                if (ECME::where('slug', $array['slug'])->whereNull('deleted_at')->exists()) {
                    DB::rollback();
                    return redirect()->back()->withErrors('CME name or slug already exist.');
                }

                $response = ECME::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/cme/list')->with('success', 'CME details added successfully.');
            }



            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            return view('admin.pages.cme.add', compact('page_title', 'page_description', 'breadcrumbs'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            if ($id) {
                if ($request->isMethod('post')) {
                    // dd($request->all());    
                    $validator = Validator::make($request->all(), [
                        'title' => 'required',
                        'short_details' => 'required',
                        'date' => 'required',
                        'time' => 'required',
                        'location' => 'required',
                        'youtube_link' => '',
                    ], [
                        'title.required' => 'Enter event title.',
                        'date.required' => 'Enter event date.',
                        'time.required' => 'Enter event time.',
                        'location.required' => 'Enter event venue.',
                        'short_details.required' => 'Enter short description.'
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());
                    }

                    DB::beginTransaction();

                    $array = [
                        'short_details' => $request->short_details,
                        'title' => $request->title,
                        'slug' => \Str::slug($request->title),
                        'details' => $request->description,
                        'date' => $request->date,
                        'time' => $request->time,
                        'location' => $request->location,
                        'youtube_link' => $request->youtube_link,

                    ];
                    $images = [];
                    if (isset($request['images']) && count($request['images']) > 0) {
                        foreach ($request->images as $sKey => $sList) {
                            if ($sList) {
                                $icon = null;
                                if ($request->hasFile('images')) {
                                    $pathString = 'uploads/cme/images/';
                                    $image = $request->file('images')[$sKey];
                                    $iconImageName = 'document' . $sKey . '-' . time() . '.' . $image->getClientOriginalExtension();
                                    $image_resize = Image::make($image->getRealPath());

                                    $height = Image::make($image)->height();
                                    $width = Image::make($image)->width();
                                    $path = public_path($pathString);

                                    if (!File::isDirectory($path)) {
                                        File::makeDirectory($path, 0777, true, true);
                                    }
                                    if ($width > $height) {
                                        $image_resize->resize(692, null, function ($constraint) use ($image_resize) {
                                            $constraint->aspectRatio();
                                        })->save(public_path($pathString . $iconImageName));
                                    } else {
                                        $image_resize->resize(null, 274, function ($constraint) use ($image_resize) {
                                            $constraint->aspectRatio();
                                        })->save(public_path($pathString . $iconImageName));
                                    }
                                    $icon = $iconImageName;
                                }
                                $images[] = [
                                    'image' => $icon,
                                ];
                            }
                        }
                        if (count($images) > 0) {
                            $centre = ECME::where('id', '=', $id)->first();
                            if ($centre) {
                                $existimages = ($centre->images) ? json_decode($centre->images, true) : null;
                                $newimages = array_merge($existimages, $images);
                                $array['images'] =  json_encode($newimages);
                            } else {
                                $array['images'] =  json_encode($images);
                            }
                        }
                    }
                    $videos = [];
                    if ($request->has('videos')) {
                        foreach ($request->videos as $vkey => $vvalue) {
                            $i = 0;
                            $uploadedFile = $request->file('videos')[$vkey];
                            //dd($uploadedFile);
                            $fileName =   \Str::slug($request['videos'][$vkey]) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

                            $destinationPath = public_path('./uploads/cme/videos/');
                            $isValid = $uploadedFile->isValid();
                            if ($isValid) {
                                $uploadedFile->move($destinationPath, $fileName);

                                $videos[] = [
                                    'video' => $fileName,
                                ];
                            }
                        }
                        (count($videos) > 0) ? $array['videos'] =  json_encode($videos) : null;
                    }
                    if (ECME::where('slug', $array['slug'])->where('id', '<>', $id)->whereNull('deleted_at')->exists()) {
                        DB::rollback();
                        return redirect()->back()->withErrors('CME name or slug already exist.');
                    }
                    $response = ECME::UpdateOrCreate(['id' => $id], $array);
                    DB::commit();
                    return redirect('admin/cme/list')->with('success', 'CME details added successfully.');
                }


                $details = ECME::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit');

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];

                    return view('admin.pages.cme.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
                } else {
                    return redirect()->back()->withErrors(['ECME details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['ECME details id is missing.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $cat = ECME::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'ECME  deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'ECME details not found.');
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
                $response = ECME::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/cme/list')->with('success', 'ECME status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'ECME details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'ECME';
            $data['page_description'] = 'Add New ECME';
            $data['breadcrumbs'] = [
                [
                    'title' => 'ECME Master',
                    'url' => url('admin/cme/list'),
                ]
            ];
            if (isset($dataArray['title']) && !empty($dataArray['title'])) {
                $data['breadcrumbs'][] =
                    [
                        'title' => $dataArray['title'],
                        'url' => '',

                    ];
            }
            return $data;
        }

        if ($action == 'add') {
            $data['page_title'] = 'ECME';
            $data['page_description'] = 'Add New ECME';
            $data['breadcrumbs'] = [
                [
                    'title' => 'ECME Master',
                    'url' => url('admin/cme/list'),
                ],
                [
                    'title' => 'Add a New ECME',
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
            return Excel::download(new CMEExport, 'CMEExport.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }

    public function deleteImage($id, $videoName)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $eventData = ECME::where('id', $id)->first();
                $newImages = [];
                if ($eventData) {
                    if ($eventData->images && $videos = json_decode($eventData->images, 1)) {
                        foreach ($videos as $key => $list) {
                            if ($list['image'] != $videoName) {
                                $newImages[] = $list;
                            }
                        }
                    }

                    $updateArr = [
                        'images' => json_encode($newImages),
                    ];
                    $response = ECME::UpdateOrCreate(['id' => $id], $updateArr);
                    DB::commit();

                    return redirect()->back()->with('success', 'Item deleted successfully.');
                } else {
                    dd('1');
                    DB::rollback();
                    return redirect()->back()->withErrors(['Event details not found.']);
                }
            } else {
                dd('2');
                DB::rollback();
                return redirect()->back()->withErrors(['Event details not found.']);
            }
        } catch (\Exception $e) {
            // DB::rollback(); 
            // dd($e); 
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
}
