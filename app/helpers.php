<?php
function getAge($dob)
{
    if (!empty($dob)) {
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    } else {
        return 0;
    }
}

function getDOBFromAge($age)
{
    if (!empty($age)) {

        return date('Y-m-d', strtotime('-' . $age . ' years'));
    } else {
        return 0;
    }
}
function displayDate($dateTime)
{
    if ($dateTime) {
        $date = date('d-m-Y', strtotime("+5 hours", strtotime($dateTime)));
        $date = date('d-m-Y', strtotime("+30 minutes",  strtotime($date)));
        return $date;
    }
}
function displayDateTime($dateTime)
{
    if ($dateTime) {
        $date = date('d-m-Y h:i A', strtotime("+5 hours", strtotime($dateTime)));
        $date = date('d-m-Y h:i A', strtotime("+30 minutes",  strtotime($date)));
        return $date;
    }
}
function displayDateTime2($dateTime)
{
    if ($dateTime) {
        $date = date('d-m-Y h:i A', strtotime($dateTime));
        $date = date('d-m-Y h:i A', strtotime($date));
        return $date;
    }
}
function runTimeSelection($myId, $matchId)
{
    if ($myId == $matchId)
        return 'selected';
}
function runTimeChecked($myId, $matchId)
{
    if ($myId == $matchId)
        return 'checked';
}
function getAllStates()
{
    return 'App\Models\State'::all();
}
function getAllFaqs()
{
    return 'App\Models\Faq'::where('status', 1)->get();
}
function getOrderStatus($statusId)
{
    $data = 'App\Models\OrderStatus'::where('id', $statusId)->first();
    return $data ?  $data->status_title : 'NA';
}
function getUserName($id)
{
    $data = 'App\Models\User'::where('id', $id)->first();
    return $data ?  $data->name : 'NA';
}
function getCentreName($id)
{
    $data = App\Models\Centre::where('id', $id)->first();
    return $data ?  $data->centre_name : 'NA';
}
function getUserIdByEmail($email)
{
    $data = 'App\Models\Customer'::where('email_id', $email)->first();
    return $data ?  $data->id : null;
}
function getAllOrderStatus()
{
    return 'App\Models\OrderStatus'::get();
}
function getStateName($stateId)
{
    $data = 'App\Models\State'::where('id', $stateId)->first();
    return $data ? $data->name : null;
}
function getFunctionalArea($id = null)
{
    $data = 'App\Models\FunctionalArea'::get()->toArray();
    return $data ? $data : null;
}
function getIndustry($id = null)
{
    $data = 'App\Models\Industry'::get()->toArray();
    // dd( $data);
    return $data ? $data : null;
}
function getQualification($id = null)
{
    $data = 'App\Models\Qualification'::get()->toArray();
    return $data ? $data : null;
}
function getschool_college_university_name($id = null)
{
    $data = 'App\Models\Colleges'::get()->toArray();
    return $data ? $data : null;
}
function getStateIdByCityId($cityId)
{
    $data = 'App\Models\City'::where('id', $cityId)->first();
    return $data ? $data->state_id : null;
}

