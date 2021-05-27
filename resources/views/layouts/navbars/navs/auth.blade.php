<nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper d-none">
            <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="#">{{ $page ?? __('Dashboard') }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
                {{-- <li class="search-bar input-group">
                    <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                        <span class="d-lg-none d-md-block">{{ __('Search') }}</span>
                    </button>
                </li> --}}

                @php
                    $user=App\Models\User::where('email','=',Auth::user()->email)->where('estado','=',0)->get();
                    $empresa=App\Models\Empresa::where('estado','=',0)->get();
                @endphp

        @if (sizeof(App\Models\User::where('email','=',Auth::user()->email)->get())>1)
    
            <form action="{{url('SearchUser')}}" method="post">
                @csrf
                <select class="custom-select" id="validationDefault04" name="selecet" >
                    @foreach ($empresa as $empresas)
                    @foreach ($user as $users)

                    @if ($users->id_empresa==$empresas->id)
                    @if ($empresas->id==Auth::user()->id_empresa)
                    <option selected  value="{{$empresas->id}}">{{$empresas->nombre}}</option>
                    @else
                    <option   value="{{$empresas->id}}">{{$empresas->nombre}}</option>
                    @endif

                    @endif

                    @endforeach
                    @endforeach
                </select>
                <button type="submit" id="btnsubmit" hidden></button>
            </form>

            @endif

                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <div class="notification d-none d-lg-block d-xl-block"></div>
                        <i class="fas fa-bell"></i>
                        <p class="d-lg-none"> {{ __('Notificaciónes') }} </p>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                    </ul>
                </li>
                <li class="dropdown nav-item">

                    @php
                        $user=Auth::user();
                    @endphp
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        @if (!empty($user->imagen))
                        <div class="photo">
                            <img src="{{ asset('img/'.$user->imagen)}}" alt="{{ __('Profile Photo') }}">
                        </div>    
                    
                        @else
                        <div class="photo">
                            <img src="{{ asset('black') }}/img/default-user-image.png" alt="{{ __('Profile Photo') }}">
                        </div>   
                        @endif

                        <b class="caret d-none d-lg-block d-xl-block"></b>
                        <p class="d-lg-none">{{ __('Cerrar Sesión') }}</p>
                    </a>
                    <ul class="dropdown-menu dropdown-navbar">
                        <li class="nav-link">
                            <a href="{{ route('user.show',$user->id) }}" class="nav-item dropdown-item">{{ __('Perfil') }}</a>
                        </li>
                        <li class="nav-link">
                            <a href="{{url('empresa')}}" class="nav-item dropdown-item">{{ __('Configuraciones') }}</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="nav-link">
                            <a href="{{ route('logout') }}" class="nav-item dropdown-item" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">{{ __('Cerrar Sesión') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="separator d-lg-none"></li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('SEARCH') }}">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('black') }}/js/core/jquery.min.js"></script>


<script>
    $("#validationDefault04").on('change',function(){
        $("#btnsubmit").trigger("click");
    })
</script>
