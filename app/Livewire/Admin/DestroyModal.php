<?php

namespace App\Livewire\Admin;

use LivewireUI\Modal\ModalComponent;
use App\Models\Project;
use App\Http\Controllers\Admin\ProjectController;

class DestroyModal extends ModalComponent
{
    public Project $project;
    
    public function render()
    {
        return view('livewire.admin.destroy-modal');
    }
}
