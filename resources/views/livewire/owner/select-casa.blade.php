<div>


    <!-- Modal -->

    <div wire:ignore.self class="modal fade " id="selectCasa" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="selectCasa" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Cual casa desea consulta ?</h5>
                            </div>    
                            <form wire:submit.prevent="save">
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-6 py-4">
                                        
                                        <select id="casasUsers" wire:model.defer="casa" class="form-select" required>
                                            <option value="" hidden selected>Seleccione casa</option>
                                            @foreach ($casas as $casa)
                                                <option value="{{$casa->id}}" >{{$casa->id}}</option>
                                            @endforeach
                                        </select>  

                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary float-end">Continuar</button>
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

    @push('scripts')

        <script>
            window.addEventListener('open-modal', event =>{
                console.log('entro');
                $('#selectCasa').modal('show');
            });            
            window.addEventListener('close-modal', event =>{
                $('#selectCasa').modal('hide');
            });            
                
            document.addEventListener('livewire:load', function () {
                @this.boton()

            })
            $('#casasUsers').on('change', function() {
                @this.casa = this.value ;
            });        
        </script>

        

    @endpush


</div>
