<!DOCTYPE html>
<html lang="en">
    <head>
        <title>El Cují - Condominio</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--favicon-->
        <link rel="icon" href="{{asset('assets/images/logo.jpg')}}" type="image/jpg" />
        <!--plugins-->
        <link href="{{public_path('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{public_path('assets/css/pdf.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">

                <div class="col-sm-4" style="width: 30%">
                    <img src="{{asset('assets/images/logos/logo_cuji.png')}}" class="logo pt-2" alt="">
                    <p class="ps-2">Rif. No.: J-30531533-7 </p>
                </div>
                <div class="col-sm-8 text-center" style="width: 70%">
                    <h3>RELACION DE GASTOS <br> {{$mes_ano}} </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
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
                                        </tr>
                                        <tr>
                                            <th>Descripción</th>
                                            <th class="text-center" >$</th>
                                            <th class="text-center" >$</th>
                                            <th class="text-center"  >Bs.</th>
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
                                                    <td>   {{number_format((($detalle->monto/30)*$dolar_BCV),2,",",".")}}</td>

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
                                            <td class="text-end fw-bold px-3">
                                            SUB-TOTAL
                                            </td>
                                            <td class="text fw-bold">
                                                {{number_format($tot_gastos,2,",",".")}}
                                            </td>
                                            <td class="text fw-bold">
                                                {{number_format(($tot_gastos/30),2,",",".")}}
                                            </td>
                                            <td class="text fw-bold">
                                                {{number_format(($tot_gastos/30)*$dolar_BCV,2,",",".")}}
                                            </td>
                                        </tr>
                                    </tfoot>     
                                </table>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </body>
</html>