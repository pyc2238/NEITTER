
<!-- winks Modal -->
<div class="modal fade" id="Modal-winks" tabindex="-1" role="dialog" aria-labelledby="Modal-large-demo-label"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <img src="{{ asset('data/ProjectImages/master/heart.png') }}" alt="user">
            <h5 class="modal-title" id="Modal-large-demo-label" style="padding-left:10px;">WINKS</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body" style="overflow-y:scroll; height:450px;">
            <table class="table">

                <thead class="thead-dark">
                  <tr>
                    <th scope="col">@lang('penpal/show.nickname')</th>
                    <th scope="col">@lang('penpal/show.country')</th>
                    <th scope="col">@lang('penpal/show.gender')</th>
                    <th scope="col">@lang('penpal/show.date')</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($winks as $wink )
                  <tr>
                    <td>
                        <a class="visitorName" href="{{ route('penpal.index',['name' =>  $wink->name]) }}">{{ $wink->name }}</a>
                    </td>
                    <td>
                      @if($wink->country == 'ko')
                        <img src="{{ asset("data/ProjectImages/master/korea.png") }}" alt="korea">
                      @else
                        <img src="{{ asset("data/ProjectImages/master/japan.png") }}" alt="japan">
                      @endif
                  </td>
                  <td>
                      @if($wink->gender == 'men')
                        <img src="{{ asset("data/ProjectImages/master/men.png") }}" alt="men">
                      @else
                        <img src="{{ asset("data/ProjectImages/master/women.png") }}" alt="women">
                      @endif
                  </td>   
                    <td>{{ $wink->pivot->created_at }}</td>
                  </tr>
               @endforeach
                </tbody>
              </table>

           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('auth/profile.model_check')</button>
        </div>
    </div>
</div>
</div>