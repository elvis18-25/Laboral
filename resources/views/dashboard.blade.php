@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<link href="{{asset('css/mdtimepicker.css')}}" rel="stylesheet">

@include('Fullcalendar.create')
<style>
  .card-tasks{
    min-height: 100% !important;

  }
</style>
<div class="row">
  <div class="col-lg-4">
    <div class="card card-chart">
        <div class="card-header">
            <h5 class="card-category"><b>Empleados</b></h5>
            <h3 class="card-title"><i class="fas fa-user text-info" title="Inativos" style="font-size: 18px "></i></i>{{$count_empleado}}</h3>
        </div>
        <div class="card-body">
            <div class="chart-area">
                <canvas id="CountryChart"></canvas>
            </div>
        </div>
    </div>
</div>
    <div class="col-lg-4">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category"><b>DEPARTAMENTOS</b></h5>
                <h3 class="card-title"><i class="fas fa-warehouse"></i>{{$count_puesto}}</h3>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chartLinePurple"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category"><b> Generos</b></h5>
                <div class="form-inline">
                <h3 class="card-title"><i class="fas fa-female text-primary" title="Mujeres" style="font-size: 20px "></i>{{$count_mujeres}}</h3>&nbsp;&nbsp;&nbsp;&nbsp;
                <h3 class="card-title"> <i class="fas fa-male text-info" title="Hombres" style="font-size: 20px "></i>{{$count_hombres}}</h3>&nbsp;&nbsp;&nbsp;&nbsp;
                <h3 class="card-title"> <i class="fas fa-male" title="Indefinido" style="font-size: 20px "></i>{{$count_indefinido}}</h3>
              </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chartLineGreen"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category"></h5>
                            <h2 class="card-title"><b> Gastos de la Empresa</b></h2>
                        </div>
                        <div class="col-sm-6">

                          <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 50%; float: inline-end;">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartBig1d"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="o-page-loader">
      <div class="o-page-loader--content">
        <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
          {{-- <div class=""></div> --}}
          <div class="o-page-loader--message">
              <span>Cargando...</span>
          </div>
      </div>
  </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header ">
                    <h4 class="title d-inline">Lista</h4>
                    <p class="card-category d-inline">Hoy</p>
                    {{-- <div class="dropdown">
                        <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                            <i class="tim-icons icon-settings-gear-63"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#pablo">Action</a>
                            <a class="dropdown-item" href="#pablo">Another action</a>
                            <a class="dropdown-item" href="#pablo">Something else</a>
                        </div>
                    </div> --}}
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Update the Documentation</p>
                                        <p class="text-muted">Dwuamish Head, Seattle, WA 8:47 AM</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">GDPR Compliance</p>
                                        <p class="text-muted">The GDPR is a regulation that requires businesses to protect the personal data and privacy of Europe citizens for transactions that occur within EU member states.</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Solve the issues</p>
                                        <p class="text-muted">Fifty percent of all respondents said they would be more likely to shop at a company </p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Release v2.0.0</p>
                                        <p class="text-muted">Ra Ave SW, Seattle, WA 98116, SUA 11:19 AM</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Export the processed files</p>
                                        <p class="text-muted">The report also shows that consumers will not easily forgive a company once a breach exposing their personal data occurs. </p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Arival at export process</p>
                                        <p class="text-muted">Capitol Hill, Seattle, WA 12:34 AM</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"><b>CALENDARIO</b></h4>
                </div>
                <div class="card-body">
                  <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('js')

<script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
<script src="{{asset('js/pageLoader.js')}}"></script>
<script src="{{asset('js/mdtimepicker.js')}}"></script>


{{-- {!! Charts::assets(['highcharts']) !!}
{!! $usersChart->script() !!} --}}

    <script>
       
       $('#timepicker').mdtimepicker();

        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',

