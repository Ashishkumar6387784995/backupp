{{-- Modal Add Location --}}
@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Location</h5>
          <button type="button" class="close iconBtn_" data-dismiss="modal" aria-label="Close" onclick="window.location.href='{{ route('company.profile') }}'">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('company.location.create') }}" method="post">
            @csrf
            <div class="form-group col-md-12">
                <label>Location name</label>
                <div>
                    <input type="text" name="location_name" value="" class="form-control" placeholder="Location name" isrequired="required">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Location/City/Address</label>
                <div>
                    <input type="text" name="address" value="" class="form-control" placeholder="Select Location" isrequired="required">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Fence Radius (mtrs)</label>
                <div>
                    <input type="text" name="fence_radius" value="" class="form-control" placeholder="Fence Radius (mtrs)" isrequired="required">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Support Email</label>
                <div>
                    <input type="text" name="support_email" value="" class="form-control" placeholder="Support Email" isrequired="required">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Support Person/Contact</label>
                <div>
                    <input type="text" name="support_contact" value="" class="form-control" placeholder="Support Person/Contact" isrequired="required">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Email</label>
                <div>
                    <input type="text" name="email" value="" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Notes</label>
                <div>
                    <input type="text" name="notes" value="" class="form-control" placeholder="Notes">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Employee</label>
                <div>
                    <select name="employee[]" id="employe" class="form-control select2" multiple isrequired="required">
                        @if (!empty($employees))
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach  
                        @endif
                        
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12 mt-3">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- edit Modal--}}

  @if (!empty($locationDetails))
  <div class="modal fade" id="locationDetails" tabindex="-1" aria-labelledby="locationDetailsLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="locationDetailsLabel">Edit Location</h5>
          <button type="button" class="close iconBtn_" data-dismiss="modal" aria-label="Close" onclick="window.location.href='{{ route('company.profile') }}'">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('company.location.update',['id' => $locationDetails->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group col-md-12">
                <label>Location name</label>
                <div>
                    <input type="text" name="location_name" value="{{ $locationDetails->location_name }}" class="form-control" placeholder="Location name" isrequired="required">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Location/City/Address</label>
                <div>
                    <input type="text" name="address" value="{{ $locationDetails->address }}" class="form-control" placeholder="Select Location" isrequired="required">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Fence Radius (mtrs)</label>
                <div>
                    <input type="text" name="fence_radius" value="{{ $locationDetails->fence_radius }}" class="form-control" placeholder="Fence Radius (mtrs)" isrequired="required">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Support Email</label>
                <div>
                    <input type="text" name="support_email" value="{{ $locationDetails->support_email }}" class="form-control" placeholder="Support Email" isrequired="required">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Support Person/Contact</label>
                <div>
                    <input type="text" name="support_contact" value="{{ $locationDetails->support_contact }}" class="form-control" placeholder="Support Person/Contact" isrequired="required">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Email</label>
                <div>
                    <input type="text" name="email" value="{{ $locationDetails->email }}" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Notes</label>
                <div>
                    <input type="text" name="notes" value="{{ $locationDetails->notes }}" class="form-control" placeholder="Notes">
                </div>
            </div>
            @php
                $detailsEmployee = json_decode($locationDetails->employee, true) ?? [];
            @endphp
            <div class="form-group col-md-12">
                <label>Employee</label>
                <div>
                    <select name="employee[]" id="employe" class="form-control select2" multiple isrequired="required">
                        @if (!empty($employees))
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" @if (in_array($employee->id, $detailsEmployee))
                                    selected
                                @endif>{{ $employee->name }}</option>
                            @endforeach  
                        @endif
                        
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12 mt-3">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
  @endif
{{-- Show Qr --}}
  @if (!empty($locationQrDetails))
  <div class="modal fade" id="locationQrDetails" tabindex="-1" aria-labelledby="locationQrDetailsLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="locationDetailsLabel">View QR Code</h5>
          <button type="button" class="close iconBtn_" data-dismiss="modal" aria-label="Close" onclick="window.location.href='{{ route('company.profile') }}'">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="printableArea">
                <b>Location name: </b>{{ $locationQrDetails->location_name}} <br>
                <b>Address: </b>{{ $locationQrDetails->address}}<br>
                <b>Fence Radius: </b>{{ $locationQrDetails->fence_radius}} (mtrs)<br>
                <div class="text-center">
                    {{ QrCode::size(300)->generate($locationQrDetails->qr_code); }}
                <br>
                </div>
                <b>Notes: </b>{{ $locationQrDetails->notes}}<br><br>
                <b>Support Number: </b>{{ $locationQrDetails->support_contact}}<br>
                <b>Email Us: </b>{{ $locationQrDetails->support_email}}<br>
            </div>
        
            <div class="text-center">
                <a href="javascript:void(0)" onclick="printDiv('printableArea')" class="btn btn-primary">Print</a>
            </div>
            <script>
                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;
                
                    document.body.innerHTML = printContents;
                
                    window.print();
                
                    document.body.innerHTML = originalContents;
                }
            
            </script>
        </div>
      </div>
    </div>
  </div>  
  @endif