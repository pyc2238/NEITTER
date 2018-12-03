@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

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
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    var socialite = '{{Session::has('socialiteLogin')}}'    
            $(window).load(function()
            {
                if(socialite){
                    $('#Modal-small').modal('show');
                }
                
            });
            </script>
<!-- 회원가입 이메일 -->

<div class="modal fade" id="Modal-small" tabindex="-1" role="dialog" aria-labelledby="Modal-small" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-small">회원가입이 완료되었습니다!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>
            </div>
            <div class="modal-body">
                <img src="https://vignette.wikia.nocookie.net/line/images/b/b5/10384549.gif/revision/latest?cb=20160318062245"
                    alt="회원가입 성공">
            </div>
            <b class="text-center"> <a href="{{url('introduction')}}">사이트소개 바로가기</a></b>
            <br>
            <p class="text-center"><a href="{{route('socialite.userInfo')}}">내정보</a>로가서 회원정보를 수정해보세요!</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> OK </button>
            </div>
        </div>
    </div>
</div>

@endsection
