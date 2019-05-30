
<div class="row">
    <div class="col">

    </div>
    <div class="col-10">
        @foreach($penpals as $penpal)
        <table border="1px solid">
            <tr>
                <td width="110px" rowspan="2"> 
                    {{-- <img src="{{ $penpal->image }}
                        height="120px" width="110px" class="img-thumbnail"> --}}
                        <a href=""><img src="{{ $penpal->image }}" alt="No Image"
                            style="max-width: none; height: 120px; display: inline; "
                             height="120px" width="125px" class="img-thumbnail"></a>
                    
                    </td>
                <td width="900" height="20">
                    <div class="row">
                        <div class="col-9" style="border:1px solid red">
                                {{ $penpal->user->name  }}
                                @if($penpal->user->gender == 'men')
                                <img src="{{ asset("data/ProjectImages/master/men.png") }}" alt="men"></td>
                            @else
                                <img style="border:1px solid blue" src="{{ asset("data/ProjectImages/master/women.png") }}" alt="women"></td>
                            @endif
                               
                                
                        </div>
                        <div class="col" style="border:1px solid red">
                            2 of 3
                        </div>
                        <div class="col" style="border:1px solid red">
                            3 of 3
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <p>asd</p>
                    <p>asd</p>
                </td>
            </tr>

        </table>
        @endforeach
    </div>
    <div class="col">

    </div>
</div>
