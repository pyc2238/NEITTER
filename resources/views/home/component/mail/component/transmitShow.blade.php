<html>
@include('home.component.mail.component.mailHeader')

<body>
    @include('home.component.mail.component.mailNav')

    <div class="row" style="margin-top:5%;">
        <div class="col">
            <span class="float-right">
                    @if($transmit->country == 'ko')
                        <img src="{{ asset("data/ProjectImages/master/korea.png") }}" alt="korean">
                    @else
                        <img src="{{ asset("data/ProjectImages/master/japan.png") }}" alt="japan">
                    @endif
                    {{ $transmit->recipient_name }}@lang('home/mail/transmitShow.intro1') {{ $transmit->created_at }} @lang('home/mail/transmitShow.intro2')</span>
        </div>
    </div>
    <div class="row" style="margin-top:5%;">
        <div class="col"></div>
        <div class="col-11 contentBox">
                {{ $transmit->content }}
        </div>
        <div class="col"></div>
    </div>


    

    <div class="col show-self_context" style="vertical-align: top; padding:2%" />
    
    <span id="translation_content"><b>@lang('penpal/show.translation_content')</b></span>
            <div style="display:none; border:1px dashed gray;">
                <div style="padding:3%">
                    <p>{{ $transmit->translation }}</p>
                </div>
            </div>
    </div>
    
    @if($transmit->image != null)
    
        <div class="row" style="margin-top:3%;">
                
            <div class="col"></div>
            <div class="col-11">
                <span>
                        <a href="{{ route('image.view',['image' => $transmit->image]) }}" target = "_blank"><img src="{{ $transmit->image }}" alt="No Image" style="max-width: none; height: 450px; display: inline; "
                        height="450px" width="480px" class="img-thumbnail"></a>
                </span>
            </div>
            <div class="col"></div>
        </div>
    @endif
    <div class="row" style="margin-top:150px;margin-bottom:5%;">
        <div class="col"></div>
        <div class="col-7 text-center">    
            <button class="btn btn-success" type="button" onclick="location.href='{{route('mail.transmit',['page'=>$page])}}'">@lang('home/mail/transmitShow.list')</button>
            <button class="btn btn-warning"  type="button" onClick="window.close()">@lang('home/mail/transmitShow.close')</button>
        </div>
        <div class="col"></div>
    </div>
</body>

</html>
