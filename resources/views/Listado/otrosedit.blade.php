  
  <!-- Modal -->
  <div class="modal-dialog">
    <div class="modal-content" style=" margin-top: -95px; ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px !important; font-weight: bold !important;">EDITAR OTROS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row">
              <div class="col-sm-6">
                  <label style="color: black"> <b>{{ __('NOMBRE ') }}</b></label>
                  <input type="text" name="name" autofocus id="name" value="{{$otros->descripcion}}"   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
              </div>
  
              <div class="col-sm-6">
                  <label style="color: black"><b>{{ __('TIPO ') }}</b></label>
                  <select id="inputState" class="form-control selec"  name="tipo" >
                      <option selected disabled>ElEGIR...</option>

                      @if ($otros->tipo_asigna=="DEDUCIÓN")
                      <option value="1" selected>DEDUCIÓN</option>
                      @else
                      <option value="1">DEDUCIÓN</option>
                      @endif

                      @if ($otros->tipo_asigna=="INCREMENTO")
                      <option value="2" selected>INCREMENTO</option>

                      @else
                      <option value="2">INCREMENTO</option>
                          
                      @endif
                    </select>
              </div>
  
              <div class="col-sm-5">
                  <label style="color: black"><b>{{ __('FORMA ') }}</b></label>
                  <select  class="form-control selec" name="formae"  id="forma" >
                      <option selected disabled>ElEGIR...</option>

                      @if ($otros->tipo=="MONTO")
                      <option value="3" selected>MONTO</option>
                      @else
                      <option value="3">MONTO</option>
                      @endif

                      @if ($otros->tipo=="PORCENTAJE")
                      <option value="4" selected>PORCENTAJE</option>

                      @else
                      <option value="4">PORCENTAJE</option>
                          
                      @endif
                    </select>
              </div>
            
              <div class="col-sm-6">
                  <label style="color: black"></label>
  
                  <div class="input-group" style="top: 5px;">
                  <div class="input-group-prepend" style="top: 0px; position: relative; height: 38px;">
                      <div class="input-group-text" style="color: black"><span id="figura"></span></div>
                    </div>
                  <input type="text" name="monto" autofocus id="monto" value="{{$otros->monto}}"  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder=""  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
              </div>
          </div>
      </div>

      <div class="modal-footer">
          <input type="text" id="empleotros" value="{{$empleados->id_empleado}}" hidden>
          <input type="text" id="perfile" value="{{$otros->id_nomina}}" hidden>
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button type="button" class="btn btn-info btn-sm" onclick="updateotros('{{$otros->id}}');"><i class="fas fa-save"></i>&nbsp;Guardar</button>
        <button type="button" class="btn btn-danger btn-sm" onclick="deleteotros('{{$otros->id}}',{{$empleados->id_empleado}});"><i class="fas fa-trash"></i>&nbsp;Eliminar</button>
      </div>
    </div>
  </div>


  <script>
      function updateotros(e){
  var name=$("#name").val();
 var tipo=$("#inputState").val();
 var forma=$("#forma").val();
 var monto=$("#monto").val();
 var idempl=$("#empleotros").val();
 var perfil=$("#perfile").val();

 if(name==""|| tipo==""||forma==""||monto==""){
  Errore();
 }else{
  var url = "{{url('otrosupdateListado')}}/"+e; 
   var data ={name:name,tipo:tipo,forma:forma,monto:monto,idempl:idempl};
      $.ajax({
       method: "POST",
         data: data,
          url:url ,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success:function(result){
           $("#ot tbody").empty();
           $("#ot tbody").append(result); 
           $("#otrosedites").trigger("click");
           tabla.ajax.reload();
           totalnomi(perfil);
      
          

         },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
              alert("Status: " + textStatus); alert("Error: " + errorThrown); 
  }
           }); 
 }
      }

      $("#forma").on('change',function(){
if($(this).val()==3){
   $("#figura").empty();
   $("#figura").append("$");
}else{
  $("#figura").empty();
  $("#figura").append("%");

}   

});

function deleteotros(e,p){
  var url="{{url('deleteotrosListado')}}/"+e; 
  var perfil=$("#perfile").val();
var data={p:p};
$.ajax({
       method: "POST",
         data: data,
          url:url ,
          success:function(result){
          $("#ot tbody").empty();
           $("#ot tbody").append(result); 
           $("#otrosedites").trigger("click");
           tabla.ajax.reload();
           totalnomi(perfil);
            

         },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
              alert("Status: " + textStatus); alert("Error: " + errorThrown); 
  }
           });
}
  </script>
