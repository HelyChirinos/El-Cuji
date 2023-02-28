<?php

namespace App\Http\Livewire\Condominio;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Casa;

class Principal extends Component
{

    public $search;
    public $paginator = 10;

    public function render()
    {
        $casas = Casa::where('casa_no','like','%'.$this->search.'%')
        ->orderBy('id')->paginate($this->paginator);

        return view('livewire.condominio.principal', compact('casas'));
    }
}
