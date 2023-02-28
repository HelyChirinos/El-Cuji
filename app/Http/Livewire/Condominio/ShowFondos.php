<?php

namespace App\Http\Livewire\Condominio;

use App\Models\Fondo;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;

class ShowFondos extends Component
{

    public $descripcion,$search, $fondo_update;
    public $paginator = 10;
    public $tipo = 1;
    public $monto = 0;
    
    protected $listeners = ['fondoDelete'];

    public function render()
    {
        $fondos = Fondo::where('activo',1)
        ->where('descripcion','like','%'.$this->search.'%')
        ->orderBy('tipo','desc')
        ->orderBy('id')
        ->paginate($this->paginator);
        return view('livewire.condominio.show-fondos', compact('fondos'));
    }

    public function save() {
        $this->validate([
            'descripcion' => 'required|string|max:255',
            'monto' => 'required|numeric',
        ]);
        Fondo::create([
             'descripcion' => $this->descripcion,
             'monto' => $this->monto,
             'activo' => 1,
             'tipo' => $this->tipo, 
         ]);
         $this->descripcion='';
         $this->tipo=1;
         $this->monto=0;
         $this->emit('render');        
         $this->dispatchBrowserEvent('close-addFondo');
         $this->dispatchBrowserEvent('alert',[
            'type' => 'success','message' => 'Se agrego un nuevo fondo'
        ]);
    }

    public function edit($id) {
        $this->fondo_update = Fondo::find($id);
        $this->descripcion = $this->fondo_update->descripcion;
        $this->monto = $this->fondo_update->monto;
        $this->tipo = $this->fondo_update->tipo;
        $this->dispatchBrowserEvent('open-updateFondo');
    }

    public function update() {
        $this->validate([
            'descripcion' => 'required|string|max:255',
            'monto' => 'required|numeric',
        ]);
        $this->fondo_update->descripcion = $this->descripcion;
        $this->fondo_update->monto = $this->monto;
        $this->fondo_update->tipo = $this->tipo;
        $this->fondo_update->save();
  
        $this->descripcion='';
        $this->monto=0;
        $this->tipo=1;
        $this->emit('render');        
        $this->dispatchBrowserEvent('close-updateFondo');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  
            'message' => 'Se actulizo el fondo correctamente']);

    }

    public function fondoDelete($id) {

        $fondo = Fondo::find($id);
        $fondo->activo = 0;
        $fondo->save();
        $this->emit('render');        
    }



}

