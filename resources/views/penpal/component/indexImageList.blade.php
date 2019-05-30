@foreach($penpals as $penpal)
<div class="row">
    <div class="col" style="border:1px solid red">
        <table border>
            <tr style="border:1px solid red">
                <td>
                    @if($penpal->image != null)
                        <a href="#"><img src="{{ $penpal->image }}" alt="No Image"
                                style="max-width: none; height: 170px; display: inline; " height="170px" width="170px"
                                class="img-thumbnail"></a>
                    @else
                        <a href="#"><img src="{{ asset("data/ProjectImages/master/logoImage/6.png") }}" alt="No Image"
                            style="max-width: none; height: 170px; display: inline; " height="170px" width="170px"
                            class="img-thumbnail"></a>
                    @endif
                </td>
            </tr>
            <tr class="text-center">
                <td>
                        {{ $penpal->user->name  }}
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
                </td>
            </tr>
        </table>
    </div>
    <div class="col" style="border:1px solid red">
        
    </div>
    <div class="col" style="border:1px solid red">
        3 of 3
    </div>
    <div class="col" style="border:1px solid red">
        4 of 4
    </div>
</div>
@endforeach
