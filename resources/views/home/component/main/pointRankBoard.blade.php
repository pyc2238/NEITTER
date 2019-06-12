<div class="penpal-point-box">

    <div class="col">
        <h5 style="padding-top:2%;"><i class="fa fa-calendar" style="color:blue"></i>&nbsp;@lang('home/main.excellent_member')
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
                    <td style="width:50px"><span style="color:blue">{{ $winner->point }}</span><span>P</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