function getCityNameByCityId($cityId)
{
    $data = 'App\Models\City'::where('id', $cityId)->first();
    return $data ? $data->name : null;
}
function getAllCities()
{
    $data = 'App\Models\City'::where('status', 1)->get();
    return $data ? $data : null;
}
function getCVTemplates($status)
{
    $data = App\Models\CVTemplate::when($status, function ($data) use ($status) {
        $data->where('status', $status);
    })->get();
    return $data ? $data : null;
}
function getCompanies($status = null)
{
    $data = App\Models\User::where('role_id', 3)->when($status, function ($data) use ($status) {
        $data->where('is_active', $status);
    })->get();
    return $data ? $data : null;
}
function getActiveJobs()
{
    $data = App\Models\Job::with(['company', 'functionalArea'])->where('status', 1)->get()->toArray();
    // dd(   $data);
    return $data ? $data : null;
}
function jobType($type = null)
{

    $jobType = App\Models\JobType::get();
    return $jobType;
}
function jobLevel($type = null)
{
    $array = [
        '1' => 'Entry-level',
        '2' => 'Intermediate or experienced (senior)',
        '3' => 'First-level management',
        '4' => 'Middle management',
        '5' => 'Executive or senior management',
    ];
    if ($type) {
        if (isset($array[$type])) {
            return $array[$type];
        } else {
            return  '';
        }
    } else {
        return $array;
    }
}
function getCityListArray()
{
    $data = 'App\Models\City'::pluck('name', 'id')->all();
    return $data ? $data : null;
}
function getFunctionalAreaArray($isPopular = '', $limit = '')
{
    $data = App\Models\FunctionalArea::pluck('title', 'id')
        ->when($isPopular, function ($data) use ($isPopular) {
            $data->where('is_popular', $isPopular);
        })
        ->when($limit, function ($data) use ($limit) {
            $data->limit($limit);
        })
        ->all();
    return $data ? $data : null;
}
function getFunctionalAreaisPopularArray($isPopular = '', $limit = '')
{
    $data = App\Models\FunctionalArea::where('is_popular', $isPopular)
        ->limit($limit)->pluck('title', 'id')

        ->all();
    return $data ? $data : null;
}
function getcategoriesids($names)
{
    if (trim($names)) {
        $namesPlace = explode(',', $names);
        if (count($namesPlace) > 0) {
            $sqlStr = " ( ";
            foreach ($namesPlace as $key => $list) {
                if ($key == 0) {
                    $_or = "";
                } else {
                    $_or = " OR ";
                }
                $sqlStr .= $_or . " category_name like '%" . trim(mb_strtolower($list)) . "%' ";
            }
            $sqlStr .= " ) ";
            $data = 'App\Models\Category'::where('parent_id', 0)
                ->whereRaw($sqlStr)
                ->pluck('id');
            return $data ? json_encode($data) : null;
        }
    }
}
function getCategoriesName($arr)
{
    if (count($arr) > 0) {
        $data = 'App\Models\Category'::whereIn('id', $arr)
            ->pluck('category_name')->toArray();
        return (count($data) > 0) ? implode(', ', $data) : null;
    }
}
function getsubcategoriesids($names)
{
    if (trim($names)) {
        $namesPlace = explode(',', $names);
        if (count($namesPlace) > 0) {
            $sqlStr = " ( ";
            foreach ($namesPlace as $key => $list) {
                if ($key == 0) {
                    $_or = "";
                } else {
                    $_or = " OR ";
                }
                $sqlStr .= $_or . " category_name like '%" . trim(mb_strtolower($list)) . "' ";
            }
            $sqlStr .= " ) ";
            $data = 'App\Models\Category'::where('parent_id', '<>', 0)
                ->whereRaw($sqlStr)
                ->pluck('id');
            return $data ? json_encode($data) : null;
        }
    }
}
function getdepartmentidsfirst($names)
{
    if (trim($names)) {
        $namesPlace = explode(',', $names);
        if (count($namesPlace) > 0) {
            return $namesPlace[0];
        }
    }
}
function getdepartmentids($names)
{
    if (trim($names)) {
        $namesPlace = explode(',', $names);
        if (count($namesPlace) > 0) {
            $sqlStr = " ( ";
            foreach ($namesPlace as $key => $list) {
                if ($key == 0) {
                    $_or = "";
                } else {
                    $_or = " OR ";
                }
                $sqlStr .= $_or . " department_name like '%" . trim(mb_strtolower($list)) . "' ";
            }
            $sqlStr .= " ) ";
            // dd( $sqlStr);
            $data = 'App\Models\Department'::whereRaw($sqlStr)
                ->pluck('id')->toArray();
            // dd( $data );
            return ($data && count($data) > 0) ? implode(',', $data) : null;
        }
    }
}
function getDepartments($arr)
{
    if (count($arr) > 0) {
        $data = 'App\Models\Department'::whereIn('id', $arr)
            ->pluck('department_name')->toArray();
        return ($data && count($data) > 0) ? implode(', ', $data) : null;
    }
}
function getSubCategories()
{
    $data = 'App\Models\Category'::where('status', 1)->where('parent_id', '<>', 0)->get();
    return $data ? $data : null;
}
function getTotalPartnerEnquires($fromToDate, $type = null)
{
    // if ($fromToDate) {
    //     $fromToDateArr = explode(' - ', $fromToDate);
    //     if (count($fromToDateArr) == 2) {
    //         $From = date('Y-m-d H:i:s', strtotime($fromToDateArr[0]));
    //         $To = date('Y-m-d 23:59:59', strtotime($fromToDateArr[1]));
    //         $isBet = true;
    //     } else {
    //         $From = date('Y-m-d 00:00:01');
    //         $To = date('Y-m-d 23:59:58');
    //         $isBet = false;
    //     }
    // } else {
    //     $From = date('Y-m-d 00:00:01');
    //     $To = date('Y-m-d 23:59:58');
    //     $isBet = false;
    // }

    // $data = 'App\Models\PartnerEnquiry'::when($type, function ($data) use ($type) {
    //     if ($type) {

    //         $data->where('status', '=',  $type);
    //     }
    // })->where('created_at', '>=', $From)->where('created_at', '<', $To)->count();

    return   0;
}
function getTotalPartnerEnquiresUpdated($fromToDate, $type = null)
{
    // if ($fromToDate) {
    //     $fromToDateArr = explode(' - ', $fromToDate);
    //     if (count($fromToDateArr) == 2) {
    //         $From = date('Y-m-d H:i:s', strtotime($fromToDateArr[0]));
    //         $To = date('Y-m-d 23:59:59', strtotime($fromToDateArr[1]));
    //         $isBet = true;
    //     } else {
    //         $From = date('Y-m-d 00:00:01');
    //         $To = date('Y-m-d 23:59:58');
    //         $isBet = false;
    //     }
    // } else {
    //     $From = date('Y-m-d 00:00:01');
    //     $To = date('Y-m-d 23:59:58');
    //     $isBet = false;
    // }

    // $data = 'App\Models\PartnerEnquiry'::when($type, function ($data) use ($type, $From,  $To) {
    //     if ($type) {

    //         $data->where('status', '=',  $type);
    //         $data->where('updated_at', '>=', $From)->where('updated_at', '<', $To);
    //     }
    // })->count();

    return 0;
}
function getTotalEnquires($fromToDate, $type = null)
{
    if ($fromToDate) {
        $fromToDateArr = explode(' - ', $fromToDate);
        if (count($fromToDateArr) == 2) {
            $From = date('Y-m-d H:i:s', strtotime($fromToDateArr[0]));
            $To = date('Y-m-d 23:59:59', strtotime($fromToDateArr[1]));
            $isBet = true;
        } else {
            $From = date('Y-m-d 00:00:01');
            $To = date('Y-m-d 23:59:58');
            $isBet = false;
        }
    } else {
        $From = date('Y-m-d 00:00:01');
        $To = date('Y-m-d 23:59:58');
        $isBet = false;
    }

    $data = 'App\Models\Query'::where('type', 2)->when($type, function ($data) use ($type) {
        if ($type) {
            if ($type == 'new') {
                $is_new = 0;
            } elseif ($type == 'pending') {
                $is_new = 1;
            } elseif ($type == 'converted') {
                $is_new = 2;
            }
            $data->where('is_lead_converted', '=',  $is_new);
        }
    })->where('created_at', '>=', $From)->where('created_at', '<', $To)->count();

    return $data ? $data : 0;
}
function getTotalEnquiresUpdated($fromToDate, $type = null)
{
    if ($fromToDate) {
        $fromToDateArr = explode(' - ', $fromToDate);
        if (count($fromToDateArr) == 2) {
            $From = date('Y-m-d H:i:s', strtotime($fromToDateArr[0]));
            $To = date('Y-m-d 23:59:59', strtotime($fromToDateArr[1]));
            $isBet = true;
        } else {
            $From = date('Y-m-d 00:00:01');
            $To = date('Y-m-d 23:59:58');
            $isBet = false;
        }
    } else {
        $From = date('Y-m-d 00:00:01');
        $To = date('Y-m-d 23:59:58');
        $isBet = false;
    }

    $data = 'App\Models\Query'::where('type', 2)->when($type, function ($data) use ($type) {
        if ($type) {
            if ($type == 'new') {
                $is_new = 0;
            } elseif ($type == 'pending') {
                $is_new = 1;
            } elseif ($type == 'converted') {
                $is_new = 2;
            }
            $data->where('is_lead_converted', '=',  $is_new);
        }
    })->where('updated_at', '>=', $From)->where('updated_at', '<', $To)->count();

    return $data ? $data : 0;
}
function getTotalCentres($fromToDate = null, $type = null)
{
    if ($fromToDate) {
        $fromToDateArr = explode(' - ', $fromToDate);
        if (count($fromToDateArr) == 2) {
            $From = date('Y-m-d H:i:s', strtotime($fromToDateArr[0]));
            $To = date('Y-m-d 23:59:59', strtotime($fromToDateArr[1]));
            $isBet = true;
        } else {
            $From = date('Y-m-d 00:00:01');
            $To = date('Y-m-d 23:59:58');
            $isBet = false;
        }
    } else {
        $From = date('Y-m-d 00:00:01');
        $To = date('Y-m-d 23:59:58');
        $isBet = false;
    }

    $data = 'App\Models\Centre'::when($type, function ($data) use ($type) {
        if ($type) {
            if ($type == 'active') {
                $is_new = 1;
            } elseif ($type == 'inactive') {
                $is_new = 0;
            }
            $data->where('status', '=',  $is_new);
        }
    })->when($isBet, function ($data) use ($isBet, $From, $To) {
        if ($isBet) {
            $data->where('created_at', '>=', $From)->where('created_at', '<', $To);
        }
    })->count();

    return $data ? $data : 0;
}
function getTotalDoctors($fromToDate = null, $type = null)
{
    if ($fromToDate) {
        $fromToDateArr = explode(' - ', $fromToDate);
        if (count($fromToDateArr) == 2) {
            $From = date('Y-m-d H:i:s', strtotime($fromToDateArr[0]));
            $To = date('Y-m-d 23:59:59', strtotime($fromToDateArr[1]));
            $isBet = true;
        } else {
            $From = null;
            $To = null;
            $isBet = false;
        }
    } else {
        $From = null;
        $To = null;
        $isBet = false;
    }

    $data = 'App\Models\Doctor'::when($type, function ($data) use ($type) {
        if ($type) {
            if ($type == 'active') {
                $is_new = 1;
            } elseif ($type == 'inactive') {
                $is_new = 0;
            }
            $data->where('status', '=',  $is_new);
        }
    })->when($isBet, function ($data) use ($isBet, $From, $To) {
        if ($isBet) {
            $data->where('created_at', '>=', $From)->where('created_at', '<', $To);
        }
    })->count();

    return $data ? $data : 0;
}
function getTotalQueries($fromToDate, $type = null)
{
    if ($fromToDate) {
        $fromToDateArr = explode(' - ', $fromToDate);

        if (count($fromToDateArr) == 2) {
            $From = date('Y-m-d H:i:s', strtotime($fromToDateArr[0]));
            $To = date('Y-m-d 23:59:59', strtotime($fromToDateArr[1]));
            $isBet = true;
        } else {
            $From = date('Y-m-d 00:00:01');
            $To = date('Y-m-d 23:59:59');
            $isBet = true;
        }
    } else {
        $From = null;
        $To = null;
        $isBet = false;
    }

    $data = 'App\Models\Query'::where('type', '=', 1)->when($type, function ($data) use ($type) {
        if ($type) {
            if ($type == 'active') {
                $is_new = 1;
            } elseif ($type == 'inactive') {
                $is_new = 0;
            }
            $data->where('status', '=',  $is_new);
        }
    })->when($isBet, function ($data) use ($isBet, $From, $To) {
        if ($isBet) {
            $data->where('created_at', '>=', $From)->where('created_at', '<', $To);
        }
    })->count();

    return $data ? $data : 0;
}
function getTotalOrders($fromToDate, $type = null)
{
    if ($fromToDate) {
        $fromToDateArr = explode(' - ', $fromToDate);

        if (count($fromToDateArr) == 2) {
            $From = date('Y-m-d H:i:s', strtotime($fromToDateArr[0]));
            $To = date('Y-m-d 23:59:59', strtotime($fromToDateArr[1]));
            $isBet = true;
        } else {
            $From = date('Y-m-d 00:00:01');
            $To = date('Y-m-d 23:59:59');
            $isBet = true;
        }
    } else {
        $From = null;
        $To = null;
        $isBet = false;
    }

    $data = 'App\Models\Order'::when($type, function ($data) use ($type) {
        if ($type) {
            $data->where('order_status', '=',  $type);
        }
    })->when($isBet, function ($data) use ($isBet, $From, $To) {
        if ($isBet) {
            $data->where('created_at', '>=', $From)->where('created_at', '<', $To);
        }
    })->count();

    return $data ? $data : 0;
}
function getTotalOrdersUpdated($fromToDate, $type = null)
{
    if ($fromToDate) {
        $fromToDateArr = explode(' - ', $fromToDate);

        if (count($fromToDateArr) == 2) {
            $From = date('Y-m-d H:i:s', strtotime($fromToDateArr[0]));
            $To = date('Y-m-d 23:59:59', strtotime($fromToDateArr[1]));
            $isBet = true;
        } else {
            $From = date('Y-m-d 00:00:01');
            $To = date('Y-m-d 23:59:59');
            $isBet = true;
        }
    } else {
        $From = null;
        $To = null;
        $isBet = false;
    }

    $data = 'App\Models\Order'::when($type, function ($data) use ($type) {
        if ($type) {
            $data->where('order_status', '=',  $type);
        }
    })->when($isBet, function ($data) use ($isBet, $From, $To) {
        if ($isBet) {
            $data->where('updated_at', '>=', $From)->where('updated_at', '<', $To);
        }
    })->count();

    return $data ? $data : 0;
}
function getSystemRoles($role = null)
{
    $data = 'App\Models\Role'::when($role, function ($data) use ($role) {
        if ($role) {
            $data->where('id', '=',  $role);
        }
    })->get();
    return $data;
}
function getCompanyRoles($role = null) {
    $data = 'App\Models\Company\Role'::when($role, function ($data) use ($role) {
        if ($role) {
            $data->where('id', '=',  $role);
        }
    })->get();
    return $data;
}
function generateHistory($array)
{
    $data = 'App\Models\OrderHistory'::create($array);
    return $data;
}
function getFacilities()
{
    $data = 'App\Models\Facility'::get();
    return $data;
}
function getActiveTests($limit)
{
    $data = 'App\Models\PathologyTest'::when($limit, function ($data) use ($limit) {
        if ($limit) {
            $data->limit($limit);
        }
    })
        ->get();
    return $data;
}
function GenerateEnquireHistory($array)
{
    $data = 'App\Models\EnquireHistory'::insert($array);
    return $data;
}
function getJobTitle($JobId)
{
    $cateDetails = App\Models\Job::where('id', $JobId)->first();
    if ($cateDetails) {
        return  $cateDetails->job_title;
    }
}
function getCityName($cityId)
{
    $cateDetails = 'App\Models\City'::where('id', $cityId)->first();
    if ($cateDetails) {
        return  $cateDetails->name;
    }
}
function getStates()
{
    $cateDetails = 'App\Models\State'::where('status', 1)->get();
    if ($cateDetails) {
        return  $cateDetails;
    }
}

