<div>
    <div class="page-breadcrumb d-none d-sm-flex  justify-content-center mb-3">
        <div class="page-title pe-3">Residentes Casa No. {{session('casa_no')}}</div>
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
                    <button type="button" class=" float-end btn btn-primary px-3"  data-bs-toggle="modal"  data-bs-target="#addResidente">Agregar</button>
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
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Cédula</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Fecha Nac.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($residentes->count())
                            @foreach ($residentes as $item)
                                <tr>
                                    <td>
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <img class="rounded-circle" width="32" height="32" src="{{ $item->profile_photo_url }}" alt="{{ $item->name }}" wire:click.prevent = 'show({{$item->id}})' />
                                        @else
                                            <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->nombre}}
                                    </td>
                                    <td> {{ $item->apellido }} </td>
                                    <td> {{ $item->cedula }} </td>
                                    <td> 
                                        {{ $item->email }}
                                    </td>
                                    <td> {{$item->telefono}} </td> 
                                    <td> @if ($item->fecha_nac)
                                            {{ formatFecha($item->fecha_nac)}} 
                                        @endif
                                    </td>      
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
                                <td colspan="5">
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
                {{ $residentes->links() }} 
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade " id="addResidente"  aria-labelledby="addResidente" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Agregar Residente</h5>
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close" wire:click = 'clearVar()'></button>
                                </div>    
                            </div>
                            <hr>
                            <form wire:submit.prevent="save" class="row g-3" enctype="multipart/form-data">
                                <div class="row g-0">
                                    <div class="col-xl-4">
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-header">Foto de Perfil</div>
                                            <div class="card-body text-center">
                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                    @if ($foto)
                                                        <img id="preview" class="img-account-profile rounded-circle mb-2 mt-2"
                                                        src="{{ $foto->temporaryUrl() }}" alt="Sin Foto" onclick="$('#foto').click()">
                                                     @else
                                                        <img id="preview" class="img-account-profile rounded-circle mb-2 mt-2"
                                                        src="{{asset('assets/images/no-foto.png')}}" alt="Sin Foto" onclick="$('#foto').click()">
                                                     @endif
                    
                                                @endif
                                                <div class="pt-4 pb-4">
                                                    <i class="fa-regular fa-hand-point-up" style="font-s
                                                    20px;"></i>
                                                    Click en Imagén
                                                </div>                                                
                                                <div class="small font-italic text-muted mb-4 mt-3">JPG o PNG no mayor de 1 MB</div>
                                                <input type="file" hidden id="foto" wire:model.defer="foto" accept="image/png, image/gif, image/jpeg" />

                                                @error('foto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="card mb-4">
                                            <div class="card-header">Detalle de la Cuenta</div>
                                            <div class="card-body">
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1  is_required" for="inputFirstName">Nombre(s)</label>
                                                        <input class="form-control" id="inputFirstName" type="text" wire:model.defer="input.nombre" 
                                                            >
                                                        @error('nombre')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror    
                                                    </div>
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputLastName">Apellido(s)</label>
                                                        <input class="form-control" id="inputLastName" type="text"wire:model.defer="input.apellido"
                                                        >
                                                        @error('apellido')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror    
                                                    </div>
                                                </div>
                    
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputCedula">Cédula de Identidad</label>
                                                        <input class="form-control" id="inputCedula" type="text" wire:model.defer="input.cedula"
                                                        >
                                                        @error('cedula','saveUser')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputEmailAddress">Correo electrónico</label>
                                                        <input class="form-control" id="inputEmailAddress" type="email" wire:model.defer="input.email"
                                                        >
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>    
                                                </div>
                    
                                                <div class="row gx-3 mb-3">
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputPhone">Teléfono</label>
                                                        <input class="form-control" id="inputPhone" type="tel" wire:model.defer="input.telefono"
                                                       >
                                                        @error('telefono')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputBirthday">Fecha de Nacimiento</label>
                                                        <input class="form-control" id="inputBirthday" type="date" wire:model.defer="input.fecha_nac"
                                                       >
                                                        @error('fecha_nac')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>
                                                </div>
                                                <div class="row gx-5">
                                                    <div class="col-sm-6">      
                                                        (<small class="small mb-1 is_required" style="color: red"></small> <small>) Campos Obligatorios </small> 
                                                    </div>
                    
                                                    <div class="col-sm-6">      
                                                        <button class="btn btn-primary float-end" type="submit" style="width:100%">Guardar Información</button>
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

    <div wire:ignore.self class="modal fade " id="updateResidente"  aria-labelledby="updateResidente" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Actualizar Residente</h5>
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"  wire:click = 'clearVar()'></button>
                                </div>    
                            </div>
                            <hr>
                            <form wire:submit.prevent="updateUser" class="row g-3" enctype="multipart/form-data">
                                <div class="row g-0">
                                    <div class="col-xl-4">
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-header">Foto de Perfil</div>
                                            <div class="card-body text-center">
                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                    @if ($foto)
                                                        <img id="preview" class="img-account-profile rounded-circle mb-2 mt-2"
                                                        src="{{ $foto->temporaryUrl() }}" alt="Sin Foto" onclick="$('#foto').click()">
                                                     @else
                                                            <img id="preview" class="img-account-profile rounded-circle mb-2 mt-2"
                                                            src="{{asset($init_foto)}}" alt="" onclick="$('#foto').click()">    
                                                        
                                                     @endif
                    
                                                @endif
                                                <div class="pt-4 pb-4">
                                                    <i class="fa-regular fa-hand-point-up" style="font-s
                                                    20px;"></i>
                                                    Click en Imagén
                                                </div>                                                
                                                <div class="small font-italic text-muted mb-4 mt-3">JPG o PNG no mayor de 1 MB</div>
                                                <input type="file" hidden id="foto" wire:model.defer="foto">

                                                @error('foto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="card mb-4">
                                            <div class="card-header">Detalle de la Cuenta</div>
                                            <div class="card-body">
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1  is_required" for="inputFirstName">Nombre(s)</label>
                                                        <input class="form-control" id="inputFirstName" type="text" wire:model.defer="input.nombre" 
                                                            >
                                                        @error('nombre')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror    
                                                    </div>
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputLastName">Apellido(s)</label>
                                                        <input class="form-control" id="inputLastName" type="text"wire:model.defer="input.apellido"
                                                        >
                                                        @error('apellido')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror    
                                                    </div>
                                                </div>
                    
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputCedula">Cédula de Identidad</label>
                                                        <input class="form-control" id="inputCedula" type="text" wire:model.defer="input.cedula"
                                                        >
                                                        @error('cedula','saveUser')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 is_required" for="inputEmailAddress">Correo electrónico</label>
                                                        <input class="form-control" id="inputEmailAddress" type="email" wire:model.defer="input.email"
                                                        >
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>    
                                                </div>
                    
                                                <div class="row gx-3 mb-3">
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputPhone">Teléfono</label>
                                                        <input class="form-control" id="inputPhone" type="tel" wire:model.defer="input.telefono"
                                                       >
                                                        @error('telefono')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>
                    
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputBirthday">Fecha de Nacimiento</label>
                                                        <input class="form-control" id="inputBirthday" type="date" wire:model.defer="input.fecha_nac"
                                                       >
                                                        @error('fecha_nac')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror 
                                                    </div>
                                                </div>
                                                <div class="row gx-5">
                                                    <div class="col-sm-6">      
                                                        (<small class="small mb-1 is_required" style="color: red"></small> <small>) Campos Obligatorios </small> 
                                                    </div>
                    
                                                    <div class="col-sm-6">      
                                                        <button class="btn btn-primary float-end" type="submit" style="width:100%">Guardar Información</button>
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

    <div wire:ignore.self class="modal fade " id="showResidente"  aria-labelledby="showResidente" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Residente casa no. {{session('casa_no')}}</h5>
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>    
                            </div>
                            <hr>
                            <form wire:submit.prevent="updateUser" class="row g-3" enctype="multipart/form-data">
                                <div class="row g-0">
                                    <div class="col-xl-4">
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-header">Foto</div>
                                            <div class="card-body text-center">
                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                    <img id="preview" class="img-account-profile rounded-circle mb-2 mt-2"
                                                    src="{{asset($init_foto)}}" alt="" style="height: 12rem;">    
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="card mb-4">
                                            <div class="card-header">Datos</div>
                                            <div class="card-body">
                                                <div class="row gx-3 mb-3">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <tr>
                                                                <th>Nombre y Apellido</th>
                                                                <td>{{$name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Cédula de Identidad</th>
                                                                <td>{{$cedula}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Correo electrónico</th>
                                                                <td>{{$correo}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Teléfono</th>
                                                                <td>{{$telefono}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Fecha de Nacimiento</th>
                                                                <td>{{formatFecha($fecha_nac)}}</td>
                                                            </tr>
                                                        </table>
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


    <div wire:ignore.self class="modal fade " id="deleteResidente"  aria-labelledby="deleteResidente" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Eliminar Residente casa no. {{session('casa_no')}}</h5>
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>    
                            </div>
                            <hr>
                            <form wire:submit.prevent="updateUser" class="row g-3" enctype="multipart/form-data">
                                <div class="row g-0">
                                    <div class="col-xl-4">
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-header">Foto</div>
                                            <div class="card-body text-center">
                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                    <img id="preview" class="img-account-profile rounded-circle mb-2 mt-2"
                                                    src="{{asset($init_foto)}}" alt="" style="height: 12rem;">    
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="card mb-4">
                                            <div class="card-header">Datos</div>
                                            <div class="card-body">
                                                <div class="row gx-3 mb-3">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <tr>
                                                                <th>Nombre y Apellido</th>
                                                                <td>{{$name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Cédula de Identidad</th>
                                                                <td>{{$cedula}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Correo electrónico</th>
                                                                <td>{{$correo}}</td>
                                                            </tr>
                                                        </table>
                                                    </div>            
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
                            </form>
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
        </style>
    @endpush

    @push('scripts')


        <script>
            window.addEventListener('close-modal', event =>{
                $('#addResidente').modal('hide');
            });
            window.addEventListener('open-edit-modal', event =>{
                $('#updateResidente').modal('show');
            });
            window.addEventListener('close-modal-update', event =>{
                $('#updateResidente').modal('hide');
            });
            window.addEventListener('open-show-modal', event =>{
                $('#showResidente').modal('show');
            });
            window.addEventListener('open-delete-modal', event =>{
                $('#deleteResidente').modal('show');
            });
            window.addEventListener('close-delete-modal', event =>{
                $('#deleteResidente').modal('hide');
            });

            var updateModalEl = document.getElementById('updateResidente');
            var addModalEl = document.getElementById('addResidente');
            updateModalEl.addEventListener('hidden.bs.modal', function (event) {
                Livewire.emit('clearVar');
            })
            addModalEl.addEventListener('hidden.bs.modal', function (event) {
                Livewire.emit('clearVar');
            })            
                                                   
        </script>
    @endpush




</div>
