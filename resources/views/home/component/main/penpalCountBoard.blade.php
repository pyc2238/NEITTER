
<div class="penpal-count-box">
        <div class="col">
            <h5 style="padding-top:2%;" ><i class="fa fa-globe" style="color:blue"></i>&nbsp;@lang('home/main.penpal_count')
                <span class="float-right" id="chartSpan" data-toggle="modal" data-target="#Modal-chart">Chart</span>
            </h5>
            <hr>
    
            <div class="col" style="margin-bottom:3%">
                <div class="text-center penpal-count-head">
                    <span>@lang('home/main.penpal')
                </div>
                <div class="penpal-count-body">
    
                    <div class="text-center" style="padding-top:4.5%;">
                        <span style="margin-right:8%"><img style="height:50px"
                                src="{{ asset("data/ProjectImages/master/koreaCount.png") }}" alt="korea"></span>
                        <span style="margin-left:8%"><img style="height:50px"
                                src="{{ asset("data/ProjectImages/master/japanCount.png") }}" alt="korea"></span>
                    </div>
                    <div class="text-center" style="padding-top:5%;margin-bottom:5%">
                        <span style="margin-right:12.8%">{{ $koreaSenderCount }}</span>
                        <span style="margin-left:13%">{{ $japanSenderCount }}</span>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    
    @include('home.component.main.penpalCountModel')
    
    