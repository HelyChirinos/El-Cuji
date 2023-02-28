<div>
    <div class="page-breadcrumb d-none d-sm-flex  justify-content-center mb-3">
        <div class="page-title pe-3">Vehiculos Casa No. {{session('casa_no')}}</div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between bd-highlight mb-4 gap-3">
                <div class="p-2  bd-highlight" >
                    <span class="float-start">
                        <p class="d-inline">mostrar</p>
                        <select wire:model='paginator' class="d-inline">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <p class="d-inline text-sm ">registros</p>
                    </span>    
                </div>
                <div class="p-2  bd-highlight" style="width: 50%">
                    <div class="position-relative">
                        <input type="text" wire:model='search' class="form-control ps-5 " placeholder="Buscar"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                    </div>                    
                </div>
                <div class="p-2  bd-highlight">
                    <button type="button" class=" float-end btn btn-primary px-3"  data-bs-toggle="modal"  data-bs-target="#addVehiculo">Agregar</button>
                    {{-- <a href="javascript:;" class=" float-end btn btn-primary  mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Nuevo</a> --}}
                </div>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Foto</th>
                            <th>Clase</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Placa</th>
                            <th>Año</th>
                            <th>Color</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($vehiculos->count())
                            @foreach ($vehiculos as $item)
                                <tr>
                                    <td>
                                        @php
                                            if ($item->vehiculo_path) {
                                                 $image = $item->vehiculo_path;
                                            } else {
                                                $image = 'assets/images/no-vehiculo.jpeg';
                                            }    
                                        @endphp
                                        <img src="{{asset('storage/'.$image)}}" alt="" width="40px" wire:click.prevent = 'show({{$item->id}})'>
                                    </td>
                                    <td>
                                        {{$item->clase}}
                                    </td>
                                    <td>
                                        {{$item->marca}}
                                    </td>
                                    <td> {{ $item->modelo }} </td>
                                    <td> {{ $item->placa }} </td>
                                    <td> 
                                        {{ $item->ano }}
                                    </td>
                                    <td> {{$item->color}} </td> 
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a wire:click.prevent = 'edit({{$item->id}})' href="javascript:;" class=""><i class='bx bxs-edit text-primary '></i></a>
                                            <a wire:click.prevent = 'showDelete({{$item->id}})' href="javascript:;" class="ms-3"><i class='bx bxs-trash text-danger'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach                           
                        @else
                            <tr>
                                <td colspan="7">
                                    <div class="px-6 py-4 text-sm text-red-500 text-bold text-center" >
                                        No Hay información en la Base de Datos
                                    </div>
                                </td>
                            </tr>                            
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-3 float-end">
                {{ $vehiculos->links() }} 
            </div>
        </div>
    </div>



    <div wire:ignore.self class="modal fade " id="addVehiculo"  aria-labelledby="addVehiculo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Agregar Vehiculo</h5>
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close" wire:click = 'clearVar()'></button>
                                </div>    
                            </div>
                            <hr>
                            <form wire:submit.prevent="save" class="row g-3" enctype="multipart/form-data">
                                <div class="row g-0">

                                    <div class="col-xl-12">
                                        <div class="card" style="margin-bottom: 0px">
                                            <div class="card-header">Datos del Vehiculo</div>
                                            <div class="card-body">
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1  is_required" for="inputClase">Clase</label>
                                                        <select class="form-select" wire:model.defer="clase" required>
                                                            <option value="" selected disabled hidden >seleccione Clase</option>
                                                            <option value="Motocicleta">Motocicleta</option>
                                                            <option value="Automóvil">Automóvil</option>
                                                            <option value="Campero">Campero</option>
                                                            <option value="Camioneta">Camioneta</option>
                                                            <option value="Cava-Camión">Cava-Camión</option>
                                                            <option value="Otro">Otro</option>
                                                            
                                                          </select>
                                                        @error('clase')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror    
                                                    </div>
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputPlacas">Placas</label>
                                                        <input class="form-control" id="inputPlaca" type="text"wire:model.defer="input.placa"
                                                        >
                                                        @error('placa')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror    
                                                    </div>
                                                </div>
                    
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputMarca">Marca</label>
                                                        <input class="form-control" id="inputMarca" type="text" wire:model.defer="input.marca"
                                                        >
                                                        @error('marca')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputModelo">Modelo</label>
                                                        <input class="form-control" id="inputModelo" type="text" wire:model.defer="input.modelo"
                                                        >
                                                        @error('modelo')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>    
                                                </div>
                    
                                                <div class="row gx-3 mb-3">
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputAno">Año</label>
                                                        <input class="form-control" id="inputAno" type="tel" wire:model.defer="input.ano"
                                                       >
                                                        @error('ano')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputColor">Color</label>
                                                        <input class="form-control" id="inputColor" type="text" wire:model.defer="input.color"
                                                       >
                                                        @error('color')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-sm-6 mt-1">      
                                                        (<small class="small mb-1 is_required" style="color: red"></small> <small>) Campos Obligatorios </small> 
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-header">Foto del Vehiculo</div>
                                            <div class="card-body text-center">
                                                <div class="small font-italic text-muted mt-1">JPG o PNG no mayor de 1 MB</div>
                                                <div class="pt-2 pb-2">
                                                    <i class="fa-regular fa-hand-point-down" style="font-s
                                                    20px;"></i>
                                                    Click en Imagén
                                                </div>    
                                                @if ($foto)
                                                    <img id="preview" class="img-vehiculo mb-2 mt-2"
                                                    src="{{ $foto->temporaryUrl() }}" alt="Vehiculo" onclick="$('#foto').click()">
                                                @else
                                                    <img id="preview" class="img-account-profile mb-2 mt-2"
                                                    src="{{asset('assets/images/no-vehiculo.jpeg')}}" alt="Sin Foto" onclick="$('#foto').click()">
                                                @endif
                                            

                                                <input type="file" hidden id="foto" wire:model.defer="foto" accept="image/png, image/gif, image/jpeg" />

                                                @error('foto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <div class="row gx-5 mt-4" >
                                                    <div class="col-sm-12">   
                                                        <div class="text-center"> 
                                                            <button class="btn btn-primary float-end" type="submit" style="width:100%">Guardar Información</button>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade " id="updateVehiculo"  aria-labelledby="updateVehiculo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Actualizar Datos del Vehiculo</h5>
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close" wire:click = 'clearVar()'></button>
                                </div>    
                            </div>
                            <hr>
                            <form wire:submit.prevent="update" class="row g-3" enctype="multipart/form-data">
                                <div class="row g-0">

                                    <div class="col-xl-12">
                                        <div class="card" style="margin-bottom: 0px">
                                            <div class="card-header">Datos del Vehiculo</div>
                                            <div class="card-body">
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1  is_required" for="inputClase">Clase</label>
                                                        <select class="form-select" wire:model.defer="clase" required>
                                                            <option value="" selected disabled hidden >seleccione Clase</option>
                                                            <option value="Motocicleta">Motocicleta</option>
                                                            <option value="Automóvil">Automóvil</option>
                                                            <option value="Campero">Campero</option>
                                                            <option value="Camioneta">Camioneta</option>
                                                            <option value="Cava-Camión">Cava-Camión</option>
                                                            <option value="Otro">Otro</option>
                                                            
                                                          </select>
                                                        @error('clase')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror    
                                                    </div>
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputPlacas">Placas</label>
                                                        <input class="form-control" id="inputPlaca" type="text"wire:model.defer="input.placa"
                                                        >
                                                        @error('placa')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror    
                                                    </div>
                                                </div>
                    
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputMarca">Marca</label>
                                                        <input class="form-control" id="inputMarca" type="text" wire:model.defer="input.marca"
                                                        >
                                                        @error('marca')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputModelo">Modelo</label>
                                                        <input class="form-control" id="inputModelo" type="text" wire:model.defer="input.modelo"
                                                        >
                                                        @error('modelo')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>    
                                                </div>
                    
                                                <div class="row gx-3 mb-3">
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputAno">Año</label>
                                                        <input class="form-control" id="inputAno" type="tel" wire:model.defer="input.ano"
                                                       >
                                                        @error('ano')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputColor">Color</label>
                                                        <input class="form-control" id="inputColor" type="text" wire:model.defer="input.color"
                                                       >
                                                        @error('color')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-sm-6 mt-1">      
                                                        (<small class="small mb-1 is_required" style="color: red"></small> <small>) Campos Obligatorios </small> 
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-header">Foto del Vehiculo</div>
                                            <div class="card-body text-center">
                                                <div class="small font-italic text-muted mt-1">JPG o PNG no mayor de 1 MB</div>
                                                <div class="pt-2 pb-2">
                                                    <i class="fa-regular fa-hand-point-down" style="font-s
                                                    20px;"></i>
                                                    Click en Imagén
                                                </div>    
                                                @if ($foto)
                                                    <img id="preview" class="img-vehiculo mb-2 mt-2"
                                                    src="{{ $foto->temporaryUrl() }}" alt="Vehiculo" onclick="$('#foto').click()">
                                                @else
                                                    <img id="preview" class="img-account-profile mb-2 mt-2"
                                                    src="{{asset($init_foto)}}" alt="Sin Foto" onclick="$('#foto').click()">
                                                @endif
                                            

                                                <input type="file" hidden id="foto" wire:model.defer="foto" accept="image/png, image/gif, image/jpeg" />

                                                @error('foto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <div class="row gx-5 mt-4" >
                                                    <div class="col-sm-12">   
                                                        <div class="text-center"> 
                                                            <button class="btn btn-primary float-end" type="submit" style="width:100%">Guardar Información</button>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade " id="showVehiculo"  aria-labelledby="showVehiculo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary" style="margin-bottom: 0px;">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
    
                            </div>
                            <hr>
                            <div class="row g-0">
                                <div class="col-xl-12">
                                    <div class="card" style="margin-bottom: 0px">
                                        <div class="card-header">Foto del Vehiculo
                                            <div class="float-end">
                                                <button type="button" class="btn-close btn-close-white float-end"  data-bs-dismiss="modal" aria-label="Close" wire:click = 'clearVar()'></button>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div>
                                                <img id="preview" class="img-vehiculo mb-2 mt-2"
                                                src="{{asset($init_foto)}}" alt="" style="max-height: 15rem; width: auto;">
                                            </div>    
                                        </div>
                                    </div>
                                </div>       
                                <div class="col-xl-12">
                                    <div class="card"  style="margin-bottom: 0px;">
                                        <div class="card-header">Datos del Vehiculo</div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Clase</th>
                                                            <th>Marca</th>
                                                            <th>Modelo</th>
                                                            <th>Placa</th>
                                                            <th>Año</th>
                                                            <th>Color</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <td>
                                                            {{$clase}}
                                                        </td>
                                                        <td>
                                                            {{$marca}}
                                                        </td>
                                                        <td> {{ $modelo }} </td>
                                                        <td> {{ $placa }} </td>
                                                        <td> 
                                                            {{ $ano }}
                                                        </td>
                                                        <td> {{$color}} </td>                                                         
                                                    </tbody>
                                                </table>
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                             
                            </div>                                
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade " id="deleteVehiculo"  aria-labelledby="deleteVehiculo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary" style="margin-bottom: 0px;">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
    
                            </div>
                            <hr>
                            <div class="row g-0">
                                <div class="col-xl-12">
                                    <div class="card" style="margin-bottom: 0px">
                                        <div class="card-header">Foto del Vehiculo
                                            <div class="float-end">
                                                <button type="button" class="btn-close btn-close-white float-end"  data-bs-dismiss="modal" aria-label="Close" wire:click = 'clearVar()'></button>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div>
                                                <img id="preview" class="img-vehiculo mb-2 mt-2"
                                                src="{{asset($init_foto)}}" alt="" style="max-height: 15rem; width: auto;">
                                            </div>
                                            <div class="row my-3">
                                                <div>
                                                    <h4 class="text-center" style="color:red;">
                                                    Seguro de Eliminar?
                                                    </h4>
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <button wire:click.prevent = 'delete()' class="btn btn-danger me-md-2" type="button">Si</button>
                                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal" aria-label="Close">No</button>
                                                </div>
                                            </div>        
                                        </div>
                                    </div>
                                </div>                                
                            </div>                                
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>



    @push('styles')
        <style type="text/css">
        
            .img-account-profile {
                height: 10rem;
            }

            .rounded-circle {
                border-radius: 50% !important;
            }

            .card {
                box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
            }

            .card .card-header {
                font-weight: 500;
            }

            .card-header:first-child {
                /* border-radius: 0.35rem 0.35rem 0 0; */
                border-radius: 0 0 0 0;
            }

            .card-header {
                padding: 1rem 1.35rem;
                margin-bottom: 0;
                background-color:#274D8F;
                color: white;
                border-bottom: 1px solid rgba(33, 40, 50, 0.125);
            }

            .form-control,
            .dataTable-input {
                display: block;
                width: 100%;
                padding: 0.875rem 1.125rem;
                font-size: 0.875rem;
                font-weight: 400;
                line-height: 1;
                color: #69707a;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #c5ccd6;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                border-radius: 0.35rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .nav-borders .nav-link.active {
                color: #0061f2;
                border-bottom-color: #0061f2;
            }

            .nav-borders .nav-link {
                color: #69707a;
                border-bottom-width: 0.125rem;
                border-bottom-style: solid;
                border-bottom-color: transparent;
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                padding-left: 0;
                padding-right: 0;
                margin-left: 1rem;
                margin-right: 1rem;
            }
            select:invalid{
                color: gray;
                font-size: 14px;
            }
            option{
                color: #69707a;
            }

            .img-vehiculo{
                width: 30rem;
            }
                    
        </style>

    @endpush

    @push('scripts')


        <script>
            window.addEventListener('close-modal', event =>{
                $('#addVehiculo').modal('hide');
            });
            window.addEventListener('open-edit-modal', event =>{
                $('#updateVehiculo').modal('show');
            });
            window.addEventListener('close-modal-update', event =>{
                $('#updateVehiculo').modal('hide');
            });
            window.addEventListener('open-show-modal', event =>{
                $('#showVehiculo').modal('show');
            });
            window.addEventListener('open-delete-modal', event =>{
                $('#deleteVehiculo').modal('show');
            });
            window.addEventListener('close-delete-modal', event =>{
                $('#deleteVehiculo').modal('hide');
            });

            var updateModalEl = document.getElementById('updateVehiculo');
            var addModalEl = document.getElementById('addVehiculo');
            updateModalEl.addEventListener('hidden.bs.modal', function (event) {
                Livewire.emit('clearVar');
            })
            addModalEl.addEventListener('hidden.bs.modal', function (event) {
                Livewire.emit('clearVar');
            })            
                                                   
        </script>
    @endpush



</div>
