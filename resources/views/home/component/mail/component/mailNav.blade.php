<p class="mail-title" style="margin-left:2%;" id="inbox-myLetter">@lang('home/mail/mail.subject')</p>
<hr>
<div class="col" style="margin-bottom:3%;">
    <button class="mailMenuBtn" type="button" onclick="location.href='{{ route('mail.inbox') }}'">@lang('home/mail/mail.inbox')</button>
    <button class="mailMenuBtn" type="button" onclick="location.href='{{ route('mail.transmit') }}'">@lang('home/mail/mail.transmit')</button>
    <button class="mailMenuBtn" type="button" onclick="location.href='{{ route('mail.sendMail') }}'">@lang('home/mail/mail.write')</button>
    <button class="mailMenuBtn" type="button">@lang('home/mail/mail.friend')</button>
   
</div>

