<?php

namespace App\Http\Livewire\Condominio;

use Livewire\Component;
use App\Models\Pago;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use App\Models\Casa;

class ShowPagos extends Component
{
    public $search, $concepto, $monto, $referencia, $fecha ,$casa; 
    public $paginator = 10;
    public $input = [];
    public  $forma_pago="";
    protected $listeners = ['casaChange','pagoDelete'];

    public function render()
    {
        $pagos = Pago::where('concepto','like','%'.$this->search.'%')
        ->orWhere('casa_id','like','%'.$this->search.'%')
        ->orderBy('fecha','desc')
        ->orderBy('id')
        ->paginate($this->paginator);  
        
        $casas = Casa::orderBy('id')->pluck('casa_no', 'id');
        return view('livewire.condominio.show-pagos',compact('pagos','casas'));
    }

    public function casaChange($cambio) {
        $this->casa = $cambio;

    }

    public function save() {


        $validatedData = $this->validate([
            'concepto' => 'string|max:255',
            'fecha' => 'required|date',
            'monto' => 'required|numeric|gt:0',
            'referencia' => 'nullable|string',
        ]);
        
        $casa = Casa::find($this->casa);
        $casa->saldo = $casa->saldo-$this->monto;
        $casa->save();

        Pago::create([
            'casa_id'=> $this->casa,
            'concepto' => $this->concepto,
            'fecha' => $this->fecha,
            'monto' => $this->monto,
            'forma_pago' => $this->forma_pago,
            'referencia' => $this->referencia,
        ]);
        $this->resetExcept('search','paginator');
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success','message' => 'Se agrego un nuevo Pago'
       ]);
       $this->emit('render');     

    }

    public function pagoDelete($id) {
        $pago = Pago::find($id);
        $id_casa = $pago->casa_id;
        $casa = Casa::find($id_casa);
        $casa->saldo = $casa->saldo + $pago->monto;
        $casa->save();
        $pago->delete();
        $this->emit('render'); 
    }
}
