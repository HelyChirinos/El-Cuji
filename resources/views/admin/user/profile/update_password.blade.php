<x-el-cuji>
 
<div>
    
    <div class="container-xl px-4 mt-4">

        <form action="{{route('update_pass',$user)}}" method="post" id="updatePassword" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-2">
                    Actualizar contraseña
                    Asegúrese que su cuenta esté usando una contraseña larga y aleatoria para mantenerse seguro.

                </div>
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Actualizar Contraseña</div>
                        <div class="card-body">
                            <div class="row gy-3 mb-3">

                                <div class="col-md-12">
                                    <label class="small mb-1  is_required" for="current_password">Contraseña Actual</label>
                                    <input class="form-control" id="current_password" type="password" name="current_password" required autocomplete="current-password">
                                    @error('current_password','updatePass')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror 
                                </div>

                                <div class="col-md-12">
                                    <label class="small mb-1 is_required" for="password">Nueva Contraseña</label>
                                    <input class="form-control" id="password" type="password" name="password" required autocomplete="current-password">
                                    @error('password','updatePass')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror 
                                </div>
                                <div class="col-md-12">
                                    <label class="small mb-1 is_required" for="password_confirmation">Confirmar Contraseña</label>
                                    <input class="form-control" id="password" type="password" name="password_confirmation" required autocomplete="current-password">
                                    @error('password_confirmation','updatePass')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror 
                                </div>

                            </div>
                            <div class="row gx-5">
                                <div class="col-sm-6">      
                                    (<small class="small mb-1 is_required" style="color: red"></small> <small>) Campos Obligatorios </small> 
                                </div>

                                <div class="col-sm-6">      
                                    <button class="btn btn-primary float-end" type="submit">Actualizar Contraseña</button>
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
                border-radius: 0.35rem 0.35rem 0 0;
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


