@extends('layouts.app')

@section('content')

<br>
<h3>NEITTER-로그인</h3>
<hr>

<div class="row" style="margin-top:7%;">
    <div class="col-sm"></div>
    <!--첫번 째 그리드 박스-->
    <div class="col-sm">
        <div class="container">
            
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/product/1274436/LINEStorePC/main@2x.png;compress=true"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/product/1419641/LINEStorePC/main@2x.png;compress=true"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/product/1432005/LINEStorePC/main@2x.png;compress=true"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/product/1439190/LINEStorePC/main@2x.png;compress=true?__=20161019"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/product/1439496/LINEStorePC/main@2x.png;compress=true"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/product/1448386/LINEStorePC/main@2x.png;compress=true"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/product/1600906/LINEStorePC/main@2x.png;compress=true"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://4.bp.blogspot.com/-uQWbVG90eTI/WTraoe8kREI/AAAAAAAAAts/AhwUW2JKwvIBVpoG4uvpoA_eHE8J9RRlgCLcB/s1600/TW444618.png"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://4.bp.blogspot.com/-oQAS2K2DvOQ/WUjlgzg2qYI/AAAAAAAAMDE/OIp8oS1M-lkxca6-wE5Z_paCSNUq4kVZQCLcBGAs/s1600/TW453311.png"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="http://dl.stickershop.line.naver.jp/products/0/0/1/1600906/android/stickers/20394946.png"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://i.pinimg.com/originals/80/2e/6f/802e6f25b7a51f25e033d06d21235b3c.png"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://sdl-stickershop.line.naver.jp/stickershop/v1/sticker/18062306/android/sticker.png"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://i.pinimg.com/originals/da/af/77/daaf771f6eda191f52c7b11e48a9a82b.png"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://i.pinimg.com/originals/e3/e9/3a/e3e93a80b6df39f14b34a85e07d0a760.png"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://i.pinimg.com/originals/b8/a2/5f/b8a25f5c0b6923a988d7ec83b6cd296c.png"
                    alt="Responsive image"></a>
            <a href="#" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="https://3.bp.blogspot.com/-jjDIk3QGMxU/WZBHUX05-1I/AAAAAAAQ0Bs/EVbIQE3MY24cS21Hn0J7WSqn35FG9LkvQCLcBGAs/s1600/TW500793.png"
                    alt="Responsive image"></a>

            <script language="javascript">
                var R=Math.floor(Math.random()*16);
                        show_Banner(R);
                    </script>

            <form action="{{route('login')}}" method="POST">
                @csrf

                <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>
                </div>
                <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete=off placeholder="Email" required autofocus>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <br>

                <label for="password" class="sr-only">Password</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <br>

                <div class="text-center">
                <button class="btn btn-outline-warning " type="submit">&nbsp;&nbsp;&nbsp;로그인&nbsp;&nbsp;&nbsp;</button>
                <button class="btn btn-outline-warning" type="button" onclick="location.href='{{ route('register') }}'">&nbsp;&nbsp;회원가입&nbsp;&nbsp;</button>
                <button class="btn btn-outline-warning" type="button" onclick="location.href='{{ route('password.request') }}'">ID/PW찾기</button>
                </div>

        </form>
    </div>
    <!--두번쨰 그리드 박스-->

    <div class="col-sm"></div>
    <!--세번째 그리드 박스-->
</div>

<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm text-center" style="margin-top:3%;margin-bottom:5%">
        <!-- Add font awesome icons -->
        <a href="#" class="fa fa-facebook Social"></a>
        <a href="#" class="fa fa-twitter Social"></a>
        <a href="#" class="fa fa-google Social"></a>
        <a href="#" class="fa fa-yahoo Social"></a>
    </div>
    <div class="col-sm"></div>
</div>

@endsection
