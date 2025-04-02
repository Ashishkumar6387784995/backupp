@extends('admin.layout.default')

@section('categorymaster','active menu-item-open')
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-3 pb-0">
        <div class="card-title">
            <h3 class="card-label">Category List
                <!-- <div class="text-muted pt-2 font-size-sm">Datatable initialized from HTML table</div> -->
            </h3>
        </div>
        <div class="card-toolbar">

            @include('admin.layout.partials.filters.common-filter')
            <div>
                <a href="{{url('/admin/categories/add')}}" class="btn btn-primary font-weight-bolder">
                    <i class="la la-plus"></i>Add Category</a>
            </div>
            <div style="margin-left: 7px;">
                <a href="{{url('/admin/subcategories/list')}}" class="btn btn-primary font-weight-bolder">
                    All Sub Categories</a>
            </div>
            <!--begin::Dropdown-->

        </div>
        <form action="" method="get" class="w-100">
            <div class="row col-lg-12 pl-0 pr-0">
                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label>Status</label>
                        <select name="status" value="" class="form-control">
                            <option value="-1">All Status</option>
                            <option value="0" @if(request('status')=='0' ) {{runTimeSelection(0, request('status'))}} @endif>InActive</option>
                            <option value="1" @if(request('status')=='1' ) {{runTimeSelection(1, request('status'))}} @endif>Active</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="dataTables_length">
                        <label cla>&#160; </label>
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Apply Filter" style="margin-top: 20px;">Filter</button>
                        <a href="{{url('admin/categories/list')}}" class="btn btn-default" data-toggle="tooltip" title="Reset Filter" style="margin-top: 20px;">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">

        <!--begin: Datatable-->
        <table class="table table-bordered table-hover" id="myTable">
            <thead>
                <tr>
                    <th class="custom_sno">SNo.</th>
                    <th>Icons</th>
                    <th>Category Name</th>
                    <th>Is Home Display?</th>
                    <th class="custom_status">Status</th>
                    <th class="custom_action">Action</th>
                </tr>
            </thead>
            <tbody>

                @if(count($categories) > 0)
                @foreach($categories as $key => $value)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{ asset('uploads/category/icons/'.$value->category_icon) }}" alt="icon" width="45"></td>
                    <td>{{$value->category_name }}</td>
                    <td>
                        <a href="{{url('admin/categories/addhomepage/'.$value->id.'/'.$value->is_home_display)}}" onclick="addHomePage(this);">
                            <div class="toggle-button-container">
                                <div class="toggle-button gd">
                                    <div class="btn btn-pill" id="button-1">
                                        <input type="checkbox" class="checkbox" {{ $value->is_home_display == 1 ? '' : 'checked' }} readonly/>
                                        <div class="knob"></div>
                                        <div class="btn-bg"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0)" data-url="{{url('admin/categories/update-status/'.$value->id.'/'.$value->status)}}" onclick="changeStatus(this)"> <span class="label label-lg font-weight-bold label-light-{{($value->status == 1) ? 'success' : 'danger'}} label-inline">{{($value->status == 1) ? 'Active' : 'InActive'}}</span></a>
                    </td>
                    <td>
                        <a href="{{url('/admin/categories/edit/'.$value->id)}}" class="btn btn-sm btn-clean btn-icon" title="Edit details" data-toggle="tooltip">
                            <i class="la la-edit"></i>
                        </a>
                        <a href="javascript:void(0)" data-url="{{url('/admin/categories/delete/'.$value->id)}}" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Delete category" onclick="deleteItem(this)">
                            <i class="la la-trash"></i>
                        </a>
                        </a>
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<script>
    
    function changeStatus() {
        confirm("Do you want to change status ?");
    }
</script>
@endsection

{{-- Styles Section --}}
@section('styles')
<!-- <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $('.dataTables_filter label input[type=search]').addClass('form-control form-control-sm');
        $('.dataTables_length select').addClass('custom-select custom-select-sm form-control form-control-sm');
    });

    function addHomePage(e) {
       let url = $(e).attr('href');
       if (confirm('do you want to add')) {
        location.href = url;
       }
    }
</script>
{{-- vendors --}}
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>
<!-- <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> -->

{{-- page scripts --}}
<!-- <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script> -->
@endsection