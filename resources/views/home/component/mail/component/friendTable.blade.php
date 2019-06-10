<html>

@include('home.component.mail.component.mailHeader')

<body>
    @include('home.component.mail.component.mailNav')
    <span style="font-size:14px">Total:{{ $friendsCount }}</span>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">@lang('home/mail/friendTable.name')</th>
                        <th scope="col">@lang('home/mail/friendTable.friend_date')</th>
                        <th scope="col">@lang('home/mail/friendTable.login_date')</th>
                    </tr>
                </thead>
                <tbody>
                    @if($friends != null)
                    @foreach($friends as $friend)
                    <tr>

                        <td>
                            @if($friend->user->country == 'ko')
                            <img src="{{ asset("data/ProjectImages/master/korea.png") }}" alt="korean">
                            @else
                            <img src="{{ asset("data/ProjectImages/master/japan.png") }}" alt="japan">
                            @endif

                            <span><a
                                    href="{{ route('mail.sendMail',['name' => $friend->user->name]) }}">{{ $friend->user->name }}</a></span>
                        </td>
                        <td>{{ $friend->created_at }}</td>

                        <td>{{ $friend->user->login_date }}</td>
                    </tr>

                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col" id="refresh" style="margin-top:2%">
        @if ($friends->hasPages())
        {{ $friends->appends(['page'=>$page])->onEachSide(5)->links() }}
        @endif
    </div>

    @include('home.component.mail.component.mailFooter')

</body>


</html>
