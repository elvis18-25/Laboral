  
  <!-- Modal -->
    <div class="modal-dialog">
      <div class="modal-content" style=" margin-top: -95px; ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px !important; font-weight: bold !important;">OTROS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="col-sm-6">
                    <label style="color: black"> <b>{{ __('DESCRIPCIÓN ') }}</b></label>
                    <input type="text" name="name" autofocus id="name" value="{{$otros->descripcion}}"   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}"  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                </div>
    
                <div class="col-sm-6">
                    <label style="color: black"><b>{{ __('TIPO ') }}</b></label>
                    <select id="inputStateTipos" class="form-control selec"  name="tipo" >


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
                <br>
              
                <div class="col-sm-6">
                  <label style="color: black"><b>{{ __('MONTO ') }}</b></label>

    
                    <div class="input-group" >
                    <div class="input-group-prepend" style="top: 0px; position: relative; height: 38px;">
                        <div class="input-group-text" style="color: black"><span id="figura"></span></div>
                      </div>
                    <input type="text"  style="text-align: right;"  id="montoOPC" value="{{number_format($otros->monto,2)}}" onkeyup="calculares();" class="form-control money ">
                    <input type="text"  id="monto" value="{{$otros->monto}}" hidden>
                  </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="text" id="empleotros" value="{{$empleados->id_empleado}}" hidden>
            <input type="text" id="perfile" value="{{$otros->id_perfiles}}" hidden>
            <input type="text" id="inputType" value="{{$otros->tipo}}" hidden>
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-danger btn-sm redondo" onclick="deleteotros('{{$otros->id}}',{{$empleados->id_empleado}});"><i class="fas fa-trash"></i></button>
          <button type="button" class="btn btn-info btn-sm redondo" onclick="updateotros('{{$otros->id}}');"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>


    <script>

$('.money').mask("#,##0.00", {reverse: true});

var figura=$("#inputType").val();
if (figura=="MONTO") {
  $("#figura").append("$");
} else {
  $("#figura").append("%");
}
        function updateotros(e){
    var name=$("#name").val();
   var tipo=$("#inputStateTipos").val();
   var forma=$("#forma").val();
   var monto=$("#monto").val();
   var idempl=$("#empleotros").val();
   var perfil=$("#perfile").val();
  //  alert(tipo);

   if(name==""|| tipo==""||forma==""||monto==""){
    Errore();
   }else{
    var url = "{{url('otrosupdate')}}/"+e; 
     var data ={name:name,tipo:tipo,forma:forma,monto:monto,idempl:idempl};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              // alert(result);
             $("#ot tbody").empty();
             $("#ot tbody").append(result); 
             $("#otrosedites").trigger("click");
             $("#detalle").trigger("click");
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


function calculares(){
   var salario=$("#montoOPC").val();
   
  //  var sum=0;

   var montoFormat = toInt(salario);
 


  //  sum=montoFormat/23.83/8;

   $("#monto").attr('value',montoFormat);
  //  $("#salDias").attr('value',financial(sum));

 }
 
 function financial(x) {
   var sala=Number.parseFloat(x).toFixed(2);
  return sala;
}


String.prototype.toInt = function (){    
    return parseInt(this.split(' ').join('').split(',').join('') || 0);
}



toInt = function(val){
  var result;
  if (typeof val === "string")
    result = parseInt(val.split(' ').join('').split(',').join('') || 0);
  else if (typeof val === "number")
    result = parseInt(val);
  else if (typeof val === "object")
    result = 0;
  return result;
}

function deleteotros(e,p){
    var url="{{url('deleteotros')}}/"+e; 
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
  