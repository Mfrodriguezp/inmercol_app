<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\Judge;

class DestroyJudgeModal extends ModalComponent
{
    public Judge $judge;
    
    public function render()
    {
        return view('livewire.admin.destroy-judge-modal');
    }
}
