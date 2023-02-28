<?php

namespace App\Http\Livewire\Condominio;


use Livewire\Component;
use App\Models\Factura;
use App\Models\Gasto;
use App\Models\Detalle;
use App\Models\Fondo;
use App\Models\Fondo_Detalle;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CreateFacturas extends Component
{
    public $mes_ano, $no_factura,$search, $searchfondo, $tot_gastos, $tot_fondos, $dollar_BCV, $dollar_today, $total_general;
    public $observacion;
    public $facturadas = [];
    public $fondeadas = [];
    public $input = [];
    public $cont = 0;


    public function mount()
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $factura = Factura::orderByDesc('ano')->orderByDesc('mes')->first();
        $observa = $factura->observacion;
        if ($factura->publicado==1) {
            $fecha = Carbon::createFromFormat('d/m/Y','01/'.$factura->mes.'/'.$factura->ano)->addMonth();
            $newFact = Factura::create([
                'mes' => $fecha->format('n'),
                'ano' => $fecha->format('Y'),
                'publicado' => 0,
                'observacion' => $observa,
            ]);
            $this->no_factura = $newFact->id;

            $fondos = Fondo::where('activo',1)->get();

            foreach ($fondos as $fondo) {
                Fondo_Detalle::create([
                    'factura_id' => $newFact->id,
                    'fondo_id' => $fondo->id,
                    'tarifa' => $fondo->monto,
                    'factor' => $fondo->tipo,
                    'activo' => 1,
                 ]);

            }

        } else {
            $fecha = Carbon::createFromFormat('d/m/Y','01/'.$factura->mes.'/'.$factura->ano);
            $this->no_factura = $factura->id;

        }
        $this->observacion = $observa;
        $mes = $meses[($fecha->format('n')) - 1];
        $ano = $fecha->format('Y');
        $this->mes_ano = $mes.'-'.$ano;
        $this->facturadas = Detalle::where('factura_id', $this->no_factura)->pluck('gasto_id')->toArray();
        $this->fondeadas = Fondo_Detalle::where('factura_id', $this->no_factura)->pluck('fondo_id')->toArray();
        $this->dollar_BCV = dolar_BCV();
        
       
    }

    public function render()
    {
        $detalles = Detalle::where('factura_id', $this->no_factura)->orderBy('gasto_id')->get();
        $detalle_fondos = Fondo_Detalle::where('factura_id', $this->no_factura)->orderBy('fondo_id')->get();
        $this->tot_gastos = $detalles->sum('monto');
        foreach ($detalle_fondos as $fondo) {
            if ($fondo->factor == 1) {
                $fondo->monto = ($fondo->tarifa * $this->tot_gastos)/100;
            } else {
                $fondo->monto = $fondo->tarifa;   
            }
            $fondo->save();              
        }
        $this->tot_fondos = $detalle_fondos->sum('monto');
        $gastos = Gasto::where('activo',1)
                ->whereNotIn('id',$this->facturadas)
                ->where('descripcion','like','%'.$this->search.'%')
                ->orderBy('fijo','desc')
                ->orderBy('id')
                ->get();
                
        $fondos = Fondo::where('activo',1)
                ->whereNotIn('id',$this->fondeadas)
                ->where('descripcion','like','%'.$this->searchfondo.'%')
                ->orderBy('tipo','desc')
                ->orderBy('id')
                ->get();

        $this->total_general = $this->tot_gastos + $this->tot_fondos;
        return view('livewire.condominio.create-facturas', compact('gastos','detalles', 'detalle_fondos', 'fondos'));
    }

    public function addGasto($id){
        
        Validator::make($this->input[$id], [
            'monto' => ['required'],
        ])->validate();

        $monto = $this->input[$id]['monto'];
        Detalle::create([
            'factura_id' => $this->no_factura,
            'gasto_id' => $id,
            'monto' => $monto, 
        ]);
        array_push($this->facturadas,$id);
        $this->emit('render');

    }

    public function deleteDetalle($id,$id_gasto){
        
        $pos = array_search($id_gasto, $this->facturadas);
        unset($this->facturadas[$pos]);
        $detalle = Detalle::find($id);
        $detalle->delete();
        
        $this->emit('render');

    }

    public function addFondo($id){
  
        $fondo = Fondo::find($id);
        Fondo_Detalle::create([
            'factura_id' => $this->no_factura,
            'fondo_id' => $fondo->id,
            'tarifa' => $fondo->monto,
            'factor' => $fondo->tipo,
            'activo' => 1,
         ]);
        array_push($this->fondeadas,$id);
     
        $this->emit('render');

    }

    public function deleteFondoDetalle($id,$id_fondo){
        
        $pos = array_search($id_fondo, $this->fondeadas);
        unset($this->fondeadas[$pos]);
        $fondoDetalle = Fondo_Detalle::find($id);
        $fondoDetalle->delete();
        $this->emit('render');

    }

    public function updateObs() {

        $this->dispatchBrowserEvent('close-showObserva');
        $factura = Factura::find($this->no_factura);
        $factura->observacion = $this->observacion;
        $factura->save();
    }
}
