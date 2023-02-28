<div>
    @push('styles')
        <style>
            .ck-editor__editable {
                min-height: 300px;
            }
        </style>        
    @endpush
    <div class="page-breadcrumb d-none d-sm-flex  justify-content-center mb-3">
        <div class="page-title pe-3 float-end">Relación de Gastos: {{$mes_ano}}</div>

    </div>
    <div class="row">   
        <div class="p-3 col bd-highlight">
            <button type="button" class="btn btn-primary px-3"  data-bs-toggle="modal"  data-bs-target="#showGastos">Agregar Gastos</button>
        </div>
        <div class="p-3 col bd-highlight">
            <button type="button" class="btn btn-primary px-3"  data-bs-toggle="modal"  data-bs-target="#showFondos">Agregar Fondo</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">   
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Gastos</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th class="text-center">Monto</th>
                                    <th colspan="2" class="text-center" style="border-color: black; border-bottom-width: 1px; border-style:solid;" >Cuota</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Descripción</th>
                                    <th class="text-center" >$</th>
                                    <th class="text-center" >$</th>
                                    <th class="text-center"  >Bs.</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($detalles->count())
                                    @foreach ($detalles as $detalle)
                                        <tr>
                                            <td style="white-space: normal;">
                                                {{$detalle->gasto->descripcion}}
                                            </td>
                                            <td>  {{number_format($detalle->monto,2,",",".")}} </td>
                                            <td>  {{number_format(($detalle->monto/30),2,",",".")}} </td>
                                            <td>   {{number_format((($detalle->monto/30)*$dollar_BCV),2,",",".")}}</td>

                                            <td>
                                                <div class="d-flex order-actions">
                                                    <a wire:click.prevent = 'deleteDetalle({{$detalle->id}},{{$detalle->gasto_id}})' href="javascript:;" class="ms-3"><i class='bx bxs-trash text-danger'></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach                           
                                @else
                                    <tr>
                                        <td colspan="4">
                                            <div class="px-6 py-4 text-sm text-red-500 text-bold text-center" >
                                                No se han registrado gastos todavía
                                            </div>
                                        </td>
                                    </tr>                            
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end fw-bold">
                                    SUB-TOTAL
                                    </td>
                                    <td class="text fw-bold">
                                        {{number_format($tot_gastos,2,",",".")}}
                                    </td>
                                    <td class="text fw-bold">
                                        {{number_format(($tot_gastos/30),2,",",".")}}
                                    </td>
                                    <td class="text fw-bold">
                                        {{number_format(($tot_gastos/30)*$dollar_BCV,2,",",".")}}
                                    </td>
                                </tr>
                            </tfoot>     
                        </table>
                    </div>
                    <div class="mt-3 float-end">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">   
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Fondos</h4>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th class="text-center">Monto</th>
                                    <th colspan="2" class="text-center" style="border-color: black; border-bottom-width: 1px; border-style:solid;" >Cuota</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Tarifa</th>
                                    <th class="text-center">$</th>
                                    <th class="text-center">$</th>                                    
                                    <th class="text-center">Bs.</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($detalle_fondos->count())
                                    @foreach ($detalle_fondos as $d_fondo)
                                        <tr>
                                            <td style="white-space: normal;">
                                                {{$d_fondo->fondo->descripcion}}
                                            </td>
                                            <td>
                                                @if ($d_fondo->factor == 1)  
                                                    {{ number_format($d_fondo->tarifa,2,",",".") . '%' }} 
                                                @else
                                                    {{ number_format($d_fondo->tarifa,2,",",".") . 'Bs.' }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ number_format($d_fondo->monto,2,",",".")}}

                                            </td>
                                            <td>
                                                {{ number_format(($d_fondo->monto/30),2,",",".") }}
                                            </td>
                                            <td>
                                                {{ number_format(($d_fondo->monto/30)*$dollar_BCV,2,",",".") }}
                                            </td>
                                            <td>
                                                <div class="d-flex order-actions">
                                                    <a wire:click.prevent = 'deleteFondoDetalle({{$d_fondo->id}},{{$d_fondo->fondo_id}})' href="javascript:;" class="ms-3"><i class='bx bxs-trash text-danger'></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach                           
                                @else
                                    <tr>
                                        <td colspan="4">
                                            <div class="px-6 py-4 text-sm text-red-500 text-bold text-center" >
                                                No se han registrado Fondos todavía
                                            </div>
                                        </td>
                                    </tr>                            
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end fw-bold">
                                    SUB-TOTAL
                                    </td>
                                    <td></td>
                                    <td class="fw-bold">
                                        {{number_format($tot_fondos,2,",",".")}}
                                    </td>
                                    <td class="fw-bold">
                                        {{number_format(($tot_fondos/30),2,",",".")}}
                                    </td>                                    
                                    <td class="fw-bold">
                                        {{number_format(($tot_fondos/30)*$dollar_BCV,2,",",".")}}
                                    </td>
                                </tr>
                            </tfoot>     
                        </table>
                    </div>
                    <div class="mt-3 float-end">

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Total Condominio</h4>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tr>
                                <td>Total Monto en $</td>
                                <td class="text-end fw-bold"> {{'$ '. formatMoney($total_general)}}</td>
                            </tr>
                            <tr>
                                <td>Total Monto en Bs.</td>
                                <td class="text-end fw-bold"> {{'Bs. '. formatMoney($total_general * $dollar_BCV)  }}</td>
                            </tr>
                            <tr>
                                <td>Cuota en $</td>
                                <td class="text-end fw-bold"> {{'$ '. formatMoney($total_general/30)  }}</td>
                            </tr>
                            <tr>
                                <td>Couta en Bs.</td>
                                <td class="text-end fw-bold"> {{'Bs. '. formatMoney(($total_general * $dollar_BCV)/30) }}</td>
                            </tr>


                        </table>
                    </div>
                    <div class="mt-3 float-end">

                    </div>
                </div>
            </div>            
        </div>
    </div>
    <div class="row justify-content-center text-center">
        <div class="col-4">
            <div class="p-3 col bd-highlight">
                <a href="{{route('publicar')}}" class="btn btn-primary px-3">Publicar</a>
            </div>
        </div>
        <div class="col-4">
            <div class="p-3 col bd-highlight">
                <a href="{{route('showPDF','stream')}}" target="blank" class="btn btn-success px-3">Ver PDF</a>
            </div>
        </div> 
        <div class="col-4">
            <div class="p-3 col bd-highlight">
                <button type="button" class="btn btn-warning px-3"  data-bs-toggle="modal"  data-bs-target="#showObserva">Observaciones</button>
            </div>
        </div>
    </div>

    <!-- Modal  Gastos-->
    <div wire:ignore.self class="modal fade " id="showGastos"  aria-labelledby="showGasto" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Gastos</h5>
                                <div class="col-8 position-relative">
                                    <input type="text" wire:model='search' class="form-control ps-5 " placeholder="Buscar"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                </div>   
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>    
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>id</th>
                                            <th>Descripción</th>
                                            <th>fijo</th>
                                            <th>Monto</th>
                                            <th>Facturar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($gastos->count())
                                            @foreach ($gastos as $item)
                                                <tr>
                                                    <td 
                                                        class="text-center">{{$item->id}}
                                                    </td>
                                                    <td style="white-space: normal;">
                                                        {{$item->descripcion}}
                                                    </td>
                                                    <td> 
                                                        @if ($item->fijo)
                                                            <div class="font-20 text-primary">	<i class="fadeIn animated bx bx-check"></i>
                                                            </div>                                       
                                                        @endif
                                                    </td>
                                                    <td >  
                                                        <input type="text" wire:model.defer="input.{{$item->id}}.monto"  style="width: 80px;"> 
                                                    </td>
                                                    <td>
                                                        <div class="d-flex order-actions">
                                                            <a wire:click.prevent = 'addGasto({{$item->id}})' href="javascript:;" class=""><i class='bx bxs-edit text-primary '></i></a>
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Fondos-->
    <div wire:ignore.self class="modal fade " id="showFondos"  aria-labelledby="showFondos" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Fondos</h5>
                                <div class="col-8 position-relative">
                                    <input type="text" wire:model='searchfondo' class="form-control ps-5 " placeholder="Buscar"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                </div>   
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>    
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Factor</th>
                                            <th>Monto</th>
                                            <th>Facturar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($fondos->count())
                                            @foreach ($fondos as $item)
                                            <tr>
                                                <td>
                                                    {{$item->descripcion}}
                                                </td>
                                                <td> 
                                                    @if ($item->tipo)
                                                        <div class="font-20 text-primary">	<i class="fa-duotone fa-percent"></i>
                                                        </div>
                                                    @else
                                                        <div class="font-20 text-primary">	<i class="fa-duotone fa-dollar-sign"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td> {{$item->monto}}</td>
                                                <td>
                                                    <div class="d-flex order-actions">
                                                        <a wire:click.prevent = 'addFondo({{$item->id}})' href="javascript:;" class=""><i class='bx bxs-edit text-primary '></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                        @else
                                            <tr>
                                                <td colspan="5">
                                                    <div class="px-6 py-4 text-sm text-red-500 text-bold text-center" >
                                                        Todos los Fondos estan facturadas
                                                    </div>
                                                </td>
                                            </tr>                            
                                        @endif
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


    <!-- Modal  Observaciones-->
    <div wire:ignore class="modal fade " id="showObserva"  aria-labelledby="showObserva" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h5 class="mb-0 text-primary">Observaciones</h5>
                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>    
                            </div>

                            <form wire:submit.prevent="updateObs" class="row g-3">
                                <div class="table-responsive">
                                    <textarea wire:model="observacion" id="editor" style="width: 100%">
                                        {!! $observacion !!}
                                    </textarea>
                                </div>
                                <div class="col-12 pt-3">
                                    <button type="submit" class="btn btn-primary px-5 float-end">Actualizar</button>
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
            
        window.addEventListener('close-showObserva', event =>{
            $('#showObserva').modal('hide');
        });
       
    </script>

    


    @push('scripts')

	    <script src="{{asset('assets/plugins/ckeditor5/ckeditor.js')}}"></script>

        <script>
            checkVariable();
            function checkVariable(){
                if ( window.jQuery){
                    $(document).ready(function() {

                        $(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {
			            $(".wrapper").addClass("sidebar-hovered")
		                }, function() {
			            $(".wrapper").removeClass("sidebar-hovered")
		                }))
                    });
                }
                else{
                    window.setTimeout("checkVariable();",100);
                    console.log('nada');
                }
            }
        </script>

        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                } )
                .then( editor => {
                    editor.model.document.on('change:data', () => {
                    @this.set('observacion', editor.getData());
                })

                    
                })
                .catch( err => {
                    console.error( err.stack );
                } );
        </script>

    @endpush
</div>
