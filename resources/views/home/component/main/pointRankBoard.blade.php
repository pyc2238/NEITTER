<div class="penpal-point-box">

    <div class="col">
        <h5 style="padding-top:2%;"><i class="fa fa-calendar" style="color:blue"></i>&nbsp;NEITTER 우수 회원
        </h5>
        <hr>
        <table style="margin-top:5%; border-collapse: separate; border-spacing: 0 10px;">
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($winners as $winner)
                <tr>
                    <td scope="row"><span class="badge">{{ $i++ }}</span></td>
                    <td style="width:300px">{{ $winner->name }}</td>
                    <td></td>
                    <td style="width:50px">{{ $winner->point }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
