<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Detalle;
use App\Models\Fondo_Detalle;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    
    public function showPDF($via)

    {

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $factura = Factura::orderByDesc('ano')->orderByDesc('mes')->first();
        $fecha = Carbon::createFromFormat('d/m/Y','01/'.$factura->mes.'/'.$factura->ano);
        $no_factura = $factura->id;
        $observacion = $factura->observacion;
        $mes = $meses[($fecha->format('n')) - 1];
        $ano = $fecha->format('Y');
        $mes_ano = $mes.'-'.$ano;
        $data = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
        $json = utf8_encode($data);
        $cambio = json_decode($json,true);
        if ($cambio) {
            $dolar_BCV = $cambio['USD']['promedio_real'];
            $dolar_today = $cambio['USD']['promedio'];
        } else {
            $dolar_BCV = 1;
            $dolar_today = 1;
        }

        $detalles = Detalle::where('factura_id', $no_factura)->orderBy('gasto_id')->get();
        $tot_gastos = $detalles->sum('monto');
        $detalle_fondos = Fondo_Detalle::where('factura_id', $no_factura)->orderBy('fondo_id')->get();
        foreach ($detalle_fondos as $fondo) {
            if ($fondo->factor == 1) {
                $fondo->monto = ($fondo->tarifa * $tot_gastos)/100;
            } else {
                $fondo->monto = $fondo->tarifa;   
            }
            $fondo->save();              
        }
        $tot_fondos = $detalle_fondos->sum('monto');
        $pdf = Pdf::loadView('admin.condominio.pdf.facturapdf',compact('mes_ano','detalles','tot_gastos','dolar_BCV','detalle_fondos','tot_fondos','observacion'));
        if ($via=='stream') {
            return $pdf->stream();
        } 
        if ($via=='storage') {
             $path = 'storage/pdf/condominio/';
             $fileName = $mes_ano.'.pdf';
             $pdf->save($path.$fileName);
             return ['path'=>$path.$fileName,'dolar'=>$dolar_BCV,'total'=>$tot_fondos+$tot_gastos,'no_factura'=>$no_factura, 'mes_ano'=>$mes_ano];
        }
        return view('admin.condominio.pdf.facturapdf',compact('mes_ano','detalles','tot_gastos','dolar_BCV','detalle_fondos','tot_fondos','observacion'));

    }

    public function showOldPDF($via)

    {

       
        return view('admin.condominio.pdf.facturapdf');

    }


}
