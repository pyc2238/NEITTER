@section('main_slider')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection

<div class="penpal-count-box w3-content w3-display-container">
    <div class="col">
            <h5 style="padding-top:2%"><i class="fa fa-globe" style="color:blue"></i>&nbsp;@lang('home/main.penpal_count')</h5> 
        <hr>
        <div class="col" style="margin-bottom:3%">
            <div class="text-center penpal-count-head">
                <span>@lang('home/main.penpal')</span>
            </div>
            <div class="penpal-count-body">
                <div class="text-center" style="padding-top:4.5%;">
                    <span style="margin-right:8%"><img style="height:50px" src="{{ asset("data/ProjectImages/master/koreaCount.png") }}"
                            alt="korea"></span>
                    <span style="margin-left:8%"><img style="height:50px" src="{{ asset("data/ProjectImages/master/japanCount.png") }}"
                            alt="korea"></span>
                </div>
                <div class="text-center" style="padding-top:5%;margin-bottom:5%">
                    <span style="margin-right:12.8%">{{ $koreaSenderCount }}</span>
                    <span style="margin-left:13%">{{ $japanSenderCount }}</span>
                </div>
            </div>
        </div>

    </div>

</div>
