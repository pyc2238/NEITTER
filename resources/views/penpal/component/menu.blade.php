<link rel="stylesheet" href="{{asset('/css/penpal/penpalMenu.css')}}">

<nav class="penpal_nav">
    <ul>
        <a href="{{ route('penpal.index') }}">
            <li id="home">

                <div class="home-icon">

                    <div class="roof">
                        <div class="roof-edge"></div>
                    </div>
                    <div class="front"></div>

                </div>

            </li>
        </a>

        <a href="{{ route('penpal.introduction') }}">
        <li id="about">
            <div class="about-icon">
                <div class="head">
                    <div class="eyes"></div>
                    <div class="beard"></div>
                </div>
            </div>
        </li>
     
        <a href="{{ route('penpal.timeline') }}">
            <li id="work">

                <div class="work-icon">
                    <div class="paper"></div>
                    <div class="lines"></div>
                    <div class="lines"></div>
                    <div class="lines"></div>
                </div>
            </li>
        </a>
        <a href="{{ route('penpal.registration') }}">
            <li id="mail">
                <div class="mail-icon">
                    <div class="mail-base">
                        <div class="mail-top"></div>
                    </div>
                </div>
            </li>
        </a>
    </ul>
</nav>
