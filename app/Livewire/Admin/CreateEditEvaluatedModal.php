<?php

namespace App\Livewire\Admin;

use LivewireUI\Modal\ModalComponent;
use App\Models\EvaluatedFragance;
use App\Models\Project;

class CreateEditEvaluatedModal extends ModalComponent
{
    public EvaluatedFragance $evaluatedFragance;
    public $projects;
    public $project_send; //Variable para asignar proyecto cuando se crea desde la sección proyectos
    public $id_project; // Parámetro para recibir el id proyecto desde la sección de proyectos
    public $projects_id_project, $number_judges;

    public function mount(){

        
        if(isset($this->id_project)){
            //Cargue de data de proyecto cuando se envía el id desde la ventana de proyectos
            $this->project_send=Project::find($this->id_project);
        }else{
            //Cargue de data de proyectos cuando se crea evalución desde la ventana evaluaciones
            $this->projects=Project::all();
        }
        //Cargue de data de evaluación de fragancia para actualizar una evaluación
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
