<?php

namespace App\Http\Livewire\Owner;

use Livewire\Component;
use App\Models\Casa;
use Illuminate\Support\Facades\Auth;

class SelectCasa extends Component
{

    public $casa;

    public function render()
    {
        $casas =  Auth::user()->casas;
        return view('livewire.owner.select-casa', compact('casas'));
    }


    public function boton() {

        $this->dispatchBrowserEvent('open-modal');
 
    }

    public function save() {

        session(['casa_no' => $this->casa]);
        $this->dispatchBrowserEvent('close-modal');
        return redirect()->route('casa',session('casa_no'));

    }
}
