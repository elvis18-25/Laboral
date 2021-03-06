
  
  <!-- Modal -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content"  style=" margin-top: -40px; width: 1008px; ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: black; font-size: 16px;"><b>{{$nomina->descripcion}}</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div style="max-height: 436px;font-size: small; top: -12px; overflow-y: auto; overflow-x: hidden; width: 975px; ">
              <table class="table table-striped table-hover" id="Nominas">
                <thead>
                  <th class="TitleNomi"><b>NOMBRE</b></th>
                  <th class="TitleNomi"><b>CARGO</b></th>
                  <th class="TitleNomi"><b>SALARIO BRUTO</b></th>
                  <th class="TitleNomi"><b>DEDUCIONES</b></th>
                  <th class="TitleNomi"><b>INCREMENTO</b></th>
                  <th class="TitleNomi"><b>HORAS</b></th>
                  <th class="TitleNomi"><b>TOTAL</b></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
                </div>
              </div>
              {{-- <input type="text" name="" value="{{$perf}}" id="input" hidden> --}}
              <div class="modal-footer">
                <button class="btn btn-danger remfesrrres btn-sm redondo" value="{{$nomina->id}}" action="{{$nomina->monto}}" type="button"><i class="fas fa-trash"></i></button>
                <span style="color: black; font-size: 16px;"><b>TOTAL:&nbsp;${{number_format($nomina->monto,2)}}</b></span>
      </div>
    </div>
  </div>
  <input type="text" id="inputCheckBox" name="inputCheckBox" value="{{$nomina->id_horas}}" hidden>
  <input type="text" id="started" name="st"  class="form-control" value="{{$nomina->start}}" hidden>
  <input type="text" id="ended" name="en"  class="form-control" value="{{$nomina->end}}" hidden>
  <input type="text" id="inputvale" value="{{$nomina->id}}"  hidden>
<script>

if($("#started").attr('value')!=" "){
startComes = new Date($("#started").attr('value'));
endComes = new Date($("#ended").attr('value'));

start = moment(startComes).format('YYYY-MM-DD');
end = moment(endComes).format('YYYY-MM-DD');
}else{
 start = moment().startOf('month').format('YYYY-MM-DD');
 end = moment().endOf('month').format('YYYY-MM-DD');

}

$(document).ready(function(){

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
    url:"{{ url('datatableListado') }}",
    "data":function(d){
      if($("#inputvale").val()!=''){
        d.dato1=$("#inputvale").val();
        // var start=$("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        // var end=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var valor =$("#inputCheckBox").val();
        d.start_date=start;
        d.end_date=end;
        d.valor=valor;
      }
    }
  },

  language: {
    searchPlaceholder: "Buscar",
      "decimal": "",
      "emptyTable": "No hay informaci??n",
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
  {data:'cargo', name:'cargo', class: "boldend", searchable:false},
  {data:'salarioBruto',name:'salarioBruto', class: "right",},
  {data:'Asigna',name:'Asigna', class: "right"},
  {data:'amount',name:'amount', class: "right"},
  {data:'time',name:'time', class: "right"},
  {data:'total',name:'total', class: "right"},
  ],

});   


});





</script>

<style>
  #Nominas{
    font-size: inherit !important;
    width: 100% !important;
  }
  .TitleNomi{
  font-size: 14px !important;
  text-align: center !important;
}
</style>