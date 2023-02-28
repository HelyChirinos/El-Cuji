<?php

namespace App\Http\Livewire\Owner;

use Livewire\Component;
use App\Models\Factura;
use App\Models\Casa;
use App\Models\Pago;
use Illuminate\Support\Carbon;

class ShowCasa extends Component
{
    public $movimientos, $casa_id, $fechaFilter, $saldo_helper ;
    public $saldo,$saldo_fecha,$saldo_mov = 0;
    public $pago_fecha, $pago_concepto, $pago_forma, $pago_ref,$pago_monto;

    public function mount($casa_id)
    {
        $this->saldo_helper = saldo_casa($casa_id);
        $this->casa_id = $casa_id;
        $total_pagos = 0;
        $filterDate = Carbon::now()->subMonths(5);
        $casa  = Casa::find($casa_id);
        $saldo_i = $casa->saldo_inicial;

        $factura = Factura::select('id','fecha','monto','mes','ano')
        ->where('publicado',1)
        ->orderByDesc('fecha')
        ->get();

        $saldo = ($factura->sum('monto')/30)+$saldo_i;
        $factShow = $factura->where('fecha','>',$filterDate);
        $saldo_fecha = $saldo - ($factShow->sum('monto'))/30;

        $a_factura = $factShow->toArray(); 
    
        foreach ($a_factura as &$fact) {
            $fact["document_id"] = $fact['id'];
            $fact["tipo"] = "Factura";
            $fact["codigo"]=setMesAno($fact['mes'],$fact['ano']);
            unset($fact['mes'],$fact['ano'],$fact['id']); 
        }

        $pagos = Pago:: select('id','fecha','monto')
            ->where('casa_id',$casa_id)
            ->orderByDesc('fecha')
            ->get();

        if ($pagos->count()) {
            $total_pagos = $pagos->sum('monto');  
            $saldo = $saldo-$total_pagos;  
        }    
        $pagosShow = $pagos->where('fecha','>',$filterDate);    
        $pagos_fecha = $total_pagos - $pagosShow->sum('monto');
        $saldo_fecha = $saldo_fecha - $pagos_fecha;

        $this->saldo = $saldo;
        $this->saldo_fecha = $saldo_fecha;
        $this->fechaFilter = $filterDate;
        $this->saldo_mov = $saldo_fecha;

        $a_pagos = $pagosShow->toArray();
        foreach ($a_pagos as &$pago) {
            $pago["document_id"] = $pago['id'];
            $pago["tipo"] = 'Recibo';
            $pago["codigo"] = date_timestamp_get(date_create($pago['fecha']));
            unset($pago['id']);
        }
        
        $mov = array_merge($a_factura,$a_pagos);
        $fechas = array_column($mov, 'fecha');
        array_multisort($fechas, SORT_ASC, $mov);

        $this->movimientos = collect($mov);
    }


    public function render()
    {
        return view('livewire.owner.show-casa',['movimientos'=>$this->movimientos]);
    }


    public function showDoc ($id) {
  
        $pago = Pago::find($id);
        $this->pago_concepto = $pago->concepto;
        $this->pago_fecha = $pago->fecha;
        $this->pago_forma = $pago->forma_pago;
        $this->pago_ref = $pago->referencia;
        $this->pago_monto = $pago->monto;
        $this->dispatchBrowserEvent('open-showPago');
    }

}
