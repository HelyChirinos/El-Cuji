<div>
    @push('styles')
        <style>   
            .bordered-heading {
                border-bottom: 5px solid #0B109D;
                padding-bottom: 10px;
                margin-top: 20px;
                margin-bottom: 0;
            }

            table.tabla-recibo {
                width: 100%;
                border-spacing: 10px;
                border-collapse: separate;
                margin-left: -10px;
            }
            table.tabla-recibo th {
                border-color: inherit;
                border-style: solid;
                border-bottom-width: 5px;
                width: 100%;
                float: right
            }
        </style> 
        
    @endpush
    <div class="page-breadcrumb d-none d-sm-flex  justify-content-center mb-3">
        <div class="page-title pe-3">Movimientos Casa No. {{$casa_id}}</div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Dolar BCV</th>
                            <th>Saldo ($)</th>
                            <th>Saldo (Bs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{formatMoney(dolar_BCV())}}</td>
                            <td>{{formatMoney($saldo_helper)}}</td>
                            <td>{{formatMoney($saldo_helper*dolar_BCV()) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>       
    </div>

    <div class="row">
        <div class="col-lg-6">
            <p>Saldo antes del {{formatFecha($fechaFilter) }} :{{ formatMoney($saldo_fecha) .' $'}}</p>  
        </div>

    </div>
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Importe</th>
                            <th>Saldo</th>
                            <th>Imprimir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($movimientos->count())
                            @foreach ($movimientos as $item)
                                <tr>
                                    <td>
                                      {{$item['codigo']}}
                                    </td>
                                    <td>
                                      {{$item['tipo']}}
                                    </td>
                                    <td>  {{ formatFecha($item['fecha'])}} </td>
                                    <td>  
                                        @if ($item['tipo']=='Factura')
                                            {{ formatMoney($item['monto']/30)}} 
                                        @else
                                        {{'-'. formatMoney($item['monto'])}} 
                                        @endif
                                    </td>
                                    <td>  
                                        @if ($item['tipo']=='Factura')
                                            @php
                                                $saldo_mov = $saldo_mov+($item['monto']/30)
                                            @endphp
                                            {{ formatMoney( $saldo_mov )}} 
                                        @else
                                            @php
                                                $saldo_mov = $saldo_mov-$item['monto']
                                            @endphp                                        
                                            {{ formatMoney($saldo_mov) }} 
                                        @endif
                                    </td>
                                        
                                    <td>
                                        @if ($item['tipo']=='Factura')
                                            <div class="d-flex order-actions">
                                                <a href="{{asset('storage/pdf/condominio/'.trim($item['codigo']).'.pdf')}}" target="blank" class=""><i class="fa-regular fa-print"></i></a>
                                            </div>
                                        @else
                                            <div class="d-flex order-actions">
                                                <a wire:click.prevent = "showDoc({{$item['document_id']}})" ><i class="fa-solid fa-eye"></i></i></a>
                                            </div>
                                        @endif
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
            
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade " id="showPago"  aria-labelledby="showPago" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex justify-content-between">
                                <h3 class="mb-0 text-primary bordered-heading " style="width: 100%;
                                text-align: center;
                                    ">RECIBO
                                </h3>

                                <div class="float-end">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>    
                            </div>

                            <div>
                                <div class="table-responsive">
                                    <table class="tabla-recibo table-responsive">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    Casa No.
                                                </th>
                                                <td>
                                                    {{$casa_id}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Concepto
                                                </th>
                                                <td style="word-wrap: break-word;
                                                white-space: normal;">
                                                    {{$pago_concepto}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                Fecha
                                                </th>
                                                <td>
                                                    {{ formatFecha($pago_fecha) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                Forma de Pago
                                                </th>
                                                <td>
                                                    {{ $pago_forma }}
                                                </td>
                                            </tr>                                        </tr>
                                            <tr>
                                                <th>
                                                Referencia
                                                </th>
                                                <td>
                                                    {{ $pago_ref }}
                                                </td>
                                            </tr>
                                        </tr>
                                        <tr>
                                            <th>
                                            Monto 
                                            </th>
                                            <td>
                                                {{ formatMoney($pago_monto) }}
                                            </td>
                                        </tr>                                        
                                        </tbody>
                                    </table>
                                </div>    
                            </div>

                  
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
            window.addEventListener('open-showPago', event =>{
                console.log('entro');
                $('#showPago').modal('show');
            });
        </script>
    @endpush


</div>
