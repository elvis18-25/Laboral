@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/gasto.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;">GASTOS FIJOS</h4>
                </div>
     
                <div class="col-4 text-right">
                </div>
              </div>
            </div>
            <div class="card-body">
              {{-- <form action="{{route('Gasto.store')}}" method="POST"> --}}
                <a href="{{url('Gasto')}}"><button type="button" title="Guardar Gastos" id="save" class="btn btn-fill btn-info redondo btn-sm float-right whiter "><i class="fas fa-save" style="font-size: 17px; margin-left: -1px"></i></button></a>
                {{-- <button type="button" title="Guardar Gastos" id="save" class="btn btn-fill btn-primary btn-sm float-right " style="top: -59px;"><i class="fas fa-save"></i></button> --}}
            @csrf   
          <div class="form-row">
            <td scope="row"><div class="col-sm-5 mb-1" ><input type="text" autofocus name="descripcion" id="concepto" placeholder="Concepto" class="form-control input focus" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"></div></td>
                        <td><div class="col-sm-4 mb-1"><input type="text" name="monto" id="monto"  class="form-control input montro" placeholder="Monto"></div></td>
                        <td><button class="btn btn-info btn-sm redondo"  title="Agregar Gasto" type="button" style=" position: relative;margin-left: 3px; top:-4px " onclick="capturar();"><i class="fas fa-plus"></i></button></td>
                      </div>
            <div class="">
                <table class="table  table table-striped table-hover " id="gastosfijo-table">
                    <thead class=" text-primary">
                        <tr>
                            <th scope="col">CONCEPTO</th>
                            <th scope="col">MONTO</th>
                        </tr>
                    </thead>
                    <tbody>  
                    </tbody>
                </table>
            </div>
        </div>
        <input type="text" name="" value="" hidden id="getval">
        <input type="text" name="" value="" hidden id="formes">
        <input type="text" name="total" value="" hidden id="totl">
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                <b class="float-right" style="color: black">TOTAL: <span id="totalnomina"></span></b>
              </nav>
        </div>
    </div>
</div>
{{-- </form> --}}
<div class="modal fade" id="fijomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>

<div class="o-page-loader">
  <div class="o-page-loader--content">
    <img src="{{asset('black')}}/img/logotipo.png" alt="" class="o-page-loader--spinner">
      {{-- <div class=""></div> --}}
      <div class="o-page-loader--message">
          <span>Cargando...</span>
      </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>
options2 = { style: 'currency', currency: 'USD' };
numberFormat2 = new Intl.NumberFormat('en-US', options2);
totalgasto();

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
 tabla=$('#gastosfijo-table').DataTable({
        dom: 'Bfrtip',
        "searching": false,
        "paging":   false,
        // "ordering": false,
        "info":     false,
        // select: true,
        processing:true,
      

    serverSide:true,
    ajax:
    {
      url:"{{ url('datatablegastos') }}",
     
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

//       columnDefs: [{
// targets: [0,1,2,3,4,5],
// className: 'bolded'
// }
// ],
      buttons: [
            {
                extend: 'excel',
                messageTop: 'Listado de Empleado.'
            },
            {
                extend: 'pdf',
                messageBottom: null
            },
            {
                extend: 'print',
                messageTop: 'Listado de Empleado.',
            }
        ],



    columns:[
    {data:'concepto',name:'concepto', },
    {data:'monto', name:'monto', class:'text-aling: right'},
    ],

});


document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
          capturar()
        }
      }))
    });

    $("#monto").mask('0#');
var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};


window.onbeforeunload = function(e) {
    HoldOn.open(options);
};

cont=0;


function capturar(){
    var conce=$("#concepto").val();
    var monto=$("#monto").val();



    if(conce!=''&& monto!=''){
        var url = "{{ url('saveFijos') }}";
     var data = {conce:conce,monto:monto};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            tabla.ajax.reload();
            $("#concepto").val("");
            $("#monto").val("");
              $("#concepto").focus();
              totalgasto()
        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
    }else{
        error()
    }
}


function totalgasto(){
    var url = "{{ url('totalgasto') }}";
     var data = '';
        $.ajax({
         method: "GET",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
                res= numberFormat2.format(result); 
            $("#totalnomina").empty();
            $("#totalnomina").append(res);

        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });  
}

function error() {
  Command: toastr["error"]("El valor monto es obligatorio", "Error")
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



$("#gastosfijo-table tbody").on('click','tr',function(){
 
 var id=$(this).attr('data-href');
 var url = "{{ url('modalfijo')}}/"+id;
     var data = '';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#fijomodal").html(result).modal("show");

        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });  
 
});



</script>
@endsection

<style>
  #gastosfijo-table tbody tr{
cursor: pointer;
  }

  .card-title{
    margin-left: -17px;
    width: 102% !important;
    /* height: 100px !important; */
    padding: 15px !important;
    background-color: #4054b2 !important;
    /* box-shadow: 10px 10px #80808040 !important; */
    color: white !important;
    position: relative;
    top: -15px;
}
</style>