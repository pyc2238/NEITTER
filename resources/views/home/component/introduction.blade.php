@extends('layouts.app')
@section('title')
@lang('home/component/introduction.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <div class="row">
        <div class="col">
            <img src="{{asset("data/ProjectImages/master/logoImage/22.png")}}" width="72" alt="thumbnail">
            <h2 style='display:inline-block;'>@lang('home/component/introduction.subject')</h2>
            <hr>
        </div>
        <div class="w-100"></div>

        @if(Session::get('locale') == 'ja')
        <div class="col" style='margin-top:40px'>

            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>プロジェクト概要</b></h4>
            <br>

            <p><b>NEITTER&nbsp;:&nbsp;&nbsp;&nbsp;neighbor+letter 隣国の人とのペンパル</b></p>

            <p>NEITTEERは2018年10月2日,初めて開発した韓日文通サイトで日韓両国一人ひとりの文化的交流を通じて政治的,歴史的問題と関連した韓日関係の困難において民間
                <img width="16%" src="{{asset("data/ProjectImages/master/logoImage/17.png")}}" align="right">
                レベルの交流をはじめ,日韓間の国家交流の発展にも小さな力になれるようにしようという主旨に開発されました。</p>

            <p>韓国に対して感情的に接する人もいるでしょうが,このような民間レベルの交流を通じて,韓国人日本人との個人的な交流において,政治的,歴史的問題が必要でしょうか？
                いいえ.　これは国家と国家の交流よりは人間と人間との交流であることを強調したいです.</p>

            <p> "寝巻き姿で隣の家の友達とパソコンでチャットでもするように手紙を書いた。"こうした個々人の文化交流がNEITTEERの追求する交流です。</p>

            <p>NEITTEERはインターネット上で発生する全ての日韓間の民間交流を支援します。 あわせて韓国,日本国内のオフライン会合を通じて情報交換及び語学的関心事を持った会員間の語学会などを支援し
                育成させます。</p>
        </div>

        <div class="w-100"></div>

    </div>
    @else

    <div class="col" style='margin-top:40px'>

        <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>프로젝트 개요</b></h4>
        <br>

        <p><b>NEITTER&nbsp;:&nbsp;&nbsp;&nbsp;neighbor+letter 이웃나라 사람과의 펜팔</b></p>

        <p>NEITTER는 2018년 10월 2일 처음 개발한 한일 펜팔사이트로 한일간 개개인의 문화적 교류를 통하여 정치적,역사적문제로 얽힌 한일관계의 어려움에 있어 민간
            <img width="16%" src="{{asset("data/ProjectImages/master/logoImage/17.png")}}" align="right">
            차원의 교류를 시작으로, 한일간 국가적 교류의 발전에도 작은 보탬이 될수 있게 하자는 취지에 개발 되었습니다.</p>

        <p>일본에 혹은 한국에 대해 감정적으로 대하는 사람도 있겠지만 이러한 민간차원의 교류를 통한 한국인 일본인과의 개인적인 교류에서 정치적, 역사적 문제가 필요할까요?
            아닙니다. 이것은 국가와 국가의 교류 보다는 인간과 인간과의 교류임을 강조하고 싶습니다.</p>

        <p> "잠옷차림으로 옆집 친구와 컴퓨터를 마주놓고 채팅을 하듯 편지를쓰듯.."이러한 개개인의 문화교류가 NEITTER의 추구하는 교류입니다.</p>

        <p>NEITTER은 인터넷상에서 발생하는 모든 한일간 민간교류를 지원합니다. 아울러 한국, 일본내의 오프라인 모임을 통하여 정보교환 및 어학적관심사를 가진 회원간의 어학 모임등을 지원하고
            육성시킵니다.</p>
    </div>


    <div class="w-100"></div>


    @endif
</div>
</div>
@endsection
