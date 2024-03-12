<?php

namespace App\Livewire\Admin\Projects;

use LivewireUI\Modal\ModalComponent;
use App\Models\Project;
use App\Http\Controllers\Admin\ProjectController;

class DestroyModal extends ModalComponent
{
    public Project $project;
    
    public function render()
    {
        return view('livewire.admin.projects.destroy-modal');
    }
}
