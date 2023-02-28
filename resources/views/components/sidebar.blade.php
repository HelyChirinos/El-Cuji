<div class="sidebar-wrapper " data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">El Cuji</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    
    <ul class="metismenu" id="menu">
        {{--              Administración                 --}}
      @if ( Auth::user()->rol_id == 0)  
        <li class="menu-label">Administración</li>
        <li>
            <a href="{{route('admin')}}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{route('owner')}}">
                <div class="parent-icon"><i class='bx bx-user-circle'></i>
                </div>
                <div class="menu-title">Propietarios</div>
            </a>
        </li> 
        <li>
            <a href="{{route('facturas')}}">
                <div class="parent-icon"><i class="fa-light fa-money-check-dollar-pen"></i>
                </div>
                <div class="menu-title">Facturas</div>
            </a>
        </li>                  
        <li>
            <a href="{{route('gastos')}}">
                <div class="parent-icon"><i class='bx bx-donate-blood'></i>
                </div>
                <div class="menu-title">Gastos</div>
            </a>
        </li> 
        <li>
            <a href="{{route('fondos')}}">
                <div class="parent-icon"><i class="fa-light fa-sack"></i>
                </div>
                <div class="menu-title">Fondos</div>
            </a>
        </li>
        <li>
            <a href="{{route('pagos')}}">
                <div class="parent-icon"><i class="fa-regular fa-hand-holding-dollar"></i>
                </div>
                <div class="menu-title">Pagos</div>
            </a>
        </li>
     @endif                
     @if ( Auth::user()->rol_id == 1)
        {{--              RSIDENTES                   --}}
        <li class="menu-label">Residentes</li>
        <li>
            @if (session()->has('casa_no'))
                <a href="{{route('casa',session('casa_no'))}}">
                    <div class="parent-icon"><i class='bx bx-home'></i>
                    </div>
                    <div class="menu-title">Saldo</div>
                </a>                
            @else
                <a href="#">
                    <div class="parent-icon"><i class='bx bx-home'></i>
                    </div>
                    <div class="menu-title">Saldo</div>
                </a>
                    
            @endif
        </li>        
        <li>
            <a href="{{route('residentes')}}">
                <div class="parent-icon"><i class="fa-regular fa-family"></i>
                </div>
                <div class="menu-title">Habitantes</div>
            </a>
        </li>     
        <li>
            <a href="{{route('vehiculos')}}">
                <div class="parent-icon"><i class="fa-regular fa-car-side"></i>
                </div>
                <div class="menu-title">Vehiculos</div>
            </a>
        </li>
        <li>
            <a href="user-prle.html">
                <div class="parent-icon"><i class="fa-regular fa-dog-leashed"></i>
                </div>
                <div class="menu-title">Mascotas</div>
            </a>
        </li>
        <li>
            <a href="user-prle.html">
                <div class="parent-icon"><i class="fa-regular fa-scale-balanced"></i>
                </div>
                <div class="menu-title">Reglamentos</div>
            </a>
        </li>        
        <li>
            <a href="user-per.html">
                <div class="parent-icon"><i class="fa-regular fa-map"></i>
                </div>
                <div class="menu-title">Planos</div>
            </a>
        </li> 
              

     @endif   
    </ul>
    <!--end navigation-->
</div>