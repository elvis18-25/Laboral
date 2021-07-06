<div class="modal-dialog modal-lg">
  <div class="modal-content" style="width: 129%; margin-top: -238px;" >
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel" style="color: black" style="font-size: 16px !important; font-weight: bold !important;"><b>NUEVA ASIGNACIÓN</b></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

    <div class="form-row">
        <div class="col-sm-3">
            <label style="color: black"><b>{{ __('NOMBRE ') }}</b></label>
            <input type="text" name="name" value="{{$asigna->Nombre}}" autofocus id="nameedit" required  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
          </div>

        <div class="col-sm-3">
            <label style="color: black"><b> {{ __('TIPO ') }}</b></label>
            <select id="inputStateed" class="form-control selec" required name="tipoedit" >
              <option selected disabled>ElEGIR...</option>
              @if ($asigna->tipo_asigna=="DEDUCCIÓN")
              <option value="1" selected>DEDUCIÓN</option>
              @else
              <option value="1" selected>DEDUCIÓN</option>
              @endif

              @if ($asigna->tipo_asigna=="INCREMENTO")
              <option value="2" selected >INCREMENTO</option>
                  
              @else
              <option value="2" >INCREMENTO</option>
                  
              @endif
            </select>
        </div>

        <div class="col-sm-3">
            <label style="color: black"><b>{{ __('FORMA ') }}</b></label>
            <select  class="form-control selec" name="formae" required id="formaedit" >
              <option selected disabled>ElEGIR...</option>
              @if ($asigna->tipo=="PORCENATJE")
              <script>
              $("#figure").empty();
              $("#figure").append("%");
              </script>
              <option value="4" selected>PORCENATJE</option>
              
              @else
              <option value="4" >PORCENATJE</option>
              <script>

                </script>
              @endif

              @if ($asigna->tipo=="MONTO")
              <option value="3" selected>MONTO</option>
              <script>
                $("#figure").empty();
                $("#figure").append("$"); 
                </script>
              @else
              <option value="3" >MONTO</option>
              <script>
                $("#figure").empty();
                $("#figure").append("$"); 
                </script>
              @endif

            </select>
        </div>
        <input type="text" id="inputfigures" value="{{$asigna->tipo}}" hidden>
      
        <div class="col-sm-2">
            <label style="color: black"></label>
            <label style="color: black"><b>{{ __('MONTO ') }}</b></label>

            <div class="input-group" >
            <div class="input-group-prepend" style="top: 0px; position: relative; height: 38px;">
              <div class="input-group-text"style="color: black"><span id="figure"></span></div>
            </div>
            <input type="text" name="monto"  onkeyup="calcular();" style="text-align: right;" id="montoedit"  value="{{$asigna->Monto}}" required  class="form-control money" placeholder=""  >
            <input type="text"   id="montoOP" value="" hidden>
        </div>
    </div>

</div> 
<br>

  <button type="button" class="btn btn-info redondo btn-sm float-left" title="Agregar Empleado a la asignacion" id="btnsingle"  data-toggle="modal" data-target="#Empleadomodal"><i class="fas fa-user-plus" style="margin-left: -3px; font-size: 17px;"></i></button>
  <button type="button" class="btn btn-warning redondo btn-sm float-left" title="Agregar Todos los empleado" onclick="allEmple();"><i class="fas fa-users" style="margin-left: -6px; font-size: 19px;"></i></button>
  <br>
  <input type="text" name="" id="inputEdit" value="{{$asigna->grupo}}" hidden>
  <table class="table tablesorter list" id="listadoEdit-table" style="width: 100% !important;">
    <thead class=" text-primary">
    <tr> 
        <th style="font-size: 12px !important; width: 61px !important;">ACCIÓN</th>
        <th class="listadoth"><b>EMPLEADO</b></th>
        <th class="listadoth2"><b>CARGO</b></th>
        <th class="listadoth3"><b>DEPARTAMENTO</b></th>
      </tr>
    </thead>
    <tbody style="font-size: 13px !important;">
      @foreach ($empleados as $empleado)
      <tr value={{$empleado->id_empleado}}>
        <td>
          <div class="form-check"><label class="form-check-label">
            <input class="form-check-input" name="dinamico[]" checked type="checkbox" value="{{$empleado->id_empleado}}">
            <span class="form-check-sign"><span class="check"></span></span></label>
          </div>
        </td>
        <td>{{$empleado->nombre." ".$empleado->apellido}}</td>
        <td>{{$empleado->cargo}}</td>
        <td>
          @foreach ($empleado->puesto as $puesto)
              {{$puesto->name}}
          @endforeach
      </td>

      </tr>
      @endforeach
    </tbody>
