<?php

namespace App\Livewire\Judments;

use Livewire\Component;
use App\Models\Judge;
use App\Models\EvaluatedFragance;
use Illuminate\Support\Facades\Cookie;

class Judment extends Component
{
    public $title;
    public $carrier, $rotationJudges, $control; //Parámetros recibidos a través de la vista
    public $judge; //Carga datos del Juez
    public $counter; //Contador de paso de jueces
    public $evaluated; //Información de codigos de fragancias para portadores y códigos de la fragancia para reporte
    public $brazo_inicial; //Se carga la data del brazo inicial
    /*------------------------------------------------------------------*/
    public $codigo_brazo_izquierdo; //Código del brazo izquierdo identificando la fragancia asignada para el portador
    public $codigo_brazo_derecho; // Código del brazo derecho identificando la fragancia asignada para el portador
    public $number_judges; // Cantidad de jueces para el juicio
    public $message;
    public $checked = false;
    /*----------------------
    Parámetros configurados para traer:
    *Códigos de muestras
    *Codigos para portadores
    *Código de proyecto
    *Código evaluación de fragancia
    ------------------------*/
    public function mount()
    {
        $this->title = "Sustantividad";
        $this->judge = Judge::where('judge_number', $this->rotationJudges->juez)
            ->first();
        $this->brazo_inicial = $this->rotationJudges->brazo_inicial;
        $this->codigo_brazo_derecho = $this->evaluated->codigo_brazo_derecho;
        $this->codigo_brazo_izquierdo = $this->evaluated->codigo_brazo_izquierdo;
        $this->counter = $this->counter + 1;
    }

    public function render()
    {
        return view('livewire.judments.judment');
    }
}
