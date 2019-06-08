<html>

@include('home.component.mail.component.mailHeader')

<body>
    @include('home.component.mail.component.mailNav')


    <span style="font-size:14px">@lang('home/mail/receiveTable.sendersCount1')[ <b id="sendCount">{{ $sendersCount }}</b>
        ]@lang('home/mail/receiveTable.sendersCount2') / @lang('home/mail/receiveTable.sendersCount3')</span>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><input type="checkbox" id="checkall" /></th>
                        <th scope="col">@lang('home/mail/receiveTable.sender')</th>
                        <th scope="col">@lang('home/mail/receiveTable.content')</th>
                        <th scope="col">@lang('home/mail/receiveTable.time')</th>
                        <th scope="col">@lang('home/mail/receiveTable.delete')</th>
                    </tr>
                </thead>
                <tbody>
                    @if($senders != null)
                    @foreach($senders as $sender)
                    <tr data-tr_value="{{ $sender->id }}">
                        <th scope="row"><input type="checkbox" name="chk" value="{{ $sender->id }}" /></th>
                        <td>
                            @if($sender->user->country == 'ko')
                            <img src="{{ asset("data/ProjectImages/master/korea.png") }}" alt="korean">
                            @else
                            <img src="{{ asset("data/ProjectImages/master/japan.png") }}" alt="japan">
                            @endif
                            <span id="userInfo" data-toggle="modal"
                                data-target="#Modal-large-demo{{ $sender->user->id }}">{{ $sender->user->name }}</span>
                        </td>
                        <td class="mailsTd">
                            @if($sender->is_read == 0)
                            <img src="{{ asset("data/ProjectImages/penpal/no_read.png") }}" alt="no_read">
                            @else
                            <img src="{{ asset("data/ProjectImages/penpal/ok_read.png") }}" alt="ok_read">
                            @endif
                            <a
                                href="{{ route('mail.show',['id' => $sender->id,'page' => $page]) }}">{{ $sender->content }}</a>
                        </td>
                        <td>{{ $sender->created_at }}</td>
                        <td><button type="button" class="btn btn-danger"
                                onclick="location.href='{{ route('mail.delete',['id' => $sender->id]) }}'"><i
                                    class="fa fa-trash"></i></button></td>
                    </tr>

                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col">
        <button class="btn btn-danger" id="allDelete" type="button">@lang('home/mail/receiveTable.selectDelet')</button>
    </div>
    <div class="col" id="refresh" style="margin-top:2%">
        @if ($senders->hasPages())
        {{ $senders->appends(['page'=>$page])->onEachSide(5)->links() }}
        @endif
    </div>

    @foreach($senders as $sender)
    @include('home.component.mail.component.selfContextModal')
    @endforeach

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
            if (confirm('@lang('home/mail/receiveTable.confirm')')) {
                $("input[name=chk]:checked").each(function () {
                    var tr_value = $(this).val();
                    var tr = $("tr[data-tr_value='" + tr_value + "']");
                    tr.remove();
                    
                    $.ajax({
                        url: '{{ route('mail.delete') }}',
                        type: 'get',
                        data: {
                            _token: "{{ csrf_token() }}",
                            'deleteAll': $(this).val(),

                        },
                        success: function (data) {
                            $('#sendCount').text(data);
                            
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
