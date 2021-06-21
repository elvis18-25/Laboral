
  <!-- Modal -->
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>HORARIO DEL {{$weekend->day}}</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table tablesorter " id="contratos-table">
            <thead class=" text-primary">
                <tr> 
                <th class="TitleP">INICIO</th>
                <th class="TitleP">SALIDA</th>
                <th></th>

              </tr>
            </thead>
            <tbody>
                @foreach ($week as $weekS)
                <tr >
                    <td  style="cursor: pointer;" onclick="UpdateHoras({{$weekS->id}})" class="TitleP">{{$weekS->start}}</td>
                    <td  style="cursor: pointer;"  onclick="UpdateHoras({{$weekS->id}})" class="TitleP">{{$weekS->end}}</td>
                    <td>
                      <button type="button" class="btn btn-danger redondo btn-sm btndelete" value="{{$weekS->id}}"><i class="fas fa-trash"></i></button> 
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>

    <style>
      .TitleP{
        text-align: center;
      }
    </style>

    <script>
  $('.btndelete').on("click",function(){
    var id =$(this).val();
      Swal.fire({
  title: '¿Estás seguro?',
  text: "¡No podrás revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
    var url = "{{url('DeleteEmpresa')}}/"+id; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#HorasEmple").trigger("click");
              tabla.ajax.reload();
              SuccesGen();

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             }); 
  }
})
})

function UpdateHoras(e){
  var url = "{{url('UpdateHorasEmpresa')}}/"+e; 
     var data ='';
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              $("#updatehours").html(result).modal("show");
              

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             }); 

}


    </script>