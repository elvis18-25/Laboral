@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')

<link rel="stylesheet" href="{{asset('css/perfiles.css')}}">
<link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

{{-- <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">   --}}
<form action="{{Route('Perfiles.update',$perfiles->id)}}" method="POST" >
    @csrf
    @method('PUT')
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>EDITAR PERFIL</b></h4>
                </div>
                <div class="col-4 text-right">
                    <button type="button" id="createdperfiles" title="Agregar Empleado al Perfil" data-toggle="modal" data-target="#Empleadoedit" class="btn btn-info btn-sm redondo"><i class="fas fa-users" style="top: 5px; margin-left: -39%;"></i></button>
                    @include('Perfiles.modaleditempleado')
                </div>
            </div>
        </div>
        <div class="card-body">
    <div class="form-row">
            <div class="col-sm-5">
                <input type="text" name="descripcion" style="font-size: 14px;"  value="{{$perfiles->descripcion}}" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Descripcion">
            </div>
            {{-- <div class="col-sm-5">
                <input type="date" id="fech" value="{{$perfiles->fecha}}" name="fecha" class="form-control"  >
            </div> --}}
        </div>
        <br>
        @php
            $empresa=Auth::user()->id_empresa;
        @endphp
            <div class="">
                <div style="max-height: 449px; overflow:auto; font-size:small; top:-12px; ">
                <table class="table tablesorter table-striped table-hover" id="perfiles-tableedit">
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
                        @foreach ($empleado as $empleados)

                        <tr>
                            <td >{{$empleados->nombre." ".$empleados->apellido}}</td>
                            <td style="text-align: center;">{{$empleados->cedula}}</td>
                            <td style="text-align: center;">{{$empleados->cargo}}</td>
                            <td style="text-align: center;">
                            {{-- @foreach ($empleados->puesto as $puesto) --}}
                                {{$empleados->puesto}}
                            {{-- @endforeach --}}
                            </td>
                            <td style="text-align: right;">${{number_format($empleados->salario,2)}}</td>
                            <td style="text-align: right;">
                                <button class="btn btn-danger btn-sm remfe" type="button" value="{{$empleados->id_empleado}}"><i class="fas fa-minus"></i></button>
                            </td>
                        </tr>
                        @endforeach
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
<div class="o-page-loader">
    <div class="o-page-loader--content">
      <img src="{{ asset('black') }}/img/logotipo.png" alt="" class="o-page-loader--spinner">
        {{-- <div class=""></div> --}}
        <div class="o-page-loader--message">
            <span>Cargando...</span>
        </div>
    </div>
</div>
<input type="text" name="arreglo" value="" id="arreglo" hidden>
<input type="text" name="arregloremo" value="" id="arregloremo" hidden>

<button type="submit" id="subir" class="btn btn-fill btn-info float-right"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
</form>

<form action="{{route('Perfiles.destroy',$perfiles->id)}}" id="deleeperfil" method="POST">
    @csrf
    @method('DELETE');
<button type="submit"  class="btn btn-fill btn-danger float-right" style="margin-right: 5px;"><i class="fas fa-trash"></i>&nbsp;{{ __('Eliminar') }}</button>
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
} 
});


tebl=$('#Empleadotable-edit').DataTable({
      scrollY: 300,
        "paging":   false,
        // "ordering": false,
        "info":     false,
    select: {
            style: 'single',
        },
        keys: {
          keys:true,
           page: 'current',
          keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */,32 ],
        },

      rowGroup: {
        dataSrc: 'group'
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


  });


//   document.addEventListener ("keydown", function (e) {
//     if (e.keyCode== 107) {
//         $("#createdperfiles").trigger("click");
//         started();
//     } 
// });

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
  $('#Empleadotable-edit').on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
      
        tebl.row(cell.index().row).select();
     });

    // Handle click on table cell
    $('#Empleadotable-edit').on('click', 'tbody td', function(e){
        e.stopPropagation();
        
        // Get index of the clicked row
        var rowIdx = tebl.cell(this).index().row;

        
        // Select row
        tebl.row(rowIdx).select();
    });
    // Handle key event that hasn't been handled by KeyTable
    $('#Empleadotable-edit').on('key.dt', function(e, datatable, key, cell, originalEvent,row){

        // If ENTER key is pressed
        if(key === 13){
            // Get highlighted row data

            var data = tebl.row(cell.index().row).data();
            
            var row_s=$(this).DataTable().row({selected:true}).node(); 

            $('td', row_s).css('backgroundColor', '#958fcd ');
            $('td', row_s).css('color', 'white');

           button=$(row_s).attr('action');
           id=$(row_s).attr('value');
           Addedit(button,id);
            
        }
        
    });


$('#Empleadoedit').keyup(function(e){
    if(e.keyCode!=13)
    {
        $('div.dataTables_filter input', tebl.table().container()).focus(); 
      
    }
});


 $("#Empleadotable-edit tbody").on('click','tr',function(){
    $('td', this).css('backgroundColor', '#958fcd ');
    $('td', this).css('color', 'white');
});






$("#descr").keypress(function(tecla)
{
   if(tecla.charCode==43)

   {
      return false;

   }

});

});

arreglo=[];
 i=0;

function Addedit(e,m){
    var url = e
     var data = '';
        $.ajax({
         method: "PUT",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $('#perfiles-tableedit tbody').append(result);
            arreglo[i]=m
            $("#arreglo").attr('value',arreglo);
            i++;
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });
}

arreRemov=[];
j=0;
$(document).on('click', '.remfe', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
   var id=$(this).val();
     arreRemov[j]=id;
     $("#arregloremo").attr('value',arreRemov);
      j++;

});

document.addEventListener ("keydown", function (e) {
    if (e.keyCode==13) {
 var modal=$('#Empleadoedit').hasClass('show');
    if(modal==false){
        $("#subir").trigger("click");
     };
    }
});

$("#deleeperfil").submit(function(e){
    e.preventDefault();
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
    this.submit();
  }
})
})

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
</script>
    
<style>
.table-striped{
  width: 100% !important;
}

.tablesorter {
  width: 100% !important;
}
</style>
@endsection