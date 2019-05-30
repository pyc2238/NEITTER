@foreach($penpals as $penpal)
<table class="penpal-list-table">

    <tr>

        <td rowspan=3>
            <a href="#"><img src="{{ $penpal->image }}" alt="No Image"
                    style="max-width: none; height: 100px; display: inline; " height="80px" width="125px"
                    class="img-thumbnail"></a>
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

        <td class="penpal-list-content" colspan=3>
            {{ $penpal->self_context  }}
        </td>

    </tr>

    <tr>

        <td class="penpal-list-translation" colspan=3>
            {{-- {{ $penpal->translation  }} --}}
            {{ $penpal->self_context  }}
        </td>

    </tr>

</table>
@endforeach
