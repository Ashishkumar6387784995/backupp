@extends('admin.layout.default')

@section('faqmaster','active menu-item-open')
@section('content')
<div class="card card-custom">

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
                                        <option value="{{$faqCategory->id}}" {{runTimeSelection($faqCategory->id,old('faq_category_id'))}}>{{$faqCategory->category}}</option>

                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Faqs Title</label>
                                <div><input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="Enter title" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Faqs Description</label>
                                <div>
                                    <textarea name="description" value="{{old('description')}}" class="form-control" placeholder="Enter Description" isrequired="required"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <center><button class="btn btn-success">Submit</button></center>
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