if (! function_exists('preparePhoneNumber')) {
    function preparePhoneNumber($phone, $regionCode)
    {
        return (! empty($phone)) ? '+'.$regionCode.$phone : null;
    }
}

function companyType()
{
    return [
        [
            'id' => 1,
            'name' => 'Private Limited Company'
        ],
        [
            'id' => 2,
            'name' => 'Public Limited Company'
        ],
        [
            'id' => 3,
            'name' => 'Section 8 Company (NGO)'
        ],
        [
            'id' => 4,
            'name' => 'Micro Companies'
        ],
        [
            'id' => 5,
            'name' => 'Small Companies'
        ],
        [
            'id' => 6,
            'name' => 'Medium Companies'
        ],
        [
            'id' => 7,
            'name' => 'Limited By Shares'
        ],
    ];
}

function getCategoryName($catId)
{
    $cateDetails = 'App\Models\Category'::where('id', $catId)->first();
    if ($cateDetails) {
        return  $cateDetails->category_name;
    }
}
function conditionalStatus($status)
{
    if ($status == '1') {
        $status = 1;
    }
    if ($status == '2') {
        $status = 0;
    }
    return $status;
}
function weekDaysArray()
{
    $array = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday',
    ];
    return $array;
}
function modulesList()
{
    return [
        [
            'id' => 1,
            'slug' => 'customers'
        ],
        [
            'id' => 2,
            'slug' => 'patients'
        ],
        [
            'id' => 3,
            'slug' => 'tests'
        ],
        [
            'id' => 4,
            'slug' => 'packages'
        ],
        [
            'id' => 5,
            'slug' => 'city'
        ],
        [
            'id' => 6,
            'slug' => 'categories'
        ],
        [
            'id' => 7,
            'slug' => 'departments'
        ],
        [
            'id' => 8,
            'slug' => 'specialities'
        ],
        [
            'id' => 9,
            'slug' => 'pgoptions'
        ],
        [
            'id' => 10,
            'slug' => 'facility'
        ],
        [
            'id' => 11,
            'slug' => 'centres'
        ],
        [
            'id' => 12,
            'slug' => 'doctors'
        ],
        [
            'id' => 13,
            'slug' => 'events'
        ],
        [
            'id' => 14,
            'slug' => 'cme'
        ],
        [
            'id' => 15,
            'slug' => 'queries'
        ],
        [
            'id' => 16,
            'slug' => 'enquires'
        ],
        [
            'id' => 17,
            'slug' => 'faqs'
        ],
        [
            'id' => 18,
            'slug' => 'testimonials'
        ],
        [
            'id' => 19,
            'slug' => 'seo'
        ],
        [
            'id' => 20,
            'slug' => 'jobs'
        ],
        [
            'id' => 21,
            'slug' => 'job-applications'
        ],
        [
            'id' => 22,
            'slug' => 'roles'
        ],
        [
            'id' => 23,
            'slug' => 'users'
        ],
        [
            'id' => 24,
            'slug' => 'settings'
        ],
        [
            'id' => 25,
            'slug' => 'dashboard'
        ],
        [
            'id' => 26,
            'slug' => 'orders'
        ],
        [
            'id' => 27,
            'slug' => 'offers'
        ],
        [
            'id' => 28,
            'slug' => 'pressrelease'
        ],
        [
            'id' => 29,
            'slug' => 'subcategories'
        ],
        [
            'id' => 30,
            'slug' => 'faqcategories'
        ],
        [
            'id' => 31,
            'slug' => 'partner'
        ],
        [
            'id' => 32,
            'slug' => 'newslettersubscription'
        ],
        [
            'id' => 33,
            'slug' => 'employer'
        ],
        [
            'id' => 34,
            'slug' => 'notification'
        ],
    ];
}

