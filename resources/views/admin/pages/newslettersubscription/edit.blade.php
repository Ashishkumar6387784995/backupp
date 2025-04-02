@extends('admin.layout.default')

@section('facilitymaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <!-- <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Edit Category
            </h3>
        </div>
    </div> -->
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">
                            <div class="form-group col-md-12">
                                <label>Faqs Category</label>
                                <div>

                                    <select name="faq_category_id" class="form-control" isrequired="required">
                                        <option value="">Select Faq Category</option>
                                        @if($faqCategories)
                                        @foreach($faqCategories as $faqCategory)
                                        <option value="{{$faqCategory->id}}" {{runTimeSelection($faqCategory->id,$details->faq_category_id)}}>{{$faqCategory->category}}</option>

                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Faqs Title</label>
                                <div><input type="text" name="title" value="{{$details->title}}" class="form-control" placeholder="Enter title" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Faqs Description</label>
                                <div>
                                    <textarea name="description" class="form-control" placeholder="Enter Description" isrequired="required">{{$details->description}}</textarea>
                                </div>
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

@endsection

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
@endsection