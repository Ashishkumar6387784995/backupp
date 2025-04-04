<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;

use App\Models\Company\Role;
use App\Models\CompanyLocation;
use App\Models\Company\Rotas;
use App\Models\Company\ManageRoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use Log;
use DB;

class RotasController extends Controller
{
    public function index($id = 0)
    {
        try {
            $page_title = 'Roster';
            $page_description = '';
            $breadcrumbs = [
                [
                    'title' => 'Roster',
                    'url' => '',
                ]
            ];

            // Get the logged-in company user
            $loggedUser = auth()->guard('company')->user();
            $userId = $loggedUser->id;

            // Get all roles and locations for the user
            $roles = Role::all();
            $locations = CompanyLocation::where('status', 1)
                ->where('company_id', $userId)
                ->get();

            // Get all employees with their rotas for the logged-in company
            $employee = ManageRoleUser::with(['rotas'])->where('status', 1)
            ->where('admin_user_id', $userId)
            ->get();
            // dd($employee);
            // Get the current date
            $date = Carbon::now();

            // Set the start of the week to Monday
            $startOfWeek = $date->startOfWeek(Carbon::MONDAY); // Start of the week (Monday)

            // Create an array of the days of the week with their corresponding dates
            $daysOfWeek = [];
            for ($i = 0; $i < 7; $i++) {
                $daysOfWeek[] = $startOfWeek->copy()->addDays($i);
            }

            $editId = request('edit');
            $rowRoster = [];
            if (!empty($editId)) {
                $rowRoster = Rotas::find($editId);
            }
            // dd($rowRoster);
            // Return the view with the data
            return view('company.pages.rotas.index', compact(
                'page_title', 
                'page_description', 
                'breadcrumbs',
                'employee', 
                'roles', 
                'locations', 
                'daysOfWeek',
                'rowRoster'
            ));
        } catch (\Exception $e) {
            // Log the error and return a user-friendly message
            \Log::error('Error loading roster page: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error loading the roster page. Please try again later.');
        }
    }


