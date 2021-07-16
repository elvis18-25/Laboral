@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<div class="o-page-loader">
    <div class="o-page-loader--content">
      <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{asset('css/users.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<div class="col-md-12">
    <div class="card ">
      <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
        <div class="card card-plain">
          <div class="card-header" role="tab" id="headingTwo">
            <div class="row">
              <div class="col-12">
              <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h4><b> FILTROS
                  <i class="tim-icons icon-minimal-down"></i>
                </b>
                </h4>
              </a>
          </div>
          </div>
          </div>
          <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-3 float-left mb-3">
                    <label><b>{{ __('BUSCAR') }}</b></label>
                    <input type="text" name="" id="btnsearch" onkeyup="saerch();" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"  placeholder="Buscar..." class="form-control">
                  </div> 
                <div class="col-md-3 float-left">
                    <label><b>{{ __('DEPARTAMENTOS') }}</b></label>
                    <select id="departament" class="form-control " name="categorias">
                      <option selected value="0" >NINGUNO</option>
                      @foreach ($puesto as $puestos)
                          
                      <option value="{{$puestos->id}}">{{$puestos->name}}</option>
                      
                      @endforeach
                  </select>
                  </div>
                <div class="col-md-3 float-left">
                    <label><b>{{ __('GENERO') }}</b></label>
                    <select id="genero" class="form-control " name="categorias">
                        <option selected value="0" >NINGUNO</option>
                        @foreach ($sexo as $sexos)
                          
                        <option value="{{$sexos->id}}">{{$sexos->name}}</option>
                        
                        @endforeach
                  </select>
                  </div>
                <div class="col-md-3 float-left">
                    <label><b>{{ __('PAGOS') }}</b></label>
                    <select id="pagos" class="form-control " name="categorias">
                        <option selected value="0" >NINGUNO</option>
                        @foreach ($pagos as $pago)
                          
                        <option value="{{$pago->id}}">{{$pago->pago}}</option>
                        
                        @endforeach
                  </select>
                  </div>

                <div class="col-md-3 float-left">
                    <label><b>{{ __('ROLES') }}</b></label>
                    <select id="roles" class="form-control " name="categorias">
                        <option selected value="0" >NINGUNO</option>
                        @foreach ($roles as $role)
                          
                        <option value="{{$role->id}}">{{$role->name}}</option>
                        
                        @endforeach
                  </select>
                  </div>
                  <div class="col-sm-2" id="fechaHora">
                    <label for=""><b>FECHA DE INGRESOS</b></label>
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 125%; position: relative; top: 3px;">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                  </div>


                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>USUARIOS</b></h4>
                </div>
                <div class="col-4 text-right">
                    <a href="{{route('user.create')}}" title="Crear Nuevo Empleado" class="btn btn-sm btn-info redondo"><button type="button" id="created" style="display: none;"></button><i class="fas fa-plus"  style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;"></i></a>
                    <button id="btnexcel" type="button" title="Exportar en Hoja de Excel" class="btn btn-success btn-sm redondo"><i class="fas fa-file-excel" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
                    {{-- <button id="btnprint" type="button" title="Imprimir Lista de Empleado" class="btn btn-warning btn-sm redondo"><i class="fas fa-print"></i></button> --}}
                    {{-- <a href="{{url('listadopdf')}}" target="_blank" rel="noopener noreferrer"><button  type="button" title="Imprimir Lista de Empleado" class="btn btn-info btn-sm"><i class="fas fa-print"></i></button></a> --}}
                    <button id="btnpdf" type="button" title="Exportar en PDF" class="btn btn-danger btn-sm redondo"><i class="fas fa-file-pdf" style= " position: relative; font-size: 17px;" ></i></button>
                   @if ($permisos->roles==1)
                   <a href="{{url('Roles')}}"><button id="btnpdf" type="button" title="Roles" class="btn btn-warning btn-sm redondo"><i class="fas fa-user-tag" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button></a>
                   @endif
                </div>
            </div>
        </div>
        <div class="card-body">            
            <div class="">
                <table class="table tablesorter " id="users-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th scope="col">NOMBRE</th>
                        <th scope="col">CÉDULA</th>
                        <th scope="col">CARGO</th>
                        <th scope="col">TÉLEFONO</th>
                        <th scope="col">DEPARTAMENTO</th>
                        <th scope="col">SALARIO</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        {{-- @foreach ($users as $user)
                        @if ($user->estado==0) 
                        @if ($user->id_empresa==$empre)
                        <tr action="{{Route('user.show',$user->id)}}">
                            <td>{{$user->name." ".$user->apellido}}</td>
                            <td>{{$user->cedula}}</td>
                            <td>{{$user->cargo}}</td>
                            <td>{{$user->telefono}}</td>
                            
                            <td>
                                @foreach ($user->puestoU as $puesto)
                                    {{$puesto->name}}
                                @endforeach
                            </td>

                            <td>${{number_format($user->salario,2)}}</td>
                        </tr>
                        @endif
                      @endif
                       
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>
</div>

<input type="text" name="" id="input" value="0" hidden>
<input type="text" name="" id="inputsub" value="0" hidden>
<input type="text" name="" id="inputpagos" value="0" hidden>
<input type="text" name="" id="inputroles" value="0" hidden>

<input type="text" name="" value="" id="started" hidden>
<input type="text" name="" value="" id="ended" hidden>
<a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a>


@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>
//     var options = {
//      theme:"sk-cube-grid",
//      message:'Cargando.... ',
// };

document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#created").trigger("click");
         
    } 
});



var start = moment().startOf('year');
var end = moment().endOf('year');

// const options2 = { style: 'currency', currency: 'USD' };
// const numberFormat2 = new Intl.NumberFormat('en-US', options2);

// if($("#started").attr('value')!=" "){

// }else{
//   var start = moment().startOf('month');
//   var end = moment().endOf('month');

// }

$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

$('#reportrange').daterangepicker({
  startDate: start,
  endDate: end,
  ranges: {
     'Hoy': [moment(), moment()],
     'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
     'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
     'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
     'Este mes': [moment().startOf('month'), moment().endOf('month')],
     'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
     'Este año': [moment().startOf('year'), moment().endOf('year')],
     'El año pasado': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
  }
}, function (start, end) {
        
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');

        $("#started").attr('value',start);
        $("#ended").attr('value',end);
        // startComes = new Date($("#started").attr('value'));
        // endComes = new Date($("#ended").attr('value'));

        // start = moment(startComes);
        // end = moment(endComes);
        table.ajax.reload();
      });

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
  table=$('#users-table').DataTable({
        // "paging":   false,
        // "ordering": false,
        "info":     false,
        processing:true,
    serverSide:true,
    select: {
           toggleable: false,
            select:true,
            style: 'single'
        },

        keys: {
          keys:true,
          focus: ':eq(0)', 
           page: 'current',
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },    
        rowGroup: {
        dataSrc: 'group'
    },   

    ajax:
    {
      url:"{{ url('datatableUsuarios') }}",
      "data":function(d){
        if($("#input").val()!=''){
          if($("#inputsub").val()==0){
            // alert($("#inputsub").val());
          d.dato1=$("#input").val();
          }else{
            d.dato2=$("#inputsub").val();
          } 
          if($("#inputpagos").val()!=0){
            d.dato3=$("#inputpagos").val();
          }
          if($("#inputroles").val()!=0){
            d.dato4=$("#inputroles").val();
          }

        }
        startComes = new Date($("#started").attr('value'));
        endComes = new Date($("#ended").attr('value'));

        start = moment(startComes).format('YYYY-MM-DD');
        end = moment(endComes).format('YYYY-MM-DD');
        // alert(start);
        // var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        // var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        d.start_date=start;
        d.end_date=end;
      }
    },

    language: {
      searchPlaceholder: "Buscar",
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }

      }, 


    columns:[
    {data:'name',name:'name'},
    {data:'cedula', name:'cedula', class: "center"},
    {data:'cargo', name:'cargo', class: "center"},
    {data:'telefono',name:'telefono', class: "right"},
    {data:'puesto',name:'puesto', class: "right",searchable:false},
    {data:'salario',name:'salario', class: "right"},
    ],

    // "fnDrawCallback":function(){
    //     var rowIdx = table.cell(':eq(0)').index().row;
      
    //   table.row(rowIdx).select();

    //   table.cell( ':eq(0)' ).focus();
    // }   

});
$('div.dataTables_filter input', table.table().container()).focus(); 


