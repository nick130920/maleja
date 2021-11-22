<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm inicial-bottom sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCerrarse"
            aria-controls="navbarCerrarse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCerrarse">
            <a class="navbar-brand" href="{{ url('/') }}" style="margin-left: 15vw">
                {{ config('app.name', 'Inicio') }}
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="inicio" href="#wrapper">Inicio</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" aria-current="calendar" href="{{ url('/calendar') }}">Calendario</a>
                </li>
               
                 @if( Auth::check() && Auth::user()->rol == "admin")
                <li class="nav-item">
                    <a class="nav-link" aria-current="services" href="{{ url('/services') }}">Servicios</a>
                </li>
                 @else
                @endif
                <li class="nav-item">
                    <a class="nav-link" aria-current="contact" href="#contact">Contacto</a>
                </li>
            </ul>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                    @endif
                @else
                    <ul class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </ul>
                @endguest
            </ul>
        </div>
        {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
        </div> --}}
    </div>
</nav>
{{-- <div class="menu">
    <div class="navbar-wrapper">
        <div class="container">
        <div class="navwrapper">
            <div class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navArea">
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                    <li class="menuItem active"><a href="#wrapper">INICIO</a></li>
                    <li class="menuItem"><a href="#abodutus">NOSOTROS</a></li>
                    <li class="menuItem"><a href="#specialties">SERVICIOS</a></li>
                    <li class="menuItem"><a href="#gallery">PRODUCTOS</a></li>
                    <li class="menuItem"><a href="#contact">CONTACTOS</a></li>
                    <li class="menuItem"><a href="{{route('calendar')}}"> CITAS </a></li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div> --}}
