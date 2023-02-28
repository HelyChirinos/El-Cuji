<?php

use Illuminate\Support\Carbon;
use App\Models\Factura;
use App\Models\Pago;
use App\Models\Casa;
use Illuminate\Support\Facades\Auth;

if(!function_exists('formatMoney'))
{
    function formatMoney($number) {
        return number_format($number,2,",",".");
    }
}    

if(!function_exists('formatFecha'))
{
    function formatFecha($fecha) {
        return  Carbon::parse($fecha)->format('d/m/Y');
    }
}    

if(!function_exists('setMesAno'))
{
    function setMesAno($mes,$ano) {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::createFromFormat('d/m/Y','01/'.$mes.'/'.$ano);
        $mes_a = $meses[($fecha->format('n')) - 1];
        return  $mes_a.'-'.$ano;
    }
}

if(!function_exists('saldo_casa'))
{
    function saldo_casa($casa_id) {

        $casa  = Casa::find($casa_id);
        $saldo_i = $casa->saldo_inicial;
        $factura = Factura::where('publicado',1)
        ->get();   
     
        $saldo = round(($factura->sum('monto')/30),2)+$saldo_i;

        $pagos = Pago:: where('casa_id',$casa_id)
        ->get();
        
        $total_pagos = $pagos->sum('monto');  
        $saldo = $saldo-$total_pagos;  

        return round($saldo,2);
    }
} 

if(!function_exists('ctas_x_cobrar'))
{
    function ctas_x_cobrar() {
        $casas = Casa::select('casa_no')->orderBy('id')->get();
        $saldo = 0;
        foreach ($casas as $casa) {
            $saldo = $saldo + saldo_casa($casa->casa_no);
        }
        return $saldo;
    }
}

if(!function_exists('total_deudores'))
{
    function total_deudores() {
        $casas = Casa::select('casa_no')->orderBy('id')->get();
        $total = 0;
        foreach ($casas as $casa) {
           if (round(saldo_casa($casa->casa_no))>0) {
             $total = $total+1;
           }
        }
        return $total;
    }
} 



if(!function_exists('dolar_BCV'))
{
    function dolar_BCV () {
        $dolar_bcv = 1;
        try{
            @$data = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
            if ($data == false) {
               return $dolar_bcv;   
            }
        } catch(Exception $e){

            echo "Load Failed\n";
             return $dolar_bcv;

        }

        $json  = iso8859_1_to_utf8($data);
        // $data = utf8_encode($data);
        $cambio = json_decode($json ,true);
        if ($cambio) {
            $dolar_bcv = $cambio['USD']['promedio_real'];
        } else {
            $dolar_bcv = 1;
        }

        return $dolar_bcv;
    }
} 


if(!function_exists('dolar_today'))
{
    function dolar_today () {
        $dolar_today = 1;
        $data = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
        $json = iso8859_1_to_utf8($data);
        $cambio = json_decode($json,true);
        if ($cambio) {
            $dolar_today = $cambio['USD']['promedio'];
        } else {
            $dolar_today = 1;
        }

        return $dolar_today;
    }
} 

function iso8859_1_to_utf8(string $s): string {
    $s .= $s;
    $len = \strlen($s);

    for ($i = $len >> 1, $j = 0; $i < $len; ++$i, ++$j) {
        switch (true) {
            case $s[$i] < "\x80": $s[$j] = $s[$i]; break;
            case $s[$i] < "\xC0": $s[$j] = "\xC2"; $s[++$j] = $s[$i]; break;
            default: $s[$j] = "\xC3"; $s[++$j] = \chr(\ord($s[$i]) - 64); break;
        }
    }

    return substr($s, 0, $j);
}


if(!function_exists('is_admin'))
{
   function is_admin() {
        return Auth::user()->rol_id == 0;

   }

}

if(!function_exists('is_owner'))
{
   function is_owner() {
       return Auth::user()->propietario == 1;
   }

}

if(!function_exists('no_de_casas'))
{
   function no_de_casas() {
       return Auth::user()->casas->count();
   }

}

