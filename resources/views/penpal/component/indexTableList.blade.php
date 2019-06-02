@foreach($penpals as $penpal)

<table class="penpal-list-table">

    <tr>

        <td rowspan=3>
            @if($penpal->image != null)
                <a href="#"><img src="{{ $penpal->image }}" alt="No Image"
                        style="max-width: none; height: 130px; display: inline; " height="80px" width="135px"
                        class="img-thumbnail image-list"></a>
            @else
                @if($penpal->user->selfPhoto != null)
                    <a href="#"><img src="{{ $penpal->user->selfPhoto }}" alt="No Image"
                        style="max-width: none; height: 130px; display: inline; " height="80px" width="135px"
                        class="img-thumbnail image-list"></a>

                @else
                    <a href="#"><img src="{{ asset("data/ProjectImages/master/logoImage/6.png") }}" alt="No Image"
                    style="max-width: none; height: 130px; display: inline; " height="80px" width="135px"
                    class="img-thumbnail image-list"></a>
                @endif
                
            @endif
        </td>

        <td class="penpal-list-title">
            <b style="font-size:13px">{{ $penpal->user->name  }}</b>
            @if($penpal->user->gender == 'men')
                <img src="{{ asset("data/ProjectImages/master/men.png") }}" alt="men">
            @else
                <img src="{{ asset("data/ProjectImages/master/women.png") }}" alt="women">
            @endif
                {{ $penpal->user->age  }}
            @if($penpal->user->country == 'ko')
                <img src="{{ asset("data/ProjectImages/master/korea.png") }}" alt="men">
            @else
                <img src="{{ asset("data/ProjectImages/master/japan.png") }}" alt="women">
            @endif
            <span class="float-right">{{ $penpal->created_at  }}</span>
        </td>

    </tr>

    <tr>

        <td class="penpal-list-content" id="list-content" colspan=3>
            {{ $penpal->self_context  }}
        </td>

    </tr>

    <tr>

        <td class="penpal-list-translation" colspan=3>
            {{ $penpal->translation  }}
        </td>

    </tr>

</table>
@endforeach
