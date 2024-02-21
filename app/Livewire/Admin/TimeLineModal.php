<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use LivewireUI\Modal\ModalComponent;

class TimeLineModal extends ModalComponent
{

    public Project $project;
    public $id_project;
    
    public function mount(){
        $this->id_project=$this->project->id_project;
    }

    public function render()
    {
        return view('livewire.admin.time-line-modal');
    }
}
