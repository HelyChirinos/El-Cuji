<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">
	    <!--favicon-->
	    <link rel="icon" href="{{asset('assets/images/elcuji.png')}}" type="image/png" />
        <title>El Cují- Conjunto Residencial</title>

        <!-- CSS FILES -->    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">                    
        <link href="{{asset('front_end/assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('front_end/assets/css/owl-carousel.css')}}" rel="stylesheet">
        <link href="{{asset('front_end/assets/css/bootstrap-icons.css')}}" rel="stylesheet">

        <link href="{{asset('front_end/assets/css/front_end.css')}}" rel="stylesheet">
        

    </head>
    
    <body>
        
        <nav class="navbar navbar-expand-lg bg-white shadow-lg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <a class="navbar-brand" href="index.html">
                    El Cují
                </a>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="/">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#el_conjunto">El Conjunto</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#ubicacion">Ubicación</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#galeria">Galería</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#contacto">Contacto</a>
                        </li>
                    </ul>
                </div>

                <div class="d-none d-lg-block">
                    <a class="nav-link"  href="{{route('login')}}">Ingresar</a>
                </div>

            </div>
        </nav>

        <main>

            <section class="hero">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-12 m-auto">
                            <div class="heroText">

                                <h4 class="text-white mb-lg-4 mb-3">Conjunto Residencial</h4>
                                <h1 class="text-white mb-lg-4 mb-3">EL Cují</h1>

                            </div>
                        </div>


                    </div>
                </div>

                <div class="video-wrap">
                    <video autoplay="" loop="" muted="" class="custom-video" poster="">
                        <source src="{{asset('front_end/assets/images/cuji1.webm')}}" type="video/mp4">
                        	Your browser does not support the video tag.
                    	</video>
                </div>

                <div class="overlay"></div>
            </section>

            <section class="menu section-padding" id="el_conjunto">
                <div class="container">
                    <div class="row">

                        <div class="col-12">
                            <h2 class="text-center mb-lg-5 mb-4">El Conjunto</h2>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="menu-thumb">
                                <div class="menu-image-wrap">
                                    <img src="{{asset('front_end/assets/images/cuji2.jpg')}}" class="img-fluid menu-image" alt="">

                                    <span class="menu-tag bg-warning">frente</span>
                                </div>

                                <div class="menu-info d-flex flex-wrap align-items-center">
                                    <h4 class="mb-0">foto</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="menu-thumb">
                                <div class="menu-image-wrap">
                                    <img src="{{asset('front_end/assets/images/cuji6.jpg')}}" class="img-fluid menu-image')}}" alt="">

                                    <span class="menu-tag bg-warning">Cancha</span>
                                </div>

                                <div class="menu-info d-flex flex-wrap align-items-center">
                                    <h4 class="mb-0">foto</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="menu-thumb">
                                <div class="menu-image-wrap">
                                    <img src="{{asset('front_end/assets/images/cuji4.jpg')}}" class="img-fluid menu-image" alt="">

                                    <span class="menu-tag bg-warning">Estacionamiento</span>
                                </div>

                                <div class="menu-info d-flex flex-wrap align-items-center">
                                    <h4 class="mb-0">foto</h4>
                              </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="menu-thumb">
                                <div class="menu-image-wrap">
                                    <img src="{{asset('front_end/assets/images/cuji5.jpg')}}" class="img-fluid menu-image" alt="">

                                    <span class="menu-tag bg-warning">casas</span>
                                </div>

                                <div class="menu-info d-flex flex-wrap align-items-center">
                                    <h4 class="mb-0">foto</h4>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="menu-thumb">
                                <div class="menu-image-wrap">
                                    <img src="{{asset('front_end/assets/images/cuji11.jpg')}}" class="img-fluid menu-image" alt="">

                                    <span class="menu-tag bg-warning">casas</span>
                                </div>

                                <div class="menu-info d-flex flex-wrap align-items-center">
                                    <h4 class="mb-0">foto</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="menu-thumb">
                                <div class="menu-image-wrap">
                                    <img src="{{asset('front_end/assets/images/cuji7.jpg')}}" class="img-fluid menu-image" alt="">

                                    <span class="menu-tag bg-warning">Parque</span>
                                </div>

                                <div class="menu-info d-flex flex-wrap align-items-center">
                                    <h4 class="mb-0">foto</h4>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="BgImage4"></section>

            <section class="map section-padding" id="ubicacion">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-center mb-lg-5 mb-4">Ubicación</h2>
                        </div>
                        <div class="col-12">
                            <h5 class="mb-4">Calle San Rafael entre Calle Palavecino y Ave. General Patiño. Cabudare. Edo. Lara</h5>

                            <div class="google-map">
                                <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=612&amp;height=400&amp;hl=en&amp;q=conjunto residencial el cuji cabudare&amp;t=k&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.gachacute.com/">Download</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style></div>                        </div>
                    </div>
                </div>
               
            </section>
            <section class="news section-padding" id="galeria">
                <div class="container">
                    <div class="row">

                        <h2 class="text-center mb-lg-5 mb-4">Galería</h2>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="news-thumb mb-4">
                                <a href="">
                                    <img src="{{asset('front_end/assets/images/cuji3.jpg')}}" class="img-fluid news-image" alt="">
                                </a>
                                
                                <div class="news-text-info news-text-info-large">
                                    <span class="category-tag bg-danger">Especial</span>

                                    <h5 class="news-title mt-2">
                                        <a href="" class="news-title-link">Texto de presentación</a>
                                    </h5>
                                </div>
                            </div> 
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="news-thumb mb-4">
                                <a href="">
                                    <img src="{{asset('front_end/assets/images/cuji11.jpg')}}" class="img-fluid news-image" alt="">
                                </a>
                                
                                <div class="news-text-info news-text-info-large">
                                    <span class="category-tag bg-danger">Especial</span>

                                    <h5 class="news-title mt-2">
                                        <a href="" class="news-title-link">Disfruta de las Comodidades</a>
                                    </h5>
                                </div>
                            </div> 
                        </div>
                        <!-- *** Owl Carousel Items ***-->
                        <div class="show-events-carousel">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="owl-show-events owl-carousel">
                                            <div class="item">
                                                <a href=""><img src="{{asset('front_end/assets/images/cuji1.jpg')}}" alt=""></a>
                                            </div>
                                            <div class="item">
                                                <a href=""><img src="{{asset('front_end/assets/images/cuji2.jpg')}}" alt=""></a> 
                                            </div>
                                            <div class="item">
                                                <a href=""><img src="{{asset('front_end/assets/images/cuji3.jpg')}}" alt=""></a> 
                                            </div>
                                            <div class="item">
                                                <a href=""><img src="{{asset('front_end/assets/images/cuji4.jpg')}}" alt=""></a> 
                                            </div>
                                            <div class="item">
                                                <a href=""><img src="{{asset('front_end/assets/images/cuji1.jpg')}}" alt=""></a> 
                                            </div>
                                            <div class="item">
                                                <a href=""><img src="{{asset('front_end/assets/images/cuji2.jpg')}}" alt=""></a> 
                                            </div>
                                            <div class="item">
                                                <a href=""><img src="{{asset('front_end/assets/images/cuji3.jpg')}}" alt=""></a> 
                                            </div>
                                            <div class="item">
                                                <a href=""><img src="{{asset('front_end/assets/images/cuji4.jpg')}}" alt=""></a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


        </main>

        <footer class="site-footer section-padding" id="contacto">
            
            <div class="container">
                
                <div class="row">

                    <div class="col-12">
                        <h4 class="text-white mb-4 me-5">Conjunto Residencial "El Cují"</h4>
                    </div>

                    <div class="col-lg-4 col-md-7 col-xs-12 tooplate-mt30">
                        <h6 class="text-white mb-lg-4 mb-3">Dirección</h6>

                        <p>Calle San Rafael entre Ave. General Patiño y Calle Palavecino.</p>

                        <a href="https://www.google.com/maps/contrib/113485550566503732764/place/ChIJjZnI4Aleh44RTbTgdGrXe_w/@10.0306948,-69.2711973,19z/data=!4m6!1m5!8m4!1e2!2s113485550566503732764!3m1!1e1?hl=es" target="_blank" class="custom-btn btn btn-dark mt-2">Mapas</a>
                    </div>

                    <div class="col-lg-4 col-md-5 col-xs-12 tooplate-mt30">
                        <h6 class="text-white mb-lg-4 mb-3">Contacto</h6>

                        <p class="mb-2">Ing. Karla Zambrano</p>

                        <p>email: karlazambrano@gmail.com</p>

                        <p>Tel: 010-02-0340</p>
                    </div>

                    <div class="col-lg-4 col-md-6 col-xs-12 tooplate-mt30">
                        <h6 class="text-white mb-lg-4 mb-3">Nuestras Redes</h6>

                        <ul class="social-icon">
                            <li><a href="#" class="social-icon-link bi-facebook"></a></li>

                            <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                            <li><a href="https://twitter.com/search?q=tooplate.com&src=typed_query&f=live" target="_blank"
                            	 class="social-icon-link bi-twitter"></a></li>

                            <li><a href="#" class="social-icon-link bi-youtube"></a></li>
                        </ul>
                    
                        <p class="copyright-text tooplate-mt60">Copyright © 2022 Conj. Res. "El Cují" Co.
                        <br>Design: <a rel="nofollow" href="" target="_blank">Ing. Hely Chirinos</a></p>
                        
                    </div>

                </div><!-- row ending -->
                
             </div><!-- container ending -->
             
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="{{asset('front_end/assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('front_end/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('front_end/assets/js/owl-carousel.js')}}"></script>

        <script src="{{asset('front_end/assets/js/custom.js')}}"></script>

    </body>
</html>
