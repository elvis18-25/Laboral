@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<link href="{{asset('css/mdtimepicker.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/timepicker.min.css')}}">

@include('Fullcalendar.create')
@include('Fullcalendar.edit')
<style>
  /* .card-tasks{
    min-height: 100% !important;
  } */

  .fc-scrollgrid{
    cursor: pointer;
  }
  @media(max-width:: 870px){
    .card-tasks{
      min-height: 90% !important;
  }
  }
  .circulo {
    width: 60px;
    height: 60px;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    background: #4054b2;

      float: right;
      top: -86px;
      position: relative;
      margin-right: 31px;
}
.icons{
  font-size: 22px;
    color: white !important;
    position: relative;
    top: 18px;
    margin-right: 16px;
}
</style>
<div class="row">
  @php
      $a=0;
  @endphp
       
 @if ($permisos->total_empleado==1)
 @php
     $a=1;
 @endphp
 <div class="col-lg-4">
  <div class="card card-chart" style="height: 118px;">
      <div class="card-header">
        <div class="title" style="margin-top: 6px;">
          <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>TOTAL EMPLEADOS</b></h5>
          <h3 class="card-title">{{$count_empleado}}</h3>
        </div>
      </div>
      <div class="card-body">
        <div class="circulo" ><span style="float: right;"><i class="fas fa-users text-light icons"></i></i></span></div>
      </div>
  </div>
</div>    
 @endif

@php
    $b=0;
@endphp

@if ($permisos->total_usuarios==1)
@php
    $b=1;
@endphp
  @if ($a==1)
<div class="col-lg-4">
  <div class="card card-chart" style="height: 118px;">
    <div class="card-header">
      <div class="title" style="margin-top: 6px;">
            <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>TOTAL USUARIOS</b></h5>
            <h3 class="card-title">{{$count_users}}</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="circulo" ><span style="float: right;"><i class="fas fa-user-friends text-light icons"></i></i></span></div>
        </div>
      </div>
    </div>  
  @else
<div class="col-lg-6">
  <div class="card card-chart" style="height: 118px;">
    <div class="card-header">
      <div class="title" style="margin-top: 6px;">
            <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>TOTAL USUARIOS</b></h5>
            <h3 class="card-title">{{$count_users}}</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="circulo" ><span style="float: right;"><i class="fas fa-user-friends text-light icons"></i></i></span></div>
        </div>
      </div>
    </div>
  @endif
@endif

@php
    $c=0
@endphp
  @if ($permisos->total_departamentos==1)
  @php
      $c=1;
  @endphp
  @if ($b==1)
  <div class="col-lg-4">
    <div class="card card-chart" style="height: 118px;">
      <div class="card-header">
        <div class="title" style="margin-top: 6px;">
          <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>TOTAL DEPARTAMENTOS</b></h5>
            <h3 class="card-title">{{$count_puesto}}</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="circulo" ><span style="float: right;"><i class="fas fa-warehouse text-light icons"></i></i></span></div>
        </div>
      </div>
    </div>  
  @else
  <div class="col-lg-4">
    <div class="card card-chart" style="height: 118px;">
      <div class="card-header">
        <div class="title" style="margin-top: 6px;">
          <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>TOTAL DEPARTAMENTOS</b></h5>
            <h3 class="card-title">{{$count_puesto}}</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="circulo" ><span style="float: right;"><i class="fas fa-warehouse text-light icons"></i></i></span></div>
        </div>
      </div>
    </div>  
  @endif

    @endif

    @php
        $d=0;
    @endphp
    @if ($permisos->formas_pago==1)
    @php
        $d=1;
    @endphp
    @if ($c==1)
    <div class="col-lg-4">
      <div class="card card-chart" style="height: 118px;">
        <div class="card-header">
          <div class="title" style="margin-top: 6px;">
            <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>FORMAS DE PAGOS</b></h5>
            <h3 class="card-title">{{$count_pagos}}</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="circulo" ><span style="float: right;"><i class="fas fa-file-invoice-dollar text-light icons" style="font-size: 25px !important;
            margin-right: 20px !important;"></i></i></span></div>
        </div>
      </div>
    </div>  
    @else
    <div class="col-lg-4">
      <div class="card card-chart" style="height: 118px;">
        <div class="card-header">
          <div class="title" style="margin-top: 6px;">
            <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>FORMAS DE PAGOS</b></h5>
            <h3 class="card-title">{{$count_pagos}}</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="circulo" ><span style="float: right;"><i class="fas fa-file-invoice-dollar text-light icons" style="font-size: 25px !important;
            margin-right: 20px !important;"></i></i></span></div>
        </div>
      </div>
    </div> 
    @endif

    @endif

    @php
        $e=0;
    @endphp
