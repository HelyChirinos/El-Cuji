<?php

namespace App\Http\Livewire\Owner;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class ShowResidentes extends Component
{
    use WithFileUploads;
    protected $listeners = ['clearVar'];
    public $newUser,$id_owner,$UserUpdate,$search, $foto, $showUser, $deleteUser;
    public $name,$cedula,$correo,$telefono, $fecha_nac;
    public $input = [];
    public $paginator = 10;
    public $init_foto = 'assets/images/no-foto.png';

    public function render()
    {
        $residentes = User::with('casas')->WhereHas('casas', function($q) 
        {
            $q->where('casas.casa_no',session('casa_no'));
        })
        ->paginate($this->paginator);
        return view('livewire.owner.show-residentes',compact('residentes'));
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
         ]);
         $this->newUser->propietario = '0';
         $this->newUser->save();
         $this->newUser->casas()->attach(session('casa_no'));
         if(isset($this->foto)) {
            $this->newUser->updateProfilePhoto($this->foto);
        }
         $this->dispatchBrowserEvent('close-modal');
         $this->dispatchBrowserEvent('alert', 
         ['type' => 'success','message' => 'Se agrego un nuevo Propietario'
        ]);
        $this->input=[];
        $this->foto = Null;
        $this->emit('render');        
        return;
    }

    public function edit($id) {

        $this->UserUpdate = User::find($id);
        $this->input['nombre']=$this->UserUpdate->nombre;
        $this->input['apellido']=$this->UserUpdate->apellido;
        $this->input['cedula']=$this->UserUpdate->cedula;
        $this->input['email']=$this->UserUpdate->email;
        $this->input['telefono']=$this->UserUpdate->telefono;
        $this->input['fecha_nac']=$this->UserUpdate->fecha_nac;
        if ($this->UserUpdate->profile_photo_path) {
            $this->init_foto = 'storage/'.$this->UserUpdate->profile_photo_path;
        } else {
            $this->init_foto = 'assets/images/no-foto.png';
        }

        $this->dispatchBrowserEvent('open-edit-modal');
 
     }

     public function updateUser() {
        
        $UserValidate = Validator::make($this->input, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'max:10'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->UserUpdate->id)],
            'telefono' => ['nullable'],
            'fecha_nac' => ['nullable'],
        ])->validate();

        $this->UserUpdate->nombre = $this->input['nombre'];
        $this->UserUpdate->apellido= $this->input['apellido'];
        $this->UserUpdate->cedula= $this->input['cedula'];
        $this->UserUpdate->email= $this->input['email'];
        $this->UserUpdate->telefono= $this->input['telefono'];
        $this->UserUpdate->fecha_nac= $this->input['fecha_nac'];
        $this->UserUpdate->save();
        if (isset($this->foto)) {
            $this->UserUpdate->updateProfilePhoto($this->foto);
        }

        $this->dispatchBrowserEvent('close-modal-update');
        $this->dispatchBrowserEvent('alert',[
           'type' => 'success','message' => 'Se Actualizo el Residente'
       ]);

        $this->emit('render');        

        $this->input=[];
        $this->foto = Null;
        $this->UserUpdate = Null;
    }
 
    public function show($id) {

        $this->showUser = User::find($id);
        $this->name = $this->showUser->name;
        $this->cedula = $this->showUser->cedula;
        $this->correo= $this->showUser->email;
        $this->telefono =$this->showUser->telefono;
        $this->fecha_nac =$this->showUser->fecha_nac;

        if ($this->showUser->profile_photo_path) {
            $this->init_foto = 'storage/'.$this->showUser->profile_photo_path;
        } else {
            $this->init_foto = 'assets/images/no-foto.png';
        }
        $this->dispatchBrowserEvent('open-show-modal');
        return;
     }

     public function showDelete($id) {

        $this->deleteUser = User::find($id);
        $this->name = $this->deleteUser->name;
        $this->cedula = $this->deleteUser->cedula;
        $this->correo= $this->deleteUser->email;
        if ($this->deleteUser->profile_photo_path) {
            $this->init_foto = 'storage/'.$this->deleteUser->profile_photo_path;
        } else {
            $this->init_foto = 'assets/images/no-foto.png';
        }
        $this->dispatchBrowserEvent('open-delete-modal');
        return;   
 
     }

     public function delete()
     {
         $this->deleteUser->deleteProfilePhoto();
         $this->deleteUser->tokens->each->delete();
         $this->deleteUser->delete();
         $this->deleteUser = Null;
         $this->emit('render');        
         $this->dispatchBrowserEvent('close-delete-modal');
         $this->dispatchBrowserEvent('alert',[
            'type' => 'success','message' => 'Se Elimino el Residente'
        ]);
        return;
     }

     public function clearVar()
     {
        $this->input=[];
        $this->foto = Null;
        $this->UserUpdate = Null;
        $this->newUser = Null;
     }   
}
