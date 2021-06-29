
  <!-- Modal -->
  <div class="modal fade" id="NewHoras" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>NUEVO HORARIO</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-row">
            <div class="col-sm-6">
                <label for="inputZip"><b>HORA DE INICIO DE EMPRESA</b></label>
              <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i style="color: black !important;" class="fas fa-clock"></i>
                 </div>      
               </div>
              <input type="text" class="form-control" id="HoraEn"  name="HoraEn" readonly style="cursor: pointer !important; " >
            </div>
            </div>
            </div>

            <div class="col-sm-6">
              <label for="inputZip"><b>HORA DE FINALIZACIÓN DE EMPRESA</b></label>
              <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i style="color: black !important;" class="fas fa-clock"></i>
               </div>      
             </div>
            <input type="text" class="form-control" id="HoraSa" name="HoraSa" readonly style="cursor: pointer !important; " >
          </div>
          </div>
          </div> 
        </div>


            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="todos" id="todos" onclick='toggle(this)' >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                    <h5><b>TODOS</b></h5>
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="dinamico[]" value="1" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                    <h5><b>LUNES</b></h5>
                </label>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"  name="dinamico[]" value="2" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                    <h5><b>MARTES</b></h5>
                </label>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="dinamico[]" value="3" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                    <h5><b>MIERCOLES</b></h5>
                </label>
            </div>


        

        <div class="card-body" style="top: 143px; position: absolute; margin-left: 104px;">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="dinamico[]" value="4" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                    <h5><b>JUEVES</b></h5>
                </label>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="dinamico[]" value="5" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                    <h5><b>VIERNES</b></h5>
                </label>
            </div>
        

            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="dinamico[]" value="6" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                    <h5><b>SABADO</b></h5>
                </label>
            </div>




        </div>
        <div class="card-body" style="top: 143px; position: absolute; margin-left: 222px;">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="dinamico[]" value="7" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                    <h5><b>DOMINGO</b></h5>
                </label>
            </div>
        </div>
      </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-info redondo" onclick="savehorario()"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>

  <script>
      function savehorario(){
        b=0;
        var array=document.getElementsByName('dinamico[]');
      var add=[];

      for(var i=0, n=array.length;i<n;i++) {
        if($(array[i]).prop('checked') ){
          add[i]= array[i].value;
          b=1;
        }
  }

  console.log(add);
  if(b!=0){
  var entrada=$("#HoraEn").val();
  var salida=$("#HoraSa").val();
    var url = "{{url('harariosave')}}"; 
     var data ={entrada:entrada,salida:salida,add:add};
        $.ajax({
         method: "POST",
           data: data,
            url:url ,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
              // alert(result)
              $("#NewHoras").trigger("click");
              tabla.ajax.reload();
              

            

           },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                ErroresGeneral();
    }
             });
            }else{
              ErroresGeneral();
            }
}
  </script>