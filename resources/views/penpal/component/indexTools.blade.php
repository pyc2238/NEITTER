<div class="row">
    <div class="col">
            <i class="fa fa-exclamation-circle"></i>TOTAL : {{ $penpalsCount }}
    </div>
    <div class="col">
            <span id="penpal-image-view" class="fa fa-th float-right" style="font-size: 25px;"></span> 
            <span id="penpal-list-view" class="fa fa-list float-right" style="font-size: 25px;padding-right:7px;"></span> 
    </div>
    <div class="col">
        <div class="col">
            
            <form action="{{ route('penpal.index', ['list'=>$list,'page' => $page]) }}" method="post">
                @csrf
                <select id="inputState" class="form-control" style="height:35px; width:80%" name="list" onchange="this.form.submit()">
                    <option value="12">@lang('penpal/component/indexMenu.twelve')</option>
                    <option value="24">@lang('penpal/component/indexMenu.twenty_four')</option>
                    <option value="36">@lang('penpal/component/indexMenu.thirty_six')</option>
                </select>
            </form>
    
        </div>
        <div class="col">
              
        </div>
            
    </div>
</div>
