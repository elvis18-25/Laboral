@php
    $user=Auth::user()->id_empresa;
    $cont=0;
    $p=0;
    $b=0;
@endphp

@foreach ($tss as $tsse)
@if ($tsse->tipo_asigna=="INCREMENTO"  && $tsse->id_empresa==$user && $tsse->estado==0)
    @if ($p==0)

    <tr>
        <td >{{$tsse->Nombre}}</td>
        <td style="text-align: center;">{{$tsse->tipo}}</td>

        @if ($tsse->tipo=="PORCENTAJE")
        @php
        $cont=$tsse->Monto*$empleado->salario;
        $cont=$cont/100;
   @endphp
        <td style="text-align: center;" >{{$tsse->Monto}}%</td>

        @else
        <td style="text-align: center;" >${{number_format($tsse->Monto,2)}}</td>
  
        @endif
        <td style="text-align: right;" >${{number_format($cont,2)}}</td>

        <td style="text-align: center;" >{{$tsse->created_at->format('d/m/Y')}}</td>
        @foreach ($estado as $estados)
        @if ($estados->id_empleado==$empleado->id_empleado)
        @if ($estados->id_asignaciones==$tsse->id)
        @if ($estados->estado==1)
        <td>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" onclick="switchetssbono('{{url('switchetssbono',[$tsse->id])}}',{{$empleado->id_empleado}})" type="checkbox" id="customSwitch1{{$tsse->id}}"  >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
              @php
                  $b=1;
              @endphp
              @break
        </td>
        @endif
        @endif
        @endif
        @endforeach
        @if ($b==0)
        <td>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" onclick="switchetssbono('{{url('switchetssbono',[$tsse->id])}}',{{$empleado->id_empleado}})" type="checkbox" checked id="customSwitch1{{$tsse->id}}" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>   
        @endif
    </tr>
    @php
        $p=1;
    @endphp
    @endif
@endif
@endforeach
 


