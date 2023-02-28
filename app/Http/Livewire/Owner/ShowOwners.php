<?php

namespace App\Http\Livewire\Owner;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Casa;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ShowOwners extends Component
{
    public $observacion,$newUser,$id_owner,$OwnwerUpdate,$house,$num_casa,$search, $saldo_init;
    public $casas = [];
    public $input = [];
    public $paginator = 10;
    
    protected $listeners = ['casasAdd','casasUpdate','clearVar','casaDelete'];

    public function render()
    {
        
        $casas_owner = Casa::with('owners')
        ->orWhereHas('owners', function($q) {
            $q->where('users.nombre','like','%'.$this->search.'%')
            ->orWhere('users.apellido','like','%'.$this->search.'%')
            ->orwhere('casas.casa_no','like','%'.$this->search.'%')
            ->orWhere('casas.observacion','like','%'.$this->search.'%');            
        })
        ->orderBy('id')->paginate($this->paginator);

        $todas = Casa::orderBy('id')->pluck('casa_no', 'id');
        return view('livewire..owner.show-owners', compact('casas_owner','todas'));
    }

    public function casasAdd($a_casas) {
        $this->casas = $a_casas;
        $this->newUser->casas()->attach(array_values($this->casas));
    }
 
    public function casasUpdate($u_casas) {
        $this->casas = $u_casas;
        $this->OwnwerUpdate->casas()->sync(array_values($this->casas));
    }

    public function edit_obs($id) {
        $this->house = Casa::find($id);
        $this->num_casa = $this->house->casa_no;
        $this->observacion = $this->house->observacion;
        $this->saldo_init = $this->house->saldo_inicial;
        $this->dispatchBrowserEvent('show-edit-obs');        
    }
   
    public function save_obs() {
        $this->house->observacion = $this->observacion;
        $this->house->saldo_inicial = $this->saldo_init;
        $this->house->save();
        $this->dispatchBrowserEvent('close-edit-obs');  
        $this->dispatchBrowserEvent('alert', 
        [
           'type' => 'success',  
           'message' => 'Se actualizaron las Observaciones'
       ]);
       $this->emit('render');        
    }

    public function save() {
        Validator::make($this->input, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'max:10', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['nullable'],
            'fecha_nac' => ['nullable','date'],

        ])->validate();

        if (!isset($this->input['telefono'])) { 
            $this->input['telefono'] = null;
        }
        if (!isset($this->input['fecha_nac'])) { 
            $this->input['fecha_nac'] = null;
        }
         $this->newUser = User::create([
             'nombre' => $this->input['nombre'],
             'apellido' => $this->input['apellido'],
             'cedula' => $this->input['cedula'],
             'email' => $this->input['email'],
             'password' => Hash::make(trim($this->input['cedula'])),
             'telefono' => $this->input['telefono'],
             'fecha_nac' => $this->input['fecha_nac'],
             'propietario' => 1,
         ]);

         $this->dispatchBrowserEvent('close-modal');
         $this->dispatchBrowserEvent('alert', 
         ['type' => 'success','message' => 'Se agrego un nuevo Propietario'
        ]);
        $this->emit('render');        
        $this->input=[];

        return;
    }

    public function edit($id) {

       $this->OwnwerUpdate = User::find($id);
       $no_casas = $this->OwnwerUpdate->casas->pluck('casa_no');
       $this->input['nombre']=$this->OwnwerUpdate->nombre;
       $this->input['apellido']=$this->OwnwerUpdate->apellido;
       $this->input['cedula']=$this->OwnwerUpdate->cedula;
       $this->input['email']=$this->OwnwerUpdate->email;
       $this->input['telefono']=$this->OwnwerUpdate->telefono;
       $this->input['fecha_nac']=$this->OwnwerUpdate->fecha_nac;
       $this->input['propietario']=$this->OwnwerUpdate->propietario;
       $this->dispatchBrowserEvent('show-edit-owner', ['casas' => $no_casas]);

    }

    public function updateUser() {

        $UserValidate = Validator::make($this->input, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telefono' => ['nullable'],
            'fecha_nac' => ['nullable'],
        ])->validate();

        $this->OwnwerUpdate->nombre = $this->input['nombre'];
        $this->OwnwerUpdate->apellido= $this->input['apellido'];
        $this->OwnwerUpdate->cedula= $this->input['cedula'];
        $this->OwnwerUpdate->email= $this->input['email'];
        $this->OwnwerUpdate->telefono= $this->input['telefono'];
        $this->OwnwerUpdate->fecha_nac= $this->input['fecha_nac'];
        $this->OwnwerUpdate->propietario= $this->input['propietario'];
        $this->OwnwerUpdate->password = Hash::make(trim($this->input['cedula']));
        $this->OwnwerUpdate->save();
        $this->dispatchBrowserEvent('close-modal-update');
        $this->dispatchBrowserEvent('alert',[
           'type' => 'success','message' => 'Se Actualizo el propietario'
       ]);

        $this->emit('render');        

        $this->input=[];

 
    }
 
    public function clearVar()
    {
       $this->input=[];
       $this->OwnwerUpdate = Null;
       $this->newUser = Null;
    }   

    public function casaDelete ($id) {
        $hogar = Casa::find($id);
        $residentes = $hogar->habitantes()->get();
        foreach ($residentes as $residente) {
            $residente->deleteProfilePhoto();
            $residente->tokens->each->delete();
            $residente->delete();
        }
        $this->emit('render'); 
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success','message' => 'Se Borraron los Residentes'
        ]);        
        return; 

    } 
    

}
