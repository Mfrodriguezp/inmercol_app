<?php

namespace App\Livewire\Admin\Judges;

use App\Models\Judge;
use LivewireUI\Modal\ModalComponent;

class CreateEditJudgeModal extends ModalComponent
{

    public Judge $judge;
    
    public function render()
    {
        return view('livewire.admin.judges.create-edit-judge-modal');
    }
}
