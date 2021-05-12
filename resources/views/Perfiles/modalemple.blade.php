
  <div class="modal fade" id="Empleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style=" width: 955px; margin-top: -76px; height: 579px;" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: black">EMPLEADO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- <div style=" max-height:435px; overflow:auto; font-size:small; top:-12px; "> --}}
                        {{-- <div class="class="display " style="width: 100""></div> --}}

            <table class="table tablesorter table-striped table-hover " style="width: 200px;"  id="Empleadotable">
                <thead class=" text-primary" style="color: black !important">
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
                  @foreach ($empleados as $empleado)
                    @if ($empleado->estado==0)
                    @if ($empleado->id_empresa==$empresa)
                      <tr onclick="Add('{{url('agregar',[$empleado->id_empleado])}}',{{$empleado->id_empleado}});" action="{{url('agregar',[$empleado->id_empleado])}}" value="{{$empleado->id_empleado}}" >
                        <td>{{$empleado->nombre." ".$empleado->apellido}}</td>
                        <td>{{$empleado->cedula}}</td>
                        <td>{{$empleado->cargo}}</td>
                        <td>
                          @foreach ($empleado->puesto as $puesto)
                              {{$puesto->name}}
                          @endforeach
                        </td>
                        <td>${{number_format($empleado->salario,2)}}</td>
                      </tr>
                      @endif
                      @endif
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

    #Empleadotable tbody tr{
      cursor: pointer;
    }
  </style>