<div class="row" style="margin-top:2%;padding-left:4%;">
        <div class="col">
          @if(Auth::id() === $friend->user->id)
          <a  class="btn btn-warning" href="{{ route('penpal.show.edit',['id' => $friend->id]) }}"><i class="fa fa-edit" style="color:white">&nbsp;@lang('penpal/show.edit')</i></a> 
          <a  class="btn btn-danger" onclick="location.href='{{ route('penpal.show.delete',['id' => $friend->id])}}'"><i class="fa fa-trash" style="color:white">&nbsp;@lang('penpal/show.delete')</i></a>  
          
          @endif
          <a  class="btn btn-info"><i class="fa fa-envelope" style="color:white">&nbsp;@lang('penpal/show.mail')</i></a>
          <a  class="btn btn-success"><i class="fa fa-user-plus" style="color:white">&nbsp;@lang('penpal/show.friends')</i></a>
          @if( Auth::check() && Auth::id() === $friend->user->id)
              <a  class="btn btn-secondary"  data-toggle="modal" data-target="#Modal-winks"><i class="fa fa-grin-wink" style="color:white">&nbsp;@lang('penpal/show.wink')
                    <span style="background-color:white; border-radius: 80px / 40px; color:#98989A">{{ $friend->winks_count }}</span>
                </i></a>
              <a  class="btn btn-primary"  data-toggle="modal" data-target="#Modal-visitors"><i class="fa fa-eye" style="color:white">&nbsp;@lang('penpal/show.visitors')
                    <span style="background-color:white; border-radius: 80px / 40px; color:#5874EC">{{ $friend->visitors_count }}</span>
                </i></a>
          @else
              <a  class="btn btn-secondary" id="winkBtn"><i class="fa fa-grin-wink" style="color:white">&nbsp;@lang('penpal/show.wink')
                    <span style="background-color:white; border-radius: 80px / 40px; color:#98989A">{{ $friend->winks_count }}</span>
                </i></a>
              <a  class="btn btn-primary"><i class="fa fa-eye" style="color:white">&nbsp;@lang('penpal/show.visitors')
                  <span style="background-color:white; border-radius: 80px / 40px; color:#5874EC">{{ $friend->visitors_count }}</span>
                </i></a>
          @endif  
        </div>
        
        
      </div>

     <script>
     $("#winkBtn").click(function(){
    $.ajax({
        url: '{{route('penpal.show.wink')}}',
        type: 'post',
        data: {_token: "{{ csrf_token() }}",
               'user_id': '{{ Auth::id() }}',
               'penpal_id': '{{ $friend->id }}',
               },
        success: function (data) {
            if(!data){
                console.log('success!!');
            }else{
                alert(data);
            }
            
        }, error: function () {
            alert("error!!!!");
        }
    });

});

     </script>