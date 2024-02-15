<?php

namespace App\Livewire\Judments;

use Livewire\Component;
use App\Models\Judge;
use App\Models\EvaluatedFragance;

class Judment extends Component
{
    
    public $carrier,$rotationJudges,$control;//Parámetros recibidos a través de la vista
    /*----------------------
    Parámetros configurados para traer:
    *Códigos de muestras
    *Codigos para portadores
    *Código de proyecto
    *Código evaluación de fragancia
    ------------------------*/
    public function mount(){
        //$this->carrier;
        //$this->control;
        //$this->judges;
    }

    public function render()
    {
        return view('livewire.judments.judment');
    }
}
