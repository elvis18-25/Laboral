@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<link rel="stylesheet" href="{{asset('css/perfiles.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">  
<form action="{{Route('Perfiles.store')}}" method="POST" >
@csrf
{{ method_field('POST') }}
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>NUEVO PERFIL</b></h4>
                </div>
                <div class="col-4 text-right">
                    <button type="button" id="createdperfiles" title="Agregar Empleado al Perfil"  data-toggle="modal" data-target="#Empleado" class="btn btn-info btn-sm redondo"><i class="fas fa-users"  style="top: 5px; margin-left: -39%;"></i></button>
               @include('Perfiles.modalemple')
                </div>
            </div>
        </div>
        <div class="card-body">
    <div class="form-row">
            <div class="col-sm-4">
                <input type="text" name="descripcion" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
            </div>
            {{-- <div class="col-sm-5">
                <input type="date" id="fech" name="fecha" class="form-control"  >
            </div> --}}
        </div>
        <br>
            <div class="">
                <div style="max-height: 449px; overflow:auto; font-size:small; top:-12px; ">
                <table class="table tablesorter table-hover" id="perfiles-table">
                    <thead class=" text-primary">
                        <tr> 
                        <th class="TitlePer">NOMBRE</th>
                        <th class="TitlePer">CEDULA</th>
                        <th class="TitlePer">CARGO</th>
                        <th class="TitlePer">DEPARTAMENTO</th>
                        <th class="TitlePer">SALARIO</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                
            </nav>
        </div>
    </div>
</div>
<input type="text" name="arreglo" value="" id="arreglo" hidden>

<button type="submit" id="subir" title="Guardar Perfil" class="btn btn-fill btn-info float-right">{{ __('Guardar') }}</button>
</form>

<input type="button" id="back" onclick="history.back()" name="volver atrás" value="volver atrás" hidden >

@endsection

@section('js')
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>
    $(document).ready(function(){
 

    document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 107) {
        $("#createdperfiles").trigger("click");
        started();
    } 
});

p=0;
document.addEventListener ("keydown", function (e) {
    if (e.keyCode== 40){
        if(p==0){
        var rowIdx = tebl.cell(':eq(0)').index().row;
      
      tebl.row(rowIdx).select();

      tebl.cell( ':eq(0)' ).focus();   
        p=1; 
        }
    } 
});


$("#createdperfiles").on('click',function(){
    var rowIdx = tebl.cell(':eq(0)').index().row;
      
      tebl.row(rowIdx).select();

      tebl.cell( ':eq(0)' ).focus();
      p=0; 
});


tebl=$('#Empleadotable').DataTable({
        scrollY: 300,
        "paging":   false,
        // "ordering": false,
        "info":     false,

    select: {
            style: 'single',
        },
        keys: {
           keys:true,
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },

      rowGroup: {
        dataSrc: 'group'
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


  });

  document.addEventListener ("keydown", function (e) {
    if (e.keyCode==16) {

      var rowIdx = tebl.cell(':eq(0)').index().row;
      
      tebl.row(rowIdx).select();

      tebl.cell( ':eq(0)' ).focus();

    }
});
  $('#Empleadotable').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        tebl.row(cell.index().row).select();
     });

    // Handle click on table cell
    $('#Empleadotable').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = tebl.cell(this).index().row;

        
        // Select row
        tebl.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#Empleadotable').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data
            event.preventDefault();
            var data = tebl.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

            $('td', row_s).css('backgroundColor', '#958fcd ');
            $('td', row_s).css('color', 'white');

           button=$(row_s).attr('action');
           id=$(row_s).attr('value');
           Add(button,id);
            
        }
        
    });


    });

//     $('#Empleadotable').DataTable().on("draw", function(){
//     var rowIdx = tebl.cell(':eq(0)').index().row;
      
//     tebl.row(rowIdx).select();

//     tebl.cell( ':eq(0)' ).focus();
// });

function started(){
    var rowIdx = tebl.cell(':eq(0)').index().row;
      
      tebl.row(rowIdx).select();

      tebl.cell( ':eq(0)' ).focus();
}

document.addEventListener ("keydown", function (e) {
    if (e.keyCode==13) {
 var modal=$('#Empleado').hasClass('show');
    if(modal==false){
        $("#subir").trigger("click");
     };
    }
});


 $("#Empleadotable tbody").on('click','tr',function(){
    $('td', row_s).css('backgroundColor', '#958fcd ');
            $('td', row_s).css('color', 'white');
});

arreglo=[];
 i=0;
function Add(e,m){
    var p=0;
    for (let index = 0; index < arreglo.length; index++) {
            if(arreglo[index]==m){
                p=1;
            }
     }
     if(p!=1){
    var url = e
     var data = '';
        $.ajax({
         method: "PUT",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $('#perfiles-table tbody').append(result);
            arreglo[i]=m
            console.log(arreglo);
            $("#arreglo").attr('value',arreglo);
            i++;
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
     }else{
        Errore();
     }
}


$(document).on('click', '.remf', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
     re=$(this).val();
     for (let index = 0; index < arreglo.length; index++) {
            if(arreglo[index]==re){
              arreglo.splice(index,1);
              console.log(arreglo);
            }else{
              $("#arreglo").attr('value',arreglo);

            }
            
     }
});   

window.onbeforeunload = function(e) {
    HoldOn.open(options);
};

$('#Empleado').keyup(function(e){
    if(e.keyCode!=13)
    {
        $('div.dataTables_filter input', tebl.table().container()).focus(); 
      
    }
});

$("#descr").keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});

document.addEventListener ("keydown", function (e) {
    if (e.keyCode==27) {
        $("#descr").focus();
    }
});

document.addEventListener ("keydown", function (e) {
    if (e.altKey  &&  e.which === 65) {
        $('#back').trigger("click");
    }
});

var options = {
     theme:"sk-cube-grid",
     message:'Cargando.... ',
};

window.onbeforeunload = function(e) {
    HoldOn.open(options);
};

function Errore(){
    Command: toastr["error"]("Este Empleado ha sido Selecionado", "Error")
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
</script>
@endsection

