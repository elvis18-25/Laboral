@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

<style>
    .TitleP{
        text-align: center;
    }
    </style>
    <link rel="stylesheet" href="{{asset('css/roles.css')}}">
    <link rel="stylesheet" href="{{asset('css/pageLoader.css')}}">

@section('content')
<form action="{{Route('Roles.store')}}" method="POST">
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>NUEVO ROL</b></h4>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>
        @csrf
        <div class="card-body">
            <div class="form-row">
                <div class="col-sm-5">
                    <input type="text" name="descripcion" id="descr" class="form-control" required autofocus  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Nombre">
                </div>

                <div class="col-sm-4">

                </div>
            </div>
            <br>
            <br>

            {{-- <div style="max-height: 449px; overflow:auto; font-size:small; top:-12px; "> --}}
    <table class="table table-striped" id="roles">
        <thead>
          <tr>
            <th class="TitleP" style="font-size: 14px;"><b>MODULO</b></th>
            <th class="TitleP"  style="font-size: 14px;"><b>DESCRIPCIÓN</b></th>
            <th class="TitleP"  style="font-size: 14px;"><b>
                <div class="form-check" style="margin-left: 20px;">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="todos" id="todos" onclick='toggle(this)' >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        {{-- <h5><b>TODOS</b></h5> --}}
                    </label>
                </div>    
            </b></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($modulos as $modulo)
            <tr>
                <td >{{$modulo->nombre}}</td>
                <td class="TitleP">{{$modulo->descripcion}}</td>
                <td class="TitleP">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input cheinput" type="checkbox" name="dinamico[]" value="{{$modulo->id}}" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{-- </div> --}}

</div>
        </div>
    </div>
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title" style="font-size: 16px !important; font-weight: bold !important;"><b>INICIO WIDGET</b></h4>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>

        @csrf
        <div class="card-body">
            <div class="form-row">


                <div class="col-sm-4">

                </div>
            </div>
            <br>
            <br>

            {{-- <div style="max-height: 449px; overflow:auto; font-size:small; top:-12px; "> --}}
    <table class="table table-striped" id="Widget">
        <thead>
          <tr>
            <th class="TitleP" style="font-size: 14px;"><b>MODULO</b></th>
            <th class="TitleP"  style="font-size: 14px;"><b>DESCRIPCIÓN</b></th>
            <th class="TitleP"  style="font-size: 14px;"><b>
                <div class="form-check" style="margin-left: 20px;">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="todos" id="todoWidget" onclick='toggleWidg(this)' >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        {{-- <h5><b>TODOS</b></h5> --}}
                    </label>
                </div>    
            </b></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($widget as $widgets)
            <tr>
                <td >{{$widgets->nombre}}</td>
                <td class="TitleP">{{$widgets->descripcion}}</td>
                <td class="TitleP">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input cheinput" type="checkbox" name="wingdt[]" value="{{$widgets->id}}" >
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{-- </div> --}}

</div>
        </div>

    </div>
</div>
<button type="submit"  id="subir" class="btn btn-fill btn-info float-right" style="top: 47px;"><i class="fas fa-save"></i>&nbsp;{{ __('Guardar') }}</button>
</form>

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
<script src="{{asset('js/pageLoader.js')}}"></script>
<script>

function toggle(source) {
  checkboxes = document.getElementsByName('dinamico[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}
function toggleWidg(source) {
  checkboxes = document.getElementsByName('wingdt[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}



table=$('#roles').DataTable({
    "info": false,
    "paging":   false,
    scrollY: 500,
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
table=$('#Widget').DataTable({
    "info": false,
    "paging":   false,
    scrollY: 300,
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

// arreglo=[];
// b=0;
// $('.cheinput').on("click",function(){
// var valor=$(this).val();
// if($(this).prop('checked')){
//     arreglo[b]=valor;
//     b++;
// }else{
//     for (let index = 0; index < arreglo.length; index++) {
//             if(arreglo[index]==valor){
//               arreglo.splice(index,1);
//             //   console.log(arreglo);
//             }else{
              

//             }
            
//      }
    
// }
// $("#arreglo").attr('value',arreglo);
//      console.log(arreglo);

// });

</script>
    

@endsection