@extends('layouts.app')
@section('title')
@lang('home/component/creator.title')
@endsection
@section('content')

<div class="container content">
    <br>
    <div class="row">
        <div class="col">
            <img src="{{asset("data/ProjectImages/master/logoImage/6.png")}}" width="72" alt="thumbnail">
            <h2 style='display:inline-block;'>@lang('home/component/creator.subject')</h2>
            <hr>
        </div>
        <div class="w-100"></div>

        @if(Session::get('locale') == 'ja')
        <div class="col" style='margin-top:40px'>

            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>クリエーター紹介</b></h4>
            <br>
            <div style="margin-bottom:10%">
                <img width="30%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/creators/bogeun.jpg")}}"
                    alt="Bogeun">
                <br><br><br>
                <table>

                    <tr>
                        <th>@lang('home/component/creator.name')&nbsp;</th>
                        <td>パク・ボグン</td>
                    </tr>
                    <tr>
                        <th>@lang('home/component/creator.role')&nbsp;</th>
                        <td>バックエンド·サーバー管理</td>
                    </tr>
                    <tr>
                        <th>@lang('home/component/creator.skill')&nbsp;</th>
                        <td>PHP,Laravel,AWS</td>
                    </tr>
                    <tr>
                        <td><a href="https://github.com/pyc2238" target="_blank"><b>Github</b></a></td>
                    </tr>
                </table>
                <br>
                NEITTER サービス企画及びバックエンドサービス開発者として成長し続けている。

            </div>
            <div class="w-100"></div>
            <br><br>
            <div class="container" style="margin-bottom:5%">
                <div class="row text-center">
                    <div class="col-sm">

                        <img class="img-thumbnail sub" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}" alt="Bogeun">
                        <br><br>


                        <div class="row">
                            <div class="col"></div>
                            <div class="col-9">
                                <table class="text-center">

                                    <tr>
                                        <th>@lang('home/component/creator.name')&nbsp; </th>
                                        <td class="float-left">チュ・ホジン</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.role')&nbsp;</th>
                                        <td class="float-left">デザイン·フロントエント</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.skill')&nbsp;</th>
                                        <td class="float-left">Vue.js,HTML,Jquery</td>
                                    </tr>
                                </table>
                                <br>
                                フロントエントの天才と呼ばれる。
                            </div>
                            <div class="col"></div>
                        </div>

                    </div>
                    <div class="col-sm">
                        <img class="img-thumbnail sub" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}" alt="Bogeun">
                        <br><br>


                        <div class="row">
                            <div class="col"></div>
                            <div class="col-9">
                                <table class="text-center">

                                    <tr>
                                        <th>@lang('home/component/creator.name')&nbsp; </th>
                                        <td class="float-left">カク·ミンス</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.role')&nbsp;</th>
                                        <td class="float-left">ラブライブコンサルタント</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.skill')&nbsp;</th>
                                        <td class="float-left">LoveLive</td>
                                    </tr>
                                </table>
                                <br>
                                ラブライブが好きだ。
                            </div>
                            <div class="col"></div>
                        </div>

                    </div>
                    <div class="col-sm">

                        <img class="img-thumbnail sub" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}" alt="Bogeun">
                        <br><br>


                        <div class="row">
                            <div class="col"></div>
                            <div class="col-9">
                                <table class="text-center">

                                    <tr>
                                        <th>@lang('home/component/creator.name')&nbsp; </th>
                                        <td class="float-left">キム·スンヨン</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.role')&nbsp;</th>
                                        <td class="float-left">ネットワーク·フロントエント</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.skill')&nbsp;</th>
                                        <td class="float-left">Vue.js,HTML,Jquery</td>
                                    </tr>
                                </table>
                                <br>
                                物好きが多い
                            </div>
                            <div class="col"></div>
                        </div>

                    </div>
                </div>
                <div class="w-100"></div>
                <br><br>
            </div>
        </div>
        @else

        <div class="col" style='margin-top:40px'>

            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>크리에이터 소개</b></h4>
            <br>
            <div style="margin-bottom:10%">
                <img width="30%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/creators/bogeun.jpg")}}"
                    alt="Bogeun">
                <br><br><br>
                <table>

                    <tr>
                        <th>@lang('home/component/creator.name')&nbsp;</th>
                        <td>박보근</td>
                    </tr>
                    <tr>
                        <th>@lang('home/component/creator.role')&nbsp;</th>
                        <td>백엔드 및 서버 관리자</td>
                    </tr>
                    <tr>
                        <th>@lang('home/component/creator.skill')&nbsp;</th>
                        <td>PHP,Laravel,AWS</td>
                    </tr>
                    <tr>
                        <td><a href="https://github.com/pyc2238" target="_blank"><b>Github</b></a></td>
                    </tr>
                </table>
                <br>
                NEITTER 서비스 기획 및 백엔드 서비스 개발자로 계속 성장중이다.

            </div>
            <div class="w-100"></div>
            <br><br>
            <div class="container" style="margin-bottom:5%">
                <div class="row text-center">
                    <div class="col-sm">

                        <img class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}" alt="Bogeun">
                        <br><br>


                        <div class="row">
                            <div class="col"></div>
                            <div class="col-9">
                                <table class="text-center">

                                    <tr>
                                        <th>@lang('home/component/creator.name')&nbsp; </th>
                                        <td class="float-left">추호진</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.role')&nbsp;</th>
                                        <td class="float-left">디자인 및 프론트엔트</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.skill')&nbsp;</th>
                                        <td class="float-left">Vue.js,HTML,Jquery</td>
                                    </tr>
                                </table>
                                <br>
                                프론트엔드의 천재로 불린다.
                            </div>
                            <div class="col"></div>
                        </div>

                    </div>
                    <div class="col-sm">
                        <img class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}" alt="Bogeun">
                        <br><br>


                        <div class="row">
                            <div class="col"></div>
                            <div class="col-9">
                                <table class="text-center">

                                    <tr>
                                        <th>@lang('home/component/creator.name')&nbsp; </th>
                                        <td class="float-left">곽민수</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.role')&nbsp;</th>
                                        <td class="float-left">러브라이브 컨설턴트</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.skill')&nbsp;</th>
                                        <td class="float-left">LoveLive</td>
                                    </tr>
                                </table>
                                <br>
                                러브라이브를 좋아한다.
                            </div>
                            <div class="col"></div>
                        </div>

                    </div>
                    <div class="col-sm">

                        <img class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}" alt="Bogeun">
                        <br><br>


                        <div class="row">
                            <div class="col"></div>
                            <div class="col-9">
                                <table class="text-center">

                                    <tr>
                                        <th>@lang('home/component/creator.name')&nbsp; </th>
                                        <td class="float-left">김승연</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.role')&nbsp;</th>
                                        <td class="float-left">네트워크 및 프론트엔트</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('home/component/creator.skill')&nbsp;</th>
                                        <td class="float-left">Vue.js,HTML,Jquery</td>
                                    </tr>
                                </table>
                                <br>
                                프론트엔드의 천재로 불린다.
                            </div>
                            <div class="col"></div>
                        </div>

                    </div>
                </div>
                <div class="w-100"></div>
                <br><br>

            </div>
        </div>
        @endif
    </div>
</div>
@endsection
