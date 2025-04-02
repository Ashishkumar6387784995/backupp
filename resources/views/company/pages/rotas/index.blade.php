@extends('company.layout.default')

@section('rostermaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-3 pb-0">
        <div class="card-title">
            <h3 class="card-label">Roster</h3>
        </div>
        <div class="card-toolbar">
            {{-- @include('company.layout.partials.filters.common-filter') --}}
        </div>
        <form action="" method="get" class="w-100">
            <div class="row col-lg-12 pl-0 pr-0">
                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="0" @if(request('status')=='0' ) {{runTimeSelection(0, request('status'))}} @endif>InActive</option>
                            <option value="1" @if(request('status')=='1' ) {{runTimeSelection(1, request('status'))}} @endif>Active</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label>&#160; </label>
                        <button type="submit" class="btn btn-success mt-7" data-toggle="tooltip" title="Apply Filter">Filter</button>
                        <label>&#160; </label>
                        <a href="{{url('company/roster')}}" class="btn btn-default mt-7" data-toggle="tooltip" title="Reset Filter">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <!-- Employee Table -->
        <table class="table table-bordered table-hover" id="myTable">
            <thead>
                <tr>
                    <th>Employee</th>
                    @foreach ($daysOfWeek as $day)
                        <th>{{ $day->format('D') }} <br> {{ $day->format('d-m-Y') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($employee as $emp)
                    @php
                    // Total hours and minutes for the employee
                    $totalHours = 0;
                    $totalMinutes = 0;
                    $totalShifts = 0;

                    foreach ($emp->rotas as $shift) {
                        $start = \Carbon\Carbon::parse($shift->start_time);
                        $end = \Carbon\Carbon::parse($shift->end_time);
                        $diff = $start->diff($end);

                        $totalHours += $diff->h;
                        $totalMinutes += $diff->i;
                        $totalShifts++;
                    }

                    // Convert excess minutes to hours
                    $totalHours += intdiv($totalMinutes, 60);
                    $totalMinutes = $totalMinutes % 60;

                    // Display hours only if minutes are 0
                    $totalTimeDisplay = ($totalMinutes > 0) ? "{$totalHours}h {$totalMinutes}m" : "{$totalHours}h";
                @endphp
                    <tr>
                        <th>{{ $emp->name }} <br> {{ $totalTimeDisplay }} {{ $totalShifts }} Shifts</th>
                        @foreach ($daysOfWeek as $day)
                            <td >
                                @php
                                    // Filter shifts for the specific day
                                    $shiftsForDay = $emp->rotas->filter(function ($shift) use ($day) {
                                        return $shift->rotas_date === $day->format('Y-m-d');
                                    });
                                @endphp
                                
                                @if ($shiftsForDay->isNotEmpty()) 
                                    @foreach ($shiftsForDay as $shiftDay)
                                        @php
                                            $start_time = \Carbon\Carbon::parse($shiftDay->start_time)->format('H:i');
                                            $end_time = \Carbon\Carbon::parse($shiftDay->end_time)->format('H:i');
                                            $shiftDetails = "{$start_time} - {$end_time}";
                                        @endphp
                                        <div class="box-btn">
                                            <span>{!! $shiftDetails !!} </span>
                                            <div class="f_right">
                                                <a href="?edit={{ $shiftDay->id }}" class="editpencil">
                                                    <i class="la la-edit"></i>
                                                </a>
                                                <form action="{{ route('company.rotas.destroy', ['id' => $shiftDay->id]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="trashicon" onclick="return confirm('Are you sure you want to delete this shift?')">
                                                        <i class="la la-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    @endforeach
                                @else
                                    <!-- No shifts for the day -->
                                    <a 
                                        data-user-id="{{ $emp->id }}" 
                                        data-date="{{ $day->format('d-m-Y') }}" 
                                        href="javascript:void(0);" 
                                        class="backcolor openModal">
                                        <i class="la la-plus"></i>
                                    </a>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table> 
   
    </div>
</div>

<!-- Modal for Form -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Create Shift</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="la la-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('company.roster.shift.create') }}" class="rotas_ctrate_location rotas_cteate_frm">
                    @csrf
                    <input name="user_id" type="hidden" id="modal_user_id">
                    <input name="rotas_date" type="hidden" id="modal_rotas_date">
                    <input id="rotas_ctrate_location" name="location_id" type="hidden" value="2">
                    <div class="row align-items-center">
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="form-label">Start Time</label>
                            <input class="form-control start_time rotas_time" placeholder="Select time" required="" name="start_time" isrequired="required" type="time">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="form-label">End Time</label>
                            <input class="form-control end_time rotas_time" placeholder="Select time" required="" name="end_time" isrequired="required" type="time">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="form-label">Break</label>
                            <input class="form-control" required="" min="0" name="break_time" type="number" isrequired="required" value="0">
                            <small>in minute</small>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="form-label">Role</label>
                            <select class="form-control" name="role_id" isrequired="required">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                   <option value="{{ $role->id }}">{{ $role->role }}</option> 
                                @endforeach
                                <!-- Add more roles if necessary -->
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="form-label">Note</label>
                            <textarea class="form-control autogrow" rows="2" style="resize: none; height: auto;" name="note" cols="50"></textarea>
                            <small>Employees can only see notes for their own shifts</small>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Form -->
@if (!empty($rowRoster))
<div class="modal fade" id="employeeModalShiftEdit" tabindex="-1" aria-labelledby="employeeModalShiftEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalShiftEdit">Edit Shift</h5>
                <a href="{{ route('company.roaster.index') }}" type="button" class="btn-close">
                    <i class="la la-close"></i>
                </a>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('company.roster.shift.update') }}" class="rotas_ctrate_location rotas_cteate_frm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $rowRoster->id }}">
                    <input name="user_id" type="hidden" id="modal_user_id" value="{{ $rowRoster->user_id }}">
                    <input name="rotas_date" type="hidden" id="modal_rotas_date" value="{{ $rowRoster->rotas_date }}">
                    <input id="rotas_ctrate_location" name="location_id" type="hidden" value="{{ $rowRoster->location_id }}">
                    <div class="row align-items-center">
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="form-label">Start Time</label>
                            <input class="form-control start_time rotas_time" placeholder="Select time" required="" value="{{ $rowRoster->start_time }}" name="start_time" isrequired="required" type="time">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="form-label">End Time</label>
                            <input class="form-control end_time rotas_time" placeholder="Select time" required="" value="{{ $rowRoster->end_time }}" name="end_time" isrequired="required" type="time">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="form-label">Break</label>
                            <input class="form-control" required="" min="0" name="break_time" type="number" isrequired="required" value="{{ $rowRoster->break_time }}">
                            <small>in minute</small>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="form-label">Role</label>
                            <select class="form-control" name="role_id" isrequired="required">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                   <option value="{{ $role->id }}" {{runTimeSelection($role->id,$rowRoster->role_id)}}>{{ $role->role }}</option> 
                                @endforeach
                                <!-- Add more roles if necessary -->
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="form-label">Note</label>
                            <textarea class="form-control autogrow" rows="2" style="resize: none; height: auto;" name="note" cols="50">{{$rowRoster->note}}</textarea>
                            <small>Employees can only see notes for their own shifts</small>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-0">
                        <a href="{{ route('company.roaster.index') }}" type="button" class="btn btn-light">Close</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

