<?php

namespace App\Livewire\Judments;

use Livewire\Component;
use App\Models\Judge;
use App\Models\EvaluatedFragance;

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
    // public $cod_port_a_frag_1;
    // public $cod_port_a_frag_2;
    // public $cod_port_b_frag_1;
    // public $cod_port_b_frag_2;
    /*----------------------
    Parámetros configurados para traer:
    *Códigos de muestras
    *Codigos para portadores
    *Código de proyecto
    *Código evaluación de fragancia
    ------------------------*/
    public function mount()
    {
        $this->title = "Marcación de sustantividad";
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
