
  
  <!-- Modal -->
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  style=" margin-top: -40px; ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black">{{$nomina->descripcion}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div style="max-height: 436px;font-size: small; top: -12px; overflow-y: auto; overflow-x: hidden; ">
                <table class="table table-striped table-hover" id="Nominas">
                  <thead>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">CARGO</th>
                    <th scope="col">SALARIO BRUTO</th>
                    <th scope="col">DEDUCIONES</th>
                    <th scope="col">INCREMENTO</th>
                    <th scope="col">TOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                  </div>
                </div>
                {{-- <input type="text" name="" value="{{$perf}}" id="input" hidden> --}}
                <div class="modal-footer">
                  <button class="btn btn-danger remfes btn-sm" value="{{$nomina->id}}" action="" type="button"><i class="fas fa-trash"></i></button>
                  <span style="color: black">TOTAL NOMINA:&nbsp;{{number_format($nomina->monto,2)}}</span>
        </div>
      </div>
    </div>

    <input type="text" id="inputvale" value="{{$perf}}"  hidden>
  <script>
   $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
  });
  
 tabla=$('#Nominas').DataTable({
        dom: 'Bfrtip',
        "searching": false,
        "paging":   false,
        "ordering": false,
        "info":     false,
        select: true,
        processing:true,
      

    serverSide:true,
    ajax:
    {
      url:"{{ url('datatable') }}",
      "data":function(d){
        if($("#inputvale").val()!=''){
          d.dato1=$("#inputvale").val();
          // alert($("#inputvale").val());
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
    {data:'nombre',name:'nombre', },
    {data:'cargo', name:'cargo', searchable:false},
    {data:'salario',name:'salario', className: "text-right",},
    {data:'Asigna',name:'Asigna', className: "text-right"},
    {data:'amount',name:'amount', className: "text-right"},
    {data:'total',name:'total', className: "text-right"},
    ],

});   

$(document).on('click', '.remfes', function (event) {
  var id=$(this).val();
  var idgasto=$("#input").val();
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
   var url = "{{ url('eliminarnomina')}}/"+id;
    var data = {idgasto:idgasto};
       $.ajax({
        method: "POST",
          data: data,
           url:url ,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success:function(result){
            $("#"+result).remove();
            $("#nominamodal").trigger("click");
            $("#listadonomina").attr('value',0);
            totalgastoshow();
          },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
               alert("Status: " + textStatus); alert("Error: " + errorThrown); 
   }
            });
 }
})
            
});

function excele(){
  tabla.ajax.reload();
    Swal.fire(
      'Eliminado!',
      'La Nomina ha sido Eliminada.',
      'success'
    )  
}
  </script>

  <style>
    #Nominas{
      font-size: inherit !important;
    }
  </style>