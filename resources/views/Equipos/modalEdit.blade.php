
  <div class="modal fade" id="EmpleadoEDIT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style=" width: 982px; margin-top: -178px; height: 615px;" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black font-size: 16px !important; font-weight: bold !important;"><b>EMPLEADOS</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="width: 964px;">
          {{-- <div style=" max-height:435px; overflow:auto; font-size:small; top:-12px; "> --}}
                        {{-- <div class="class="display " style="width: 100""></div> --}}
                <div class="col-sm-7" style="left: 22%;">
                <input type="text" name="" id="btnsearch" onkeyup="saerches();" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"  placeholder="Buscar..." class="form-control">
              </div>                       

            <table class="table tablesorter table-striped table-hover " style="width: 200px;"  id="Empleadotableedit">
                <thead class=" text-primary" style="color: black !important">
                    <tr> 
                    <th class="TitlePer">NOMBRE</th>
                    <th class="TitlePer">CEDULA</th>
                    <th class="TitlePer">CARGO</th>
                    <th class="TitlePer">DEPARTAMENTO</th>
                    <th class="TitlePer">SALARIO</th>
                  </tr>
                </thead>
                @php
                    $empresa=Auth::user()->id_empresa;
                @endphp
                <tbody>
                  @foreach ($emple as $empleados)

                      <tr onclick="AddGroup('{{url('agregarGruopEdit',[$empleados->id_empleado])}}',{{$empleados->id_empleado}});" action="{{url('agregarGruopEdit',[$empleados->id_empleado])}}" value="{{$empleados->id_empleado}}" >
                        <td class="left">{{$empleados->nombre." ".$empleados->apellido}}</td>
                        <td class="center">{{$empleados->cedula}}</td>
                        <td class="center">{{$empleados->cargo}}</td>
                        <td class="center">
                          @foreach ($empleados->puesto as $puesto)
                              {{$puesto->name}}
                          @endforeach
                        </td>
                        <td>${{number_format($empleados->salario,2)}}</td>
                      </tr>
                  @endforeach
                </tbody>
            </table>
          {{-- </div> --}}
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
  
  <style>
    .display{
      margin-left: 0px;
      width: 844px !important;
    }
    .dataTables_scrollBody{
      width: 104% !important;
      position: relative !important;
      overflow: auto !important;
      max-height: 449px !important;
      height: 473px !important;
    }
    .dataTables_scrollHeadInner{
      box-sizing: content-box !important;
    width: 860px !important;
    padding-right: 17px !important;
    }

    .table-striped{
      width: 935px !important;
    margin-left: 0px !important;
    }
    .dataTables_scrollHead{
      overflow: hidden !important;
    position: relative !important;
    border: 0px !important;
    width: 100% !important;
    }

    #Empleadotableedit tbody tr{
      cursor: pointer;
    }
    .left{
      text-align: left;
      font-size: 14px;
    }
    .center{
      text-align: center;
    }
  </style>