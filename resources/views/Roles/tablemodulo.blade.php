<tr>
    <td>EMPLEADOS</td>
    <td class="TitleP">VER REGISTRO DE EMPLEADOS Y MODIFICACIONES</td>

        @if ($permisos->empleado==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="1" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="1" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >USUARIOS</td>
    <td class="TitleP">VER REGISTRO DE USUARIOS Y MODIFICACIONES</td>

        @if ($permisos->usuario==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="2" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="2" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >DEPARTAMENTOS</td>
    <td class="TitleP">VER REGISTRO DE USUARIOS Y MODIFICACIONES</td>
        @if ($permisos->departamento==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="3" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="3" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >ROLES</td>
    <td class="TitleP">VER REGISTRO DE ROLES Y MODIFICACIONES</td>
        @if ($permisos->roles==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="4" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="4" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >GASTOS</td>
    <td class="TitleP">VER REGISTRO DE GASTOS Y MODIFICACIONES</td>
        @if ($permisos->gastos==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="5" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="5" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >ASIGNACIONES</td>
    <td class="TitleP">VER REGISTRO DE GASTOS Y MODIFICACIONES</td>
        @if ($permisos->asignaciones==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="6" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="6" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >PERFILES DE NOMINAS</td>
    <td class="TitleP">VER REGISTRO DE PERFILES DE NOMINAS Y MODIFICACIONES</td>
        @if ($permisos->perfiles==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="8" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="8" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >FORMA DE PAGO</td>
    <td class="TitleP">VER REGISTRO DE FORMA DE PAGO Y MODIFICACIONES</td>
        @if ($permisos->formas_pagos==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="9" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="9" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >PERFILES DE USUARIOS</td>
    <td class="TitleP">VER REGISTRO DE PERFILES DE USUARIOS Y MODIFICACIONES</td>
        @if ($permisos->perfilesuser==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="10" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="10" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >NOMINAS</td>
    <td class="TitleP">	
        VER REGISTRO DE NOMINAS Y MODIFICACIONES</td>
        @if ($permisos->nomina==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="11" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="11" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >ASISTENCIAS</td>
    <td class="TitleP">	
        VER REGISTRO DE ASISTENCIA</td>
        @if ($permisos->asistencia==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="12" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="12" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >EMPRESA</td>
    <td class="TitleP">	
        CONFIGURACION DE LA EMPRESA</td>
        @if ($permisos->empresa==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="13" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="13" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >GRUPOS</td>
    <td class="TitleP">	
        REGISTRO Y MODIFICACIONES DE GRUPOS</td>
        @if ($permisos->empresa==1) 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" name="dinamico[]" value="13" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  type="checkbox" name="dinamico[]" value="13" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
