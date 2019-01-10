<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('home/component/welcomeMail.title')</title>
</head>
<style>
    a {
        text-decoration: none;
    }

</style>

<body>
    <img id=Rand_Banner class="img-fluid" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
        alt="Responsive image">

    <br>
    <div style='background-color: #ea314e;display: inline-block;margin-left: 60px;'><img src="{{asset("data/ProjectImages/master/NEITTER.png")}}"
            alt="Logo" ondragstart="return false"></div>
    <br>
    <br>
    @if(Session::has('newUser'))
        @lang('home/component/welcomeMail.notice1')"<b style="color:blue;">{{Session::get('newUser')}}</b>"@lang('home/component/welcomeMail.notice2')
    @endif
    <br>
    <a href="{{route('login')}}">@lang('home/component/welcomeMail.goLogin')</a>
</body>

</html>
