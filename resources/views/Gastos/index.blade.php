@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/gasto.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

<style>
    .center{
        text-align: center;
    }
    .right{
        text-align: right;
    }
</style>
<div class="col-md-12">
    <div class="card ">
      <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
        <div class="card card-plain">
          <div class="card-header" role="tab" id="headingTwo">
            <div class="row">
              <div class="col-8">
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
                <div class="col-md-3 float-left">
                  <label><b>{{ __('BUSCAR') }}</b></label>
                  <input type="text" name="" id="btnsearch" onkeyup="saerch();" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"  placeholder="Buscar..." class="form-control">
                </div> 
                <div class="col-md-3 float-left">
                    <label><b>{{ __('CATEGORIAS') }}</b></label>
                    <select id="category" class="form-control " name="categorias">
                      <option selected value="0" >NINGUNO</option>
                      @foreach ($categorias as $categoria)
                          
                      <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                      
                      @endforeach
                  </select>
                  </div>
                <div class="col-md-3 float-left">
                    <label><b>{{ __('SUBCATEGORIAS') }}</b></label>
                    <select id="subcategory" class="form-control " name="categorias">
                      <option selected value="0" >NINGUNO</option>
                  </select>
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
                    <h4 class="card-title"  style="font-size: 16px !important; font-weight: bold !important;" ><b>GASTOS</b></h4>
                </div>
                <div class="col-4 text-right">
                    <a href="{{route('Gasto.create')}}" title="Agregar Gastos" class="btn btn-sm btn-info float-right redondo"><button type="button" id="created" style="display: none;"></button><i class="fas fa-plus" style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;"></i></a>
                    <a href="{{url('GastosFijo')}}" title="Agregar Nuevo Gastos Fijo" class="btn btn-sm btn-warning float-right redondo"><button type="button" id="created" style="display: none;"></button><i class="fas fa-coins"style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;" ></i></a>
                  
                    @php
                    // dd($permisos);
                    // dd(Auth::user());
                @endphp
                    @if ($permisos->categorias==1)

                    <a href="{{url('Categorias')}}" title="Agregar Nuevo Gastos Fijo" class="btn btn-sm btn-success float-right redondo"><button type="button" id="created" style="display: none;"></button><i class="fas fa-file-alt"style="margin-left: -3px; top: 6px; position: relative; font-size: 20px;" ></i></a>
                    @endif
                    {{-- <p>
                        <button class="btn btn-success redondo btn-sm" type="button" title="Filtros" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-filter" style="font-size: 16px;
                            margin-left: -2px;
                            position: relative;
                            top: 2px;"></i>
                        </button>
                      </p> --}}

                </div>

            </div>
        </div>

        {{-- <br> --}}
        {{-- <div class="collapse" id="collapseExample">
            <div class="card card-body">

              <div class="form-row">
                <div class="col-md-3 float-left">
                    <label><b>{{ __('CATEGORIAS') }}</b></label>
                    <select id="category" class="form-control " name="categorias">
                      <option selected value="0" >NINGUNO</option>
                      @foreach ($categorias as $categoria)
                          
                      <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                      
                      @endforeach
                  </select>
                  </div>
                <div class="col-md-3 float-left">
                    <label><b>{{ __('SUBCATEGORIAS') }}</b></label>
                    <select id="subcategory" class="form-control " name="categorias">
                      <option selected value="0" >NINGUNO</option>
                  </select>
                  </div>
                </div>
            </div>
          </div> --}}

        <div class="card-body">
            @php
                $user=Auth::user()->id_empresa;
            @endphp
            <div class="">
                <table class="table tablesorter " id="gastos-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitleP">DESCRIPCION</th>
                        <th class="TitleP">FECHA</th>
                        <th class="TitleP">USUARIO</th>
                        <th class="TitleP">MONTO</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($gasto as $gastos)
                        @if ($gastos->estado!=1)
                        @if ($gastos->id_empresa==$user)
                        <tr action="{{Route('Gasto.show',$gastos->id)}}">
                            <td>{{$gastos->descripcion}}</td>
                            <td style="text-align: center;" >{{date("d/m/Y", strtotime($gastos->fecha))}}</td>
                            <td style="text-align: center;" >{{$gastos->user}}</td>
                            <td style="text-align: right;" >${{number_format($gastos->monto,2)}}</td>
                        </tr>
                        @endif
                        @endif
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<a href="" id="sd"><button type="button" id="urles"  class="btn btn-primary " hidden><i class="far fa-edit"></i></button></a>
<input type="text" name="" id="input" value="0" hidden>
<input type="text" name="" id="inputsub" value="0" hidden>

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

