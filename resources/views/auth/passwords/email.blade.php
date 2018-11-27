@extends('layouts.app')
@section('title')
비밀번호 찾기
@endsection
@section('content')


<div class="container">
    <br>
    <h3>NEITTER-비밀번호 찾기</h3>
    <hr>
    <div class="row find_div">
        <div class="col-sm"></div>
        <!--첫번 째 그리드 박스-->
        <div class="col-sm" style="padding-top:3%">
            <!-- <img src="https://stickershop.line-scdn.net/stickershop/v1/product/1274436/LINEStorePC/main@2x.png;compress=true" class="img-fluid" alt="Responsive image"> -->
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
            <form action="{{route('reset')}}" class='form-group find_form' method="post">
                @csrf
                <h1 class="h3 mb-3 font-weight-normal text-center">Please enter your email</h1>
                <i class="fa fa-envelope"><label for="inputPassword">이메일</label></i>
                <input type="email" id="email" name="email" class="form-control" autocomplete=off required>

                <div class='text-center checkBtn'>
                    <button class="btn btn-outline-warning" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;확인&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </form>
            <!--end of form-->

        </div>
        <!--두번쨰 그리드 박스-->

        <div class="col-sm">

        </div>
        <!--세번째 그리드 박스-->
    </div>
    <!--end of row-->
    @endsection
