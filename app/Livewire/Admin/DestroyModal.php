<?php

namespace App\Livewire\Admin;

use LivewireUI\Modal\ModalComponent;
use App\Models\Project;
use App\Http\Controllers\Admin\ProjectController;

class DestroyModal extends ModalComponent
{
    public Project $project;
    public $id; //

    public function deleteProject()
    {
        $project = Project::find($this->project->id_project);
        $project->delete();

        return redirect()->action([ProjectController::class, 'index'])
                ->with('success', 'Proyecto Eliminado Correctamente!');
    }
    
    public function render()
    {
        return view('livewire.admin.destroy-modal');
    }
}
