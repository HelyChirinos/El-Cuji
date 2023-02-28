<x-el-cuji>
 
<div>
    <div class="page-breadcrumb d-none d-sm-flex  justify-content-center mb-3">
        <div class="page-title ">Perfil</div>
    </div>    
    <div class="container-xl px-4 mt-4">
         {{-- <div class="px-5">
            <x-jet-validation-errors/>
        </div>   --}}

        <form action="{{route('save_perfil',$user)}}" method="post" id="updateDatos" enctype="multipart/form-data">
            @csrf
            <hr class="mt-0 mb-4">
            <div class="row g-0">
                <div class="col-xl-4">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Foto de Perfil</div>
                        <div class="card-body text-center">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                                <img id="preview" class="img-account-profile rounded-circle mb-2 mt-2"
                                src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" onclick="$('#foto').click()">

                            @endif
                            <div class="small font-italic text-muted mb-4 mt-4">JPG o PNG no mayor de 1 MB</div>
                            <input type="file" hidden id="foto" name="foto">
                            <div class="pt-2 pb-3">
                                <button class="btn btn-primary" type="button" onclick="$('#foto').click()">Cargar Imagén</button>
                            </div>
                            @error('foto','saveUser')
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
                                    <input class="form-control" id="inputFirstName" type="text" name="nombre"
                                        value="{{old("nombre", $user->nombre ?? "")}}">
                                    @error('nombre','saveUser')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror    
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1 is_required" for="inputLastName">Apellido(s)</label>
                                    <input class="form-control" id="inputLastName" type="text" name="apellido"
                                    value="{{old("apellido", $user->apellido ?? "")}}">
                                    @error('apellido','saveUser')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror    
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1 is_required" for="inputCedula">Cédula de Identidad</label>
                                    <input class="form-control" id="inputCedula" type="text" name="cedula"
                                    value="{{old("cedula", $user->cedula ?? "")}}">
                                    @error('cedula','saveUser')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror 
                                </div>    
                                <div class="col-md-6">
                                    <label class="small mb-1 is_required" for="inputEmailAddress">Correo electrónico</label>
                                    <input class="form-control" id="inputEmailAddress" type="email" name="email"
                                    value="{{old("email", $user->email ?? "")}}">
                                    @error('email','saveUser')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror 
                                </div>    
                            </div>

                            <div class="row gx-3 mb-3">

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Teléfono</label>
                                    <input class="form-control" id="inputPhone" type="tel" name="telefono"
                                    value="{{old("telefono", $user->telefono ?? "")}}">
                                    @error('telefono','saveUser')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror 
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Fecha de Nacimiento</label>
                                    <input class="form-control" id="inputBirthday" type="date" name="fecha_nac"
                                    value="{{old("fecha_nac", $user->fecha_nac ?? "")}}">
                                    @error('fecha_nac','saveUser')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror 
                                </div>
                            </div>
                            <div class="row gx-5">
                                <div class="col-sm-6">      
                                    (<small class="small mb-1 is_required" style="color: red"></small> <small>) Campos Obligatorios </small> 
                                </div>

                                <div class="col-sm-6">      
                                    <button class="btn btn-primary float-end" type="submit" style="width:100%">Actualizar Datos y Foto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

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
        <script type="text/javascript">
            $(document).ready(function (e) {
                $('#foto').change(function(){
                    let reader = new FileReader();
                    reader.onload = (e) => { 
                        $('#preview').attr('src', e.target.result); 
                    }
                    reader.readAsDataURL(this.files[0]); 
                });
            });        
        </script>   
    @endpush

</div>

</x-el-cuji>