{{-- Styles Section --}}
@section('styles')
<!-- <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<style>
    .box-btn {
    background: #ffffff8c;
    padding: 5px 5px 5px 4px;
    margin: 3px 0px 3px 0;
    /* text-align: left; */
    transition-duration: 0.5s;
    border: 1px solid rgb(132, 146, 166);
    border-left: 3px solid rgb(132, 146, 166);
    /* box-shadow: 0 0 1px 1px #0000006b; */
    min-height: 48px;
    margin-bottom: 5px;
    border-radius: 10px;
    opacity: 0.5;
}
.box-btn span {
    display: block;
}
.f_right {
    float: right;
    display: block;
}
.backcolor {
    background: linear-gradient(141.55deg, #012982 3.46%, #012982 99.86%), #012982 !important;
    border-radius: 58px;
    padding: 1px;
    color: #fff!important;
    opacity: 1;
}
.backcolor i {
    color: #fff;
}

button.btn-close {
    background: linear-gradient(141.55deg, #012982 3.46%, #012982 99.86%), #012982 !important;
    border-radius: 50%;
    padding: 3px 6px;
    border: 0;
    color: #fff;
}
button.btn-close i {
    color: #fff;
    font-size: 14px;
    font-weight: bold;
}button.trashicon {
    border: none;
    background: transparent;
}
    </style>


@endsection

{{-- Scripts Section --}}
@section('scripts')


<!-- First, load jQuery -->
<!-- Include the necessary Bootstrap JS (if not already included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $('.dataTables_filter label input[type=search]').addClass('form-control form-control-sm');
        $('.dataTables_length select').addClass('custom-select custom-select-sm form-control form-control-sm');
    });
</script>
<script>
    $(document).on('click', '.openModal', function() {
        // Get user ID and date from the clicked button
        var userId = $(this).data('user-id');
        var date = $(this).data('date');
        
        // Set the user ID and date in the hidden fields inside the modal
        $('#modal_user_id').val(userId);
        $('#modal_rotas_date').val(date);
        
        // Show the modal
        $('#employeeModal').modal('show');
    });
</script>
@if (!empty($rowRoster))
<script>
    $('#employeeModalShiftEdit').modal('show');
</script> 
@endif
@endsection