function jobApplicationStatus()
{
    $array = [
        1 => 'Pending',
        2 => 'Shortlisted',
        3 =>  'Rejected',
        4 =>  'Selected',
    ];
    return $array;
}

function getBrochures()
{
    return 'App\Models\Department'::select('brochures', 'department_name', 'id', 'is_brochures_page')->get();
}

function sendSMS($data)
{
    if (isset($data['mobile']) && !empty($data['mobile'])) {
        $curl = curl_init();
     
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
        // echo ($response); die;
    }
}

function messagesTemplateArray($data, $templateId)
{
    switch ($templateId) {
        case "":
            return  [
                'templateName' => 'send_otp',
                'templateId' => '',
                'senderId' => '',
                'template' => $data['otp'] . " is your OTP for  login OTP is valid for 10 minutes",

            ];
            break;



        default:
            return  [
                'templateName' => '',
                'templateId' => '',
                'senderId' => '',
                'template' =>  "",

            ];
    }
}

if (! function_exists('getCountries')) {
    function getCountries()
    {
        return 'App\Models\Country'::orderBy('name')->pluck('name', 'id');
    }
}
if (! function_exists('getCompanySize')) {
    function getCompanySize()
    {
        return 'App\Models\CompanySize'::pluck('size', 'id');
    }
}
if (! function_exists('getCareerLavel')) {
    function getCareerLavel()
    {
        return 'App\Models\CareerLevel'::get();
    }
}

