<!-- chart Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>

<div class="modal fade" id="Modal-chart" tabindex="-1" role="dialog" aria-labelledby="Modal-large-demo-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="col modal-content" style="height:1000;">
            <div class="modal-header">
                <img src="{{ asset('data/ProjectImages/master/userInfo.png')}}" alt="user">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
         
                <canvas id="myChart" style="margin-bottom:3%;"></canvas>
         
        </div>
    </div>
</div>
  
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['@lang('home/main.korea'){!! $koreaPenpalCount !!}', '@lang('home/main.japan'){!! $japanPenpalCount !!}'],
    datasets: [{
      backgroundColor: [
        "red",
        "blue",
        
      ],
      data: [
        {!! $koreaPercent !!} ,
        {!! $japanPercent !!} ,
      ]
    }]
  },
  options: {
      tooltips : {

      callbacks : { 
        label : function(tooltipItem, data) {
          var dataset = data.datasets[tooltipItem.datasetIndex];
                  return  dataset.data[tooltipItem.index] + ' %';
                },
        },
      },
  }
});

    
    </script>
    
    
    
