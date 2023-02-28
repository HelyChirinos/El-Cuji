<div>
    <style>
        select:invalid{
            color: gray;
            font-size: 14px;
        }
        option{
            color: black;
        }
    </style>
    <div class="page-breadcrumb d-none d-sm-flex  justify-content-center mb-3">
        <div class="page-title pe-3">Pagos</div>
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
                    <button type="button" class=" float-end btn btn-primary px-3"  data-bs-toggle="modal"  data-bs-target="#addPago">Nuevo</button>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif
            <div class="table-responsive"  >
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Casa</th>
                            <th>Concepto</th>
                            <th>fecha</th> 
                            <th>Forma de Pago</th>                           
                            <th>Referencia</th>
                            <th>Monto</th>                            
                            <th>acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pagos->count())
                            @foreach ($pagos as $item)
                                <tr>
                                    <td style="white-space: normal;">
                                        {{$item->casa_id}}
                                    </td>
                                    <td style="word-wrap: break-word;
                                    white-space: normal;"> {{$item->concepto}}</td>
                                    <td> {{formatFecha($item->fecha)}}</td>
                                    <td> {{$item->forma_pago}}</td>
                                    <td> {{$item->referencia}}</td>
                                    <td> {{formatMoney($item->monto)}}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a wire:click.prevent = 'edit({{$item->id}})' href="javascript:;" class=""><i class='bx bxs-envelope text-primary '></i></a>
                                            <a wire:click.prevent = "$emit('delete-pago', {{$item->id}})" href="javascript:;" class="ms-3"><i class='bx bxs-trash text-danger'></i></a>
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
                {{ $pagos->links() }} 
            </div>
        </div>
    </div>

    <!-- Modal -->

    <div wire:ignore.self class="modal fade " id="addPago"  aria-labelledby="addPago" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Nuevo Pago</h5>
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>    
                            </div>

                            <hr>
                            <form wire:submit.prevent="save" class="row g-3">
                              
                                <div class="col md-3"></div>
                                <div wire:ignore class="col-md-6">
                                    <label for="casas" class="form-label">Casa</label>
                                    <select id="casasUsers" wire:model.defer="casa" class="form-select" required
                                    >
                                        <option value="">Selecione casa</option>
                                        @foreach ($casas as $id => $casa)
                                            <option value="{{$id}}" >{{$casa}}</option>
                                        @endforeach
                                    </select>  

                                </div>
                                <div class="col md-3"></div> 

                                <div class="col-md-8">
                                    <label for="Concepto" class="form-label">Concepto</label>
                                    <input type="text" wire:model.defer="concepto"  class="form-control"  >
                                    @error('concepto') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="forma_pago" class="form-label">Forma de Pago</label>
                                    <select class="form-select" wire:model.defer="forma_pago" required>
                                        <option value="" selected disabled hidden class="placehold">seleccione pago</option>
                                        <option value="Zelle">Zelle</option>
                                        <option value="Transferencia">Transferencia</option>
                                        <option value="Pago Movil">Pago Movil</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Otro">Otro</option>
                                        
                                      </select>
                                    @error('forma_pago') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" wire:model.defer="fecha" class="form-control" >
                                    @error('fecha') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputmonto" class="form-label">Monto</label>
                                    <input type="number" wire:model.defer="monto" step=".01" class="form-control">
                                    @error('monto') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputEmail" class="form-label">Referencia</label>
                                    <input type="text" wire:model.defer="referencia" class="form-control" >
                                    @error('referencia') <span class="invalid-feedback" style="display: block;">{{ $message }}</span> @enderror
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



@push('scripts')

    <script>
        $('#casasUsers').select2({
            theme: "bootstrap-5",
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
            placeholder: 'seleccione casa'
        });

        $('#casasUsers').on('select2:select', (e) => {
            casas_g = $('#casasUsers').select2('val');
            Livewire.emit('casaChange', casas_g);
            console.log(casas_g);
        });

        window.addEventListener('close-modal', event =>{
            $('#addPago').modal('hide');
        });            

        var addModalEl = document.getElementById('addPago');

        addModalEl.addEventListener('hidden.bs.modal', function (event) {
                @this.casa="";
                $('#casasUsers').val(null).trigger('change');
                @this.forma_pago="";
                @this.referencia="";
                @this.concepto="";
                @this.fecha="";
                @this.monto=0.00;
            })            
                               
    </script>
    <script>
             Livewire.on('delete-pago', gastoId => {
                Swal.fire({
                title: '¿ Esta seguro ?',
                text: "al eliminar el Pago se sumará el monto al Saldo de la casa",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'

                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('pagoDelete', gastoId);    
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