</table>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-info redondo" id="saveredit" onclick="updateasignaciones({{$asigna->id}});"><i class="fas fa-save" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>
      <button type="button" class="btn btn-danger redondo" id="deletesr" onclick="deleteasigna({{$asigna->id}});"><i class="fas fa-trash" style="margin-left: -2px;  position: relative; font-size: 17px;"></i></button>    </div>
  </div>
</div>

<script>
var figure=$("#inputfigures").val();

if(figure=="PORCENATJE"){
  $("#figure").empty();
  $("#figure").append("$"); 
}else{
  $("#figure").empty();
  $("#figure").append("$"); 
}
  function updateasignaciones(e){
     var name=$("#nameedit").val();
     var tipo=$("#inputStateed").val();
     var forma=$("#formaedit").val();
     var monto=$("#montoedit").val();
     var id=$("#inputEdit").val();
     var arreglo=[];
    var p=0;
    i=0;
    $("#listadoEdit-table tbody tr").each(function(){
    arreglo[i]=$(this).attr('value');
      i++;
    });

     if(name==""|| tipo==""||forma==""||monto==""){
      Errores();
     }else{
      var url = "{{url('updateasignaciones')}}/"+e; 
       var data ={name:name,tipo:tipo,forma:forma,monto:monto,arreglo:arreglo,id:id};
          $.ajax({
           method: "POST",
             data: data,
              url:url ,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success:function(result){
              table.ajax.reload();
              $("#showmodal").trigger("click");
              SuccesGenUpdate();
              
  
             },
                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGenerales(); 
      }
               }); 
     } 
  }
  
  function Errores(){
      Command: toastr["error"]("Debes llenar los compos", "Error")
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
  
    function deleteasigna(e){
      Swal.fire({
    title: 'Estas seguro?',
    text: "Ya no se podra revertir los cambios!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      var url = "{{ url('deleteasigna')}}/"+e;
       var data = '';
          $.ajax({
           method: "POST",
             data: data,
              url:url ,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success:function(result){
                table.ajax.reload();
              $("#showmodal").trigger("click");
              SuccesGenDele();
          
            
             
             },
                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGenerales(); 
      }
               });
    }
  });
    }

    tab=$('#listadoEdit-table').DataTable({
    "info": false,
    "paging":   false,
    scrollY: 350,

    select: {
            style: 'single',
        },
        keys: {
           keys:true,
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },

      rowGroup: {
        dataSrc: 'group',
    },

    "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
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

function allEmple(){
  arreglo=[];
  i=0;
  $("#listadoEdit-table tbody tr").each(function(){
    arreglo[i]=$(this).attr('value');
      i++;
    });
  var url = "{{url('allempleadoasignaciones')}}"; 
       var data ={arreglo:arreglo};
          $.ajax({
           method: "POST",
             data: data,
              url:url ,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success:function(result){
              $('#listadoEdit-table tbody').append(result);
              SuccesAdd(); 
              
  
             },
                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  ErroresGenerales(); 
      }
               }); 
}

function checkendesd(){
      $('#listadoEdit-table tbody input[type="checkbox"]').prop('checked',false);
}

$('div.dataTables_filter input', tebl.table().container()).on('click',function(){

  var rowIdx = tebl.cell(':eq(0)').index().row;
      
  tebl.row(rowIdx).select();

  tebl.cell( ':eq(0)' ).focus();
});




$('#showmodal').keyup(function(e){
    if(e.keycode!=13)
    {
       
      $('div.dataTables_filter input', tebl.table().container()).focus();
        
    }
});
      </script>

<style>
      #listadoEdit-table_filter{
      margin-left: 33%;
    }
</style>