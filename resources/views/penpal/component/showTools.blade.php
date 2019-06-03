<div class="row" style="margin-top:2%;padding-left:4%;">
        <div class="col">
          @if(Auth::id() == $friend->user->id)
          <a  class="btn btn-warning" href="{{ route('penpal.show.edit',['id' => $friend->id]) }}"><i class="fa fa-edit" style="color:white">&nbsp;@lang('penpal/component/showIntroBox.edit')</i></a>  
          @endif
          <a  class="btn btn-info"><i class="fa fa-envelope" style="color:white">&nbsp;@lang('penpal/component/showIntroBox.mail')</i></a>
          <a  class="btn btn-success"><i class="fa fa-user-plus" style="color:white">&nbsp;@lang('penpal/component/showIntroBox.friends')</i></a>
          <a  class="btn btn-danger"><i class="fa fa-grin-wink" style="color:white">&nbsp;@lang('penpal/component/showIntroBox.wink')
                <span style="background-color:white; border-radius: 80px / 40px; color:#E75151">12</span>
            </i></a>
          <a  class="btn btn-primary"><i class="fa fa-eye" style="color:white">&nbsp;@lang('penpal/component/showIntroBox.future')
                <span style="background-color:white; border-radius: 80px / 40px; color:#5874EC">24</span>
            </i></a>
        </div>
        
        
      </div>