@extends('layouts.app')
@section('title')
@lang('home/component/policy.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <div class="row">
        <div class="col">
            <img src="{{asset("data/ProjectImages/master/logoImage/9.png")}}" width="72" alt="thumbnail">
            <h2 style='display:inline-block;'>@lang('home/component/policy.subject')</h2>
            <hr>
        </div>
        <div class="w-100"></div>

        @if(Session::get('locale') == 'ja')
        <div class="col" style='margin-top:40px'>

            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>サイト総則</b></h4>
            <br>

            <p>■利用総則</p>
            <p>本約款は,NEITTEERで運営するサービスを利用するにあたり,"NEITTEER"と"利用顧客"間の利用条件および手続きなど,
                ,その他必要な事項を具体的に規定することを目的とします。</p>
            <ul style='margin-left:35px'>
                <li><b>利用申込者は次の事項を順守しなければなりません。</b></li>
                (1)加入申請様式には申請者の実名を記載しなければなりません。<br>
                (2)加入申し込みの様式は事実と一致しなければなりません。<br>
                (3)社会の安寧,秩序または美風良俗を阻害する目的で申請してはいけません。<br>
                (4)登録様式またはその内容の変動した事項に対して,変動された事実と一致する完全な情報に更新しなければなりません。<br>
                (5)利用申込者が提供した情報が不正確だったり,現在の事実と一致しない場合,または満20歳未満の利用者が有料サービスを利用しようとする場合でも,法定代理人の同意を得た後に
                サービス利用が可能です。<br><br>
            </ul>
        </div>

        <div class="w-100"></div>
        <div class="col" style='margin-top:40px'>
            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>サービス利用</b></h4>

            <br>
            <br>
            <ul style='margin-left:35px'>
                <li><b>サービスの内容</b></li>
                (1) ペンパル<br>
                (2) 翻訳<br>
                (3)コンテンツ<br>
                (4) チャット<br>
                (5) その他サービス<br><br>

                <li><b>細部の内容</b></li>

            </ul>
        </div>
        @else

        <div class="col" style='margin-top:40px'>

            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>사이트 총칙</b></h4>
            <br>

            <p>■이용 총칙</p>
            <p>이 약관은 NEITTER에서 운영하는 서비스를 이용함에 있어 "NEITTER"과 "이용고객" 사이의 이용조건 및 절차 등
                기타 필요한 사항을 구체적으로 규정함을 목적으로 합니다.</p>
            <ul style='margin-left:35px'>
                <li><b>이용 신청자는 다음 사항을 준수하여야 합니다.</b></li>
                (1) 가입신청 양식에는 신청자의 실명을 기재하여야 합니다.<br>
                (2) 가입신청 양식의 내용은 사실과 일치해야 합니다.<br>
                (3) 사회의 안녕, 질서 또는 미풍양속을 저해할 목적으로 신청해서는 안됩니다.<br>
                (4) 등록 양식 또는 그 내용의 변동된 사항에 대해서 변동된 사실과 일치하는 완전한 정보로 갱신해야 합니다.<br>
                (5) 이용신청자가 제공한 정보가 부정확하거나 현재의 사실과 일치하지 않는 경우, 또는 만 20세 미만의 이용자가 유료 서비스를 이용하고자 하는 경우에도 법정대리인의 동의를 얻은 후에
                서비스 이용이 가능합니다.<br><br>
            </ul>

        </div>

        <div class="w-100"></div>
        <div class="col" style='margin-top:40px'>
            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>서비스 이용</b></h4>

            <ul style='margin-left:35px'>
                <li><b>서비스의 내용</b></li>
                (1) 펜팔<br>
                (2) 번역<br>
                (3) 컨텐츠<br>
                (4) 채팅<br>
                (5) 그 외 서비스<br><br>

                <li><b>세부내용</b></li>

            </ul>

        </div>
        @endif
    </div>
</div>
@endsection
