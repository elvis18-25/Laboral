
@php
    $user=Auth::user()->id_empresa;
@endphp

@foreach ($tss as $tsse)
@if ($tsse->tipo_asigna=="DEDUCCIÓN" && $tsse->id_empresa==$user && $tsse->estado==0 )
@php
    $cont=0;
@endphp
    <tr>
        <td >{{$tsse->Nombre}}</td>
        <td style="text-align: center;">{{$tsse->tipo}}</td>
        @if ($tsse->tipo=="PORCENTAJE")
        @php
             $cont=$tsse->Monto*$empleado->salario;
             $cont=$cont/100;
        @endphp
        <td style="text-align: right;" >{{$tsse->Monto}}%</td>
        @else
        <td style="text-align: right;">${{number_format($tsse->Monto,2)}}</td>
        @endif
        <td style="text-align: center;" >${{number_format($cont,2)}}</td>
        <td style="text-align: center;">{{$tsse->created_at->format('d/m/Y')}}</td>
        @php
            $b=0;
        @endphp
        @foreach ($estado as $estados)
        @if ($estados->id_empleado==$empleado->id_empleado)
        @if ($estados->id_asignaciones==$tsse->id)
        @if ($estados->estado==1 )
        <td>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" onclick="switchetss('{{url('switchetss',[$tsse->id])}}',{{$empleado->id_empleado}})" type="checkbox" id="customSwitch1{{$tsse->id}}" >
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
                    <input class="form-check-input" onclick="switchetss('{{url('switchetss',[$tsse->id])}}',{{$empleado->id_empleado}})" type="checkbox"  checked id="customSwitch1{{$tsse->id}}" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>   
        @endif
    </tr>


@endif
@endforeach


