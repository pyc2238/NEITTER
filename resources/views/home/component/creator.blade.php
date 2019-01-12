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
            <div>
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
                </table>
                <br>
                NEITTER サービス企画及びバックエンドサービス開発者として成長し続けている。

            </div>
            <div class="w-100"></div>
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>チュ・ホジン</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>デザイン·フロントエント</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>Vue.js,HTML,Jquery</td>
                            </tr>
                        </table>
                        <br>
                        フロントエントの天才と呼ばれる。
                    </div>

                    <div class="col-sm">
                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>カク·ミンス</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>ラブライブコンサルタント</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>LoveLive</td>
                            </tr>
                        </table>
                        <br>
                        ラブライブが好きだ。
                    </div>
                    <div class="col-sm">

                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>キム·スンヨン</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>ネットワーク通信·フロントエント</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>Vue.js,Ajax</td>
                            </tr>
                        </table>
                        <br>
                        物好きが多い
                    </div>
                </div>
            </div>
            <div class="w-100"></div>
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>未定</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>未定</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>未定</td>
                            </tr>
                        </table>
                        <br>
                        
                    </div>

                    <div class="col-sm">
                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>未定</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>未定</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>未定</td>
                            </tr>
                        </table>
                        <br>
                        
                    </div>
                    <div class="col-sm">

                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>未定</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>未定</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>未定</td>
                            </tr>
                        </table>
                        <br>
                        
                    </div>
                </div>
            </div>
        </div>
        @else

        <div class="col" style='margin-top:40px'>

            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>크리에이터 소개</b></h4>
            <br>
            <div>
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
                </table>
                <br>
                NEITTER 서비스 기획 및 백엔드 서비스 개발자로 계속 성장중이다.

            </div>
            <div class="w-100"></div>
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>추호진</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>디자인 및 프론트엔트</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>Vue.js,HTML,Jquery</td>
                            </tr>
                        </table>
                        <br>
                        프론트엔트의 천재로 불린다.
                    </div>

                    <div class="col-sm">
                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>곽민수</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>러브라이브 컨설턴트</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>LoveLive</td>
                            </tr>
                        </table>
                        <br>
                        러브라이브를 좋아한다.
                    </div>
                    <div class="col-sm">

                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>김승연</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>네트워크 통신 및 프론트엔트</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>Vue.js,Ajax</td>
                            </tr>
                        </table>
                        <br>
                        도게자를 잘한다.
                    </div>
                </div>
            </div>
            <div class="w-100"></div>
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>미정</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>미정</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>미정</td>
                            </tr>
                        </table>
                        <br>
                        
                    </div>

                    <div class="col-sm">
                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>미정</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>미정</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>미정</td>
                            </tr>
                        </table>
                        <br>
                        
                    </div>
                    <div class="col-sm">

                        <img width="50%" class="img-thumbnail" src="{{asset("data/ProjectImages/master/logoImage/6.png")}}"
                            alt="Bogeun">
                        <br><br>
                        <table>

                            <tr>
                                <th>@lang('home/component/creator.name')&nbsp; </th>
                                <td>미정</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.role')&nbsp;</th>
                                <td>미정</td>
                            </tr>
                            <tr>
                                <th>@lang('home/component/creator.skill')&nbsp;</th>
                                <td>미정</td>
                            </tr>
                        </table>
                        <br>
                        
                    </div>
                </div>
            </div>

        </div>

        @endif
    </div>
</div>
@endsection
