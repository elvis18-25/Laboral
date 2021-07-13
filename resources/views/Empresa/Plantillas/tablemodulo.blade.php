<tr>

    <td>EMPLEADOS</td>
    <td class="TitleL">VER REGISTRO DE EMPLEADOS Y MODIFICACIONES</td>

        @if ($permisos->empleado==1) 
        <td class="TitleP" value={{1}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{1}}" checked type="checkbox" name="donm[]" value="1" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{1}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{1}}" type="checkbox" name="donm[]" value="1" >
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
    <td class="TitleL">VER REGISTRO DE USUARIOS Y MODIFICACIONES</td>

        @if ($permisos->usuario==1) 
        <td class="TitleP"  value={{2}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{2}}" checked type="checkbox" name="donm[]" value="2" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{2}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{2}}"  type="checkbox" name="donm[]" value="2" >
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
    <td class="TitleL">VER REGISTRO DE USUARIOS Y MODIFICACIONES</td>
        @if ($permisos->departamento==1) 
        <td class="TitleP" value={{3}}>
            <div class="form-check checkaling ">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{3}}" checked type="checkbox" name="donm[]" value="3" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{3}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{3}}"  type="checkbox" name="donm[]" value="3" >
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
    <td class="TitleL">VER REGISTRO DE ROLES Y MODIFICACIONES</td>
        @if ($permisos->roles==1) 
        <td class="TitleP"  value={{4}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{4}}" checked type="checkbox" name="donm[]" value="4" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP"  value={{4}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{4}}"  type="checkbox" name="donm[]" value="4" >
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
    <td class="TitleL">VER REGISTRO DE GASTOS Y MODIFICACIONES</td>
        @if ($permisos->gastos==1) 
        <td class="TitleP" value={{5}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{5}}" checked type="checkbox" name="donm[]" value="5" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{5}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{5}}"  type="checkbox" name="donm[]" value="5" >
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
    <td class="TitleL">VER REGISTRO DE GASTOS Y MODIFICACIONES</td>
        @if ($permisos->asignaciones==1) 
        <td class="TitleP" value={{6}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{6}}" checked type="checkbox" name="donm[]" value="6" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{6}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{6}}"  type="checkbox" name="donm[]" value="6" >
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
    <td class="TitleL">VER REGISTRO DE PERFILES DE NOMINAS Y MODIFICACIONES</td>
        @if ($permisos->perfiles==1) 
        <td class="TitleP" value={{8}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  id="modulo{{8}}" checked type="checkbox" name="donm[]" value="8" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{8}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  id="modulo{{8}}" type="checkbox" name="donm[]" value="8" >
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
    <td class="TitleL">VER REGISTRO DE FORMA DE PAGO Y MODIFICACIONES</td>
        @if ($permisos->formas_pagos==1) 
        <td class="TitleP" value={{9}} >
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{9}}" checked type="checkbox" name="donm[]" value="9" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{9}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{9}}"  type="checkbox" name="donm[]" value="9" >
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
    <td class="TitleL">VER REGISTRO DE PERFILES DE USUARIOS Y MODIFICACIONES</td>
        @if ($permisos->perfilesuser==1) 
        <td class="TitleP" value={{10}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{10}}" checked type="checkbox" name="donm[]" value="10" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{10}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{10}}"  type="checkbox" name="donm[]" value="10" >
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
    <td class="TitleL">	
        VER REGISTRO DE NOMINAS Y MODIFICACIONES</td>
        @if ($permisos->nomina==1) 
        <td class="TitleP"  value={{11}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{11}}" checked type="checkbox" name="donm[]" value="11" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{11}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{11}}" type="checkbox" name="donm[]" value="11" >
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
    <td class="TitleL">	
        VER REGISTRO DE ASISTENCIA</td>
        @if ($permisos->asistencia==1) 
        <td class="TitleP"  value={{12}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{12}}" checked type="checkbox" name="donm[]" value="12" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP"  value={{12}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{12}}" type="checkbox" name="donm[]" value="12" >
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
    <td class="TitleL">	
        CONFIGURACION DE LA EMPRESA</td>
        @if ($permisos->empresa==1) 
        <td class="TitleP" value={{13}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{13}}" checked type="checkbox" name="donm[]" value="13" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{13}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{13}}" type="checkbox" name="donm[]" value="13" >
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
    <td class="TitleL">	
        REGISTRO Y MODIFICACIONES DE GRUPOS</td>
        @if ($permisos->empresa==1) 
        <td class="TitleP"  value={{14}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{14}}" checked type="checkbox" name="donm[]" value="14" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{14}}>
            <div class="form-check checkaling">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="modulo{{14}}" type="checkbox" name="donm[]" value="14" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
