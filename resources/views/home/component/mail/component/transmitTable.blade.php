<html>
@include('home.component.mail.component.mailHeader')

<body>
    @include('home.component.mail.component.mailNav')


    <span style="font-size:14px">@lang('home/mail/transmitTable.transmitsCount1')[ <b id="transmitCount">{{ $transmitsCount }}</b> ]@lang('home/mail/transmitTable.transmitsCount2') / @lang('home/mail/transmitTable.transmitsCount3')</span>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><input type="checkbox" id="checkall" /></th>
                        <th scope="col">@lang('home/mail/transmitTable.transmit')</th>
                        <th scope="col">@lang('home/mail/transmitTable.content')</th>
                        <th scope="col">@lang('home/mail/transmitTable.time')</th>
                        <th scope="col">@lang('home/mail/transmitTable.delete')</th>
                    </tr>
                </thead>
                <tbody>
                    @if($transmits != null)
                    @foreach($transmits as $transmit)
                    <tr data-tr_value="{{ $transmit->id }}">
                        <th scope="row"><input type="checkbox" name="chk" value="{{ $transmit->id }}" /></th>
                        <td>
                            @if($transmit->country == 'ko')
                                <img src="{{ asset("data/ProjectImages/master/korea.png") }}" alt="korea">
                            @else
                                <img src="{{ asset("data/ProjectImages/master/japan.png") }}" alt="japan">
                            @endif
                            <a id="userInfo">{{ $transmit->recipient_name }}</a>
                        </td>
                        <td class="mailsTd">
                           
                            <img src="{{ asset("data/ProjectImages/penpal/transmit.png") }}" alt="transmit">
                                       
                            <a
                                href="{{ route('mail.transmit.show',['id' => $transmit->id,'page' => $page]) }}">{{ $transmit->content }}</a>
                        </td>
                        <td>{{ $transmit->created_at }}</td>
                        <td><button type="button" class="btn btn-danger"
                                onclick="location.href='{{ route('mail.transmit.delete',['id' => $transmit->id]) }}'"><i
                                    class="fa fa-trash"></i></button></td>
                    </tr>

                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col">
        <button class="btn btn-danger" id="allDelete" type="button">@lang('home/mail/transmitTable.selectDelet')</button>
    </div>
    <div class="col" style="margin-top:2%">
        @if ($transmits->hasPages())
            {{ $transmits->appends(['page'=>$page])->onEachSide(5)->links() }}
        @endif
    </div>

    
    @include('home.component.mail.component.mailFooter')

</body>

<script>
        $(document).ready(function () {
           
            //최상단 체크박스 클릭
            $("#checkall").click(function () {
                //클릭되었으면
                if ($("#checkall").prop("checked")) {
                    //input태그의 name이 chk인 태그들을 찾아서 checked옵션을 true로 정의
                    $("input[name=chk]").prop("checked", true);
                    //클릭이 안되있으면
                } else {
                    //input태그의 name이 chk인 태그들을 찾아서 checked옵션을 false로 정의
                    $("input[name=chk]").prop("checked", false);
                }
            })
    
            $('#allDelete').click(function () {
                if (confirm('@lang('home/mail/transmitTable.confirm')')) {
                    $("input[name=chk]:checked").each(function () {
                        var tr_value = $(this).val();
                        var tr = $("tr[data-tr_value='" + tr_value + "']");
                        tr.remove();
                        
                        $.ajax({
                            url: '{{ route('mail.transmit.delete') }}',
                            type: 'get',
                            data: {
                                _token: "{{ csrf_token() }}",
                                'deleteAll': $(this).val(),
    
                            },
                            success: function (data) {
                                $('#transmitCount').text(data);
                
                            },
                            error: function () {
                                alert("error!!!!");
                            }
                        });
    
                    });
                } else {
                    return false;
                }
            });
        })
    
    </script>

</html>
