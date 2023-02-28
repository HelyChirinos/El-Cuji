<div>
    <div class="page-breadcrumb d-none d-sm-flex  justify-content-center mb-3">
        <div class="page-title pe-3">Fondos</div>
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
                    <button type="button" class=" float-end btn btn-primary px-3"  data-bs-toggle="modal"  data-bs-target="#addFondo">Nuevo</button>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>id</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>tipo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($fondos->count())
                            @foreach ($fondos as $item)
                                <tr>
                                    <td class="text-center">{{$item->id}}</td>
                                    <td>
                                        {{$item->descripcion}}
                                    </td>
                                    <td> {{$item->monto}}</td>

                                    <td> 
                                        @if ($item->tipo)
                                            <div class="font-20 text-primary">	<i class="fa-duotone fa-percent"></i>
                                            </div>
                                        @else
                                            <div class="font-20 text-primary">	<i class="fa-duotone fa-dollar-sign"></i>
                                            </div>
                                        @endif
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a wire:click.prevent = 'edit({{$item->id}})' href="javascript:;" class=""><i class='bx bxs-edit text-primary '></i></a>
                                            <a wire:click.prevent = "$emit('delete-fondo', {{$item->id}})" href="javascript:;" class="ms-3"><i class='bx bxs-trash text-danger'></i></a>
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
                {{ $fondos->links() }} 
            </div>
        </div>
    </div>


    <!-- Modal -->



    <div wire:ignore.self class="modal fade " id="addFondo"  aria-labelledby="addFondo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Nuevo Fondo</h5>
                                <div class="float-end">
                                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>    
                        </div>

                        <hr>
                            <form wire:submit.prevent="save" class="row g-3">
                                <div class="col-12">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <input type="text" wire:model.defer="descripcion"  class="form-control"  >
                                    @error('descripcion') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-4">
                                    <label for="monto" class="form-label">Monto</label>
                                    <input type="number" min="0" step="0.01" wire:model.defer="monto"  class="form-control"  >
                                    @error('monto') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <div class="pt-4 px-3">
                                        <input wire:model.defer="tipo" class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
                                        <label class="form-check-label" for="flexCheckChecked">Porcentaje (%)</label>
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

    <div wire:ignore.self class="modal fade " id="updateFondo"  aria-labelledby="updateFondo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Actualizar Fondo</h5>
                                <div class="float-end">
                                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>    
                        </div>

                        <hr>
                            <form wire:submit.prevent="update" class="row g-3">
                                <div class="col-12">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <input type="text" wire:model.defer="descripcion"  class="form-control"  >
                                    @error('descripcion') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-4">
                                    <label for="monto" class="form-label">Monto</label>
                                    <input type="number" min="0" step="0.01" wire:model.defer="monto"  class="form-control"  >
                                    @error('monto') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <div class="pt-4 px-3">
                                        <input wire:model.defer="tipo" class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
                                        <label class="form-check-label" for="flexCheckChecked">Porcentaje (%)</label>
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

    

    @push('scripts')

        <script>
                
            window.addEventListener('close-addFondo', event =>{
                $('#addFondo').modal('hide');
            });

            window.addEventListener('open-updateFondo', event =>{
                $('#updateFondo').modal('show');
            });

            window.addEventListener('close-updateFondo', event =>{
                $('#updateFondo').modal('hide');
            });

            var addModalEl = document.getElementById('addFondo');
            var updateModalEl = document.getElementById('updateFondo');

            addModalEl.addEventListener('hidden.bs.modal', function (event) {
                @this.descripcion='';
                @this.tipo=1;
                @this.monto=0;
            })            
                            
            updateModalEl.addEventListener('hidden.bs.modal', function (event) {
                @this.descripcion='';
                @this.tipo=1;
                @this.monto=0;
            })                
        
        </script>

        <script>
            Livewire.on('delete-fondo', fondoId => {

                Swal.fire({
                title: '¿ Esta seguro ?',
                text: "No podrá utilizar este Fondo en el Resumen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'

                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('fondoDelete', fondoId);    
                        Swal.fire(
                        'Borrado!',
                        'El fondo se ha eliminado.',
                        'success'
                        )
                    }
                })

            });       
        </script>  
 
    @endpush    
  

</div>