@section('js')
@if (session('guardar')=='ya')
<script>
    Command: toastr["success"]("se ha guardo el gasto", "")
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    }
  </script>    
@endif
@if (session('actualizar')=='ya')
<script>
    Command: toastr["success"]("se ha actualizado el gasto", "")
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    }
  </script>    
@endif
@if (session('eliminado')=='ya')
<script>
    Command: toastr["success"]("se ha eliminado el gasto", "")
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    }
  </script>    
@endif
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>

$("#category").on('change',function(){
var id=$(this).val();
$("#input").val(id);
$("#inputsub").val(0);
table.ajax.reload();
subcategory(id);
});

$("#subcategory").on('change',function(){
var id=$(this).val();
$("#inputsub").val(id);
table.ajax.reload();
});


function subcategory(id){
  var url = "{{url('searchsubcategory')}}/"+id; 
    var data = "";
    $.ajax({
     method: "GET",
       data: data,
        url:url ,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(result){
        $("#subcategory").empty();
        $("#subcategory").append(result);
          
       },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
           ErroresGeneral();
}
         }); 
}

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
  table=$('#gastos-table').DataTable({
        "paging":   false,
        // "ordering": false,
        "info":     false,
        processing:true,
      
        // select: {
        //     style: 'single',
        // },

    //     keys: {
    //       keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
    //     },
    //     rowGroup: {
    //     dataSrc: 'group'
    // },

    serverSide:true,
    ajax:
    {
      url:"{{ url('datatableGastosIndex') }}",
      "data":function(d){
        if($("#input").val()!=''){
          if($("#inputsub").val()==0){
            // alert($("#inputsub").val());
          d.dato1=$("#input").val();
          }else{
            d.dato2=$("#inputsub").val();
          }

        }
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
    {data:'descripcion',name:'descripcion'},
    {data:'fecha', name:'fecha', class: "center"},
    {data:'user', name:'user', class: "center"},
    {data:'monto',name:'monto', class: "right"},
    ],

});
$('div.dataTables_filter input', table.table().container()).focus();   


// var options = {
//      theme:"sk-cube-grid",
//      message:'Cargando.... ',
// };

document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#created").trigger("click");
         
    } 
});

window.onbeforeunload = function(e) {
    HoldOn.open(options);
};

$("#gastos-table tbody").on('click','tr',function(){
 
 url=$(this).attr('action');

 $("#sd").attr('href',url);

 $("#urles").trigger("click");

 
});

$('#gastos-table').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        table.row(cell.index().row).select();
     });
 
    // Handle click on table cell
    $('#gastos-table').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = table.cell(this).index().row;

        
        // Select row
        table.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#gastos-table').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

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

    document.addEventListener ("keydown", function (e) {
    if (e.keyCode==16) {

      var rowIdx = table.cell(':eq(0)').index().row;
      
      table.row(rowIdx).select();

      table.cell( ':eq(0)' ).focus();

    }
});


    // var rowIdx = table.cell(':eq(0)').index().row;
      
    //   table.row(rowIdx).select();

    //   table.cell( ':eq(0)' ).focus();


$('div.dataTables_filter input', table.table().container()).keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});

$("#gastos-table tbody").on('click','tr',function(){
    url=$(this).attr('action');

$("#sd").attr('href',url);

$("#urles").trigger("click");

});


function saerch(){
  name=$("#btnsearch").val();
  table.search(name).draw();
  // $('div.dataTables_filter input', table.table().container()).attr('value',name);
  // alert(name);
}
</script>
@endsection