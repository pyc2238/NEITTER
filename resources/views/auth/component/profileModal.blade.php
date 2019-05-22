<style>
    .scrolltbody {
        display: block;
        width: 100%;
        border-collapse: collapse;
        border: 2px solid #000;
    
    }
 
    .scrolltbody tbody {
        display: block;
        height: 350px;
        overflow: auto;
    }
 
    </style>

<!-- profile Modal -->
<div class="modal fade" id="Modal-large-demo" tabindex="-1" role="dialog" aria-labelledby="Modal-large-demo-label"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <img src="{{asset('data/ProjectImages/master/userInfo.png')}}" alt="user">
            <h5 class="modal-title" id="Modal-large-demo-label">@lang('auth/profile.model_information')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">


            <div class="row">
                <div class="col">
                    @if(Auth::user()->selfPhoto == null)
                    <img src="{{asset('data/ProjectImages/master/basics.jpg')}}" alt="selfPhoto" class="img-thumbnail"
                        width="100%">
                    <h4 class="text-center" style="margin-top:3%"><b>@lang('auth/profile.model_notice')</b></h4>
                    @else
                    <img src="{{Auth::user()->selfPhoto}}" alt="selfPhoto" class="img-thumbnail"
                        width="100%">
                    <h4 class="text-center" style="margin-top:3%"><b>@lang('auth/profile.model_photo')</b></h4>
                    @endif
                </div>
                <div class="col-7" >
                    <h5 class="text-center" style="background-color:#ea314e;color:white;"><b>@lang('auth/profile.model_profile')</b></h5>
                    <table class="table scrolltbody">
                        <tr>
                            <th>@lang('auth/profile.model_nickname')</th>
                            <td><b style="color:blue">{{Auth::user()->name}}<b></td>
                        </tr>
                        <tr>
                            <th>@lang('auth/profile.model_age')</th>
                            <td><b style="color:blue">{{Auth::user()->age}}<b></td>
                        </tr>
                        <tr>
                            <th>@lang('auth/profile.model_gender')</th>

                            @if(Auth::user()->gender == 'men')

                            <td><img src="{{asset("data/ProjectImages/master/men.png")}}" alt="men"></td>
                            @else
                            <td><img src="{{asset("data/ProjectImages/master/women.png")}}" alt="women"></td>
                            @endif

                        </tr>
                        <tr>
                            <th>@lang('auth/profile.model_area')</th>
                            <td><b style="color:blue">{{Auth::user()->address}}<b></td>
                        </tr>
                        <tr>
                            <th>@lang('auth/profile.model_Date_of_entry')</th>
                            <td><b style="color:blue">{{Auth::user()->created_at}}<b></td>
                        </tr>
                        <tr>
                                <th>@lang('auth/profile.model_is_penpal')</th>
                                @if(Auth::user()->is_penpal == 1)
                                <td><b style="color:blue">@lang('auth/profile.model_onPenpal')<b></td>
                                @else
                                <td><b style="color:blue">@lang('auth/profile.model_offpenpal')<b></td>
                                @endif
                                
                        </tr>
                        <tr>
                            <th>@lang('auth/profile.model_self_introduction')</th>
                            <td><b style="color:blue">{{Auth::user()->selfContext}}<b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('auth/profile.model_check')</button>
        </div>
    </div>
</div>
</div>