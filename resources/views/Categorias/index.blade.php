@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<style>
  .center{
  text-align: center !important;
}
</style>
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<link rel="stylesheet" href="{{asset('css/categorias.css')}}">

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
              <div class="col-md-4 float-left">
                  <label><b>{{ __('BUSCAR') }}</b></label>
                  <input type="text" name="" id="btnsearch" onkeyup="saerch();" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Buscar..." class="form-control">
                </div> 
                {{-- <div class="col-sm-2" id="fechaHora">
                  <label for=""><b>FECHA DE CREACION</b></label>
                  <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 125%; position: relative; top: 3px;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                  </div>
                </div> --}}
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
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>CATEGORIAS</b></h4>
                </div>
                <div class="col-4 text-right">
                    <a href="#" class="btn btn-sm btn-info redondo"  data-toggle="modal" data-target="#Modalcategorias" ><button type="button" id="createcategoria" style="display: none;"></button><i class="fas fa-plus" style="margin-left: -2px; top: 6px; position: relative; font-size: 17px;"></i></a>
                    <a href="{{url('CatalogoPdf')}}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-warning redondo" ><button type="button" style="display: none;"></button><i class="fas fa-scroll incons"></i></a>
                @include('Categorias.modal')
                </div>
            </div>
        </div>
        <div class="card-body">
            
            <div class="">
                <table class="table tablesorter " id="categorias">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitleP">ID</th>
                        <th class="TitleP">NOMBRE</th>
                        <th class="TitleP">FECHA</th>
                        <th class="TitleP">SUBCATEGORIAS</th>
                        <th class="TitleP">USUARIO</th>
                      </tr>
                    </thead>
                    <tbody>
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
<div class="o-page-loader">
  <div class="o-page-loader--content">
    <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
      {{-- <div class=""></div> --}}
      <div class="o-page-loader--message">
          <span>Cargando...</span>
      </div>
  </div>
</div>
@include('Categorias.Modales.subcategoria')

<div class="modal fade" id="EditCategorias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<div class="modal fade" id="SubmodalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
<div class="modal fade" id="SubupdateEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
  {{-- @include('Categorias.Modales.subedit') --}}

<input type="text" name="" value="1" id="inputCheckBox" hidden>
@endsection

@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.1/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.1/select2.min.js"></script>
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>

document.addEventListener ("keydown", function (e) {
  if (e.keyCode== 107) {
      $("#createcategoria").trigger("click");
  } 
});


     $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  table=$('#categorias').DataTable({
    "info": false,
    select: {
            style: 'single',
        },
        keys: {
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },
        rowGroup: {
        dataSrc: 'group'
    },

    
    ajax:
    {
      url:"{{ url('datatableCategorias') }}",
    },

    columns:[
    {data:'id_category',name:'id_category'},
    {data:'nombre',name:'nombre'},
    {data:'created_at',name:'created_at', class:"center"},
    {data:'count',name:'count',searchable:false,class:"center"},
    {data:'user',name:'user',class:"center"},
    ],
 
    language: {
      searchPlaceholder: "Buscar",
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
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
   
});
$('div.dataTables_filter input', table.table().container()).focus(); 



$('div.dataTables_filter input', table.table().container()).keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});

$("#categorias tbody").on('click','tr',function(){
  var id=$(this).attr('data-href');
  InfoCategorias(id);
});


$("#subcategorias").hide();
$("#btnplus").hide();

$("#btnCheck").on('click',function(){
var valor =$("#inputCheckBox").val();

  if(valor==0){
    $("#inputCheckBox").attr('value',1)
    $("#subcategorias").hide();
    $("#btnplus").hide();

  }else{
    $("#inputCheckBox").attr('value',0)
    $("#subcategorias").show();
    $("#btnplus").show();
  }

});


function InfoCategorias(e){
//  var url="{{url('showcategorias')}}/"+e;
 var url = "{{url('showcategorias')}}/"+e; 
  var data='';
  $.ajax({
    method:"GET",
    data:data,
    url:url,
    success:function(result){
      $("#EditCategorias").html(result).modal("show");
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGen();
    }
  });
}

$('#Modalcategorias').keyup(function(e){
    if(e.keyCode==13)
    {
      $('#btnclick').trigger("click");
    }
    if(e.keycode!=13)
    {
       $("#newcategoria").focus();
    }
});

function savecategoria(){
  var name=$("#newcategoria").val();
  var url="{{route('Categorias.store')}}"
  var arreglo=[];
  var arreglocode=[];
  i=0;
  $("#subcategorias tbody tr").each(function(){
    arreglo[i]=$(this).attr('value');
    arreglocode[i]=$(this).attr('action');
    i++;
  });
  console.log(arreglocode);
  
  var data ={name:name,arreglo:arreglo,arreglocode:arreglocode};
  $.ajax({
  method:"POST",
  data: data,
  url:url,
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  success:function(result){
  // alert(result);
  $("#Modalcategorias").trigger('click');
  table.ajax.reload(); 
  sucessf();
  },

error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGen();
    }
});
}

function  sucessf(){
  Command: toastr["success"]("Se ha Efectuado la operación exitosamente ", "Corecto!")
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
  "hideMethod": "fadeOut"
}
}


function ErroresGen(){
  Command: toastr["error"]("", "Error!")
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
}


$("#subcat").on('keypress', function(e) { return e.keyCode != 13; });

$('#Submodal').keyup(function(e){
    if(e.keyCode==13)
    {
      $('#btnclicksub').trigger("click");
      
      
    }
    if(e.keycode!=13)
    {
       var id=$("#subcode").val();

       if(id==""){
         $("#subcode").focus();

       }
        
    }
});

function capturar(){
  
    function  Persona(codigo,nombre){
      this.codigo=codigo;
     this.nombre=nombre;
    }
    var nombreCapturar=document.getElementById("subcat").value;
    var codigoCapturar=document.getElementById("subcode").value;

    if(nombreCapturar!="" || codigoCapturar!="" ){
      nuevoSujeto= new Persona(codigoCapturar,nombreCapturar);
    agregar();
    }else{
      ErroresGen();
    }



}

$("#subcode").mask("#0");
var baseDatos=[];

function agregar(){
  $('.datosInput').val('');
  $("#subcat").focus();

baseDatos.push(nuevoSujeto);
console.log(baseDatos);
var button = '<button type="button"class="btn btn-danger borrar redondo btn-sm"><i class="fas fa-trash"></i></button';
$('subcategorias').append(button);




document.getElementById("subcategorias").innerHTML += '<tr class="reducir" value="'+nuevoSujeto.nombre+'" action="'+nuevoSujeto.codigo+'"><td style="text-align: left;"><input  type="text" name="codigo[]" value="'+nuevoSujeto.codigo+'"/ hidden>'+nuevoSujeto.codigo+'</td><td style="text-align: center;"><input  type="text" name="nombre[]" value="'+nuevoSujeto.nombre+'"/ hidden>'+nuevoSujeto.nombre+'<td style="text-align: left;">'+button+'</td></tr>';


}

function saerch(){
  name=$("#btnsearch").val();
  table.search(name).draw();
}

$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
    // ($(this).closest('tr').val());
});  
</script>
@endsection