<p class="mail-title" style="margin-left:2%;" id="inbox-myLetter">@lang('home/mail/mail.subject')</p>
<hr>
<div class="col" style="margin-bottom:3%;">
    <button class="mailMenuBtn" type="button" onclick="location.href='{{ route('mail.inbox') }}'">@lang('home/mail/mail.inbox')</button>
    <button class="mailMenuBtn" type="button" onclick="location.href='{{ route('mail.transmit') }}'">@lang('home/mail/mail.transmit')</button>
    <button class="mailMenuBtn" type="button" onclick="location.href='{{ route('mail.sendMail') }}'">@lang('home/mail/mail.write')</button>
    <button class="mailMenuBtn" type="button" onclick="location.href='{{ route('mail.friend') }}'">@lang('home/mail/mail.friend')</button>
    @if(Auth::check())
    <span id="penpal_countSpan" class="float-right" style="margin-right:9%"><i id="penpal_countI" class="fa fa-exclamation-circle" style="display:none"></i>@lang('home/mail/mail.penpal_count')[{{ Auth::user()->penpal_count }}/10]</span>
    @endif
</div>

<script>

if('{{ Auth::user()->penpal_count }}' == 10){
    $("#penpal_countSpan").css('color','red');
    $("#penpal_countI").show();
    
}



</script>