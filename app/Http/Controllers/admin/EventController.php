<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use DB;
use Validator;
use Image;
use File;

use App\Exports\Excel\EventsExport;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{
    public function index()
    {
        try {
            $page_title = 'News & Event';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'News & Event',
                    'url' => '',
                ]
            ];


            $fromDate = request('fromtodate');
            $status = request('status');
            if ($status == '0') {
                $status = '2';
            }
            $events = Event::when($status, function ($events) use ($status) {
                if ($status != '-1') {
                    $status = conditionalStatus($status);
                    $events->where('status', '=', $status);
                }
            })->when($fromDate, function ($events) use ($fromDate) {
                if ($fromDate) {
                    $dateArr = explode(' - ', $fromDate);
                    $From = date('Y-m-d', strtotime($dateArr[0]));
                    $To = date('Y-m-d', strtotime($dateArr[1]));
                    $events->whereBetween('created_at', [$From, $To]);
                }
            })->orderBy('id', 'desc')->get();
            return view('admin.pages.events.list', compact('page_title', 'page_description', 'breadcrumbs', 'events'));
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
                    'posted_by' => $request->posted_by,
                    'location' => $request->location,
                    'youtube_link' => $request->youtube_link,

                ];
                $images = [];
                if (isset($request['images']) && count($request['images']) > 0) {
                    foreach ($request->images as $sKey => $sList) {
                        if ($sList) {
                            $icon = null;
                            if ($request->hasFile('images')) {
                                $pathString = 'uploads/event/images/';
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

                        $destinationPath = public_path('./uploads/event/videos/');
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

                if (Event::where('slug', $array['slug'])->whereNull('deleted_at')->exists()) {
                    DB::rollback();
                    return redirect()->back()->withErrors('Event name or slug already exist.');
                }
                $response = Event::UpdateOrCreate(['id' => null], $array);
                DB::commit();
                return redirect('admin/events/list')->with('success', 'Event details added successfully.');
            }



            $pageSettings = $this->pageSetting('add');

            $page_title =  $pageSettings['page_title'];
            $page_description = $pageSettings['page_description'];
            $breadcrumbs = $pageSettings['breadcrumbs'];
            return view('admin.pages.events.add', compact('page_title', 'page_description', 'breadcrumbs'));
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
                        'posted_by' => $request->posted_by,
                        'youtube_link' => $request->youtube_link,

                    ];
                    $images = [];
                    if (isset($request['images']) && count($request['images']) > 0) {
                        foreach ($request->images as $sKey => $sList) {
                            if ($sList) {
                                $icon = null;
                                if ($request->hasFile('images')) {
                                    $pathString = 'uploads/event/images/';
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
                            $centre = Event::where('id', '=', $id)->first();
                            if ($centre) {
                                $existimages = ($centre->images) ? json_decode($centre->images, true) : [];
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

                            $destinationPath = public_path('./uploads/event/videos/');
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
                    if (Event::where('slug', $array['slug'])->where('id', '<>', $id)->whereNull('deleted_at')->exists()) {
                        DB::rollback();
                        return redirect()->back()->withErrors('Event name or slug already exist.');
                    }
                    $response = Event::UpdateOrCreate(['id' => $id], $array);
                    DB::commit();
                    return redirect('admin/events/list')->with('success', 'Event details added successfully.');
                }


                $details = Event::where('id', $id)->first();
                if ($details) {
                    $pageSettings = $this->pageSetting('edit');

                    $page_title =  $pageSettings['page_title'];
                    $page_description = $pageSettings['page_description'];
                    $breadcrumbs = $pageSettings['breadcrumbs'];

                    return view('admin.pages.events.edit', compact('page_title', 'page_description', 'breadcrumbs', 'details'));
                } else {
                    return redirect()->back()->withErrors(['Faq details not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['Faq details id is missing.']);
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
                $cat = Event::find($id);
                if ($cat->delete()) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Event  deleted successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Event details not found.');
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
                $response = Event::UpdateOrCreate(['id' => $id], $updateArr);
                DB::commit();
                return redirect('admin/events/list')->with('success', 'Event status updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Event details not found.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function deleteVideo($id, $videoName)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $eventData = Event::where('id', $id)->first();
                $newVideos = [];
                if ($eventData) {
                    if ($eventData->videos && $videos = json_decode($eventData->videos, 1)) {
                        foreach ($videos as $key => $list) {
                            if ($list['video'] != $videoName) {
                                $newVideos[] = $list;
                            }
                        }
                    }
                    $updateArr = [
                        'videos' => json_encode($newVideos),
                    ];
                    $response = Event::UpdateOrCreate(['id' => $id], $updateArr);
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
    public function deleteImage($id, $videoName)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                $eventData = Event::where('id', $id)->first();
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
                    $response = Event::UpdateOrCreate(['id' => $id], $updateArr);
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


    public function pageSetting($action, $dataArray = [])
    {
        if ($action == 'edit') {
            $data['page_title'] = 'Events';
            $data['page_description'] = 'Add New Event';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Event Master',
                    'url' => url('admin/events/list'),
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
            $data['page_title'] = 'Events';
            $data['page_description'] = 'Add New Event';
            $data['breadcrumbs'] = [
                [
                    'title' => 'Event Master',
                    'url' => url('admin/events/list'),
                ],
                [
                    'title' => 'Add a New Event',
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
            return Excel::download(new EventsExport, 'NewsEvents.xlsx');
        else
            return redirect()->back()->withErrors(['Export type not defined.']);
    }
}
