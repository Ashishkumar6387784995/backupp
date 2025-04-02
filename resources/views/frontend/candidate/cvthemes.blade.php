@php
$cvTemplates = getCVTemplates(1)
@endphp
<div class="col-md-1 no-print mob-view">
    <div class="hide-desk"><h3>Choose your template</h3> <div class="close c-close">&times;</div></div>
    <div class="left-menu">
        @if($cvTemplates)
        @foreach($cvTemplates as $key => $list)
        <div class="l-menu">
            @if($currentURI == 'build-a-resume' && !Auth()->guard('candidate')->user())
            <a href="{{url('/build-a-resume/cv/preview?template='. $list->id)}}">
                <img src="{{url('/public/uploads/cvthemes/'.$list->img)}}">
            </a>
            @else
            <a href="{{url('/account/cv/preview?template='. $list->id)}}">
                <img src="{{url('/public/uploads/cvthemes/'.$list->img)}}">
            </a>
            @endif
        </div>
        <div class="l-menu">
            @if($currentURI == 'build-a-resume' && !Auth()->guard('candidate')->user())
            <a href="{{url('/build-a-resume/cv/preview?template='. $list->id)}}">
                <img src="{{url('/public/uploads/cvthemes/'.$list->img)}}">
            </a>
            @else
            <a href="{{url('/account/cv/preview?template='. $list->id)}}">
                <img src="{{url('/public/uploads/cvthemes/'.$list->img)}}">
            </a>
            @endif
        </div>
        <div class="l-menu">
            @if($currentURI == 'build-a-resume' && !Auth()->guard('candidate')->user())
            <a href="{{url('/build-a-resume/cv/preview?template='. $list->id)}}">
                <img src="{{url('/public/uploads/cvthemes/'.$list->img)}}">
            </a>
            @else
            <a href="{{url('/account/cv/preview?template='. $list->id)}}">
                <img src="{{url('/public/uploads/cvthemes/'.$list->img)}}">
            </a>
            @endif
        </div>
        @endforeach
        @endif

    </div>
</div>