document.addEventListener ("keydown", function (e) {
    if (e.keyCode!=13) {
        $('div.dataTables_filter input', table.table().container()).focus(); 
    }
});

$('#users-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#users-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#users-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            var data = table.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

                url=$(row_s).attr('action');

                $("#sd").attr('href',url);

                $("#urles").trigger("click");
            
        }
        
    });



    //   var rowIdx = table.cell(':eq(0)').index().row;
      
    //   table.row(rowIdx).select();

    //   table.cell( ':eq(0)' ).focus();


$("#users-table tbody").on('click','tr',function(){
 
   url=$(this).attr('action');

   $("#sd").attr('href',url);

   $("#urles").trigger("click");

   
});

$('div.dataTables_filter input', table.table().container()).keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});

document.addEventListener ("keydown", function (e) {
    if (e.altKey  &&  e.which === 65) {
        $('#back').trigger("click");
    }
});

$("#btnexcel").on('click',function(){
$(".buttons-excel").click();
});

$("#btnprint").on('click',function(){
$(".buttons-print").click();
});

$("#btnpdf").on('click',function(){
$(".buttons-pdf").click();
});

$("#departament").on('change',function(){
var id=$(this).val();
$("#input").val(id);
$("#inputsub").val(0);
table.ajax.reload();
});

$("#genero").on('change',function(){
var id=$(this).val();
$("#inputsub").val(id);
table.ajax.reload();
});

$("#pagos").on('change',function(){
var id=$(this).val();
$("#inputpagos").val(id);
table.ajax.reload();
});

$("#roles").on('change',function(){
var id=$(this).val();
$("#inputroles").val(id);
table.ajax.reload();
});

function saerch(){
  name=$("#btnsearch").val();

  table.search(name).draw();

}
</script>
    
@endsection