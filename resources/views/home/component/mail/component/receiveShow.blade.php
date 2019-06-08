<html>
@include('home.component.mail.component.mailHeader')

<body>
    @include('home.component.mail.component.mailNav')

    <div class="row" style="margin-top:5%;">
        <div class="col">
            <span class="float-right">
                    @if($sender->user->country == 'ko')
                        <img src="{{ asset("data/ProjectImages/master/korea.png") }}" alt="korea">
                    @else
                        <img src="{{ asset("data/ProjectImages/master/japan.png") }}" alt="japan">
                    @endif
                    {{ $sender->user->name }}@lang('home/mail/receiveShow.intro1') {{ $sender->created_at }} @lang('home/mail/receiveShow.intro2')</span>
        </div>
    </div>
    <div class="row" style="margin-top:5%;">
        <div class="col"></div>
        <div class="col-11 contentBox">
                {{ $sender->content }}
        </div>
        <div class="col"></div>
    </div>


    

    <div class="col show-self_context" style="vertical-align: top; padding:2%" />
    
    <span id="translation_content"><b>@lang('penpal/show.translation_content')</b></span>
            <div style="display:none; border:1px dashed gray;">
                <div style="padding:3%">
                    <p>{{ $sender->translation }}</p>
                </div>
            </div>
    </div>
    
    @if($sender->image != null)
    
        <div class="row" style="margin-top:3%;">
                
            <div class="col"></div>
            <div class="col-11">
                <span>
                        <a href="{{ route('image.view',['image' => $sender->image]) }}" target = "_blank"><img src="{{ $sender->image }}" alt="No Image" style="max-width: none; height: 450px; display: inline; "
                        height="450px" width="480px" class="img-thumbnail"></a>
                </span>
            </div>
            <div class="col"></div>
        </div>
    @endif
    <div class="row" style="margin-top:150px;margin-bottom:5%;">
        <div class="col"></div>
        <div class="col-7 text-center">
            <button class="btn btn-info" type="button" onclick="location.href='{{ route('mail.sendMail',['name' => $sender->user->name]) }}'">@lang('home/mail/receiveShow.reply')</button>
            <button class="btn btn-success" type="button" onclick="location.href='{{route('mail.inbox',['page'=>$page])}}'">@lang('home/mail/receiveShow.list')</button>
            <button class="btn btn-warning"  type="button" onClick="window.close()">@lang('home/mail/receiveShow.close')</button>
        </div>
        <div class="col"></div>
    </div>
</body>

</html>
