@extends('admin.layout.default')

@section('testsmaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-3 pb-0">
        <div class="card-title">
            <h3 class="card-label">Tests List
                <!-- <div class="text-muted pt-2 font-size-sm">Datatable initialized from HTML table</div> -->
            </h3>
        </div>
        <div class="card-toolbar">
            @include('admin.layout.partials.filters.common-filter')
            <a href="{{url('/admin/tests/import')}}" class="btn btn-default font-weight-bolder">
                <span class="svg-icon svg-icon-primary">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 7.000000) rotate(-180.000000) translate(-12.000000, -7.000000) " x="11" y="1" width="2" height="12" rx="1" />
                        <path d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        <path d="M14.2928932,10.2928932 C14.6834175,9.90236893 15.3165825,9.90236893 15.7071068,10.2928932 C16.0976311,10.6834175 16.0976311,11.3165825 15.7071068,11.7071068 L12.7071068,14.7071068 C12.3165825,15.0976311 11.6834175,15.0976311 11.2928932,14.7071068 L8.29289322,11.7071068 C7.90236893,11.3165825 7.90236893,10.6834175 8.29289322,10.2928932 C8.68341751,9.90236893 9.31658249,9.90236893 9.70710678,10.2928932 L12,12.5857864 L14.2928932,10.2928932 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>Import
            </a>
            &nbsp;
            <!--begin::Button-->
            <a href="{{url('/admin/tests/add')}}" class="btn btn-primary font-weight-bolder">
                <i class="la la-plus"></i>Add Test</a>
            <!--end::Button-->
            <!--begin::Button-->

            <!--end::Button-->
        </div>
        <form action="" method="get" class="w-100">
            <div class="row col-lg-12 pl-0 pr-0">

                <div class="col-sm-2">
                    <div class="dataTables_length">
                        <label>Department</label>
                        <select name="department_id" class="form-control">
                            <option value="">Select</option>
                            @if($departments)
                            @foreach($departments as $department)
                            <option value="{{$department->id}}" {{runTimeSelection($department->id,request('department_id'))}}>{{$department->department_name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="dataTables_length">
                        <label>Category</label>
                        <select class="form-control" name="category_id" id="category">
                            <option value="">Select Category</option>
                            @if($categories)
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{runTimeSelection($category->id,request('category_id'))}}>{{$category->category_name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="dataTables_length">
                        <label>Sub Category</label>
                        <select class="form-control" name="sub_category_id" id="subcategory">
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="dataTables_length">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="0" @if(request('status')=='0' ) {{runTimeSelection(0, request('status'))}} @endif>InActive</option>
                            <option value="1" @if(request('status')=='1' ) {{runTimeSelection(1, request('status'))}} @endif>Active</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="dataTables_length">
                        <label>Test Name/Code</label>
                        <input type="search" name="test_name" class="form-control" value="{{request('test_name')}}">
                    </div>
                </div>

                <div class="col-sm-1">
                    <div class="dataTables_length">
                        <label cla>&#160; </label>
                        <button type="submit" class="btn btn-success mt-7" data-toggle="tooltip" title="Apply Filter">Filter</button>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="dataTables_length">
                        <label cla>&#160; </label>
                        <a href="{{url('/').'/admin/tests/list'}}" class="btn btn-default mt-7" data-toggle="tooltip" title="Reset Filter">Reset</a>
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
                    <th class="custom_test_name">Test Name</th>
                    <th>Test Code</th>
                    <th>Department</th>
                    <th>Price</th>
                    <th class="custom_status">Status</th>
                    <th class="custom_action">Action</th>
                </tr>
            </thead>
            <tbody>

                @if(count($tests) > 0)
                @foreach($tests as $key => $value)
                @php
                if( $value->other_departments){
                $departments = explode(',',$value->other_departments);
                $departments = getDepartments( $departments );
                }elseif(isset($value->department_data->department_name) ){
                $departments = $value->department_data->department_name;
                }else{
                $departments ='N/A';
                }
                @endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$value->test_name }}</td>
                    <td>{{$value->test_code }}</td>
                    <td>{{ $departments ?  $departments : 'N/A' }}</td>
                    <td>
                        @if($value->mrp == $value->selling_price)
                        <span class="selling_price" data-toggle="tooltip" title="Selling Price">₹{{$value->selling_price }}</span>
                        @else
                        <span class="mrp_price" data-toggle="tooltip" title="MRP">₹{{$value->mrp }}</span> /&nbsp;<span class="selling_price" data-toggle="tooltip" title="Selling Price">₹{{$value->selling_price }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="javascript:void(0)" data-url="{{url('admin/tests/update-status/'.$value->id.'/'.$value->status)}}" onclick="changeStatus(this)"> <span class="label label-lg font-weight-bold label-light-{{($value->status == 1) ? 'success' : 'danger'}} label-inline">{{($value->status == 1) ? 'Active' : 'InActive'}}</span></a>
                    </td>
                    <td>
                        <a href="{{url('/admin/tests/edit/'.$value->id)}}" class="btn btn-sm btn-clean btn-icon" title="Edit details" data-toggle="tooltip">
                            <i class="la la-edit"></i>
                        </a>
                        <a href="javascript:void(0)" data-url="{{url('/admin/tests/delete/'.$value->id)}}" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Delete" onclick="deleteItem(this)">
                            <i class="la la-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>

        <div class="pagination_div">
            {{ $tests->appends(request()->input())->links() }}
        </div>
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
    var categoryId = '{{request("category_id")}}';
    var subcategoryId = '{{request("sub_category_id")}}';
    $(document).ready(function() {
        $('#myTable').DataTable({
            "paging": false
        });
        $('.dataTables_filter label input[type=search]').addClass('form-control form-control-sm');
        $('.dataTables_length select').addClass('custom-select custom-select-sm form-control form-control-sm');
        if (categoryId) {
            $('#category').change();
        }
    });
</script>
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

{{-- page scripts --}}
@endsection