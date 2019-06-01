<link rel="stylesheet" href="{{ asset('/css/shop-item.css') }}">

<div style="height:auto;">

    <form method="post" action="{{ route('penpal.index.search',['list'=>$list]) }}" class="form-inline" id="fsearch">
        @csrf
        <input type="hidden" name="ageMin" value="" id="ageMin-input">
        <input type="hidden" name="ageMax" value="" id="ageMax-input">

        <div class="list-group list-search-form">

            <div class="list-group-item">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="gender">@lang('penpal/component/indexMenu.gender'):</label>
                        <select id="gender" name="gender" class="form-control input-sm">
                            <option value="all" selected>
                                @lang('penpal/component/indexMenu.gender_all')</option>
                            <option value="men">@lang('penpal/component/indexMenu.men')</option>
                            <option value="women">@lang('penpal/component/indexMenu.women')</option>
                        </select>
                    </div>

                    <div class="form-group col-md-8 pdr3">
                        <label style="display: inline">
                            @lang('penpal/component/indexMenu.age') :

                            <span class="example-val" id="slider-snap-value-lower">10</span>
                            -
                            <span class="example-val" id="slider-snap-value-upper">90</span>
                            <span></span>
                        </label>
                        <div style="display: inline">
                            <div id="" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                                <div id="slider-snap"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="list-group-item">
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label for="country">@lang('penpal/component/indexMenu.country'):</label>
                        <select name="country" class="form-control input-sm">
                            <option value="all">@lang('penpal/component/indexMenu.country_all')</option>
                            <option value="ko">@lang('penpal/component/indexMenu.korea')</option>
                            <option value="jp">@lang('penpal/component/indexMenu.japan')</option>
                        </select>
                    
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="goal">@lang('penpal/component/indexMenu.goal'):</label>
                        <select name="goal" class="form-control input-sm" id="goal">
                            <option value="all">@lang('penpal/component/indexMenu.goal_all')</option>
                            <option value="1">@lang('penpal/component/indexMenu.e-mail_friend')</option>
                            <option value="2">@lang('penpal/component/indexMenu.heterosexual_friend')</option>
                            <option value="3">@lang('penpal/component/indexMenu.study')</option>
                            <option value="4">@lang('penpal/component/indexMenu.tour_guide')</option>
                            <option value="5">@lang('penpal/component/indexMenu.want_to_know')</option>
                            <option value="6">@lang('penpal/component/indexMenu.other')</option>
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="name">@lang('penpal/component/indexMenu.nickname'):</label>
                        <input name="name" id="name" class="form-control input-sm" maxlength="50" autocomplete=off>
                    </div>
                    <div class="form-group col-md=3 pdt1">
                            
                        <input style="margin-left: 30px" type="checkbox" name="cehck_photo" value="photo" id="check_photo" />
                        <label  id="check_photo_label" for="check_photo">@lang('penpal/component/indexMenu.photo')</label>
                        <button class="btn btn-info" style="margin-left:40px" type="submit"><i
                                class="fa fa-search">@lang('penpal/component/indexMenu.search')</i></button>
                    </div>
                </div>
            </div>
            
        </div>
        
    </form>
</div>

<link rel="stylesheet" href="{{asset('/css/nouislider.css')}}">
<script src="{{asset('/js/nouislider.js')}}"></script>

