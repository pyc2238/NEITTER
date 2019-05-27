@foreach($penpals as $penpal)
<div class="row penpal-list-box">
    <div class="col-2 penpal-list-image">
           
            <a href=""><img src="{{ $penpal->image }}" alt="No Image"
                style="max-width: none; height: 130px; display: inline; "
                 height="130px" width="125px" class="img-thumbnail"></a>
    </div>
    <div class="col-10 penpal-list-card">

        <div class="row penpal-list-card-body">
            <div class="col penpal-list-card-border">
                <div class="row">
                    <div class="col penpal-list-title">
                        {{ $penpal->user->name  }}
                            @if($penpal->user->gender == 'men')
                                <img src="{{ asset("data/ProjectImages/master/men.png") }}" alt="men"></td>
                            @else
                                <img src="{{ asset("data/ProjectImages/master/women.png") }}" alt="women"></td>
                            @endif
                        {{ $penpal->user->age  }}
                            @if($penpal->user->country == 'ko')
                                <img src="{{ asset("data/ProjectImages/master/korea.png") }}" alt="men"></td>
                            @else
                                <img src="{{ asset("data/ProjectImages/master/japan.png") }}" alt="women"></td>
                            @endif

                    </div>
                    <div class="col penpal-list-menu" >
                     
                    </div>
                    <div class="col penpal-list-date">
                        {{ $penpal->created_at  }}
                    </div>
                </div>
            </div>
            <div class="w-100 penpal-list-center"></div>
            <div class="col penpal-list-body">
                    <p id="self_context">{{ $penpal->self_context  }}</p>
                    <p id="translation">{{ $penpal->translation  }}</p>
                   
            </div>
        </div>


    </div>

</div>
@endforeach