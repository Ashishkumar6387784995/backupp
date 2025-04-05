{{-- Modal Add Location --}}
<!-- Modal -->
<div class="modal fade" id="exampleModalNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Company</h5>
                <button type="button" class="close iconBtn_" data-dismiss="modal" aria-label="Close" onclick="window.location.href='{{ route('company.profile') }}'">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('company.sponsor.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-12">
                        <label>Company Name</label>
                        <div>
                            <input type="text" name="sponsor_company_name" value="{{ old('sponsor_company_name') }}" class="form-control" placeholder="Company name" isrequired="required">
                        </div>
                    </div>

                    <div class="form-group col-md-12"> 
                        <label>Company Short Description</label>
                        <div>
                            <input type="text" name="sponsor_company_description" value="{{ old('sponsor_company_description') }}" class="form-control" placeholder="Company description" isrequired="required">
                        </div>
                    </div>


                    <div class="form-group col-md-12">
                        <label>Company logo</label>
                        <div>
                            <input type="file" name="sponsor_company_logo" value="{{ old('sponsor_company_logo') }}" class="form-control" placeholder="Company logo" isrequired="required" accept=".jpeg,.jpg,.png,.gif,.svg">
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

@if (!empty($sponsorDetails))
<div class="modal fade" id="sponsorDetails" tabindex="-1" aria-labelledby="locationDetailsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationDetailsLabel">Edit Location</h5>
                <button type="button" class="close iconBtn_" data-dismiss="modal" aria-label="Close" onclick="window.location.href='{{ route('company.profile') }}'">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('company.sponsor.update',['id' => $sponsorDetails->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group col-md-12">
                        <label>Company Name</label>
                        <div>
                            <input type="text" name="sponsor_company_name" value="{{ old('sponsor_company_name', $sponsorDetails->company_name) }}" class="form-control" placeholder="Company name" isrequired="required">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Company Short Description</label>
                        <div>
                            <input type="text" name="sponsor_company_description" value="{{ old('sponsor_company_description', $sponsorDetails->company_description) }}" class="form-control" placeholder="Company description" isrequired="required">
                        </div>
                    </div>


                    <div class="form-group col-md-12">
                        <label>Company logo</label>

                        <div class="row">
                            <div class="col-md-8">
                                <input type="file" name="sponsor_company_logo" value="{{ $sponsorDetails->company_logo }}" class="form-control" accept=".jpeg,.jpg,.png,.gif,.svg">
                            </div>
                            <div class="col-md-4">
                                <a href="{{url('uploads/company/sponsor/' . $sponsorDetails->company_logo)}}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset('uploads/company/sponsor/' . $sponsorDetails->company_logo) }}" alt="logo" height="50px;">
                                </a>
                            </div>
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