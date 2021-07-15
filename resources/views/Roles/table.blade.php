<tr>
    <td >TOTAL EMPLEADOS</td>
    <td class="TitleL">VISUALIZACION DE DATOS DE EMPLEADOS</td>

        @if ($permisos_widget->total_empleado==1) 
        <td class="TitleP" value={{1}}>
            <div class="form-check checks">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" checked type="checkbox" id="widgdt{{1}}" name="wingdt[]" value="1" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{1}}>
            <div class="form-check checks">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{1}}"  type="checkbox" name="wingdt[]" value="1" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >TOTAL USUARIOS</td>
    <td class="TitleL">VISUALIZACION DE DATOS DE USUARIOS</td>

        @if ($permisos_widget->total_usuarios==1) 
        <td class="TitleP" value={{2}}>
            <div class="form-check checks">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{2}}" checked type="checkbox" name="wingdt[]" value="2" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{2}}>
            <div class="form-check checks">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{2}}" type="checkbox" name="wingdt[]" value="2" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >TOTAL DEPARTAMENTOS</td>
    <td class="TitleL">VISUALIZACION DE DATOS DE DEPARTAMENTOS</td>
        @if ($permisos_widget->total_departamentos==1) 
        <td class="TitleP" value={{3}}>
            <div class="form-check checks">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{3}}" checked type="checkbox" name="wingdt[]" value="3" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{3}}>
            <div class="form-check checks">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{3}}"  type="checkbox" name="wingdt[]" value="3" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >FORMAS DE PAGOS</td>
    <td class="TitleL">VISUALIZACION DE DATOS DE FORMAS DE PAGOS</td>
        @if ($permisos_widget->formas_pago==1) 
        <td class="TitleP" value={{4}}>
            <div class="form-check checks">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{4}}" checked type="checkbox" name="wingdt[]" value="4" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{4}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  id="widgdt{{4}}"  type="checkbox" name="wingdt[]" value="4" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >TOTAL ROLES</td>
    <td class="TitleL">VISUALIZACION DE DATOS DE ROLES</td>
        @if ($permisos_widget->totales_roles==1) 
        <td class="TitleP" value={{5}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  id="widgdt{{5}}" checked type="checkbox" name="wingdt[]" value="5" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{5}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput"  id="widgdt{{5}}" type="checkbox" name="wingdt[]" value="5" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >REUNIONES PENDIENTE</td>
    <td class="TitleL">VISUALIZACION DE DATOS DE REUNIONES</td>
        @if ($permisos_widget->reuniones==1) 
        <td class="TitleP" value={{6}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{6}}" checked type="checkbox" name="wingdt[]" value="6" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{6}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{6}}" type="checkbox" name="wingdt[]" value="6" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >EMPLEADOS</td>
    <td class="TitleL">GRAFICO DE EMPLEADOS</td>
        @if ($permisos_widget->w_empleados==1) 
        <td class="TitleP" value={{7}}>
            <div class="form-check"  >
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{7}}"  checked type="checkbox" name="wingdt[]" value="7" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleL" value={{7}}>
            <div class="form-check" >
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{7}}"  type="checkbox" name="wingdt[]" value="7" >
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
    <td class="TitleL">GRAFICO DE DEPARTAMENTOS</td>
        @if ($permisos_widget->w_departamentos==1) 
        <td class="TitleP" value={{8}}>
            <div class="form-check" >
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{8}}" checked type="checkbox" name="wingdt[]" value="8" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{8}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{8}}"  type="checkbox" name="wingdt[]" value="8" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >GENEROS</td>
    <td class="TitleL">GRAFICO DE GENEROS</td>
        @if ($permisos_widget->w_generos==1) 
        <td class="TitleP" value={{9}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{9}}" checked type="checkbox" name="wingdt[]" value="9" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{9}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{9}}" type="checkbox" name="wingdt[]" value="9" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >GASTOS DE LA EMPRESA</td>
    <td class="TitleL">GRAFICO DE GASTO DE EMPRESA</td>
        @if ($permisos_widget->g_gasto==1) 
        <td class="TitleP" value={{10}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{10}}" checked type="checkbox" name="wingdt[]" value="10" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{10}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{10}}"  type="checkbox" name="wingdt[]" value="10" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >HISTORIAL DE EMPLEADOS</td>
    <td class="TitleL">VISUALIZACION DE HISTORIAL DE LOS EMPLEADOS</td>
        @if ($permisos_widget->historial==1) 
        <td class="TitleP" value={{11}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{11}}" checked type="checkbox" name="wingdt[]" value="11" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{11}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{11}}"  type="checkbox" name="wingdt[]" value="11" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>
<tr>
    <td >CALENDARIO</td>
    <td class="TitleL">VISUALIZACION DE CALENDARIO</td>
        @if ($permisos_widget->calendario==1) 
        <td class="TitleP" value={{12}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{12}}" checked type="checkbox" name="wingdt[]" value="12" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @else 
        <td class="TitleP" value={{12}}>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input cheinput" id="widgdt{{12}}" type="checkbox" name="wingdt[]" value="12" >
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </td>
        @endif
</tr>