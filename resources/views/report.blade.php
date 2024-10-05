@extends('adminMaster')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">My Dashboard</a></li>
            <li class="breadcrumb-item active">My Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <section>
    <div class="row container-fluid">
      <!-- /.col-md-6 -->
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card text-white">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h4 class="card-title">Total work monthly report</h4>
              <a href="javascript:void(0);">More</a>
            </div>
          </div>
          <div class="card-body">
            <!-- /.d-flex -->
            <div class="position-relative mb-4">
              <canvas id="sales-chart1" height="200"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
              <span class="mr-2">
                <i class="fas fa-square text-green"></i> Total Work
              </span>
              <span class="mr-2">
                <i class="fas fa-square text-blue"></i> Total Hour
              </span>
              <span class="mr-2">
                <i class="fas fa-square text-red"></i> Total Distance
              </span>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card -->
      <div class="col-lg-12 col-md-12 col-sm-12">
        <!-- DONUT CHART -->
        <div class="card">
          <div class="card-header">
          <h4 class="card-title">Top 5 Work Places</h4>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="donutChart1"></canvas>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <!-- DONUT CHART -->
        <div class="card">
          <div class="card-header">
          <h4 class="card-title">{{$month}} Month Work Report</h4>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-sm dTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Place</th>
                      <th>Duration</th>
                      <th>Distance</th>
                      <th>Company</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($thisMonthData as $key=>$record)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$record->date}}</td>
                      <td>{{$record['place']['name']}}</td>
                      <td>{{$record->duration}}</td>
                      <td>{{$record->distance}}</td>
                      <td>{{$record->description}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Place</th>
                      <th>Duration</th>
                      <th>Distance</th>
                      <th>Company</th>
                    </tr>
                  </tfoot>
                </table>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
</div>
<!-- plugin for the charts -->
<script src="{{asset('backend/assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Script file for the charts -->
<script type="text/javascript">
  $(function () {

    'use strict'

    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var $salesChart1 = $('#sales-chart1')

    // chart 1
    var salesChart1 = new Chart($salesChart1, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
          {
            backgroundColor: 'green',
            borderColor: 'green',
            data: [@foreach($totalYearlyWork as $key=>$value)
            {{ $value }},
            @endforeach]
          },
          {
            backgroundColor: 'blue',
            borderColor: 'blue',
            data: [@foreach($totalYearlyWorkDuration as $key=>$value)
            {{ $value }},
            @endforeach]
          },
          {
            backgroundColor: 'red',
            borderColor: 'red',
            data: [@foreach($totalYearlyWorkDistance as $key=>$value)
            {{ $value }},
            @endforeach]
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            // display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,

              // Include a dollar sign in the ticks
              callback: function (value) {
                if (value >= 1000) {
                  value /= 1000
                  value += '  K'
                }

                return value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    })

    // Donut 1
    var donutChartCanvas1 = $('#donutChart1').get(0).getContext('2d')
    var donutData = {
      labels: [
        @foreach($topFivePlaceName as $key=>$value)
        '{{$value}}',
        @endforeach
      ],
      datasets: [
        {
          data: [@foreach($topFivePlaceCount as $key=>$value)
              '{{$value}}',
              @endforeach],
          backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', 'White'],
        }
      ]
    }
    var donutOptions = {
      maintainAspectRatio: false,
      responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas1, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })
  })
</script>
<script>
    $(function () {
      var colsToExport = [0,1,2,3,4];
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": [{
        extend: 'copyHtml5',
        text: 'copy',
        exportOptions: {
          columns: colsToExport
        }
      } , {
        extend: 'excelHtml5',
        text: 'excel',
        exportOptions: {
          columns: colsToExport
        }
      }, {
        extend: 'pdfHtml5',
        text: 'pdf',
        exportOptions: {
          columns: colsToExport
        }
      }, {
        extend: 'csv',
        text: 'csv',
        exportOptions: {
          columns: colsToExport
        }
      },
      {
        extend: 'print',
        text: 'print',
        exportOptions: {
          columns: colsToExport
        }
      },'colvis']
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
