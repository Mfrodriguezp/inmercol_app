<?php

namespace App\Livewire\Admin;

use LivewireUI\Modal\ModalComponent;
use App\Models\EvaluatedFragance;
use App\Models\Project;

class CreateEditEvaluatedModal extends ModalComponent
{
    public EvaluatedFragance $evaluatedFragance;
    public $projects;
    public Project $project;
    public $id_project;
    public $projects_id_project, $number_judges;

    public function mount(){
        if(isset($this->id_project)){
            $this->project=Project::find($this->id_project);
        }else{
            $this->projects=Project::all();
        }
        if(isset($this->evaluatedFragance)){
            $this->projects_id_project= $this->evaluatedFragance->projects_id_project;
            $this->number_judges = $this->evaluatedFragance->number_judges;
        }

    }

    public function render()
    {
        return view('livewire.admin.create-edit-evaluated-modal');
    }
}
