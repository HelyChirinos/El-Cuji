<div>
    <div class="page-breadcrumb d-none d-sm-flex  justify-content-center mb-3">
        <div class="page-title pe-3">Propietarios</div>
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
                    <button type="button" class=" float-end btn btn-primary px-3"  data-bs-toggle="modal"  data-bs-target="#addOwner">Nuevo</button>
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
                            <th>Casa No</th>
                            <th>Propietario(s)</th>
                            <th>Saldo Inicial</th>
                            <th>Saldo ($)</th>
                            <th>Saldo (Bs.)</th>
                            <th>Observación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($casas_owner->count())
                            @foreach ($casas_owner as $item)
                                <tr>
                                    <td class="text-center">
                                       <a href="{{route('casa', $item->casa_no)}}"> {{$item->casa_no}} </a>
                                    </td>
                                    <td>
                                        @php
                                            $array=[]; 
                                            foreach ($item->owners as $owner) {
                                                $comilla = '"';
                                                $texto ="<a wire:click.prevent='edit(".$comilla.$owner->id.$comilla.")' href=''>".$owner->name."</a>";
                                                array_push($array,$texto);
                                            }
                                            $duenos = implode(' - ',$array);
                                        @endphp
                                        {!! $duenos !!}
                                    </td>
                                    <td> {{ formatMoney( $item->saldo_inicial) .' $'}} </td>
                                    <td> {{  formatMoney (saldo_casa($item->casa_no)).' $'}} </td>
                                    <td> 
                                        @php
                                            $dolar = dolar_BCV();
                                        @endphp
                                        {{  formatMoney  ((saldo_casa($item->casa_no)) * $dolar) .' Bs.'}} 
                                    </td>
                                    <td> <div style="word-wrap: break-word; white-space: normal;">{{$item->observacion}} </div> 
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a wire:click.prevent = 'edit_obs({{$item->id}})' href="javascript:;" class=""><i class='bx bxs-edit text-primary '></i></a>
                                            <a wire:click.prevent = "$emit('delete-casa', {{$item->id}})" class="ms-3"><i class='bx bxs-trash text-danger'></i></a>
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
                {{ $casas_owner->links() }} 
            </div>
        </div>
    </div>


    <!-- Modal -->

    <div wire:ignore.self class="modal fade " id="addOwner"  aria-labelledby="addOwner" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Nuevo Propietario</h5>
                                <div class="float-end">
                                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close" wire:click = 'clearVar()'></button>
                            </div>    
                        </div>

                        <hr>
                            <form wire:submit.prevent="save" class="row g-3">
                              
                                <div class="col md-3"></div>
                                <div wire:ignore class="col-md-6">
                                    <label for="casas" class="form-label">Casa(s)</label>
                                    <select  id="casasUsers" wire:model.defer="input.casas" class="select2-multiple form-select" name="totcasas[]" style="width: 100%;" multiple="multiple" required
                                    >
                                        @foreach ($todas as $id => $casa)
                                            <option value="{{$id}}" >{{$casa}}</option>
                                        @endforeach
                                    </select>  

                                </div>
                                <div class="col md-3"></div> 

                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Nombres</label>
                                    <input type="text" wire:model.defer="input.nombre"  class="form-control"  >
                                    @error('nombre') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName" class="form-label">Apellidos</label>
                                    <input type="text" wire:model.defer="input.apellido" class="form-control" >
                                    @error('apellido') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputcedula" class="form-label">Cedula de Identidad</label>
                                    <input type="text" wire:model.defer="input.cedula" class="form-control">
                                    @error('cedula') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Correo electrónico</label>
                                    <input type="email" wire:model.defer="input.email" class="form-control" >
                                    @error('email') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>                                
                                <div class="col-md-4">
                                    <label for="inputphone" class="form-label">Telefono</label>
                                    <input type="text" wire:model.defer="input.telefono" class="form-control" >
                                    @error('telefono') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputfn" class="form-label">fecha Nac.</label>
                                    <input type="date" wire:model.defer="input.fecha_nac" class="form-control">
                                    @error('fecha_nac') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror

                                </div>
                                <div class="col-md-4 p-4">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.defer="input.propietario" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">Propietario</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Agregar</button>
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


    <div wire:ignore.self class="modal fade " id="updateOwner"  aria-labelledby="updateOwner" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Actualizar Propietario</h5>
                                <div class="float-end">
                                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>    
                        </div>

                        <hr>
                            <form wire:submit.prevent="updateUser" class="row g-3">
                              
                                <div class="col md-3"></div>
                                <div wire:ignore class="col-md-6">
                                    <label for="casas" class="form-label">Casa(s)</label>
                                    <select id="UpdateCasasUsers" class="form-select" name="totcasas[]" multiple="multiple"
                                    >
                                        @foreach ($todas as $id => $casa)
                                            <option value="{{$id}}" >{{$casa}}</option>
                                        @endforeach
                                    </select>  

                                </div>
                                <div class="col md-3"></div> 

                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Nombres</label>
                                    <input type="text" wire:model.defer="input.nombre"  class="form-control"  >
                                    @error('nombre') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName" class="form-label">Apellidos</label>
                                    <input type="text" wire:model.defer="input.apellido" class="form-control" >
                                    @error('apellido') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputcedula" class="form-label">Cedula de Identidad</label>
                                    <input type="text" wire:model.defer="input.cedula" class="form-control">
                                    @error('cedula') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Correo electrónico</label>
                                    <input type="email" wire:model.defer="input.email" class="form-control" >
                                    @error('email') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>                                
                                <div class="col-md-4">
                                    <label for="inputphone" class="form-label">Telefono</label>
                                    <input type="text" wire:model.defer="input.telefono" class="form-control" >
                                    @error('telefono') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputfn" class="form-label">fecha Nac.</label>
                                    <input type="date" wire:model.defer="input.fecha_nac" class="form-control">
                                    @error('fecha_nac') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror

                                </div>
                                <div class="col-md-4 p-4">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.defer="input.propietario" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">Propietario</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Actualizar</button>
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

    <div wire:ignore.self class="modal fade " id="observacion"  aria-labelledby="observacion" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Observaciones Casa No. {{$num_casa}} </h5>
                                <div class="float-end">
                                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>    
                        </div>

                        <hr>
                            <form wire:submit.prevent="save_obs" class="row g-3">
                              <div class="row py-3">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                    <label for="inputsaldo" class="form-label">Saldo Inicial</label>
                                    <input type="number" step=".01" wire:model="saldo_init" class="form-control">

                                </div>

                              </div>  
                              <div class="row"> 
                                    <div class="col-12">
                                        <label for="inputObs" class="form-label">Obsrvaciones</label>
                                        <textarea wire:model='observacion' class="form-control" id="inputObs" placeholder="..." rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Actualizar</button>
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

    <script>
        var casas_g = [];
        var casas_u = [];

        document.addEventListener('livewire:load', function() {
 			$('.select2-multiple').select2({
				// theme: "bootstrap-5",
    			// selectionCssClass: "select2--small",
    			// dropdownCssClass: "select2--small",
				placeholder: 'seleccione casa'
			});

            $('#casasUsers').on('select2:select', (e) => {
                casas_g = $('#casasUsers').select2('val');
                console.log(casas_g);
            });

            $('#UpdateCasasUsers').select2({
				placeholder: 'seleccione casa'
			});            

            $('#UpdateCasasUsers').on('select2:select select2:unselect', (e) => {
                casas_u = $('#UpdateCasasUsers').select2('val');
                console.log(casas_u);
            });


        });
        window.addEventListener('close-modal', event =>{
             Livewire.emit('casasAdd', casas_g);
            $('#addOwner').modal('hide');
        });

        window.addEventListener('show-edit-owner', event =>{
            $('#updateOwner').modal('show');
            $('#UpdateCasasUsers').val(event.detail.casas);
            $('#UpdateCasasUsers').trigger('change');
            casas_u = event.detail.casas;
        });

        window.addEventListener('close-modal-update', event =>{
             Livewire.emit('casasUpdate', casas_u);
            $('#updateOwner').modal('hide');
        });

        window.addEventListener('show-edit-obs', event =>{
            $('#observacion').modal('show');
        });

        window.addEventListener('close-edit-obs', event =>{
            $('#observacion').modal('hide');
        });

        var addModalEl = document.getElementById('addOwner');
        var updateModalEl = document.getElementById('updateOwner');

        addModalEl.addEventListener('hidden.bs.modal', function (event) {
                $('#casasUsers').val(null).trigger('change');
                @this.input=[];
                // Livewire.emit('clearVar');

            })            
                           
        updateModalEl.addEventListener('hidden.bs.modal', function (event) {
                $('#casasUsers').val(null).trigger('change');
                @this.input=[];
            })    
    </script>


    @push('scripts')
        <script>
            Livewire.on('delete-casa', casaId => {
                Swal.fire({
                title: '¿ Esta seguro ?',
                text: "Al eliminar el la casa se borrarán todos los residentes de la misma",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'

            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('casaDelete', casaId);    
                    Swal.fire(
                    'Borrado!',
                    'los Residentes de la casa se han eliminado.',
                    'success'
                    )
                }
            })

        });       

        </script>
    @endpush

</div>
