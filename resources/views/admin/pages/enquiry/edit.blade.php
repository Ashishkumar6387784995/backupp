@extends('admin.layout.default')

@section('enquiremaster','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">


                            <div class="form-group col-md-6">
                                <label>Customer Name</label>
                                <div><input type="text" name="customer_name" value="{{$details->customer_name}}" isrequired="required" class="form-control" placeholder="Enter Customer Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Customer Mobile</label>
                                <div><input type="text" name="customer_mobile" value="{{$details->customer_mobile}}" isrequired="required" class="form-control" placeholder="Enter Customer Mobile"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Customer Email</label>
                                <div><input type="email" name="customer_email" value="{{$details->customer_email}}" isrequired="required" class="form-control" placeholder="Enter Customer Email"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>City</label>
                                <select class="form-control" name="city_id" id="city_id" isrequired="required">
                                    <option value="">Select City</option>
                                    @if($cities)
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{runTimeSelection($city->id,$details->city_id)}}>{{$city->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Centre</label>
                                <select class="form-control" name="centre_id" id="centre_id" isrequired="required">
                                    <option value="">Select Centre</option>
                                    @if($centres)
                                    @foreach($centres as $centre)
                                    <option value="{{$centre->id}}" {{runTimeSelection($centre->id,$details->centre_id)}}>{{$centre->centre_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select name="is_lead_converted" class="form-control">
                                    <option value="0" {{runTimeSelection(0,$details->is_lead_converted)}}>Request Taken/New</option>
                                    <option value="1" {{runTimeSelection(1,$details->is_lead_converted)}}>Pending</option>
                                    <option value="2" {{runTimeSelection(2,$details->is_lead_converted)}}>Converted/Confirmed</option>
                                    <option value="3" {{runTimeSelection(3,$details->is_lead_converted)}}>Call back requested</option>
                                    <option value="4" {{runTimeSelection(4,$details->is_lead_converted)}}>Not responding</option>
                                    <option value="5" {{runTimeSelection(5,$details->is_lead_converted)}}>Not interested</option>
                                    <option value="6" {{runTimeSelection(6,$details->is_lead_converted)}}>Follow up</option>
                                    <option value="7" {{runTimeSelection(7,$details->is_lead_converted)}}>Centre Allocated</option>
                                    <option value="8" {{runTimeSelection(8,$details->is_lead_converted)}}>Phlebo Allocated</option>
                                    <option value="9" {{runTimeSelection(9,$details->is_lead_converted)}}>Sample Collected</option>
                                    <option value="10" {{runTimeSelection(10,$details->is_lead_converted)}}>Report Generated</option>
                                    <option value="11" {{runTimeSelection(11,$details->is_lead_converted)}}>Cancelled</option>
                                    <option value="12" {{runTimeSelection(12,$details->is_lead_converted)}}>Refunded</option>

                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Address</label>
                                <textarea class="form-control" name="address" row="27">{{$details->address}}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Followup Date</label>
                                <input type="text" class="form-control" readonly="" disabled="" value="{{$details->last_follow_up_date ? $details->last_follow_up_date : 'NA'}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Followup Comment</label>
                                <textarea type="text" class="form-control" readonly="" disabled="" value="">{{$details->last_follow_up_comment}}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Comment</label>
                                <textarea type="text" class="form-control" value="" name="last_follow_up_comment"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Next Followup Date</label>
                                <input type="date" min="{{date('Y-m-d')}}" class="form-control" value="{{$details->next_follow_up_date ? date('Y-m-d',strtotime($details->next_follow_up_date)) : ''}}" name="next_follow_up_date">
                            </div>

                            <div class="form-group col-md-12">
                                <label>Message</label>
                                <textarea class="form-control" name="message" row="27">{{$details->message}}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Uploaded Prescriptions</label>
                                <div>
                                    <input type="file" name="prescriptions[]" multiple class="form-control w-50">
                                </div>
                                @if(!empty($details->prescriptions) && $images = json_decode($details->prescriptions,true))
                                @foreach($images as $key => $contract_document)


                                <div class="_update_img_action">
                                    <br>
                                    @if(str_contains($contract_document, '.pdf'))
                                    <a target="_blank" href="{{asset('uploads/bookings/prescriptions/'.$contract_document)}}" class="btn btn-primary btn-sm">View PDF </a>
                                    @else
                                    <img src="{{asset('uploads/bookings/prescriptions/'.$contract_document)}}" class="btn btn-primary btn-sm" onclick="window.open('{{asset('uploads/bookings/prescriptions/'.$contract_document)}}', '_blank');" style="width: 200px;"> &nbsp;
                                    @endif
                                    <!-- <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteImage(this)">Delete</a> -->
                                </div>
                                @endforeach
                                @endif
                            </div>


                            <div class="form-group col-md-12">
                                <center><button class="btn btn-success">Update</button></center>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group col-md-12">
            <h6> Order History </h6>
        </div>
        <div class="form-group col-md-12" style="    max-height: 201px; overflow: auto;">
            @php
            $orderHistory = $details->enquire_history ? $details->enquire_history : false;

            @endphp
            <table class="table table-bordered">
                <tr>
                    <th>SNo.</th>
                    <th>Lead Status</th>
                    <th>Last Comment</th>
                    <th>Last Follow Date</th>
                    <th>Next Follow Date</th>
                    <th>Action By</th>
                    <th>Created At</th>
                </tr>
                @if( $orderHistory)
                @foreach( $orderHistory as $History)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>@if($History->status==0) New @elseif($History->status==1) Pending @elseif($History->status==2) Convert @else NA @endif</td>
                    <td>{{$History->comment }}</td>
                    <td>{{displayDate($History->created_at)}}</th>
                    <td>{{$History->next_followup_date ? date('d-m-Y', strtotime($History->next_followup_date)) : 'NA'}}</th>
                    <td>{{getUserName($History->created_by)}}</td>
                    <td>{{$History->created_at ? displayDateTime($History->created_at) : 'NA'}}</th>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center">No record found</th>
                </tr>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
@endsection