<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\Admin\ProjectController;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\Project;
use App\Models\Client;
use App\Models\Judge;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class CreateEditModal extends ModalComponent
{
    public Project $project;
    public Judge $judge;
    public $clients;
    public $checked = false;
    public $id_project, $id_client = "", $id_analisys, $project_name, $client_name;
    public function mount()
    {
        $this->clients = Client::all();
        //Montamos las variables si vamos a editar el proyecto
        if (isset($this->project)) {
            $this->id_project = $this->project->id_project;
            $this->project_name = $this->project->project_name;
            $this->id_client = $this->project->clients_id_client;
            $this->id_analisys = $this->project->id_analisys;
        }
    }

    public function editProject()
    {
        //re
        $id = $this->id_project = $this->project->id_project;

        $project = Project::where('id_project', $id)
            ->update([
                'id_analisys'=>$this->id_analisys,
                'project_name'=>$this->project_name,
            'clients_id_client'=>$this->id_client
            ]);

            return redirect()->action([ProjectController::class, 'index'])
                ->with('success', 'Proyecto Actualizado Correctamente!');
    }

    public function render()
    {
        return view('livewire.admin.create-edit-modal');
    }
}
