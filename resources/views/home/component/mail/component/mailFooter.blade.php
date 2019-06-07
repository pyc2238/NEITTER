
    <div class="row">
       
        </div>
        <div class="row" style="margin-top:3%;margin-bottom:5%;">
            <div class="col text-center">
                <button class="btn btn-warning" type="button"  onClick="window.close()">@lang('home/mail/mail.close')</button>
            </div>
        </div>
    
    
        @include('component.noticeModal')

    <script>
        
        var exist = '{{Session::has('message')}}';
        $(window).load(function () {
            if (exist) {
                $('#Modal-small-demo').modal('show');
            }
        });
    </script>