<?php

namespace App\Livewire\Admin\Evaluateds;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\RotationAplicationFragance;
use App\Models\EvaluatedFragance;

class RotFraganceCarriersModal extends ModalComponent
{
    public EvaluatedFragance $evaluatedFragance; //Parámetro recibido de la tabla de evaluaciones
    public $id_evaluatedFragance;
    public $rotationCarriers;
    public function mount(){
        $this->rotationCarriers = RotationAplicationFragance::all()
        ->where('evaluated_fragances_id_evaluated_fragance','=',$this->evaluatedFragance->id_evaluated_fragance)
        ->first();
    }


    public function render()
    {
        return view('livewire.admin.evaluateds.rot-fragance-carriers-modal');
    }
}