@if ($permisos->totales_roles==1)
@php
    $e=1;
@endphp
@if ($d==1)
<div class="col-lg-4">
  <div class="card card-chart" style="height: 118px;">
    <div class="card-header">
      <div class="title" style="margin-top: 6px;">
            <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>TOTAL ROLES</b></h5>
            <h3 class="card-title">{{$count_roles}}</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="circulo" ><span style="float: right;"><i class="fas fa-user-cog text-light icons" style="font-size: 25px !important;
            margin-right: 11px !important;"></i></i></span></div>
        </div>
      </div>
    </div>  
@else
<div class="col-lg-4">
  <div class="card card-chart" style="height: 118px;">
    <div class="card-header">
      <div class="title" style="margin-top: 6px;">
            <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>TOTAL ROLES</b></h5>
            <h3 class="card-title">{{$count_roles}}</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="circulo" ><span style="float: right;"><i class="fas fa-user-cog text-light icons" style="font-size: 25px !important;
            margin-right: 11px !important;"></i></i></span></div>
        </div>
      </div>
    </div>
@endif

    @endif

@if ($permisos->reuniones==1) 
@if ($e==1)
<div class="col-lg-4">
  <div class="card card-chart" style="height: 118px;">
    <div class="card-header">
      <div class="title" style="margin-top: 6px;">
        <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>REUNIONES PENDIENTE</b></h5>
        <h3 class="card-title">0</h3>
      </div>
    </div>
    <div class="card-body">
      <div class="circulo" ><span style="float: right;"><i class="fas fa-user-clock text-light icons" style="font-size: 25px !important;
            margin-right: 11px !important;"></i></i></span></div>
        </div>
      </div>
    </div>  
@else
<div class="col-lg-4">
  <div class="card card-chart" style="height: 118px;">
    <div class="card-header">
      <div class="title" style="margin-top: 6px;">
        <h5 class="card-category" style="font-size: 19px !important; color: black !important"><b>REUNIONES PENDIENTE</b></h5>
        <h3 class="card-title">0</h3>
      </div>
    </div>
    <div class="card-body">
      <div class="circulo" ><span style="float: right;"><i class="fas fa-user-clock text-light icons" style="font-size: 25px !important;
            margin-right: 11px !important;"></i></i></span></div>
        </div>
      </div>
    </div> 
@endif

    @endif

  @if ($permisos->w_empleados==1)
    <div class="col-lg-4">
      <div class="card card-chart" >
        <div class="card-header">
          <h5 class="card-category" style="color: black"><b>EMPLEADOS</b></h5>
        </div>
        <div class="card-body">
            <div class="chart-area">
                {{-- <canvas id="CountryChart"></canvas> --}}
                {{-- <div id="chartbar"></div> --}}
                <div id="chartbar" style="height: 149%;
                top: -43px;
                position: relative;"></div>
                {{-- {!! $salesChart->container() !!} --}}
              </div>
            </div>
          </div>
      </div>
 @endif

@if ($permisos->w_departamentos==1)
<div class="col-lg-4">
  <div class="card card-chart">
    <div class="card-header">
      <h5 class="card-category" style="color: black"><b>DEPARTAMENTOS</b></h5>
    </div>
    <div class="card-body">
      <div class="chart-area">
        {{-- <canvas id="chartLinePurple"></canvas> --}}
        <div id="chartbardepartamen" style="height: 149%;
        top: -43px;
        position: relative;"></div>
      </div>
    </div>
  </div>
</div>
@endif

