<?php

namespace App\Http\Livewire\Condominio;

use App\Models\Gasto;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;

class ShowGastos extends Component
{
    public $descripcion,$search, $gasto_update;
    public $paginator = 10;
    public $fijo = 0;
    
    protected $listeners = ['gastoDelete'];

    public function render()
    {
        $gastos = Gasto::where('activo',1)
        ->where('descripcion','like','%'.$this->search.'%')
        ->orderBy('fijo','desc')
        ->orderBy('id')
        ->paginate($this->paginator);
        return view('livewire.condominio.show-gastos', compact('gastos'));
    }

    public function save() {

        $this->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        Gasto::create([
             'descripcion' => $this->descripcion,
             'activo' => 1,
             'fijo' => $this->fijo, 
         ]);

         $this->descripcion='';
         $this->fijo=0;
         $this->emit('render');        
         $this->dispatchBrowserEvent('close-addGastos');
         $this->dispatchBrowserEvent('alert',[
            'type' => 'success','message' => 'Se agrego un nuevo gasto'
        ]);
    }

    public function edit($id) {

        $this->gasto_update = Gasto::find($id);
        $this->descripcion = $this->gasto_update->descripcion;
        $this->fijo = $this->gasto_update->fijo;
        $this->dispatchBrowserEvent('open-updateGastos');

    }


    public function update() {

        $this->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $this->gasto_update->descripcion = $this->descripcion;
        $this->gasto_update->fijo = $this->fijo;
        $this->gasto_update->save();
  
        $this->descripcion='';
        $this->fijo=0;
        $this->emit('render');        
        $this->dispatchBrowserEvent('close-updateGastos');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  
            'message' => 'Se actulizo el gasto correctamente']);

    }

    public function gastoDelete($id) {

        $gasto = Gasto::find($id);
        $gasto->activo = 0;
        $gasto->save();
        $this->emit('render');        
    }



}
