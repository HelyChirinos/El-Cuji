<div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Saldo en Bancos</p>
                            <h4 class="my-1 text-info">$805,25</h4>
                            <p class="mb-0 font-13">Banco Provincial</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa-regular fa-building-columns"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Caja Chica</p>
                            <h4 class="my-1 text-danger">$84,24</h4>
                            <p class="mb-0 font-13">Bs. llevados a $</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="fa-regular fa-vault"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Ctas. x Cobrar</p>
                            <h4 class="my-1 text-success">$ {{formatMoney(ctas_x_cobrar())}}</h4>
                            <p class="mb-0 font-13">{{total_deudores()}} casas con deudas</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fa-regular fa-money-bill-transfer"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Dolar Referencia</p>
                            <h4 class="my-1 text-warning"> {{formatMoney(dolar_BCV())}} Bs.</h4>
                            <p class="mb-0 font-13">Según el BCV</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa-regular fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
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

            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Casa No</th>
                            <th>Saldo Inicial</th>
                            <th>Saldo ($)</th>
                            <th>Saldo (Bs.)</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($casas->count())
                            @foreach ($casas as $item)
                                <tr>
                                    <td class="text-center">
                                       <a href="{{route('casa', $item->casa_no)}}" class="twxt-center"> {{$item->casa_no}} </a>
                                    </td>
                                    <td> {{ formatMoney( $item->saldo_inicial) .' $'}} </td>
                                    <td> {{ formatMoney (saldo_casa($item->casa_no)).' $'}} </td>
                                    <td> 
                                        @php
                                            $dolar = dolar_BCV();
                                        @endphp
                                        {{  formatMoney  ((saldo_casa($item->casa_no)) * $dolar) .' Bs.'}} 
                                    </td>
                                    <td> <div style="word-wrap: break-word; white-space: normal;">{{$item->observacion}} </div> 
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
                {{ $casas->withQueryString()->links() }}
            </div>
        </div>
    </div>

</div>
