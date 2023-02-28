<div>
    <div class="page-breadcrumb d-none d-sm-flex  justify-content-center mb-3">
        <div class="page-title pe-3">Gastos</div>
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
                    <button type="button" class=" float-end btn btn-primary px-3"  data-bs-toggle="modal"  data-bs-target="#addGasto">Nuevo</button>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif
            <div class="table-responsive"  >
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>id</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Fijo</th>
                            <th>Ejecutar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($gastos->count())
                            @foreach ($gastos as $item)
                                <tr>
                                    <td class="text-center">{{$item->id}}</td>
                                    <td style="white-space: normal;">
                                        {{$item->descripcion}}
                                    </td>
                                    <td> 0$ </td>

                                    <td> 
                                        @if ($item->fijo)
                                            <div class="font-20 text-primary">	<i class="fadeIn animated bx bx-check"></i>
                                            </div>                                       
                                        @endif
                                    </td>    
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a wire:click.prevent = 'edit({{$item->id}})' href="javascript:;" class=""><i class='bx bxs-edit text-primary '></i></a>
                                            <a wire:click.prevent = "$emit('delete-gasto', {{$item->id}})" href="javascript:;" class="ms-3"><i class='bx bxs-trash text-danger'></i></a>
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
                {{ $gastos->links() }} 
            </div>
        </div>
    </div>


    <!-- Modal -->



    <div wire:ignore.self class="modal fade " id="addGasto"  aria-labelledby="addGasto" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Nuevo Gasto</h5>
                                <div class="float-end">
                                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>    
                        </div>

                        <hr>
                            <form wire:submit.prevent="save" class="row g-3">
                              

                                <div class="col-md-11">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <input type="text" wire:model.defer="descripcion"  class="form-control"  >
                                    @error('descripcion') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-1 form-check" style="padding-top: 32px;">
                                        <input wire:model.defer="fijo" class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
                                        <label class="form-check-label" for="flexCheckChecked">fijo</label>
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

    <div wire:ignore.self class="modal fade " id="updateGasto"  aria-labelledby="updateGasto" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Actualizar Gasto</h5>
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>    
                            </div>
                            <hr>
                            <form wire:submit.prevent="update" class="row g-3">

                                <div class="col-md-11">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <input type="text" wire:model.defer="descripcion"  class="form-control"  >
                                    @error('descripcion') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-1 form-check" style="padding-top: 32px;">
                                        <input wire:model.defer="fijo" class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
                                        <label class="form-check-label" for="flexCheckChecked">fijo</label>
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
            window.addEventListener('close-addGastos', event =>{
                $('#addGasto').modal('hide');
            });

            window.addEventListener('open-updateGastos', event =>{
                $('#updateGasto').modal('show');
            });

            window.addEventListener('close-updateGastos', event =>{
                $('#updateGasto').modal('hide');
            });

            var addModalEl = document.getElementById('addGasto');
            var updateModalEl = document.getElementById('updateGasto');

            addModalEl.addEventListener('hidden.bs.modal', function (event) {
                @this.descripcion='';
                @this.fijo=0;
            })            
                            
            updateModalEl.addEventListener('hidden.bs.modal', function (event) {
                @this.descripcion='';
                @this.fijo=0;
                    // Livewire.emit('clearVar');
            })    
            
        </script>

        <script>
            Livewire.on('delete-gasto', gastoId => {

                Swal.fire({
                title: '¿ Esta seguro ?',
                text: "No podrá utilizar este gasto en el Resumen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'

                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('gastoDelete', gastoId);    
                        Swal.fire(
                        'Borrado!',
                        'El gasto se ha eliminado.',
                        'success'
                        )
                    }
                })

            });       
        </script>  
 
    @endpush    
  

</div>