    public function create(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id', // Ensure user exists
                'rotas_date' => 'required|date_format:d-m-Y', // Ensure it's a valid date in DD-MM-YYYY format
                'location_id' => 'required', // Ensure location exists
                'start_time' => 'required|date_format:H:i', // Ensure valid start time format
                'end_time' => 'required|date_format:H:i|after:start_time', // Ensure end time is after start time
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            // Extract the validated data
            $userId = $request->user_id;
            $rotas_date = $request->rotas_date;
            $location_id = $request->location_id;
            $start_time = $request->start_time;
            $end_time = $request->end_time;
            $break_time = $request->break_time ?? 0; // If break_time is not provided, default to 0
            $role_id = $request->role_id;
            $note = $request->note ?? ''; // Default empty string if no note is provided
            $create_by = auth()->guard('company')->user()->id;

            // Convert 'rotas_date' to the correct format 'YYYY-MM-DD'
            $rotas_date = \Carbon\Carbon::createFromFormat('d-m-Y', $rotas_date)->format('Y-m-d');

            // Create a new Rotas record
            $rotas = new Rotas;
            $rotas->user_id = $userId;
            $rotas->rotas_date = $rotas_date; // Store the formatted date (YYYY-MM-DD)
            $rotas->location_id = $location_id;
            $rotas->start_time = $start_time;
            $rotas->end_time = $end_time;
            $rotas->break_time = $break_time;
            $rotas->role_id = $role_id;
            $rotas->note = $note;
            $rotas->created_by = $create_by;

            // Save the new record to the database
            $rotas->save();

            // Redirect to a success page with a success message
            return redirect()->route('company.roaster.index')->with('success', 'Shift created successfully!');
        } catch (\Exception $e) {
            // In case of any exception, log it and show a user-friendly error
            \Log::error('Error creating rotas: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error creating the rotas. Please try again later.');
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required', // Ensure user exists
                'rotas_date' => 'required', // Ensure it's a valid date in DD-MM-YYYY format
                'location_id' => 'required', // Ensure location exists
                'start_time' => 'required|date_format:H:i', // Ensure valid start time format
                'end_time' => 'required|date_format:H:i|after:start_time', // Ensure end time is after start time
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $id = $request->id;
            if ($id) {
                
                $userId = $request->user_id;
                // $rotas_date = $request->rotas_date;
                $location_id = $request->location_id;
                $start_time = $request->start_time;
                $end_time = $request->end_time;
                $break_time = $request->break_time ?? 0; // If break_time is not provided, default to 0
                $role_id = $request->role_id;
                $note = $request->note ?? ''; // Default empty string if no note is provided
                $create_by = auth()->guard('company')->user()->id;

                // Convert 'rotas_date' to the correct format 'YYYY-MM-DD'
                
                $rotas = Rotas::find($id);
                // $rotas->rotas_date = $rotas_date; // Store the formatted date (YYYY-MM-DD)
                $rotas->location_id = $location_id;
                $rotas->start_time = $start_time;
                $rotas->end_time = $end_time;
                $rotas->break_time = $break_time;
                $rotas->role_id = $role_id;
                $rotas->note = $note;
                $rotas->created_by = $create_by;

                // Save the new record to the database
                $rotas->save();

                // Redirect to a success page with a success message
                return redirect()->route('company.roaster.index')->with('success', 'Shift Updated successfully!');
            }
        } catch (\Exception $e) {
            // In case of any exception, log it and show a user-friendly error
            \Log::error('Error creating rotas: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error creating the rotas. Please try again later.');
        }
    }

    

   

    public function destroyee(Request $request, $id)
    {
        if ($id) {
            $rotas = Rotas::find($id);
            $rotas->delete();
            return redirect()->route('company.roaster.index')->with('success', 'Shift deleted successfully!');
        } else {
            return redirect()->route('company.roaster.index')->withErrors('Id must be requred');
        }
    }

    public function clear_week()
    {
        $created_by = $_REQUEST['created_by'];
        $week = (!empty($_REQUEST['week'])) ? $_REQUEST['week'] : 0 ;
        $week = $week * 7;

        $employee_data = Employee::whereRaw('id = '.$created_by.' ')->first();
        $setting = [];
        if(!empty($employee_data->company_setting))
        {
            $setting = json_decode($employee_data->company_setting,true);
        }
        $start_day = (!empty($setting['company_week_start'])) ? $setting['company_week_start'] : 'monday';
        $week_date = Rotas::getWeekArray('Y-m-d',$week,$start_day);

        $location_id    = (!empty($_REQUEST['location_id'])) ? $_REQUEST['location_id'] : 0;
        $created_by     = (!empty($_REQUEST['created_by'])) ? $_REQUEST['created_by'] : 0;
        $end_date       = (!empty($_REQUEST['end_date'])) ? $_REQUEST['end_date'] : 0;
        $start_date     = (!empty($_REQUEST['start_date'])) ?  $_REQUEST['start_date'] : 0;

        $rotas = Rotas::WhereRaw('location_id = '.$location_id)
            ->WhereRaw('create_by = '.$created_by)
            ->WhereRaw('rotas_date BETWEEN "'.$week_date[0].'" AND "'.$week_date[6].'"');
        $rotas->delete();
        $array =  array('status'=>'success','msg'=> __('Delete Succsefully'));
        return $array;
    }

    public function week_sheet()
    {
        $userId = Auth::id();
        $user = Auth::user();
        $created_by = $user->get_created_by();

        $week = (!empty($_REQUEST['week'])) ? $_REQUEST['week'] * 7 : 0*7;

        $week1 = 0;
        if (!empty($_REQUEST['week'])) {
            $week1 = $_REQUEST['week'];
        }

        $location_id = (!empty($_REQUEST['location_id'])) ? $_REQUEST['location_id'] : 0;
        $role_id = $_REQUEST['role_id'];

        $employee_data = Employee::whereRaw('id = ' . $created_by . ' ')->first();
        $setting = [];
        if (!empty($employee_data->company_setting)) {
            $setting = json_decode($employee_data->company_setting, true);
        }

        $start_day = (!empty($setting['company_week_start'])) ? $setting['company_week_start'] : 'monday';
        $date_formate = User::CompanyDateFormat('d M Y');
        $week_date1 = Rotas::getWeekArray($date_formate, $week, $start_day);
        $week_date = Rotas::getWeekArray('Y-m-d', $week, $start_day);
        $week_date123 = Rotas::getWeekArray('d M Y', $week, $start_day);
        $where = '0 = 0 ';
        $emp_only_see_own_rota = 0;
        if (Auth::user()->acount_type == 3) {
            $employee_data = Employee::whereRaw('id = ' . $created_by . ' ')->first();
            if (!empty($employee_data->company_setting)) {
                $setting = json_decode($employee_data->company_setting, true);
                $emp_only_see_own_rota = (!empty($setting['emp_only_see_own_rota'])) ? $userId : 0;
            }
        }

        $table_date = [];
        $thead = '<thead> <tr class="text-center">
            <th></th>
            <th><span>' . __(date('D', strtotime($week_date1[0]))) . '</span><br><span>' . __($week_date1[0]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[1]))) . '</span><br><span>' . __($week_date1[1]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[2]))) . '</span><br><span>' . __($week_date1[2]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[3]))) . '</span><br><span>' . __($week_date1[3]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[4]))) . '</span><br><span>' . __($week_date1[4]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[5]))) . '</span><br><span>' . __($week_date1[5]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[6]))) . '</span><br><span>' . __($week_date1[6]) . '</span></th>
            </tr></thead>';
        $thead2 = '
            <th></th>
            <th><span>' . __(date('D', strtotime($week_date1[0]))) . '</span><br><span>' . __($week_date1[0]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[1]))) . '</span><br><span>' . __($week_date1[1]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[2]))) . '</span><br><span>' . __($week_date1[2]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[3]))) . '</span><br><span>' . __($week_date1[3]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[4]))) . '</span><br><span>' . __($week_date1[4]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[5]))) . '</span><br><span>' . __($week_date1[5]) . '</span></th>
            <th><span>' . __(date('D', strtotime($week_date1[6]))) . '</span><br><span>' . __($week_date1[6]) . '</span></th>';

        $employees = Rotas::getLocatioWiseUser($location_id, $emp_only_see_own_rota, $role_id);

        $tbody = '';
        if (count($employees) != 0) {
            foreach ($employees as $employee)
            {
                $tbody .= $employee->getWorkSchedule($employee->id, $week1, $location_id);
            }
        } else {
            $tbody = '<tr>
                        <td colspan="8">
                            <div class="text-center">
                                <i class="fas fa-map-marker-alt text-primary fs-40"></i>
                                <h2>' . __('Opps...') . '</h2>
                                <h6>' . __('User not assign this location.') . ' </h6>
                                <h6 class="d-none"> ' . __('Please assign user in this location.') . ' </h6>
                            </div>
                        </td>
                    </tr>';
        }

        // 2nd table in page bottom
        $week_exp = '';
        if(Auth::user()->type == 'company')
        {
            $week_exp = Employee::getCompanyWeeklyUserSalary($week1, $created_by, $location_id, $role_id);
        }

        $array = array('table' => $thead . '<tbody>' . $tbody . '</tbody><tfoot class="bt2"></tfoot>', 'title' => $week_date1[0] . ' - ' . $week_date1[6],'start_date' => $week_date1[0],'end_date' => $week_date1[6], 'week_exp' => $week_exp, 'thead' => $thead2);
        return $array;
    }

    public function shift_copy()
    {
        $array =  array('status'=>'error','msg'=> __('Please Try Again.'));

        $userId = Auth::id();
        $user = Auth::user();
        $created_by = $user->get_created_by();

        $drag_rotas_data = Rotas::whereRaw('id = '.$_POST['rotas_id'])->first()->toArray();
        $rotas_start_time = $drag_rotas_data['start_time'];
        $rotas_end_time = $drag_rotas_data['end_time'];
        $rotas_role_id = $drag_rotas_data['role_id'];

        $user_have_role = Profile::WhereRaw('user_id = '. $_REQUEST['drop_user_id'].' ')
                                    ->WhereRaw(' FIND_IN_SET('.$rotas_role_id.', role_id) ')
                                    ->count();
        if(Auth::user()->type == 'company'  || Auth::user()->acount_type == 1)
        {
            if ($user_have_role != 0 || $rotas_role_id == 0)
            {
                $time_override = Rotas::WhereRaw('user_id = '. $_REQUEST['drop_user_id'].' ')
                                    ->WhereRaw('rotas_date = "'.$_REQUEST['drop_date'].'"')
                                    ->WhereRaw('(
                                        ( start_time = "'.$rotas_start_time.'" AND end_time = "'.$rotas_end_time.'" ) or
                                        ("'.$rotas_start_time.'" BETWEEN start_time and end_time or "'.$rotas_end_time.'" BETWEEN start_time and end_time ) or
                                        (start_time BETWEEN "'.$rotas_start_time.'" and "'.$rotas_end_time.'" or end_time BETWEEN "'.$rotas_start_time.'" and "'.$rotas_end_time.'" )
                                        )')
                                    ->first();

                $role_name = '';
                $role_color = 'border-color : rgb(132, 146, 166);';
                if(!empty($rotas_role_id) || $rotas_role_id == 0) {
                    $role = Role::where('id', $rotas_role_id)->first();
                    if(!empty($role)) {
                        $role_name = $role->name;
                        $role_color = 'border-color : '.$role->color.';';
                    }
                }

                if(empty($time_override))
                {
                    $diff_in_minutes = 0;
                    $to = \Carbon\Carbon::createFromFormat('H:i', $rotas_start_time);
                    $from = \Carbon\Carbon::createFromFormat('H:i', $rotas_end_time);
                    if($from == $to)
                    {
                        $diff_in_minutes = 1440;
                    }
                    elseif($from > $to)
                    {
                        $diff_in_minutes = $to->diffInMinutes($from);
                    }
                    elseif($from < $to)
                    {
                        $to = $rotas_start_time;
                        $to_array = explode(':', $to);
                        $to_minutes = 1440 - ($to_array[0] * 60 + $to_array[1]);

                        $from = $rotas_end_time;
                        $from_array = explode(':', $from);
                        $from_minutes = $from_array[0] * 60 + $from_array[1];

                        $diff_in_minutes = $to_minutes + $from_minutes;
                    }

                    $rotas = new Rotas();
                    $rotas->user_id               = $_REQUEST['drop_user_id'];
                    $rotas->issued_by             = $userId;
                    $rotas->rotas_date            = $_REQUEST['drop_date'];
                    $rotas->start_time            = $rotas_start_time;
                    $rotas->end_time              = $rotas_end_time;
                    $rotas->time_diff_in_minut    = $diff_in_minutes;
                    $rotas->role_id               = $drag_rotas_data['role_id'];
                    $rotas->location_id           = $_REQUEST['location_id'];
                    $rotas->note                  = $drag_rotas_data['note'];
                    $rotas->publish               = 0;
                    $rotas->create_by             = $created_by;
                    $rotas->save();

                    $insert_id = $rotas->id;
                    $time = date('h:i a', strtotime($rotas_start_time)).' - '.date('h:i a', strtotime($rotas_end_time));
                    $shift = '<b class="text-dark">'.$time.'</b><br>
                                <span class="text-secondary"> '.$role_name.' </span>
                                <div class="float-right d-block">
                                    <a href="#" class="action-item only_rotas bg-transparent p-0  " data-toggle="tooltip" title="'.$drag_rotas_data['note'].'"><i class="fas fa-comment"></i></a>
                                    <a href="#" class=" action-item edit_rotas only_rotas bg-transparent p-0" data-ajax-popup="true" data-title="'.__('Edit Shift').'" data-size="md" data-url="'.route('rotas.edit', $insert_id).'">
                                        <i class="fas fa-pencil-alt" data-toggle="tooltip"  title="'.__('Edit Shift').'"></i>
                                    </a>

                                    <a href="#" class=" action-item delete_rotas only_rotas bg-transparent p-0" data-confirm="'. __('Are You Sure?') .'|'. __('This action can not be undone. Do you want to continue?') .'" data-confirm-yes=document.getElementById("delete-form-'.$insert_id.'").submit(); >
                                        <i class="fas fa-trash" data-toggle="tooltip" data-original-title="'.__('Delete').'" ></i>
                                    </a>
                                    <form method="POST" action="'.route('rotas.destroy',$insert_id).'" id="delete-form-'.$insert_id.'">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                    </form>
                                </div>
                                <sapn class="clearfix">
                            </sapn>';


                    $array =  array('status'=>'success', 'msg'=> __('Shift Add Successfully'), 'shift' => $shift, 'insert_id' => $insert_id);
                }
                else
                {
                    $employee = Employee::where('id', $_REQUEST['drop_user_id'])->first();
                    $name = (!empty($employee->first_name)) ? $employee->first_name : __(' employee ') ;
                    $msg = __('This Shift clashes ').''.$name.' '.date("g:i a", strtotime($time_override['start_time'])).' - '.date("g:i a", strtotime($time_override['end_time'])).' '.$role_name.''.__(' shift');
                    $array =  array('status'=>'error', 'msg'=> $msg);
                }
            }
            else
            {
                $array =  array('status'=>'error', 'msg'=> __('Roles are different for both the user.'));
            }
        }
        else
        {
            $array =  array('status'=>'error', 'msg'=> __('Permission denied.'));
        }
        return $array;
    }

    public function un_publish_week()
    {
        $array =  array('status'=>'error', 'msg'=> __('Please Try Again'));
        $userId = Auth::id();
        $user = Auth::user();
        $created_by = $user->get_created_by();

        $week = (!empty($_REQUEST['week'])) ? $_REQUEST['week'] * 7 : 0*7;
        $created_by = $_REQUEST['created_by'];
        $location_id = $_REQUEST['location_id'];

        $employee_data = Employee::whereRaw('id = '.$created_by.' ')->first();
        $setting = [];
        if(!empty($employee_data->company_setting))
        {
            $setting = json_decode($employee_data->company_setting,true);
        }
        $start_day = (!empty($setting['company_week_start'])) ? $setting['company_week_start'] : 'monday';
        $week_date = Rotas::getWeekArray('Y-m-d',$week,$start_day);
        $rotas = Rotas::whereRaw('location_id = '.$location_id.'')->whereRaw('create_by = '.$created_by.'')->whereRaw('rotas_date BETWEEN "'.$week_date[0].'" AND "'.$week_date[6].'" ')->get()->toArray();
        if(!empty($rotas))
        {
            foreach($rotas as $rota)
            {
                $rota_data = Rotas::find($rota['id']);
                $rota_data->publish = 0;
                $rota_data->save();
            }
            $array =  array('status'=>'success', 'msg'=> __('Shift Un-Publish Successfully'));
        }
        return $array;
    }

    public function publish_week()
    {
        $array =  array('status'=>'success', 'msg'=> __('Please Try Again'));
        $userId = Auth::id();
        $user = Auth::user();
        $created_by = $user->get_created_by();

        $week = (!empty($_REQUEST['week'])) ? $_REQUEST['week'] * 7 : 0*7;
        $created_by = $_REQUEST['created_by'];
        $location_id = $_REQUEST['location_id'];

        $employee_data = Employee::whereRaw('id = '.$created_by.' ')->first();
        $setting = [];
        if(!empty($employee_data->company_setting))
        {
            $setting = json_decode($employee_data->company_setting,true);
        }
        $start_day = (!empty($setting['company_week_start'])) ? $setting['company_week_start'] : 'monday';
        $week_date = Rotas::getWeekArray('Y-m-d',$week,$start_day);
        $rotas = Rotas::whereRaw('location_id = '.$location_id.'')->whereRaw('create_by = '.$created_by.'')->whereRaw('rotas_date BETWEEN "'.$week_date[0].'" AND "'.$week_date[6].'" ')->get()->toArray();
        if(!empty($rotas))
        {
            foreach($rotas as $rota)
            {
                $rota_data = Rotas::find($rota['id']);
                $rota_data->publish = 1;
                $rota_data->save();
            }
            $array =  array('status'=>'success', 'msg'=> __('Shift Publish Successfully'));
        }
        return $array;
    }

    public function add_dayoff()
    {
        $array =  array('status'=>'success', 'msg'=> __('Please Try Again'));
        $date[] = $_REQUEST['date'];
        $click_day = date('l', strtotime($_REQUEST['date']));

        $date_status = '';
        if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['date']))
        {
            $profile = Profile::whereRaw('user_id = '.$_REQUEST['user_id'].'')->first();
            if(!empty($profile->custom_day_off))
            {
                $date_array = json_decode($profile->custom_day_off, true);
                $date_inarray = in_array($_REQUEST['date'], $date_array);
                if($date_inarray) {
                    $remove_date = array_diff( $date_array, $date);
                    $date_array = (!empty($remove_date)) ? array_values($remove_date) : '' ;
                    $date_status = '';
                    $msg = __('Remove day off successfully');
                } else {
                    array_push( $date_array, $_REQUEST['date'] );
                    $date_status = 'add';
                    $date_status = '<div class="text-center text-danger day_off_leave cus_day_off_leave ui-sortable-handle" data-date="'.$_REQUEST['date'].'" data-placement="top" data-html="true" data-toggle="tooltip" title="'.__('This is').$profile->getUserName->first_name.__(' Day Off').'">'.__(' Day Off').'</div>';
                    $msg = __('Add day off successfully');
                    $settings  = Utility::settings(Auth::user()->ownerId());
                    if(isset($settings['days_off_notificaation']) && $settings['days_off_notificaation'] ==1){

                        $uArr = [
                            'employee_name' => $profile->getUserName->first_name,
                            'company_name'  => \Auth::user()->first_name,
                            'rota_date'  => $_REQUEST['date'],
                        ];
                        Utility::send_slack_msg('days_off',$uArr);

                        // $mesg = __('Day off to date the ').$_REQUEST['date'].'.';
                        // Utility::send_slack_msg($mesg);

                    }
                    if(isset($settings['telegram_days_off_notificaation']) && $settings['telegram_days_off_notificaation'] ==1){
                        $uArr = [
                            'employee_name' => $profile->getUserName->first_name,
                            'company_name'  => \Auth::user()->first_name,
                            'rota_date'  => $_REQUEST['date'],
                        ];
                        Utility::send_telegram_msg('days_off',$uArr);

                        // $resp = __('Day off to date the ').$_REQUEST['date'].'.';
                        // Utility::send_telegram_msg($resp);
                    }
                }
            } else {
                $date_array[] = $_REQUEST['date'];
                $date_status = 'add';
                $date_status = '<div class="text-center text-danger day_off_leave cus_day_off_leave ui-sortable-handle" data-date="'.$_REQUEST['date'].'" data-placement="top" data-html="true" data-toggle="tooltip" title="'.__('This is').$profile->getUserName->first_name.__(' Day Off').'">'.__(' Day Off').'</div>';
                $msg = __('Add day off successfully');
                 $settings  = Utility::settings(Auth::user()->ownerId());
                    if(isset($settings['days_off_notificaation']) && $settings['days_off_notificaation'] ==1){

                        $uArr = [
                            'employee_name' => $profile->getUserName->first_name,
                            'company_name'  => \Auth::user()->first_name,
                            'rota_date'  => $_REQUEST['date'],
                        ];
                        Utility::send_slack_msg('days_off',$uArr);
                        // $mesg = __('Day off to date the ').$_REQUEST['date'].'.';
                        // Utility::send_slack_msg($mesg);
                    }
                    if(isset($settings['telegram_days_off_notificaation']) && $settings['telegram_days_off_notificaation'] ==1){

                        $uArr = [
                            'employee_name' => $profile->getUserName->first_name,
                            'company_name'  => \Auth::user()->first_name,
                            'rota_date'  => $_REQUEST['date'],
                        ];
                        Utility::send_telegram_msg('days_off',$uArr);
                        // $resp = __('Day off to date the ').$_REQUEST['date'].'.';
                        // Utility::send_telegram_msg($resp);
                    }
            }

            $profile->custom_day_off = (!empty($date_array)) ? json_encode($date_array) : null ;
            $profile->save();

            $module ='Days Off';
            $webhook=  Utility::webhookSetting($module);
            if($webhook)
            {
                $parameter = json_encode($date_array);
                // 1 parameter is  URL , 2 parameter is data , 3 parameter is method
                $status = Utility::WebhookCall($webhook['url'],$parameter,$webhook['method']);
            }
            $array =  array('status'=>'success', 'msg'=> $msg,'date_status' => $date_status, 'date' => $_REQUEST['date']);
        }
        return response()->json($array);
    }

    public function add_remove_employee_popup(Request $request)
    {
        $location = $_REQUEST['loaction'];
        $create_by = $_REQUEST['create_by'];
        $users = User::where('id',$create_by)->orwhere('created_by',$create_by)->get();
        $user_array = [];
        $id_array = [];
        if(!empty($users)) {
            $id_array = array_column($users->toArray(), 'id');
            foreach($users as $key => $user)
            {
                $has_location = Profile::whereRaw(' FIND_IN_SET('. $location.', location_id)')->where('user_id',$user['id'])->first();
                $user_array[$key]['name'] = (!empty($user['first_name'])) ? $user['first_name'] : $user['last_name'];
                $user_array[$key]['profile_id'] = (!empty($user['id'])) ? $user['id'] : 0;
                $user_array[$key]['has_location'] = (!empty($has_location)) ? true : false;
                $user_array[$key]['loaction_id'] = (!empty($location)) ? $location : 0;
            }
        }
        $id_array  = json_encode($id_array);
        $employee  = 'employee';
        return view('rotas.addremoveemployee',compact('user_array','id_array','employee','location'));
    }

    public function add_remove_employee(Request $request)
    {
        $request_data = $request->all();
        $id_array = $request->id_array;
        $location = $request->location;
        $location_arr[] = $request->location;

        unset($request_data['id_array']);
        unset($request_data['location']);

        $name = [];
        $add_data = [];
        if(!empty($request_data))
        {
            foreach($request_data as $key => $data)
            {
                $add_data[] =  $key;

                $user_data = Profile::whereRaw('user_id ='.$key.'')->first();
                if(!empty($user_data['location_id']))
                {
                    $loation_array = explode(',',$user_data['location_id']);
                    if(!empty($loation_array) && !in_array($location, $loation_array))
                    {
                        array_push($loation_array, $location);
                    }
                    $user_data->location_id = implode(',',$loation_array);
                }
                else
                {
                    $user_data->location_id = $location;
                }
                $user_data->save();
            }
        }

        $remove_datas = [];
        if(!empty($id_array))
        {
            $id_array = json_decode($id_array, true);
            if(!empty($add_data))
            {
                $remove_datas = array_diff($id_array,$add_data);
                if(!empty($remove_datas))
                {
                    $remove_datas = array_values($remove_datas);
                }
            }
            else
            {
                $remove_datas = $id_array;
            }

            if(!empty($remove_datas))
            {
                foreach($remove_datas as $remove_data)
                {
                    $remove_location = Profile::whereRaw('user_id ='.$remove_data.'')->first();

                    $today_date = date("Y-m-d");
                    $has_rotas = Rotas::whereRaw('user_id ='.$remove_data.'')
                                        ->whereRaw('rotas_date >= "'.$today_date.'"')
                                        ->whereRaw('publish >= 1')
                                        ->count();

                    if($has_rotas == 0)
                    {
                        if(!empty($remove_location['location_id']))
                        {
                            $re_loation_array = explode(',', $remove_location['location_id']);

                            if(!empty($re_loation_array) && in_array($location, $re_loation_array))
                            {
                                $key2 = array_search($location, $re_loation_array);

                                if (false !== $key2) {
                                    unset($re_loation_array[$key2]);
                                }

                                $remove_location->location_id = implode(',', $re_loation_array);
                                $remove_location->save();
                            }
                        }
                    }
                    else
                    {
                        $emp_data =  User::whereRaw('id='.$remove_data.'')->first();
                        $name[] = $emp_data['first_name'];
                    }
                }
            }
        }
        $name = (!empty($name)) ? ' <br> <span class="text-danger">'.implode(', ',$name).__(' has shift') : '</span>' ;
        return redirect()->back()->with('success', __('Employee Remove this location').''.$name);
    }

    public function send_email_rotas()
    {
        $week = 0;
        $location_id = $_REQUEST['location_id'];

        $user = Auth::user();
        $created_by = $user->get_created_by();

        $date = Employee::week_day_by_setting($_REQUEST['week'], $created_by);

        $has_users = User::where('id', $created_by)->orwhere('created_by', $created_by)->get()->toArray();

        $all_role = Role::where('created_by', $created_by)->get()->toArray();
        $role_datas = [];
        if (!empty($all_role)) {
            foreach ($all_role as $role_data) {
                $role_datas[$role_data['id']] = $role_data['name'];
            }
        }

        $all_locations = Location::where('created_by', $created_by)->get()->toArray();
        $location_datas = [];
        if (!empty($all_locations)) {
            foreach ($all_locations as $all_location) {
                $location_datas[$all_location['id']] = $all_location['name'];
            }
        }

        if (!empty($has_users)) {
            foreach ($has_users as $has_user) {
                $rotas_data = Rotas::whereRaw('user_id =' . $has_user['id'] . '')->whereRaw('publish = 1')->whereRaw(' rotas_date BETWEEN "' . $date[0] . '" AND "' . $date[6] . '"')->orderBy('rotas_date', 'ASC')->get()->toArray();
              //  echo "<pre>";
               // print_r($rotas_data); 
                if (!empty($has_user['email'])) {
                    $smtp_error = '';
                    try {
                        Mail::to($has_user['email'])->send(new SendRotas($rotas_data, $role_datas, $location_datas, $has_user['id'], $date));
                    } catch (\Exception $e) {
                        $smtp_error = '<br><span class="text-danger">' . __('E-Mail has been not sent due to SMTP configuration') . '<span>';
                    }
                }
            } //die;
        }
        return response()->json([
            'status' => 'success',
            'message' => __('Mail Send Successfully') . $smtp_error
        ]);
    }

    public function print_rotas_popup(Request $request)
    {
        $week       = $request->week;
        $loaction   = $request->location_id;
        $create_by  = $request->created_by;
        $role_id    = $request->role_id;

        $where = ' 0 = 0 ';

        $location_id = $request->loaction;
        if ($location_id != 0 && !empty($location_id)) {
            $where .= ' AND FIND_IN_SET(' . $location_id . ', profiles.location_id) ';
        }

        $role_id = $request->role_id;
        if ($role_id != 0 && !empty($role_id)) {
            $where .= ' AND FIND_IN_SET(' . $role_id . ', profiles.role_id) ';
        }

        $create_by = $request->create_by;
        if ($create_by != 0 && !empty($create_by)) {
            $where .= ' AND users.created_by = ' . $create_by . ' ';
        }

        $users = Profile::join('users', 'users.id', '=', 'profiles.user_id')->whereraw($where)->get();

        $user_array = [];
        if ($users) {
            foreach ($users as $key => $user) {
                $user_array[$key]['id'] = $user->id;
                $user_array[$key]['name'] = $user->first_name . ' ' . $user->last_name;
            }
        }
        return view('rotas.printrotas', compact('user_array', 'week', 'location_id', 'create_by', 'role_id'));
    }


    public function export_rotas_popup(Request $request)
    {
        $week       = $request->week;
        $loaction   = $request->location_id;
        $create_by  = $request->created_by;
        $role_id    = $request->role_id;

        $where = ' 0 = 0 ';

        $location_id = $request->loaction;
        if ($location_id != 0 && !empty($location_id)) {
            $where .= ' AND FIND_IN_SET(' . $location_id . ', profiles.location_id) ';
        }

        $role_id = $request->role_id;
        if ($role_id != 0 && !empty($role_id)) {
            $where .= ' AND FIND_IN_SET(' . $role_id . ', profiles.role_id) ';
        }

        $create_by = $request->create_by;
        if ($create_by != 0 && !empty($create_by)) {
            $where .= ' AND users.created_by = ' . $create_by . ' ';
        }

        $users = Profile::join('users', 'users.id', '=', 'profiles.user_id')->whereraw($where)->get();

        $user_array = [];
        if ($users) {
            foreach ($users as $key => $user) {
                $user_array[$key]['id'] = $user->id;
                $user_array[$key]['name'] = $user->first_name . ' ' . $user->last_name;
            }
        }
        return view('rotas.exportrota', compact('user_array', 'week', 'location_id', 'create_by', 'role_id'));
    }

    public function printrotasInvoice(Request $request)
    {
        if (!empty($request->user)) {
            $user_array = $request->user;
            $week = $request->week * 7;
            $role_id = $request->role_id;

            $settings = User::companystaticSetting();
            $start_day = (!empty($settings['company_week_start'])) ? $settings['company_week_start'] : 'monday';
            $week_date = Rotas::getWeekArray('Y-m-d', $week, $start_day);

            $company_date_format = (!empty($settings['company_date_format'])) ? $settings['company_date_format'] : 'd M Y';
            $week_date_formate = Rotas::getWeekArray($company_date_format, $week, $start_day);
            $location_data = Location::find($request->location_id);

            $users_name = [];
            if (!empty($user_array)) {
                foreach ($user_array as $key => $value) {
                    $user_data = User::where('id', $value)->first();
                    $users_name[$key]['id'] = $value;
                    $users_name[$key]['name'] = $user_data->first_name;
                }
            }
    //echo "<pre>";
    //print_r($users_name); die;
            $logo = asset(Storage::url('uploads/logo/'));
            $settting = Utility::settings(Auth::user()->get_created_by());
            $logo_path = $logo . '/' . $settting['company_logo'];

            return view('rotas.rotastable', compact('week_date_formate', 'week_date', 'users_name', 'logo_path', 'location_data', 'role_id'));
        } else {
            return redirect()->back()->with('errors', __('Please select User'));
        }
    }

    public function exportrotasInvoice(Request $request)
    {
        if (!empty($request->user)) {
            $user_array = $request->user;
            $week = $request->week * 7;
            $role_id = $request->role_id;
            $settings = User::companystaticSetting();
            $start_day = (!empty($settings['company_week_start'])) ? $settings['company_week_start'] : 'monday';
            $week_date = Rotas::getWeekArray('Y-m-d', $week, $start_day);
            $company_date_format = (!empty($settings['company_date_format'])) ? $settings['company_date_format'] : 'd M Y';
            $week_date_formate = Rotas::getWeekArray($company_date_format, $week, $start_day);
            $location_data = Location::find($request->location_id);

            $users_name = [];
            if (!empty($user_array)) {
                foreach ($user_array as $key => $value) {
                    $user_data = User::where('id', $value)->first();
                    $users_name[$key]['id'] = $value;
                    $users_name[$key]['name'] = $user_data->first_name;
                }
            }

            $logo = asset(Storage::url('uploads/logo/'));
            $settting = Utility::settings(Auth::user()->get_created_by());
            $logo_path = $logo . '/' . $settting['company_logo'];

            return view('rotas.expotrotastable', compact('week_date_formate', 'week_date', 'users_name', 'logo_path', 'location_data', 'role_id'));
        } else {
            return redirect()->back()->with('errors', __('Please select User'));
        }
    }

    public function shift_cancel(Request $request, $id)
    {
        $rota = Rotas::find($id);
        return view('rotas.shift_cancel', compact('rota'));
    }

    public function shift_disable(Request $request)
    {
        $rota_id = $request->rota_id;
        $shift_status = $request->shift_status;
        $shift_cancel_employee_msg = $request->shift_cancel_employee_msg;
        $rota_id = Rotas::find($rota_id);
        $rota_id->shift_status = $request->shift_status;
        $rota_id->shift_cancel_employee_msg = $request->shift_cancel_employee_msg;
        $rota_id->save();

        $module ='Cancel Rotas';
        $webhook=  Utility::webhookSetting($module);
        if($webhook)
        {
            $parameter = json_encode($rota_id);
            // 1 parameter is  URL , 2 parameter is data , 3 parameter is method
            $status = Utility::WebhookCall($webhook['url'],$parameter,$webhook['method']);
        }

        return redirect()->back()->with('success', __('Shift unavailability request sent.'));
    }

    public function shift_disable_response(Request $request, $id)
    {
        $rota_id = $id;
        $rota = Rotas::find($id);
        $user_data = User::find($rota->user_id);
        $f_name = $user_data->first_name;

        $name = (!empty(trim($f_name))) ? $f_name : __('User');
        $msg = $name . __(' has requested unavailability for this shift.');
        return view('rotas.shift_cancel_response', compact('rota', 'msg'));
    }

    public function shift_disable_reply(Request $request)
    {
        $rota = Rotas::find($request->rota_id);
        $rota->shift_status = $request->shift_status;
        $rota->shift_cancel_owner_msg = $request->shift_cancel_owner_msg;
        $rota->save();
        $stutas = ($request->shift_status == 'disable') ? __('Approve') : __('Deny');
        return redirect()->back()->with('success', __('Shift Request ') . $stutas . '.');
    }

    public function share_rotas_popup(Request $request)
    {
        $rota['loaction_id']  = $request->loaction;
        $rota['role_id']      = $request->role_id;
        $rota['create_by']    = $request->create_by;
        $rota['week']         = $request->week;
        $rota['user_array']   = $request->user;
        return view('rotas.shift_share', compact('rota'));
    }

    public function share_rotas_link(Request $request)
    {
        $query_string['location'] = $request->location;
        $query_string['create_by'] = $request->create_by;
        $query_string['role_id'] = $request->role_id;
        $query_string['week'] = $request->week;
        $query_string['user_array'] = $request->user_array;
        $query_string['share_password'] = $request->share_password;
        $query_string['password_sts'] = (!empty($request->share_password)) ? 1 : 0;
        $query_string['expiry_date'] = $request->expiry_date;
        $enc_url = Crypt::encrypt($query_string);
        $url = route('rotas.share', $enc_url);
        return response()->json([
            'status' => 'success',
            'message' => $url
        ]);
    }

    public function share_rotas(Request $request, $slug)
    {
        try{
            $decrypted_array = Crypt::decrypt($slug);
            $user_array     = $decrypted_array['user_array'];
            $location       = $decrypted_array['location'];
            $create_by      = $decrypted_array['create_by'];
            $role_id        = $decrypted_array['role_id'];
            $week           = $decrypted_array['week'];
            $password_sts   = $decrypted_array['password_sts'];
            $expiry_date    = $decrypted_array['expiry_date'];

            if (!empty($decrypted_array['share_password'])) {
                $password       = $decrypted_array['share_password'];
            } else {
                $password       = '';
            }

            $location = Location::find($location);

            $users_name = User::whereraw('id in (' . $user_array . ')')->get();
            if (empty($users_name)) {
                $users_name = [];
            }

            $week_date = Rotas::getWeekArray('Y-m-d', $week*7, 'monday');

            $logo = asset(Storage::url('uploads/logo/'));
            $settting = Utility::settings(0);
            $logo_path = $logo . '/' . $settting['company_logo'];

            $date = date('Y-m-d');
            $date_sts = 1;
            if (!empty($expiry_date) && $expiry_date < $date) {
                $date_sts = 0;
                $msg = __('This link is expired.');
                return view('rotas.share_shift_table', compact('logo_path', 'msg', 'date_sts'));
            }

            if ($password_sts == 1) {
                return view('rotas.share_shift_table', compact('logo_path', 'password_sts', 'slug', 'location', 'week_date', 'role_id', 'user_array', 'date_sts'));
            } else {
                $compact = ['logo_path', 'users_name', 'week_date', 'location', 'password_sts', 'role_id', 'user_array', 'date_sts'];
                return view('rotas.share_shift_table', compact($compact));
            }
        }
        catch(\Exception $e)
        {
            return redirect()->route('login')->with('error', __($e->getMessage()));
        }
    }

    public function slug_match(Request $request)
    {
        $confirm_password = $request->confirm_password;
        $slug = $request->slug;
        $decrypted_array = Crypt::decrypt($slug);

        if ($decrypted_array['share_password'] ==  $confirm_password) {
            $decrypted_array['password_sts'] = 0;
            $enc_url = Crypt::encrypt($decrypted_array);
            $return['status'] = 'success';
            $url = route("rotas.share", $enc_url);
            $return['url'] = $enc_url;
        } else {
            $return['status'] = 'error';
        }

        return response()->json($return);
    }

    public function rota_date_change(Request $request)
    {
        $s_date = $request->s_date;
        $e_date = $request->e_date;
        $ff = Utility::displayDates($s_date, $e_date, 'Y-m-d');
        if(count($ff) > 7) {
            $return['status'] = 0;
            $return['msg'] = __('Only 7 days rotas are printed');
            return response()->json($return);
        }

        $week = $request->week * 7;
        $location_id = $request->location_id;
        $role_id = (!empty($request->role_id)) ? $request->role_id : 0;
        $user_array = $request->user_array;
        $week_date = Rotas::getWeekArray('Y-m-d', $week, 'monday');
        $customDates = Rotas::customDatesrange($s_date, $e_date, 'Y-m-d');
        $th = '';
        foreach ($customDates as $date) {
            $th .= '<th class="bg-primary">' . $date . '</th>';
        }
        $thead = '<thead><tr><th class="bg-primary">' . __('Name') . '</th>' . $th . '</tr></thead>';
        if (!empty($user_array)) {
            $user_array = explode(',', $user_array);
            $tbody = '';
            $tr = '';
            if (!empty($user_array)) {
                foreach ($user_array as $key => $value) {
                    $tb = '';
                    foreach ($customDates as $date) {
                        $tb .= '<td>' . Rotas::getdaterotas($date, $value, $location_id, $role_id) . '</td>';
                    }
                    $user = User::find($value);
                    $tbody .= '
                        <tr>
                            <td>' . $user->first_name . '</td>'.$tb.'
                        </tr>';
                }
            } else {
                $tbody = '<tr> <td colspan="8"> <h2> <center> ' . __("No Data Found")  . '  </center> </h2> </td> </tr>';
            }
            $return['status'] = 1;
            $return['msg'] = $thead . $tbody;
            $return['date_title'] = $week_date[0] . ' - ' . $week_date[6];
        } else {
            $return['status'] = 0;
        }
        return response()->json($return);
    }

    public function hidedayoff(Request $request)
    {
        $day_off_sts = $request->hide_day_off;
        $userId = Auth::id();
        $user = Auth::user();
        $users = User::find($userId);
        if (!empty($users->employee_setting)) {
            $setting = json_decode($users->employee_setting, true);
            if (!empty($setting['day_off'])) {
                $setting['day_off'] = $day_off_sts;
                $users->employee_setting = json_encode($setting);
                $users->save();
            } else {
                $new_setting['day_off'] = $day_off_sts;
                $setting =  array_merge($new_setting, $setting);
                $users->employee_setting = json_encode($setting);
                $users->save();
            }
        } else {
            $setting['day_off'] = $day_off_sts;
            $users->employee_setting = json_encode($setting);
            $users->save();
        }
        return $users->employee_setting;
    }

    public function hideleave(Request $request)
    {
        $leave_display = $request->leave_display;
        $userId = Auth::id();
        $user = Auth::user();
        $users = User::find($userId);
        if (!empty($users->employee_setting)) {
            $setting = json_decode($users->employee_setting, true);
            if (!empty($setting['leave_display'])) {
                $setting['leave_display'] = $leave_display;
                $users->employee_setting = json_encode($setting);
                $users->save();
            } else {
                $new_setting['leave_display'] = $leave_display;
                $setting =  array_merge($new_setting, $setting);
                $users->employee_setting = json_encode($setting);
                $users->save();
            }
        } else {
            $setting['leave_display'] = $leave_display;
            $users->employee_setting = json_encode($setting);
            $users->save();
        }
        return $users->employee_setting;
    }

    public function hideavailability(Request $request)
    {
        $availability_display = $request->availability_display;
        $userId = Auth::id();
        $user = Auth::user();

        $users = User::find($userId);
        if (!empty($users->employee_setting)) {
            $setting = json_decode($users->employee_setting, true);
            if (!empty($setting['availability_display'])) {
                $setting['availability_display'] = $availability_display;
                $users->employee_setting = json_encode($setting);
                $users->save();
            } else {
                $new_setting['availability_display'] = $availability_display;
                $setting =  array_merge($new_setting, $setting);
                $users->employee_setting = json_encode($setting);
                $users->save();
            }
        } else {
            $setting['availability_display'] = $availability_display;
            $users->employee_setting = json_encode($setting);
            $users->save();
        }
        return $users->employee_setting;
    }

    public function copy_week_sheet(Request $request)
    {
        $rotas_id_array = $request->rotas_id_array;
        $error_msg = [];
        if (Auth::user()->type == 'company' || Auth::user()->acount_type == 1) {
            if(!empty($rotas_id_array)) {
                foreach ($rotas_id_array as $key => $rotas_id) {
                    $drag_rotas_data = Rotas::where('id', $rotas_id)->first()->toArray();
                    $rotas_start_time = $drag_rotas_data['start_time'];
                    $rotas_end_time = $drag_rotas_data['end_time'];
                    $rotas_role_id = $drag_rotas_data['role_id'];
                    $rotas_date = $drag_rotas_data['rotas_date'];
                    $drop_user_id = $drag_rotas_data['user_id'];
                    $location_id = $drag_rotas_data['location_id'];
                    $note = $drag_rotas_data['note'];
                    $created_by = $drag_rotas_data['create_by'];
                    $drop_rotas_date = date('Y-m-d', strtotime($rotas_date . ' + 7 days'));
                    $user_have_role = Profile::WhereRaw('user_id = ' . $drop_user_id . ' ')
                        ->WhereRaw(' FIND_IN_SET(' . $rotas_role_id . ', role_id) ')
                        ->count();
                    $time_override = Rotas::WhereRaw('user_id = ' . $drop_user_id . ' ')
                        ->WhereRaw('rotas_date = "' . $drop_rotas_date . '"')
                        ->WhereRaw('(
                                            ( start_time = "' . $rotas_start_time . '" AND end_time = "' . $rotas_end_time . '" ) or
                                            ("' . $rotas_start_time . '" BETWEEN start_time and end_time or "' . $rotas_end_time . '" BETWEEN start_time and end_time ) or
                                            (start_time BETWEEN "' . $rotas_start_time . '" and "' . $rotas_end_time . '" or end_time BETWEEN "' . $rotas_start_time . '" and "' . $rotas_end_time . '" )
                                        )')
                        ->first();
                    $role_name = '';
                    $role_color = 'border-color : rgb(132, 146, 166);';
                    if (!empty($rotas_role_id) || $rotas_role_id == 0) {
                        $role = Role::where('id', $rotas_role_id)->first();
                        if (!empty($role)) {
                            $role_name = $role->name;
                            $role_color = 'border-color : ' . $role->color . ';';
                        }
                    }
                    if (empty($time_override)) {
                        $diff_in_minutes = 0;
                        $to = \Carbon\Carbon::createFromFormat('H:i', $rotas_start_time);
                        $from = \Carbon\Carbon::createFromFormat('H:i', $rotas_end_time);
                        if ($from == $to) {
                            $diff_in_minutes = 1440;
                        } elseif ($from > $to) {
                            $diff_in_minutes = $to->diffInMinutes($from);
                        } elseif ($from < $to) {
                            $to = $rotas_start_time;
                            $to_array = explode(':', $to);
                            $to_minutes = 1440 - ($to_array[0] * 60 + $to_array[1]);
                            $from = $rotas_end_time;
                            $from_array = explode(':', $from);
                            $from_minutes = $from_array[0] * 60 + $from_array[1];
                            $diff_in_minutes = $to_minutes + $from_minutes;
                        }
                        $rotas = new Rotas();
                        $rotas->user_id               = $drop_user_id;
                        $rotas->issued_by             = Auth::user()->id;
                        $rotas->rotas_date            = $drop_rotas_date;
                        $rotas->start_time            = $rotas_start_time;
                        $rotas->end_time              = $rotas_end_time;
                        $rotas->time_diff_in_minut    = $diff_in_minutes;
                        $rotas->role_id               = $rotas_role_id;
                        $rotas->location_id           = $location_id;
                        $rotas->note                  = $note;
                        $rotas->publish               = 0;
                        $rotas->create_by             = $created_by;
                        $rotas->save();
                    } else {
                        $employee = Employee::where('id', $drop_user_id)->first();
                        $name = (!empty($employee->first_name)) ? $employee->first_name : __(' employee ');
                        $error_msg[] = __('This Shift clashes ') . '' . $name . ' ' . date("g:i a", strtotime($time_override['start_time'])) . ' - ' . date("g:i a", strtotime($time_override['end_time'])) . ' ' . $role_name . '' . __(' shift') . '';
                    }
                }
            }
            $array =  array('status' => 'success', 'msg' => __('Rotas copy succefully in next week.').implode('<br>', $error_msg));
        } else {
            $array =  array('status' => 'error', 'msg' => __('Permission denied.'));
        }
        return response()->json($array);
    }
    public function export()
    {
        $name = 'Rotas' . date('Y-m-d i:h:s');
        $data = Excel::download(new RotasExport(), $name . '.xlsx'); ob_end_clean();

        return $data;
    }
}