@if ($permisos->w_generos==1)
    <div class="col-lg-4">
        <div class="card card-chart" >
            <div class="card-header">
                <h5 class="card-category" style="color: black"><b> GENEROS</b></h5>
                <div class="form-inline">
                {{-- <h3 class="card-title"><i class="fas fa-female text-primary" title="Mujeres" style="font-size: 20px "></i>{{$count_mujeres}}</h3>&nbsp;&nbsp;&nbsp;&nbsp;
                <h3 class="card-title"> <i class="fas fa-male text-info" title="Hombres" style="font-size: 20px "></i>{{$count_hombres}}</h3>&nbsp;&nbsp;&nbsp;&nbsp;
                <h3 class="card-title"> <i class="fas fa-male" title="Indefinido" style="font-size: 20px "></i>{{$count_indefinido}}</h3> --}}
              </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    {{-- <canvas id="chartLineGreen"></canvas> --}}
                <div id="chartbarsex" style="height: 149%;
                top: -43px;
                position: relative;"></div>
                </div>
            </div>
        </div>
    </div>
  @endif

</div>
@if ($permisos->g_gasto==1)
    <div class="row">
        <div class="col-12">
            <div class="card card-chart" style="height: 99%; top: -15px;">
                <div class="card-header ">
                    <div class="row">
                      
                        <div class="col-sm-6 text-left">

                            <h5 class="card-category"></h5>

                            <h2 class="card-title"><b> GASTOS DE LA EMPRESA</b></h2>
                        </div>
                        <div class="col-sm-6">
                          <div id="Reportegastos" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 50%; float: right; color: black; float: right;">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        {{-- <canvas id="chartBig1d"></canvas> --}}
                        <div id="chart" style="height: 147%;
                        width: 120%;
                        top: -32px;
                        position: relative;
                        margin-left: -131px;
                        max-height: 305px;"></div>
                        {{-- {!! $bar!!} --}}
                        {{-- <div id="chart-container"></div> --}}
                      </div>
                </div>
            </div>
        </div>
    </div>
  @endif

    <div class="row">
      @if ($permisos->historial==1)
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header ">
                    <h4 class="title d-inline">HISTORIAL DE EMPLEADOS</h4>

                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 50%; float: right; color: black;">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span></span> <i class="fa fa-caret-down"></i>
                  </div>
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
                        <table class="table" id="tableeventos">
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($permisos->calendario==1)
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
        @endif
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
@endsection
@push('js')

<script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
<script src="{{asset('js/pageLoader.js')}}"></script>
<script src="{{asset('js/mdtimepicker.js')}}"></script>
<script src="{{asset('js/jscolor.js')}}"></script>
<script src="{{asset('js/timepicker.min.js')}}"></script>
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.1.2/echarts.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.1.2/echarts.min.js"></script>
{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}


    <script>

      const chart = new Chartisan({
        el: '#chart',
        url: "@chart('sample_chart')",
        hooks: new ChartisanHooks()
    .legend()
    .colors()
    .datasets([{ type: 'line', fill: false }])
    .tooltip(),
    
      });
      const chartew = new Chartisan({
        el: '#chartbar',
        url: "@chart('empleados_charts')",
        hooks: new ChartisanHooks()
        .legend()
        .colors(['#3396FF','#4054b2'])
        .datasets(['bar'])
        .tooltip(),
    
      });
      const SexoChart = new Chartisan({
        el: '#chartbarsex',
        url: "@chart('sexo_chart')",
        hooks: new ChartisanHooks()
        .legend()
        .colors(['#7133FF','#4054b2'])
        .tooltip(),
    
      });
      const DepartamentoChart = new Chartisan({
        el: '#chartbardepartamen',
        url: "@chart('depatamento_chart')",
        hooks: new ChartisanHooks()
        .legend()
        .colors(['#4054b2'])
        .tooltip(),
      });

//       var chartDom = document.getElementById('chartbardepartamen');
// var myChart = echarts.init(chartDom);
// var option;

