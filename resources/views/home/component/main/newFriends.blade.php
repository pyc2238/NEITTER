
<div class="col newFriendsBox" style="margin-top:2%; padding-bottom:3%;">
        <h5 style="padding-top:2%"><i class="fa fa-users" style="color:blue"></i>&nbsp;@lang('home/main.new_friends')</h5> 
    <hr>
    @if(count($penpals) === 0)
        <h3 class="text-center"><i class="fa fa-bell-slash"></i>@lang('home/main.not_friends')</h3>
    @else
        @foreach($penpals->chunk(8) as $penpalsGroup)
        <div class="row">
            @foreach($penpalsGroup as $penpal)
                <div class="col penpal-image-box" style="margin-top:10px">
                    <table class="penpal-image-list">
                        <tr>
                            <td>
                                <a href="{{ route('penpal.friends',['id' => $penpal->id]) }}">
                                    @if($penpal->image)
                                            <img 
                                                src="{{ $penpal->image }}" 
                                                alt="No Image"
                                                style="max-width: none; height: 125px; width: 125px; display: inline; " 
                                                class="img-thumbnail image-list" />
                                        
                                    @else
                                        @if($penpal->user->selfPhoto != null)
                                            
                                                <img 
                                                    src="{{ $penpal->user->selfPhoto }}" 
                                                    alt="No Image"
                                                    style="max-width: none; height: 125px; width: 125px; display: inline;" 
                                                    class="img-thumbnail image-list" />
                                        @else
                                            
                                                <img 
                                                    src="{{ asset("data/ProjectImages/master/logoImage/6.png") }}" 
                                                    alt="No Image"
                                                    style="max-width: none; height: 125px; width: 125px; display: inline;" 
                                                    class="img-thumbnail image-list" />
            
                                        @endif
                                        
                                    @endif
                                </a>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td class="image-iist-info">
                                <span style="font-size:10px">{{ $penpal->user->name  }}</span>

                                @if($penpal->user->gender == 'men')
                                    <img style="width:10px" src="{{ asset("data/ProjectImages/master/men.png") }}" alt="men">
                                @else
                                    <img style="width:10px" src="{{ asset("data/ProjectImages/master/women.png") }}" alt="women">
                                @endif

                                <span style="font-size:10px">{{ $penpal->user->age  }}</span>

                                @if($penpal->user->country == 'ko')
                                    <img style="width:10px" src="{{ asset("data/ProjectImages/master/korea.png") }}" alt="korea">
                                @else
                                    <img style="width:10px" src="{{ asset("data/ProjectImages/master/japan.png") }}" alt="japan">
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    @endforeach
    @endif
</div>