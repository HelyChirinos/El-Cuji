<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Http\Controllers\PdfController;
Use App\Models\Casa;
use Illuminate\Support\Carbon;
use App\Mail\CondominioMail;
use Illuminate\Support\Facades\Mail;

class PublicaController extends Controller
{
    public function publicar() {

        $data =  (new PdfController)->showPDF('storage');
        $dolar_BCV = $data['dolar'];
        $path = $data['path'];
        $total = $data['total'];
        $no_factura= $data['no_factura'];
        $mes_ano= $data['mes_ano'];
        $factura = Factura::find($no_factura);
        $factura->publicado = 1;
        $factura->fecha = Carbon::now();
        $factura->monto = $total;
        $factura->dolar = $dolar_BCV;
        $factura->file_path = $path;

        $casas = Casa::orderBy('id')->get();
        foreach ($casas as $casa) {
            $casa->saldo = $casa->saldo+($total/30);
            $casa->save();
            foreach ($casa->owners as $owner) {
                if (($casa->id==21) or ($casa->id == 28) ) {
                    Mail::to($owner->email)->send(new CondominioMail($path, $mes_ano, $owner->name, $dolar_BCV, $total));
                }
            }
        };

        $factura->save();
        return redirect()->route('facturas');

    }
}
