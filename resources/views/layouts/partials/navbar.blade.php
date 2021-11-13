
<header>
    <div class="jumbotron jumbotron-fluid">
        <div class="parallax text-center" style="background-image: url({{asset('img/1.jpg')}});">
            <div class="parallax-pattern-overlay">
                <div class="container text-center" style="height:600px;padding-top:170px;">
                    <a href="#"><img id="site-title" class=" wow fadeInDown" wow-data-delay="0.0s" wow-data-duration="0.9s" src="img/2.png" alt=""/></a>
                    <h2 class="intro"><a href="index.html"></a></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="nav navbar-nav">
                            <li class=" nav-item nav-link  menuItem active"><a href="#wrapper">INICIO</a></li>
                            <li class=" nav-item nav-link  menuItem"><a href="#abodutus">NOSOTROS</a></li>
                            <li class=" nav-item nav-link  menuItem"><a href="#specialties">SERVICIOS</a></li>
                            <li class=" nav-item nav-link  menuItem"><a href="#gallery">PRODUCTOS</a></li>
                            <li class=" nav-item nav-link  menuItem"><a href="#contact">CONTACTOS</a></li>
                            <li class=" nav-item nav-link  menuItem"><a href="{{route('calendar')}}"> CITAS </a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
