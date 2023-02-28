<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('assets/images/elcuji.png')}}" type="image/png" />
    <title>El Cují - Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Pacifico&display=swap" rel="stylesheet">   
    
    <link href="{{asset('assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
  </head>
  <body>

    <section class="login py-4 bg-light">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-5">
                    <img src="{{asset('assets/images/login-images/luna3.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-7 text-center py-3">
                  
                  <h3>Bienvenidos al</h3>
                  <h1>EL Cují</h1>
                  <h3>Conjunto Residencial</h3>
                  <p class="mens1">Sistema exclusivo para propietarios y residentes del Conjunto Residencial</p>
                  <div class="px-5">
                      <x-jet-validation-errors/>
                  </div> 
                  <form method="POST" action="{{ route('login') }}" >
                      @csrf
                      <div class="form-row py-2">
                        <div class=" offset-1 col-lg-10">
                          <i class="fa-regular fa-envelope icon"></i>
                          <input type="email" class="input-field" name="email" placeholder="ejemplo@correo.com" value="{{old('email')}}" required>
                        </div>
                      </div>  

                      <div class="form-row">
                        <div class=" offset-1 col-lg-10 py-3">
                          <i class="fa-regular fa-lock icon"></i>
                          <input type="password" class="input-field" name="password" placeholder="Password" required>
                        </div>
                      </div>  
                      <div class="form-row py-3">
                        <div class="d-flex">
                          <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked="">
                              <label class="form-check-label" for="form1Example3">Recuerdamé</label>
                            </div>
                          </div>
                          <div class="col">
                            <!-- Simple link -->
                            <a href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
                          </div>
                        </div>                  
                      </div>
                      <div class="form-row py-3">
                        <div class=" offset-1 col-lg-10">
                          <button class="btn1">Ingresar</button>
                        </div>
                      </div>  

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>