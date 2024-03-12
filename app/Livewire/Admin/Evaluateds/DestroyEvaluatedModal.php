<?php

namespace App\Livewire\Admin\Evaluateds;

use App\Models\EvaluatedFragance;
use LivewireUI\Modal\ModalComponent;

class DestroyEvaluatedModal extends ModalComponent
{
    public EvaluatedFragance $evaluatedFragance;


    public function render()
    {
        return view('livewire.admin.evaluateds.destroy-evaluated-modal');
    }
}
