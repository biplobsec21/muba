@extends('Admin.fixed.master')

@section('left_bar')
@include('Admin.fixed.left_bar')
@endsection

@section('top_bar')
@include('Admin.fixed.top_bar')
@endsection

@section('alert')
@include('Admin.fixed.alert')
@endsection

@section('content')
<!-- top tiles -->
<style type="text/css">
canvas{

  /*width:1000px !important;
  height:600px !important;*/

}
</style>
<div class="row tile_count">
    
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-group"></i></div>
                  <div class="count">179</div>
                  <h3>Total Users</h3>
                  <p>Total user in the application </p>
                </div>
              </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count">179</div>
                  <h3>Schedule</h3>
                  <p>Total Number of Schedule</p>
                </div>
              </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">179</div>
                  <h3>Total Surgery </h3>
                  <p>Total number of surgery</p>
                </div>
    </div>
</div>
<!-- /top tiles -->
<div class="row">
<!--              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Transaction Summary <small>Weekly progress</small></h2>
                    <div class="filter">
                      <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>January 23, 2018 - February 21, 2018</span> <b class="caret"></b>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                 
                </div>
              </div>-->
            </div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Dashboard</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row" align="center">
                    <h3>Surgery Chart Distributed by Day of the Week</h3>
                </div>
                <div class="clearfix"></div>
                <br>

                <div class="row">
                    <div class="col-sm-6">
                        <canvas id="hbarChart"></canvas>
                    </div>
                    <div class="col-sm-6">
                        <canvas id="doughnutChart"></canvas> 
                    </div>
                </div>
                <br><br>

                <div class="row" align="center">
                    <h3>Surgery Chart Distributed Yearly</h3>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                <br><br>

                <div class="row" align="center">
                    <h3>Chart of Surgeries Performed and Canceled</h3>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <canvas id="pieChartP"></canvas>
                    </div>
                </div>
                <br><br>

            </div>
        </div>
    </div>

</div>
@endsection

@section('foot_css_js')
<script>
var ctx = document.getElementById("hbarChart").getContext('2d');
var hbarChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri","Sat"],
        datasets: [{
            label: 'Fulfilled',
            data: [
                {{ isset($processArray['Sunday']) ?  $processArray['Sunday']['finished'] : 0 }},
                {{ isset($processArray['Monday']) ?  $processArray['Monday']['finished'] : 0 }},
                {{ isset($processArray['Tuesday']) ?  $processArray['Tuesday']['finished'] : 0 }},
                {{ isset($processArray['Wednesday']) ?  $processArray['Wednesday']['finished'] : 0 }},
                {{ isset($processArray['Thursday']) ?  $processArray['Thursday']['finished'] : 0 }},
                {{ isset($processArray['Friday']) ?  $processArray['Friday']['finished'] : 0 }},
                {{ isset($processArray['Saturday']) ?  $processArray['Saturday']['finished'] :0 }}
            ],
            backgroundColor: '#549AD6'
        },{
            label: 'Canceled',
            data: [
                {{ isset($processArray['Sunday']) ?  $processArray['Sunday']['canceled'] : 0 }},
                {{ isset($processArray['Monday']) ?  $processArray['Monday']['canceled'] : 0 }},
                {{ isset($processArray['Tuesday']) ?  $processArray['Tuesday']['canceled'] : 0 }},
                {{ isset($processArray['Wednesday']) ?  $processArray['Wednesday']['canceled'] : 0 }},
                {{ isset($processArray['Thursday']) ?  $processArray['Thursday']['canceled'] : 0 }},
                {{ isset($processArray['Friday']) ?  $processArray['Friday']['canceled'] : 0 }},
                {{ isset($processArray['Saturday']) ?  $processArray['Saturday']['canceled'] :0 }}
            ],
            backgroundColor: '#EA8136'
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        title: {
            display: true,
            text: 'Horizontal Bar Chart'
        },
        legend: {
            display: true,
            position: 'bottom'
        }
    }
});

var ctx = document.getElementById("doughnutChart").getContext('2d');
var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                {{ isset($processArray['Sunday']) ?  $processArray['Sunday']['finished'] : 0 }},
                {{ isset($processArray['Monday']) ?  $processArray['Monday']['finished'] : 0 }},
                {{ isset($processArray['Tuesday']) ?  $processArray['Tuesday']['finished'] : 0 }},
                {{ isset($processArray['Wednesday']) ?  $processArray['Wednesday']['finished'] : 0 }},
                {{ isset($processArray['Thursday']) ?  $processArray['Thursday']['finished'] : 0 }},
                {{ isset($processArray['Friday']) ?  $processArray['Friday']['finished'] : 0 }},
                {{ isset($processArray['Saturday']) ?  $processArray['Saturday']['finished'] :0 }}
            ],
            backgroundColor: ['#3366CC','#DD3811','#FA9C00','#12951A','#9D009F','#0496C4','#E04277']
        }],
        labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri","Sat"]
    },
    options: {
        title: {
            display: true,
            text: 'Doughnut Chart'
        },
        legend: {
            display: true,
            position: 'bottom'
        }
    }
});

var ctx = document.getElementById("barChart").getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: 'Fulfilled',
            data: [10,10,10,10,10,10,10,10,10,10,10,10],
            backgroundColor: '#FBDB35'
        },{
            label: 'Canceled',
            data: [5,5,5,5,5,5,5,5,5,5,5,5],
            backgroundColor: '#02C3AA'
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        title: {
            display: true,
            text: 'Bar Chart'
        },
        legend: {
            display: true,
            position: 'bottom'
        }
    }
});

var ctx = document.getElementById("pieChartP").getContext('2d');
var myPieChartP = new Chart(ctx,{
    type: 'pie',
    data: {
        datasets: [{
            data: [2007, 247],
            backgroundColor: ['#55B5EF','#02C3AA']
        }],
        labels: ["Performed", "Canceled"]
    },
    options: {
        title: {
            display: true,
            text: 'Pie Chart'
        },
        legend: {
            display: true,
            position: 'bottom'
        }
    }
});
</script>
@endsection
