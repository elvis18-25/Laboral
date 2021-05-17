<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px !important; font-weight: bold !important;">EDITAR CONCEPTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4"><b>CONCEPTO</b></label>
                <input type="text" class="form-control" value="{{$concepto->concepto}}" id="nombre" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" >
              </div>
              <div class="form-group col-md-3">
                  <label for="inputEmail4">MONTO</label>
                  <input type="text" value="{{$concepto->monto}}" class="form-control" id="monts">
                </div>
          </div>
      </div>
      <input type="text" id="retenido" value="{{$concepto->monto}}" hidden>
      <div class="modal-footer">
          <button class="btn btn-danger eliminiconcepts btn-sm" value="{{$concepto->id}}" type="button"><i class="fas fa-trash"></i>&nbsp;Eliminar</button> 
        <button type="button" class="btn btn-info updatestes btn-sm" value="{{$concepto->id}}" ><i class="fas fa-save">&nbsp;</i> Guardar</button>
      </div>
    </div>
  </div>

  <script>
      $("#monts").mask('0#');

$('.eliminiconcepts').on('click',function(){

var id=$(this).val();
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
   var url = "{{ url('deleteconcept')}}/"+id;
    var data = '';
       $.ajax({
        method: "POST",
          data: data,
           url:url ,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success:function(result){
            $("#gasto"+id).closest('tr').remove();
            var condition=parseInt($(result).attr('action'),10);
            var general=parseInt($("#totl").val(),10);
            var total=0;

            if(condition==0){
              // $("#gastoperido-table tbody").append(result);
              $("#fijomodal").trigger("click");
              var cont=parseInt($("#totalconcepto").val());

              var resta=cont-parseInt($("#retenido").val(),10);
              // var sum=resta+parseInt($(result).attr('value'),10);

              var restotal= numberFormat2.format(resta); 
              $("#totalperiodo").empty();
              $("#totalperiodo").append(restotal);

              total=general-parseInt($("#retenido").val(),10);
              
              
              // total=parseInt($(result).attr('value'),10)+total;
              $("#totl").attr('value',total);

            }else{
              // $("#gastofijo-table tbody").append(result);

                $("#fijomodal").trigger("click");
              var cont=parseInt($("#formes").val());

              var resta=cont-parseInt($("#retenido").val(),10);
              // var sum2=resta+parseInt($(result).attr('value'),10);

              var restotal2= numberFormat2.format(resta); 
              $("#totalnomina").empty();
              $("#totalnomina").append(restotal2);
              
              total=general-parseInt($("#retenido").val(),10);
            // total=parseInt($(result).attr('value'),10)+total;
            $("#totl").attr('value',total);
            }

            var resgeneral= numberFormat2.format(total);
            $("#totalgeneral").empty();
            $("#totalgeneral").append(resgeneral);
            
         
          
          },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
               alert("Status: " + textStatus); alert("Error: " + errorThrown); 
   }
            });
 }
})
});

$('.updatestes').on('click',function(){
    var id=$(this).val();
    var name=$("#nombre").val();
    var monto=$("#monts").val();
    var url = "{{ url('updateconcept')}}/"+id;
     var data = {name:name,monto:monto};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
            $("#gasto"+id).closest('tr').remove();
            var condition=parseInt($(result).attr('action'),10);
            var general=parseInt($("#totl").val(),10);
            var total=0;

            if(condition==0){
              $("#gastoperido-table tbody").append(result);
              $("#fijomodal").trigger("click");
              var cont=parseInt($("#totalconcepto").val());

              var resta=cont-parseInt($("#retenido").val(),10);
              var sum=resta+parseInt($(result).attr('value'),10);

              var restotal= numberFormat2.format(sum); 
              $("#totalperiodo").empty();
              $("#totalperiodo").append(restotal);

              total=general-parseInt($("#retenido").val(),10);
              
              total=parseInt($(result).attr('value'),10)+total;
              $("#totl").attr('value',total);

            }else{
              $("#gastofijo-table tbody").append(result);

                $("#fijomodal").trigger("click");
              var cont=parseInt($("#formes").val());

              var resta=cont-parseInt($("#retenido").val(),10);
              var sum2=resta+parseInt($(result).attr('value'),10);

              var restotal2= numberFormat2.format(sum2); 
              $("#totalnomina").empty();
              $("#totalnomina").append(restotal2);
              
              total=general-parseInt($("#retenido").val(),10);
            total=parseInt($(result).attr('value'),10)+total;
            $("#totl").attr('value',total);
            }

            var resgeneral= numberFormat2.format(total);
            $("#totalgeneral").empty();
            $("#totalgeneral").append(resgeneral);


        
          
           
           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
             });  
});
  </script>