// option = {
//     tooltip: {
//         trigger: 'item'
//     },
//     legend: {
//         top: '5%',
//         left: 'center'
//     },
//     series: [
//         {
//             name: '访问来源',
//             type: 'pie',
//             radius: ['40%', '70%'],
//             avoidLabelOverlap: false,
//             itemStyle: {
//                 borderRadius: 10,
//                 borderColor: '#fff',
//                 borderWidth: 2
//             },
//             label: {
//                 show: false,
//                 position: 'center'
//             },
//             emphasis: {
//                 label: {
//                     show: true,
//                     fontSize: '40',
//                     fontWeight: 'bold'
//                 }
//             },
//             labelLine: {
//                 show: false
//             },
//             data: [
//                 {value: 1048, name: '搜索引擎'},
//                 {value: 735, name: '直接访问'},
//                 {value: 580, name: '邮件营销'},
//                 {value: 484, name: '联盟广告'},
//                 {value: 300, name: '视频广告'},
//                 {value: 300, name: '视频广告'},
//                 {value: 300, name: 'hola'}
//             ]
//         }
//     ]
// };

// option && myChart.setOption(option);

      var calendar;
      
       $('.bs-timepicker').timepicker();
       $('#timepicker').mdtimepicker();

        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

          calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',


  headerToolbar: {
    left: 'prev,next ',
    center: 'title',
    right: 'today'
  },

  dateClick: function(info) {

    $("#opnemodal").trigger("click");
    $("#txtfecha").val(info.dateStr)
  },
  
  // eventClick: function(info){
  //   $("#opneditmodal").trigger("click");
  //   $("#edittitulo").val(info.event.title),
  //   $("#editcolor").val(info.event.backgroundColor),
  //   console.log(info);
  // },

  
  events:"{{url('Eventos/show')}}"


        });

        calendar.setOption('locale','Es');
        calendar.render();
      });

      $("#btnsave").on('click',function(){
        var Evento=RecolectarDatos("POST");
        EnviarInfo('',Evento);

      })

      var reserv = new Date($("#timepicker").val()).getTime();
      function RecolectarDatos(method){
        nuevoEvento={
          title:$("#txttitulo").val(),
          descripcion:$("#textarea").val(),
          color:$("#txtcolor").val(),
          textColor:'#FFFFFF',
          start:$("#txtfecha").val()+" "+$("#horas").val(),
          end:$("#txtfecha").val()+" "+$("#horas").val(),
          id_empresa:$("#empresa").val(),
          estado:$("#estado").val(),
          '_token':$("meta[name='csrf-token']").attr("content"),
          '_method':method

        }
        return (nuevoEvento);
      }

      function EnviarInfo(Accion,Evento){
        $.ajax(
        {
          type:"POST",
          url:"{{url('/Eventos')}}"+Accion,
          data:Evento,
          success:function(msg){
            $("#opnemodal").trigger("click");
            calendar.refetchEvents();
            SerchEventos(start,end);

            // calendar.fullCalendar('refetchEvents');
            
           
          },
          error:function(){alert("Error");}
        }
        );
      }




      var start = moment();
    var end = moment();

    SerchEventos(start,end);
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    $('#Reportegastos span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));



    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#Reportegastos').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
           'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
           'Este mes': [moment().startOf('month'), moment().endOf('month')],
           'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, function (start, end) {
          
          $('#Reportegastos span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          chart.update({ background: true })
        });

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
           'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
           'Este mes': [moment().startOf('month'), moment().endOf('month')],
           'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, function (start, end) {
          
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          // table.ajax.reload();
          SerchEventos(start,end);
        });

    // cb(start, end);


    function SerchEventos(start,end){
      var url = "{{url('SerchEventos')}}";
      var Istart=start.format('YYYY-MM-DD');
      var Iend=end.format('YYYY-MM-DD');
      // alert(Istart);

     var data = {Istart:Istart,Iend:Iend};
        $.ajax({
         method: "GET",
           data: data,
            url:url ,
            success:function(result){
              // alert(result);
              $("#tableeventos tbody").empty();
            $("#tableeventos tbody").append(result);
   
             
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
 
    }


    

    
    //       $(document).ready(function() {
      





    //     var data_puesto = <?php echo $puesto_empleado; ?>;
    //     gradientChartOptionsConfigurationWithTooltipBlue = {
    //       maintainAspectRatio: false,
    //       legend: {
    //         display: false
    //       },
          
    //       tooltips: {
    //         backgroundColor: '#f5f5f5',
    //         titleFontColor: '#333',
    //         bodyFontColor: '#666',
    //     bodySpacing: 4,
    //     xPadding: 12,
    //     mode: "nearest",
    //     intersect: 0,
    //     position: "nearest"
    //   },
    //   responsive: true,
    //   scales: {
    //     yAxes: [{
    //       barPercentage: 1.6,
    //       gridLines: {
    //         drawBorder: false,
    //         color: 'rgba(29,140,248,0.0)',
    //         zeroLineColor: "transparent",
    //       },
    //       ticks: {
    //         suggestedMin: 60,
    //         suggestedMax: 125,
    //         padding: 20,
    //         fontColor: "#2380f7"
    //       }
    //     }],

    //     xAxes: [{
    //       barPercentage: 1.6,
    //       gridLines: {
    //         drawBorder: false,
    //         color: 'rgba(29,140,248,0.1)',
    //         zeroLineColor: "transparent",
    //       },
    //       ticks: {
    //         padding: 20,
    //         fontColor: "#2380f7"
    //       }
    //     }]
    //   }
    // };
    
    // var data_click = <?php echo $puesto; ?>;
    // gradientChartOptionsConfigurationWithTooltipPurple = {
    //   maintainAspectRatio: false,
    //   legend: {
    //     display: false
    //   },

    //   tooltips: {
    //     backgroundColor: '#f5f5f5',
    //     titleFontColor: '#333',
    //     bodyFontColor: '#666',
    //     bodySpacing: 4,
    //     xPadding: 12,
    //     mode: "nearest",
    //     intersect: 0,
    //     position: "nearest"
    //   },
    //   responsive: true,
    //   scales: {
    //     yAxes: [{
    //       barPercentage: 1.6,
    //       gridLines: {
    //         drawBorder: false,
    //         color: 'rgba(29,140,248,0.0)',
    //         zeroLineColor: "transparent",
    //       },
    //       ticks: {
    //         suggestedMin: 60,
    //         suggestedMax: 125,
    //         padding: 20,
    //         fontColor: "#9a9a9a"
    //       }
    //     }],

    //     xAxes: [{
    //       barPercentage: 1.6,
    //       gridLines: {
    //         drawBorder: false,
    //         color: 'rgba(225,78,202,0.1)',
    //         zeroLineColor: "transparent",
    //       },
    //       ticks: {
    //         padding: 20,
    //         fontColor: "#9a9a9a"
    //       }
    //     }]
    //   }
    // };

    // gradientChartOptionsConfigurationWithTooltipOrange = {
    //   maintainAspectRatio: false,
    //   legend: {
    //     display: false
    //   },

    //   tooltips: {
    //     backgroundColor: '#f5f5f5',
    //     titleFontColor: '#333',
    //     bodyFontColor: '#666',
    //     bodySpacing: 4,
    //     xPadding: 12,
    //     mode: "nearest",
    //     intersect: 0,
    //     position: "nearest"
    //   },
    //   responsive: true,
    //   scales: {
    //     yAxes: [{
    //       barPercentage: 1.6,
    //       gridLines: {
    //         drawBorder: false,
    //         color: 'rgba(29,140,248,0.0)',
    //         zeroLineColor: "transparent",
    //       },
    //       ticks: {
    //         suggestedMin: 50,
    //         suggestedMax: 110,
    //         padding: 20,
    //         fontColor: "#ff8a76"
    //       }
    //     }],

    //     xAxes: [{
    //       barPercentage: 1.6,
    //       gridLines: {
    //         drawBorder: false,
    //         color: 'rgba(220,53,69,0.1)',
    //         zeroLineColor: "transparent",
    //       },
    //       ticks: {
    //         padding: 20,
    //         fontColor: "#ff8a76"
    //       }
    //     }]
    //   }
    // };

    // gradientChartOptionsConfigurationWithTooltipGreen = {
    //   maintainAspectRatio: false,
    //   legend: {
    //     display: false
    //   },

    //   tooltips: {
    //     backgroundColor: '#f5f5f5',
    //     titleFontColor: '#333',
    //     bodyFontColor: '#666',
    //     bodySpacing: 4,
    //     xPadding: 12,
    //     mode: "nearest",
    //     intersect: 0,
    //     position: "nearest"
    //   },
    //   responsive: true,
    //   scales: {
    //     yAxes: [{
    //       barPercentage: 1.6,
    //       gridLines: {
    //         drawBorder: false,
    //         color: 'rgba(29,140,248,0.0)',
    //         zeroLineColor: "transparent",
    //       },
    //       ticks: {
    //         suggestedMin: 50,
    //         suggestedMax: 125,
    //         padding: 20,
    //         fontColor: "#9e9e9e"
    //       }
    //     }],

    //     xAxes: [{
    //       barPercentage: 1.6,
    //       gridLines: {
    //         drawBorder: false,
    //         color: 'rgba(0,242,195,0.1)',
    //         zeroLineColor: "transparent",
    //       },
    //       ticks: {
    //         padding: 20,
    //         fontColor: "#9e9e9e"
    //       }
    //     }]
    //   }
    // };


    // gradientBarChartConfiguration = {
    //   maintainAspectRatio: false,
    //   legend: {
    //     display: false
    //   },

    //   tooltips: {
    //     backgroundColor: '#f5f5f5',
    //     titleFontColor: '#333',
    //     bodyFontColor: '#666',
    //     bodySpacing: 4,
    //     xPadding: 12,
    //     mode: "nearest",
    //     intersect: 0,
    //     position: "nearest"
    //   },
    //   responsive: true,
    //   scales: {
    //     yAxes: [{

    //       gridLines: {
    //         drawBorder: false,
    //         color: 'rgba(29,140,248,0.1)',
    //         zeroLineColor: "transparent",
    //       },
    //       ticks: {
    //         suggestedMin: 60,
    //         suggestedMax: 120,
    //         padding: 20,
    //         fontColor: "#9e9e9e"
    //       }
    //     }],

    //     xAxes: [{

    //       gridLines: {
    //         drawBorder: false,
    //         color: 'rgba(29,140,248,0.1)',
    //         zeroLineColor: "transparent",
    //       },
    //       ticks: {
    //         padding: 20,
    //         fontColor: "#9e9e9e"
    //       }
    //     }]
    //   }
    // };

//     var ctxE = document.getElementById("CountryChart").getContext("2d");

// var gradientStroke = ctxE.createLinearGradient(0, 230, 0, 50);

// gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
// gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
// gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors


// var myChart = new Chart(ctxE, {
//   type: 'bar',
//   responsive: true,
//   legend: {
//     display: false
//   },
//   data: {
//     labels: ['Activos', 'Vacaciones', 'Licencia'],
//     datasets: [{
//       label: "Countries",
//       fill: true,
//       backgroundColor: gradientStroke,
//       hoverBackgroundColor: gradientStroke,
//       borderColor: '#1f8ef1',
//       borderWidth: 2,
//       borderDash: [],
//       borderDashOffset: 0.0,
//       data: [{{$count_empleado}}, 0, 0],
//     }]
//   },
//   options: gradientBarChartConfiguration
// });

//     var ctx = document.getElementById("chartLinePurple").getContext("2d");

//     var gradientStrokew = ctx.createLinearGradient(0, 230, 0, 50);

//     gradientStrokew.addColorStop(1, 'rgba(72,72,176,0.2)');
//     gradientStrokew.addColorStop(0.2, 'rgba(72,72,176,0.0)');
//     gradientStrokew.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

    
//     var myChart = new Chart(ctx, {
//       type: 'radar',
//       responsive: true,
//       legend: {
//         display: false
//       },
//       data: {
//         labels: data_click,
//         datasets: [{
//           label: "Empleado",
//           fill: true,
//           backgroundColor: gradientStrokew,
//           hoverBackgroundColor: gradientStrokew,
//           borderColor: '#d346b1',
//           borderWidth: 2,
//           borderDash: [],
//           borderDashOffset: 0.0,
//           data: data_puesto,
//         }]
//       },
//       options: gradientBarChartConfiguration
//     });


//     var ctxgreesn = document.getElementById("chartLineGreen").getContext("2d");

//       var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);


//     gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
//     gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)'); //green colors
//     gradientStroke.addColorStop(0, 'rgba(66,134,121,0)'); //green colors


//     var myChart = new Chart(ctxgreesn, {
//       type: 'bar',
//       responsive: true,
//       legend: {
//         display: false
//       },
//       data: {
//         labels: ['Hombre', 'Mujer', 'Indefinido'],
//         datasets: [{
//           label: "Empleado",
//           fill: true,
//           backgroundColor: gradientStroke,
//           hoverBackgroundColor: gradientStroke,
//           borderColor: '#00d6b4',
//           borderWidth: 2,
//           borderDash: [],
//           borderDashOffset: 0.0,
//           data: [{{$count_hombres}}, {{$count_mujeres}}, {{$count_indefinido}}],
//         }]
//       },
//       options: gradientBarChartConfiguration
//     });





//     // console.log(cMoth);

    

//     var meses=[];
//     var monto=[];
    



// console.log(cData);
//     var ctx = document.getElementById("chartBig1d").getContext('2d');

//     var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

//     gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
//     gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
//     gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

//     var gradientStrokes = ctx.createLinearGradient(0, 230, 0, 50);

//     gradientStrokes.addColorStop(1, 'rgba(29,140,248,0.2)');
//     gradientStrokes.addColorStop(0.4, 'rgba(29,140,248,0.0)');
//     gradientStrokes.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors
//     var config = {
//       type: 'line',
//       data: {
//         datasets: [{
//           label: "Gasto",
//           fill: true,
//           backgroundColor: gradientStroke,
//           borderColor: '#d346b1',
//           borderWidth: 2,
//           borderDash: [],
//           borderDashOffset: 0.0,
//           pointBackgroundColor: '#d346b1',
//           pointBorderColor: 'rgba(255,255,255,0)',
//           pointHoverBackgroundColor: '#d346b1',
//           pointBorderWidth: 20,
//           pointHoverRadius: 4,
//           pointHoverBorderWidth: 15,
//           pointRadius: 4,
//           data: cData,
//         },{
//           label: 'NOMINA',
  
//            type: 'line',
//            order: 1,
//            borderColor: 'rgb(54, 162, 235)'
           
//         }],

//         labels: cMoth,
        
//       },
//       options: gradientChartOptionsConfigurationWithTooltipPurple
//     };

// //     var gradientStrokes = ctx.createLinearGradient(0,230,01,50);

// // gradientStrokes.addColorStop(1, 'rgba(72,72,176,0.2)');
// // gradientStrokes.addColorStop(0.2, 'rgba(72,72,176,0.0)');
// // gradientStrokes.addColorStop(0, 'rgba(119,52,50,0)'); //purple colors
// //     var config = {
// //       type: 'line',
// //       data: {
// //         labels: meses_chart,
// //         datasets: [{
// //           label: "Monto",
// //           fill: true,
// //           backgroundColor: gradientStrokes,
// //           borderColor: '#d346b1',
// //           borderWidth: 2,
// //           borderDash: [],
// //           borderDashOffset: 0.0,
// //           pointBackgroundColor: '#d346b1',
// //           pointBorderColor: 'rgba(255,255,255,0)',
// //           pointHoverBackgroundColor: '#d346b1',
// //           pointBorderWidth: 20,
// //           pointHoverRadius: 4,
// //           pointHoverBorderWidth: 15,
// //           pointRadius: 4,
// //           data: chart_data,
// //         }]
// //       },
// //       options: gradientChartOptionsConfigurationWithTooltipPurple
// //     };
//     var myChartData = new Chart(ctx, config);
//     $("#0").click(function() {
//       var data = myChartData.config.data;
//       data.datasets[0].data = chart_data;
//       data.labels = chart_labels;
//       myChartData.update();
//     });
//     $("#1").click(function() {
//       var chart_data = [80, 120, 105, 110, 95, 105, 90, 100, 80, 95, 70, 120];
//       var data = myChartData.config.data;
//       data.datasets[0].data = chart_data;
//       data.labels = chart_labels;
//       myChartData.update();
//     });

//     $("#2").click(function() {
//       var chart_data = [60, 80, 65, 130, 80, 105, 90, 130, 70, 115, 60, 130];
//       var data = myChartData.config.data;
//       data.datasets[0].data = chart_data;
//       data.labels = chart_labels;
//       myChartData.update();
//     });



//         });


    </script>


@endpush



