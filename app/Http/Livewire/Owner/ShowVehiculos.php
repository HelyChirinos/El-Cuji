<?php

namespace App\Http\Livewire\Owner;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Casa;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Storage;


class ShowVehiculos extends Component
{
    use WithFileUploads;
    public $search, $foto, $newVehiculo, $vehiculoUpdate, $deleteVehiculo, $placa, $modelo, $marca, $ano, $color;
    public $input = [];
    public $paginator = 10;
    public $clase = "";
    public $init_foto;
    
    public function render()
    {
        $vehiculos = Vehiculo::where('casa_id',session('casa_no'))->paginate($this->paginator);
        return view('livewire.owner.show-vehiculos', compact('vehiculos'));
    }

    public function save() {
        Validator::make($this->input, [
            'placa' => ['required', 'string', 'max:255'],
            'marca' => ['required', 'string', 'max:255'],
            'modelo' => ['required', 'string', 'max:255'],
            'ano' => ['required', 'string', 'max:255' ],
            'color' => ['required','string','max:255'],
        ])->validate();

         $this->newVehiculo = Vehiculo::create([
            'casa_id'=> session('casa_no'),
             'clase' => $this->clase,
             'marca' => ucfirst($this->input['marca']),
             'placa' => strtoupper($this->input['placa']) ,
             'modelo' => ucfirst($this->input['modelo']),
             'ano' => $this->input['ano'],
             'color' => ucfirst($this->input['color']),
         ]);
         if(isset($this->foto)) {
                $urlimage = $this->foto->storePublicly('vehiculos','public');
                $this->newVehiculo->vehiculo_path=$urlimage;
                $this->newVehiculo->save();
        }
         $this->dispatchBrowserEvent('close-modal');
         $this->dispatchBrowserEvent('alert', 
         ['type' => 'success','message' => 'Se agrego un nuevo Vehiculo'
        ]);
        $this->input=[];
        $this->foto = Null;
        $this->clase = "";
        $this->emit('render');        
        return;
    }

    public function edit($id) {

        $this->vehiculoUpdate = Vehiculo::find($id);
        $this->clase=$this->vehiculoUpdate->clase;
        $this->input['marca']=$this->vehiculoUpdate->marca;
        $this->input['placa']=$this->vehiculoUpdate->placa;
        $this->input['modelo']=$this->vehiculoUpdate->modelo;
        $this->input['ano']=$this->vehiculoUpdate->ano;
        $this->input['color']=$this->vehiculoUpdate->color;
        if ($this->vehiculoUpdate->vehiculo_path) {
            $this->init_foto = 'storage/'.$this->vehiculoUpdate->vehiculo_path;
        } else {
            $this->init_foto = 'assets/images/no-vehiculo.jpeg';
        }

        $this->dispatchBrowserEvent('open-edit-modal');
 
    }

    public function update() {
        Validator::make($this->input, [
            'placa' => ['required', 'string', 'max:255'],
            'marca' => ['required', 'string', 'max:255'],
            'modelo' => ['required', 'string', 'max:255'],
            'ano' => ['required', 'string', 'max:255' ],
            'color' => ['required','string','max:255'],
        ])->validate();

        $this->validate([
            'foto' => 'image|max:1024', // 1MB Max
        ]);

        $this->vehiculoUpdate->clase = $this->clase;
        $this->vehiculoUpdate->marca = ucfirst($this->input['marca']);
        $this->vehiculoUpdate->placa = strtoupper($this->input['placa']);
        $this->vehiculoUpdate->modelo = ucfirst($this->input['modelo']);
        $this->vehiculoUpdate->ano = $this->input['ano'];
        $this->vehiculoUpdate->color = ucfirst($this->input['color']);
        
         if(isset($this->foto)) {
                Storage::disk('public')->delete($this->vehiculoUpdate->vehiculo_path);
                $urlimage = $this->foto->storePublicly('vehiculos','public');
                $this->vehiculoUpdate->vehiculo_path=$urlimage;
        }

        $this->vehiculoUpdate->save();
         $this->emit('render'); 
         $this->dispatchBrowserEvent('close-modal-update');
         $this->dispatchBrowserEvent('alert', 
         ['type' => 'success','message' => 'Se Actualizó la información del Vehiculo'
        ]);
        $this->input=[];
        $this->foto = Null;
        $this->clase = "";
       
        return;
    }

    public function show($id) {

        $vehiculo = Vehiculo::find($id);
        $this->clase=$vehiculo->clase;
        $this->marca =$vehiculo->marca;
        $this->placa =$vehiculo->placa;
        $this->modelo=$vehiculo->modelo;
        $this->ano = $vehiculo->ano;
        $this->color =$vehiculo->color;
        if ($vehiculo->vehiculo_path) {
            $this->init_foto = 'storage/'.$vehiculo->vehiculo_path;
        } else {
            $this->init_foto = 'assets/images/no-vehiculo.jpeg';
        }

        $this->dispatchBrowserEvent('open-show-modal');
 
    }

    public function showDelete($id) {

        $this->deleteVehiculo = Vehiculo::find($id);
        if ($this->deleteVehiculo->vehiculo_path) {
            $this->init_foto = 'storage/'.$this->deleteVehiculo->vehiculo_path;
        } else {
            $this->init_foto = 'assets/images/no-vehiculo.jpeg';
        }

        $this->dispatchBrowserEvent('open-delete-modal');
 
    }

    public function delete() {
        if ($this->deleteVehiculo->vehiculo_path) {
            Storage::disk('public')->delete($this->deleteVehiculo->vehiculo_path);
        } 
        $this->deleteVehiculo->delete();
        $this->deleteVehiculo=Null;
        $this->emit('render'); 
        $this->dispatchBrowserEvent('close-delete-modal');
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success','message' => 'Se Elimino la información del Vehiculo'
       ]);


    }

    public function clearVar()
    {
       $this->input=[];
       $this->foto = Null;
       $this->clase = "";

    }   

}
