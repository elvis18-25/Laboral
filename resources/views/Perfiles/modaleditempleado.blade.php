
  <div class="modal fade" id="Empleadoedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style=" width: 955px; margin-top: -188px; height: 579px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black">EMPLEADO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div style=" max-height:512px; overflow:auto; font-size:small; top:-12px; ">
            <table class="table tablesorter " style="color: black !important" id="Empleadotable-edit">
                <thead class=" text-primary">
                    <tr> 
                    <th scope="col">NOMBRE</th>
                    <th scope="col">CEDULA</th>
                    <th scope="col">CARGO</th>
                    <th scope="col">DEPARTAMENTO</th>
                    <th scope="col">SALARIO</th>
                  </tr>
                </thead>
                @php
                    $empresa=Auth::user()->id_empresa;
                @endphp
                <tbody>
                  @foreach ($empleado as $empleados)
                  
                    @if ($empleados->estado==0)
                    @if ($empleados->id_empresa==$empresa)
                      <tr onclick="Addedit('{{url('agregar',[$empleados->id_empleado])}}',{{$empleados->id_empleado}});" action="{{url('agregar',[$empleados->id_empleado])}}" value="{{$empleados->id_empleado}}" >
                        <td>{{$empleados->nombre." ".$empleados->apellido}}</td>
                        <td>{{$empleados->cedula}}</td>
                        <td>{{$empleados->cargo}}</td>
                        <td>
                          @foreach ($empleados->puesto as $puesto)
                              {{$puesto->name}}
                          @endforeach
                        </td>
                        <td>${{number_format($empleados->salario,2)}}</td>
                      </tr>
                      @endif
                      @endif
            
                  @endforeach
                </tbody>
            </table>
          </div>
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

    #Empleadotable-edit tbody tr{
      cursor: pointer;
    }
  </style>
  