<!-- translation Modal -->
<div class="modal fade" id="Modal-translation" tabindex="-1" role="dialog" aria-labelledby="Modal-large-demo-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img style="width:7%" src="{{ asset('data/ProjectImages/master/papago.jpg') }}" alt="user">
                <h5 style="padding-top:1%;" class="modal-title" id="Modal-large-demo-label">
                    @lang('home/main.translator')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="translationDiv" class="row">
                    <div class="col">
                        <textarea class="form-control" id="translationBox" rows="10" style="resize: none;"
                            name="translationText" autocomplete=off></textarea>
                    </div>

                    <div class="col">
                        <textarea class="form-control" id="translationResBox" rows="10" style="resize: none;"
                            name="translationResText" autocomplete=off></textarea>
                    </div>
                </div>

                <div id="recodeDiv" class="row" style="margin-bottom:1%;">
                    <div class="col" style="overflow-y:scroll; height:243px;">
                        <table class="table table-hover">
                            <thead>
                            </thead>
                            <tbody id="transRecords">

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <button style="display:inline-block;margin-left:2%;" id="translationBtn" type="button"
                        class="btn btn-primary">@lang('home/main.translation')</button>
                    <button style="display:inline-block" id="translationRecodeBtn" type="button"
                        class="btn btn-success">@lang('home/main.translationRecord')</button>
                    <button style="display:inline-block; margin-bottom:2%;margin-right:2%;" id="closeBtn" type="button"
                        class="btn btn-danger float-right"
                        data-dismiss="modal">@lang('auth/profile.model_check')</button>

                </div>



            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        $('#translationDiv').show();
        $('#recodeDiv').hide();

        $('#translationRecodeBtn').click(function () {
            if($(".traRecods").length){
                $(".traRecods").remove();
            }
            $.ajax({
                url: '{{route('translation.recodes')}}',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    data.forEach((rec) => {
                        document.querySelector('#transRecords').innerHTML +=
                            `
                <tr class="traRecods">
                    <td id="recodeValue-${rec.id}" style="display:none">${rec.id}</td>
                    <td>${rec.korean}</td>
                    <td>${rec.japanese}</td>
                    <td><button id="recodeRemoveBtn-${rec.id}" type="button" class="btn btn-danger float-right">삭제</button></td>
                </tr>

                `
                    })

                },
                error: function () {
                    alert("error!!!!");
                }
            });
            $("#translationBox").val('');
            $("#translationResBox").val('');
            $('#translationDiv').hide();
            $('#recodeDiv').show();
        });

    });

    if ($('#translationDiv').hide()) {
        $('#translationBtn').click(function () {
            $('#recodeDiv').hide();
            $('#translationDiv').show();
        });
    }


    // translation ajax
    $("#translationBtn").click(function () {
        $.ajax({
            url: '{{route('translation')}}',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                'material': $('#translationBox').val(),
            },
            success: function (data) {
                $("#translationBox").val('');
                $("#translationResBox").val(data);

            },
            error: function () {
                alert("error!!!!");
            }
        });
    });

    $("#closeBtn").click(function () {
        $("#translationBox").val('');
        $("#translationResBox").val('');
        $('#translationDiv').show();
        $('#recodeDiv').hide();
    });



</script>
