<nav class="navbar sticky-top navbar-dark bg-dark navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Inicio') }}
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               
                <li class="nav-item">
                    <a class="nav-link" aria-current="calendar" href="{{ url('/calendar') }}">Calendario</a>
                  </li>
                   @if( Auth::check() && Auth::user()->rol == "admin")
                <li class="nav-item">
                  <a class="nav-link active" aria-current="services" href="{{ url('/services') }}">Servicios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="productos" href="{{ url('/producto') }}">Productos</a>
                </li>
                 @else
                @endif
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <div class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    @else
                        <ul class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            </div>
        </div>
    </div>
</nav>
