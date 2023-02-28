<!DOCTYPE html>
<html lang="en">
    
    <head>
        <title>El Cují - PDF</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--favicon-->
        <link rel="icon" href="{{asset('assets/images/logo.jpg')}}" type="image/jpg" />
        <!--plugins-->
        <link href="{{public_path('assets/css/pdf/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{public_path('assets/css/pdf/pdf.css')}}" rel="stylesheet" type="text/css">

       <!--plugins-->
       <link href="{{asset('assets/css/pdf/bootstrap.min.css')}}" rel="stylesheet">
       <link href="{{asset('assets/css/pdf/pdf.css')}}" rel="stylesheet">
    <style>
    .table>tbody>tr>td{
        padding: 2px;
        line-height: 1.42857143;
        vertical-align: middle;
        border-top: 1px solid #ddd;
    }
    .table>thead>tr>th, .table>tfoot>tr>td  {
        padding: 4px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

    </style>          
    </head>
    <body>
        <div class="container">
            <div class="row">

                <div class="column-3" style="padding-left:10%;">
                    <img src="{{asset('assets/images/logos/logo_cuji.png')}}" class="logo pt-2" alt="">
                    <p class="ps-2">Rif. No.: J-30531533-7 </p>
                </div>
                <div class="column-7">
                    <h3 style="text-align: center; margin-right: 20%;">
                        RELACION DE GASTOS <br> {{$mes_ano}} 
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="show-table">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Gastos</th>
                                    <th class="text-center">Monto</th>
                                    <th colspan="2" class="text-center" style="border-bottom-color: black; border-bottom-width: 1px; border-bottom-style:solid;" >Cuota</th>
                                </tr>
                                <tr>
                                    <th>Descripción</th>
                                    <th class="text-center">$</th>
                                    <th class="text-center" style="border-bottom-color: black; border-bottom-width: 1px; border-bottom-style:solid;">$</th>
                                    <th class="text-center" style="border-bottom-color: black; border-bottom-width: 1px; border-bottom-style:solid;">Bs.</th>
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
                                    <td  >
                                        <strong  style="float:right; padding-right:2rem;">SUB-TOTAL GASTOS</strong> 
                                    </td>
                                    <td style="font-weight: bold; border-top: 1px solid black;">
                                        {{number_format($tot_gastos,2,",",".")}}
                                    </td>
                                    <td style="font-weight: bold; border-top: 1px solid black;">
                                        {{number_format(($tot_gastos/30),2,",",".")}}
                                    </td>
                                    <td style="font-weight: bold; border-top: 1px solid black;">
                                        {{number_format(($tot_gastos/30)*$dolar_BCV,2,",",".")}}
                                    </td>
                                </tr>
                            </tfoot>     
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="show-table">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="2" class="text-center">Fondos</th>
                                    <th class="text-center">Monto</th>
                                    <th colspan="2" class="text-center" style="border-bottom-color: black; border-bottom-width: 1px; border-bottom-style:solid;" >Cuota</th>
                                </tr>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Tarifa</th>
                                    <th class="text-center">$</th>
                                    <th class="text-center" style="border-bottom-color: black; border-bottom-width: 1px; border-bottom-style:solid;">$</th>
                                    <th class="text-center" style="border-bottom-color: black; border-bottom-width: 1px; border-bottom-style:solid;">Bs.</th>
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
                                                    {{ '$ '.number_format($d_fondo->tarifa,2,",",".") }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ number_format($d_fondo->monto,2,",",".")}}

                                            </td>
                                            <td>
                                                {{ number_format(($d_fondo->monto/30),2,",",".") }}
                                            </td>
                                            <td>
                                                {{ number_format(($d_fondo->monto/30)*$dolar_BCV,2,",",".") }}
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
                                    <td colspan="2" >
                                        <strong  style="float:right; padding-right:2rem;">SUB-TOTAL FONDOS</strong> 
                                    </td>
                                    <td style="font-weight: bold; border-top: 1px solid black;">
                                        {{number_format($tot_fondos,2,",",".")}}
                                    </td>
                                    <td style="font-weight: bold; border-top: 1px solid black;">
                                        {{number_format(($tot_fondos/30),2,",",".")}}
                                    </td>
                                    <td style="font-weight: bold; border-top: 1px solid black; ">
                                        {{number_format(($tot_fondos/30)*$dolar_BCV,2,",",".")}}
                                    </td>
                                </tr>
                            </tfoot>     
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="show-table">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="2" class="text-center"></th>
                                    <th class="text-center">Monto</th>
                                    <th colspan="2" class="text-center" style="border-bottom-color: black; border-bottom-width: 1px; border-bottom-style:solid;" > Su Cuota</th>
                                </tr>
                                <tr>
                                    <th rowspan="2" style="vertical-align : middle;text-align:center;   
                                        border-right-color: rgb(221, 221, 221); 
                                        border-right-width: 1px; 
                                        border-right-style:solid;
                                        color:blue;
                                  ">TOTAL CONDOMINIO</th>
                                    <th class="text-center">{{'Dolar al '. date("d-m") }}</th>
                                    <th class="text-center">$</th>
                                    <th class="text-center" style="border-bottom-color: black; border-bottom-width: 1px; border-bottom-style:solid;">$</th>
                                    <th class="text-center" style="border-bottom-color: black; border-bottom-width: 1px; border-bottom-style:solid;">Bs.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td class="text-center"> {{ number_format($dolar_BCV,2,",",".")}}</td>
                                    <td class="text-center">{{ number_format($tot_gastos+$tot_fondos,2,",",".")}}</td>
                                    <td class="text-center" style="font-weight: bold; fon-size:16px; ">{{ number_format(($tot_gastos+$tot_fondos)/30,2,",",".") }}</td>
                                    <td class="text-center" style="font-weight: bold; fon-size:16px; ">{{ number_format((($tot_gastos+$tot_fondos)/30) * $dolar_BCV,2,",",".") }}</td>

                                </tr>
                            </tbody>
                            <tfoot>

                            </tfoot>     
                        </table>
                    </div>
                </div>
                <div class="text-center" style="color:red;">
                    {{'Paga tu Condominio antes del: 15-'.date('m-Y') }}
                </div>
            </div>
            <div class="row"> 
                <div class="show-table" style="padding-top: 2rem;">
                    {!! $observacion !!}
                </div>
            </div>
        </div>
    </body>
</html>