//  customButtons: {
//     myCustomButton: {
//       text: 'custom!',
//       click: function() {
//        $("#opnemodal").trigger("click");
//       }
//     }
//   },

  headerToolbar: {
    left: 'prev,next today ',
    center: 'title',
    right: 'myCustomButton'
  },

  dateClick: function(info) {

    $("#opnemodal").trigger("click");
    $("#txtfecha").val(info.dateStr)
    calendar.addEvent({title:"Eventos mio",date:info.dateStr});
  },

  eventClick: function(info){
    // console.log(info.event.title);
    // console.log(info.event.start);

    // console.log(info.event.extendedProps.descripcion);
  },

  events:[
    {
      title:"Mi evento",
      start:"2021-05-18 10:00:00",
      descripcion:"Este dia voy para la playa"
    },{
      title:"Mi evento 2",
      start:"2021-05-24 10:00:00",
      end:"2021-05-27 10:00:00",
      color:"#FFCCAA",
      textColor:"#000",
      descripcion:" Ir Para el dentista"

    }
  ]

        });

        calendar.setOption('locale','Es');
        calendar.render();
      });

      $("#btnsave").on('click',function(){
        RecolectarDatos("POST");

      })

      function RecolectarDatos(method){
        nuevoEvento={
          titulo:$("#txttitulo").val(),
          descripcion:$("#textarea").val(),
          color:$("#txtcolor").val(),
          textcolor:'#FFFFFF',
          start:$("#txtfecha").val()+" "+$("#timepicker").val(),
          end:$("#txtfecha").val()+" "+$("#timepicker").val(),
          '_token':$("meta[name='csrf-token']").attr("content"),
          '_method':method

        }
        console.log(nuevoEvento);
      }



      var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
      

      $(document).ready(function() {

        var data_puesto = <?php echo $puesto_empleado; ?>;
        gradientChartOptionsConfigurationWithTooltipBlue = {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          
          tooltips: {
            backgroundColor: '#f5f5f5',
            titleFontColor: '#333',
            bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.0)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 60,
            suggestedMax: 125,
            padding: 20,
            fontColor: "#2380f7"
          }
        }],

        xAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#2380f7"
          }
        }]
      }
    };
    
    var data_click = <?php echo $puesto; ?>;
    gradientChartOptionsConfigurationWithTooltipPurple = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.0)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 60,
            suggestedMax: 125,
            padding: 20,
            fontColor: "#9a9a9a"
          }
        }],

        xAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(225,78,202,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9a9a9a"
          }
        }]
      }
    };

    gradientChartOptionsConfigurationWithTooltipOrange = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.0)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 50,
            suggestedMax: 110,
            padding: 20,
            fontColor: "#ff8a76"
          }
        }],

        xAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(220,53,69,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#ff8a76"
          }
        }]
      }
    };

    gradientChartOptionsConfigurationWithTooltipGreen = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.0)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 50,
            suggestedMax: 125,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(0,242,195,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    };


    gradientBarChartConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 60,
            suggestedMax: 120,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    };

    var ctx = document.getElementById("chartLinePurple").getContext("2d");

    var gradientStrokew = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStrokew.addColorStop(1, 'rgba(72,72,176,0.2)');
    gradientStrokew.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStrokew.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

    
    var myChart = new Chart(ctx, {
      type: 'bar',
      responsive: true,
      legend: {
        display: false
      },
      data: {
        labels: data_click,
        datasets: [{
          label: "Empleado",
          fill: true,
          backgroundColor: gradientStrokew,
          hoverBackgroundColor: gradientStrokew,
          borderColor: '#d346b1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          data: data_puesto,
        }]
      },
      options: gradientBarChartConfiguration
    });


    var ctxgreesn = document.getElementById("chartLineGreen").getContext("2d");

      var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);


    gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
    gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)'); //green colors
    gradientStroke.addColorStop(0, 'rgba(66,134,121,0)'); //green colors


    var myChart = new Chart(ctxgreesn, {
      type: 'bar',
      responsive: true,
      legend: {
        display: false
      },
      data: {
        labels: ['Hombre', 'Mujer', 'Indefinido'],
        datasets: [{
          label: "Empleado",
          fill: true,
          backgroundColor: gradientStroke,
          hoverBackgroundColor: gradientStroke,
          borderColor: '#00d6b4',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          data: [{{$count_hombres}}, {{$count_mujeres}}, {{$count_indefinido}}],
        }]
      },
      options: gradientBarChartConfiguration
    });



    var cData = <?php echo $data; ?>;
    var cMoth = <?php echo $moth; ?>;

    var cDatanom = <?php echo $datanom; ?>;
    var cMothnom = <?php echo $mothnom; ?>;
    

    var meses=[];
    var monto=[];
    var list=0;
  for (var mes = 1; mes <=12; mes++) {
    list++;
    for (pos=0; pos <12; pos++) {

        if(cMoth[pos]==mes && mes==1){
          meses[pos]="ENERO";
          monto[pos]=cData[pos];
        }

        if(mes==2 && cMoth[pos]==mes){
          meses[pos]="FEBRERO";
          monto[pos]=cData[pos];
        }

        if(cMoth[pos]==mes && mes==3){
          meses[pos]="MARZO";
          monto[pos]=cData[pos];
        }

        if(mes==4 && cMoth[pos]==mes){
          meses[pos]="ABRIL";
          monto[pos]=cData[pos];
        }

        if(mes==5 && cMoth[pos]==mes){
          meses[pos]="MAYO";
          monto[pos]=cData[pos];
        }

        if(mes==6 && cMoth[pos]==mes){
          meses[pos]="JUNIO";
          monto[pos]=cData[pos];
        }
        if(mes==7 && cMoth[pos]==mes){
          meses[pos]="JULIO";
          monto[pos]=cData[pos];
        }
        if(mes==8 && cMoth[pos]==mes){
          meses[pos]="AGOSTO";
          monto[pos]=cData[pos];
        }
        if(mes==9 && cMoth[pos]==mes){
          meses[pos]="SEPTIEMBRE";
          monto[pos]=cData[pos];
        }
        if(mes==10 && cMoth[pos]==mes){
          meses[pos]="OCTUBRE";
          monto[pos]=cData[pos];
        }
        if(mes==11 && cMoth[pos]==mes){
          meses[pos]="NOVIEMBRE";
          monto[pos]=cData[pos];
        }
        if(mes==12 && cMoth[pos]==mes){
          meses[pos]="DICIEMBRE";
          monto[pos]=cData[pos];
        }
      
    }

  }

  // console.log(meses);

  // for (let index = 0; index < meses.length; index++) { 
  //     if(index==1){
  //       if(meses[index]==" "){
  //       meses[index]="ENERO"
  //       monto[index]=0;
  //       }
  //     } 
  // }


    // var meses = (['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE']);
    // var chart_data = [100, 70, 90, 70, 85, 60, 75, 60, 90, 80, 110, 100];


    var ctx = document.getElementById("chartBig1d").getContext('2d');

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
    gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors
    var config = {
      type: 'line',
      data: {
        labels: meses,
        datasets: [{
          label: "Monto",
          fill: true,
          backgroundColor: gradientStroke,
          borderColor: '#d346b1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: '#d346b1',
          pointBorderColor: 'rgba(255,255,255,0)',
          pointHoverBackgroundColor: '#d346b1',
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: monto,
        }]
      },
      options: gradientChartOptionsConfigurationWithTooltipPurple
    };
    var myChartData = new Chart(ctx, config);
    $("#0").click(function() {
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
    $("#1").click(function() {
      var chart_data = [80, 120, 105, 110, 95, 105, 90, 100, 80, 95, 70, 120];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });

    $("#2").click(function() {
      var chart_data = [60, 80, 65, 130, 80, 105, 90, 130, 70, 115, 60, 130];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });




    var ctx = document.getElementById("CountryChart").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
    gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
    gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors


    var myChart = new Chart(ctx, {
      type: 'bar',
      responsive: true,
      legend: {
        display: false
      },
      data: {
        labels: ['Activos', 'Vacaciones', 'Licencia'],
        datasets: [{
          label: "Countries",
          fill: true,
          backgroundColor: gradientStroke,
          hoverBackgroundColor: gradientStroke,
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          data: [{{$count_empleado}}, 0, 0],
        }]
      },
      options: gradientBarChartConfiguration
    });

        });


    </script>


@endpush



