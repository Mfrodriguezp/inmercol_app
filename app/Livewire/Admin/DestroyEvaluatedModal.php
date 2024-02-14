<?php

namespace App\Livewire\Admin;

use App\Models\EvaluatedFragance;
use LivewireUI\Modal\ModalComponent;

class DestroyEvaluatedModal extends ModalComponent
{
    public EvaluatedFragance $evaluatedFragance;


    public function render()
    {
        return view('livewire.admin.destroy-evaluated-modal');
    }
}
