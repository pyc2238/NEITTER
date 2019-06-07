
    <div class="row">
            <div class="col"></div>
            <div class="col-6">
                    <form action="{{ route('penpal.penpal.registration') }}" method="post"
                        style="margin-top:8%;margin-bottom:8%" enctype="multipart/form-data">
        
                        @csrf
        
                        <i class="fa fa-exclamation-circle"><label for="inputNickname"><b>수신자 별명</b></label></i>
                        <input type="text" name="name" class="form-control">
                        <br>
                        <br>
        
        
                        <div class="form-group">
                            <label for="comment"><b>@lang('penpal/component/registration.selfContext')</b></label>
                            <textarea class="form-control" rows="5" style="resize: none;" name="selfContext" autocomplete=off
                                placeholder="@lang('auth/profile.self_introduction_notice')"
                                required></textarea>
                        </div>
                        <br>
                        <br>
        
    
                        <label for="exampleFormControlFile1">@lang('penpal/component/registration.photo')</label>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
        
                        <br>
                        <br>
                        <br>
           
                        <button style="padding-left:50%;padding-right:50%;" class="btn btn-primary " type="submit"><i class="fa fa-pencil">보내기</i></button>
                    </form>
        
                </div>
            <div class="col"></div>
        </div>