if (! function_exists('getSkills')) {
    function getSkills()
    {
        return 'App\Models\Skill'::get();
    }
}
if (! function_exists('getLanguage')) {
    function getLanguage()
    {
        return 'App\Models\Language'::get();
    }
}

if (! function_exists('getMartialStatus')) {
    function getMartialStatus()
    {
        return 'App\Models\MaritalStatus'::get();
    }
}

if (!function_exists('getOwnerShipType')) {
    function getOwnerShipType(){
        return 'App\Models\OwnerShipType'::pluck('name', 'id');
    }
}

if (!function_exists('getJobExperience')) {
    function getJobExperience() {
        return 'App\Models\JobExperience'::where('status', 1)->get();
    }
}
if (!function_exists('getJobLicenseCertifications')) {
    function getJobLicenseCertifications() {
        return 'App\Models\JobLicenseCertification'::where('status', 1)->get();
    }
}

if (!function_exists('getAllCategories')) {
    function getAllCategories() {
        return 'App\Models\Category'::where('status', 1)->get();
    }
}

if (!function_exists('getJobQualifications')) {
    function getJobQualifications() {
        return 'App\Models\JobQualification'::where('status', 1)->get();
    }
}

if (!function_exists('getJobLocations')) {
    function getJobLocations() {
        $company_id = auth()->guard('company')->user()->id;
        return 'App\Models\CompanyLocation'::where('status', 1)->where('company_id', $company_id)->get();
    }
}

if (!function_exists('getJobPayWages')) {
    function getJobPayWages() {
        return 'App\Models\JobPayWages'::where('status', 1)->get();
    }
}

if (!function_exists('getCompanyLocationNameById')) {
    function getCompanyLocationNameById($id) {
        return 'App\Models\CompanyLocation'::where('id', $id)->first()->location_name;
    }
}
if (!function_exists('getJobTypeNameById')) {
    function getJobTypeNameById($id) {
        return 'App\Models\JobType'::where('id', $id)->first()->name;
    }
}
if (!function_exists('getJobCategoryNameById')) {
    function getJobCategoryNameById($id) {
        return 'App\Models\JobCategory'::where('id', $id)->first()->category_name;
    }
}
if (!function_exists('getjobExperienceNameById')) {
    function getjobExperienceNameById($id) {
        return 'App\Models\JobExperience'::where('id', $id)->first()->name;
    }
}

if (!function_exists('getLicenseCertificateNameById')) {
    function getLicenseCertificateNameById($id) {
        return 'App\Models\JobLicenseCertification'::where('id', $id)->first()->name;
    }
}


