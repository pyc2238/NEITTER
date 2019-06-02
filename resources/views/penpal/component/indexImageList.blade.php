@foreach($penpals->chunk(4) as $penpalsGroup)
    <div class="row">
        @foreach($penpalsGroup as $penpal)
            <div class="col penpal-image-box">
                <table class="penpal-image-list">
                    <tr>
                        <td>
                            @if($penpal->image)
                                <a href="#">
                                    <img 
                                        src="{{ $penpal->image }}" 
                                        alt="No Image"
                                        style="max-width: none; height: 170px; width: 180px; display: inline; " 
                                        class="img-thumbnail image-list" />
                                </a>
                            @else
                                @if($penpal->user->selfPhoto != null)
                                    <a href="#">
                                        <img 
                                            src="{{ $penpal->user->selfPhoto }}" 
                                            alt="No Image"
                                            style="max-width: none; height: 170px; width: 180px; display: inline;" 
                                            class="img-thumbnail image-list" />
                                    </a>
                            
                                @else
                                    <a href="#">
                                        <img 
                                            src="{{ asset("data/ProjectImages/master/logoImage/6.png") }}" 
                                            alt="No Image"
                                            style="max-width: none; height: 170px; width: 180px; display: inline;" 
                                            class="img-thumbnail image-list" />
                                    </a>
    
                                @endif
                                
                            @endif
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td class="image-iist-info">
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
        @endforeach
    </div>
@endforeach
