<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Factura;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Mail\CondominioMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Pago;
use Illuminate\Support\Facades\Auth;

class PruebasController extends Controller
{

    public function nombres()
    {
        $user = User::find(3);
     
        $nombre = strpos(trim($user->nombre)," ") ? substr($user->nombre,0,strpos(trim($user->nombre)," ")) :  trim($user->nombre);
        $apellido = strpos(trim($user->apellido)," ") ? substr($user->apellido,0,strpos(trim($user->apellido)," ")) : trim($user->apellido);

        $nombre_completo = $nombre.' '.$apellido;
        
        dd($nombre_completo);

        return view('/admin');
    }

    public function implode_users()
    {
        $array =[];
        $casa = Casa::find(10);
        $owners = $casa->owners;
  
        foreach ($owners as $owner) {
            $comilla = '"';
            $texto ="<a wire:click.prevent='prueba(".$comilla.$owner->id.$comilla.")' href=''>".$owner->name."</a>";
            array_push($array,$texto);
        }
        dd(implode(' - ',$array));

        return view('/admin');
    }

    public function use_carbon()
    {
        
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $factura = Factura::orderByDesc('ano')->orderByDesc('mes')->first();
        if ($factura->publicado==1) {
            $fecha = Carbon::createFromFormat('d/m/Y','01/'.$factura->mes.'/'.$factura->ano)->addMonth();
            # crear factura
        } else {
            $fecha = Carbon::createFromFormat('d/m/Y','01/'.$factura->mes.'/'.$factura->ano);
        }
      
        $mes = $meses[($fecha->format('n')) - 1];
        $ano = $fecha->format('Y');
        dd($mes.'-'.$ano);

        return view('/admin');
    }

    public function setItem()
    {
        $casas = Casa::all();

        $casas->map(function ($item)
        {
            $item['status'] = 1;
            return $item;
        });

       dd($casas->toJson());
    }

    public function dolar()
    {

        $data = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
        $cambio = json_decode($data,true);
        $bcv = $cambio['USD']['promedio_real'];
        $dollar_today = $cambio['USD']['promedio'];
        dd('BCV: '.$bcv.' ===> Dollar Today: '.$dollar_today);
    }

    public function emails()
    {
        $nombre='Hely Chirinos';
        $email="helychirinos@gmail.com";
        $attach = 'storage/pdf/condominio/Junio-2022.pdf';
        $mes_ano = 'Julio-2022';
        $dolar_BCV = '19.90';
        $total = '552';
        $destinatarios = ['JesusDaniel@example.com'];
        foreach ($destinatarios as $destino) {
            Mail::to($destino)->send(new CondominioMail($attach, $mes_ano, $nombre, $dolar_BCV, $total));
        }

        dd('ENVIADO');
 
    }

    public function movimientos() {
        
  //      $posts = Post::latest()->take(10)->get();  
  
        $filterDate = Carbon::now()->subMonths(5);
        $casa  = Casa::find(21);
        $saldo_i = $casa->saldo_inicial;
        $factura = Factura::select('id','fecha','monto','mes','ano')
            ->where('publicado',1)
            ->orderBy('fecha')
            ->get();
        $saldo = $factura->sum('monto')+$saldo_i;

        $factura2 = $factura->where('fecha','>',$filterDate);
        $saldo = $saldo - $factura2->sum('monto');
        $a_factura = $factura2->toArray(); 
        
        foreach ($a_factura as &$fact) {
            $fact["document_id"] = $fact['id'];
            $fact["tipo"] = "Factura";
            $fact["codigo"]=setMesAno($fact['mes'],$fact['ano']);
            unset($fact['mes'],$fact['ano'],$fact['id']); 
        }

        $total_pagos = 0;
        $pagos = Pago:: select('id','fecha','monto')
            ->where('casa_id',21)
            ->orderBy('fecha')
            ->get();
          
        $total_pagos = $pagos->sum('monto');
        $pagos2 = $pagos->where('fecha','>',$filterDate);    
        $total_pagos = $total_pagos - $pagos2->sum('monto');
        $saldo = $saldo-$total_pagos;

        $a_pagos = $pagos->toArray();
        foreach ($a_pagos as &$pago) {
            $pago["document_id"] = $pago['id'];
            $pago["tipo"] = 'Recibo';
            $pago["codigo"] = date_timestamp_get(date_create($pago['fecha']));
            unset($pago['id']);
        }
        
        $movimientos = array_merge($a_factura,$a_pagos);
        $fechas = array_column($movimientos, 'fecha');
        array_multisort($fechas, SORT_DESC, $movimientos);

        $mov = collect($movimientos);
        dd($mov);

    }

    public function casa_data() {
        $is_admin = Auth::user()->rol_id == 0;
        $is_propietario = Auth::user()->propietario == 1;
        $no_de_casas = Auth::user()->casas->count(); 
        if (session()->has('casa_no')) {
            $valor_almacenado = session('casa_no');
        } else {
            $valor_almacenado = 'NO HAY SESSION';
   
        }
        dd($valor_almacenado);

    }
 

}
