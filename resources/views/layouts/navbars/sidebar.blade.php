<div class="sidebar sidebar-dark" style="top: -66px; width: 258px; overflow-y: auto;">
    <div class="sidebar-wrapper">
        <div class="logo">
            {{-- <a href="{{ route('home') }}" class="simple-text logo-mini">{{ __('RH') }}</a> --}}
            {{-- <a href="{{ route('home') }}" class="simple-text logo-normal" style="text-align: center">{{ __('LABORAL') }}</a> --}}
        </div>
        @php
            $user=Auth::user()->id;
            $empresa=Auth::user()->id_empresa;
            $permiso=App\Models\Permisos::where('id_empresa','=', $empresa)->get();
            // dd($permiso);
            $role=App\Models\Role_users::select('role_id')->where('user_id','=',$user)->first();
            $b=0;
            // dd($role->role_id);
        @endphp

        @foreach ($permiso as $permisos)
        @if ($b!=1)
        @if ($permisos->role_id==$role->role_id)
        <ul class="nav">
            @php
                $b=1;
            @endphp
        
            <li @if ($pageSlug == 'dashboard') class="active  " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Inicio') }}</p>
                </a>
            </li>                 
            
            @if ($permisos->empleado==1)
            <li >
                <a href="{{ url('Empleados') }}">
                    <i class="fas fa-users"></i>
                    <p>{{ __('Empleados') }}</p>
                </a>
            </li>
            @endif

            @if ($permisos->asignaciones==1)
            <li>
                <a href="{{ url('Asignaciones') }}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{ __('Asignaciones') }}</p>
                </a>
            </li>
            @endif



            {{-- @if ($permisos->roles==1)
            <li @if ($pageSlug == 'notifications') class="active " @endif>
                <a href="{{ url('Roles') }}">
                    <i class="fas fa-user-plus"></i>
                    <p>{{ __('Roles') }}</p>
                </a>
            </li>
            @endif --}}

            @if ($permisos->gastos==1)
            <li @if ($pageSlug == 'tables') class="active " @endif>
                <a href="{{ url('Gasto') }}">
                    <i class="tim-icons icon-money-coins"></i>
                    <p>{{ __('Gastos') }}</p>
                </a>
            </li>
            @endif



            {{-- @if ($permisos->perfiles==1)
            <li  >
                <a href="{{ url('Perfiles')  }}" class="nav-link  {{request()->Is('Perfiles') ? 'active' : ''}}" >
                    <i class="tim-icons icon-single-copy-04"></i>
                    <p>{{ __('Perfiles de nomina') }}</p>
                </a>
            </li>
            @endif --}}

            @if ($permisos->nomina==1)
            <li >
                <a href="{{ url('Listado')  }}" >
                    <i class="fas fa-file-invoice-dollar"></i>
                    <p>{{ __('nominas') }}</p>
                </a>
            </li>
            @endif
            
            {{-- <li>
                <a href="{{url('Cooperativas')}}">
                    <i class="fas fa-users"></i>
                    <p>{{ __('Cooperativas') }}</p>
                </a>
            </li> --}}

            @if ($permisos->asistencia==1)
            <li>
                <a href="{{url('Asistencia')}}">
                    <i class="fas fa-users"></i>
                    <p>{{ __('Asistencia') }}</p>
                </a>
            </li>
            @endif



        
            @if ($permisos->departamento==1||$permisos->formas_pagos==1||$permisos->empresa==1 || $permisos->usuario==1)
            <li>
                <a data-toggle="collapse" href="#Confi" aria-expanded="true">
                    <i class="fa fa-cog fa-2x"> </i>
                    <span class="nav-link-text" >{{ __('Configuracion') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                
                
                <div class="collapse show" id="Confi">
                    <ul class="nav pl-4">
                        @if ($permisos->empresa==1)
                        <li >
                            <a href="{{ url('Empresa')  }}" >
                                <i class="tim-icons icon-single-copy-04"></i>
                                <p>{{ __('Empresa') }}</p>
                            </a>
                        </li>
                        @endif
                        @if ($permisos->departamento==1)
                        <li>
                            <a href="{{ url('Puesto')  }}"  >
                                <i class="tim-icons icon-paper"></i>
                                <p>{{ __('Departamentos') }}</p>
                            </a>
                        </li>
                        @endif
                        @if ($permisos->formas_pagos==1)
                        <li>
                            <a href="{{ url('Pagos')  }}"  >
                                <i class="tim-icons icon-money-coins"></i>
                                <p>{{ __('Formas de Pagos') }}</p>
                            </a>
                        </li>
                        @endif

                        @if ($permisos->usuario==1)
                        <li>
                            <a href="{{ url('user') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('Usuarios') }}</p>
                            </a>
                        </li>
                        @endif

                        @if ($permisos->perfilesuser==1)
                        <li>
                            <a href="{{url('PerfilesUsuario')}}">
                                <i class="fas fa-users-cog"></i>
                                <p>{{ __('Perfiles Usuarios') }}</p>
                            </a>
                        </li>
                        @endif

                        @if ($permisos->categorias==1)
                        <li>
                            <a href="{{url('Categorias')}}">
                                <i class="fas fa-coins"></i>
                                <p>{{ __('Categorias') }}</p>
                            </a>
                        </li>
                        @endif
                        
                    </ul>
                </div>
            </li>
            @endif
            
        </ul>
        @endif
        @endif
        @endforeach
    </div>
</div>
