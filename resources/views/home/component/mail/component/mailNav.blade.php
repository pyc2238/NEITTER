<p class="mail-title" id="inbox-myLetter">@lang('home/mail/mail.subject')</p>
<hr>
<div class="col" style="margin-bottom:3%;">
    <button type="button" onclick="location.href='{{ route('mail.inbox') }}'">@lang('home/mail/mail.inbox')</button>
    <button type="button" onclick="location.href='{{ route('mail.transmit') }}'">@lang('home/mail/mail.transmit')</button>
    <button type="button" onclick="location.href='{{ route('mail.sendMail') }}'">@lang('home/mail/mail.write')</button>
    <button type="button">@lang('home/mail/mail.friend')</button>
    {{-- <span id="receiveSpan"><a href="" id="R">@lang('home/mail/mail.inbox')</a></span>
    <span id="transmitBox"><a href="" id="S">@lang('home/mail/mail.transmit')</a></span>
    <span id="sendBox"><a href="" id="write">@lang('home/mail/mail.write')</a></span>
    <span id="friendBox"><a href="" id="friend">@lang('home/mail/mail.write')</a></span> --}}
</div>



