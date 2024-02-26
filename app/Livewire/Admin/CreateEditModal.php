<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\Admin\ProjectController;
use LivewireUI\Modal\ModalComponent;
use App\Models\Project;
use App\Models\Client;
use App\Models\Judge;

class CreateEditModal extends ModalComponent
{
    public Project $project;
    public Judge $judge;
    public $clients;
    public $checked = false;
    public $id_project, $id_client = "";

    public function mount()
    {
        //Carga de listado de clientes para el select del formulario
        $this->clients = Client::all();

        //Montamos las variables si vamos a editar el proyecto
        if (isset($this->project)) {
            $this->id_client = $this->project->clients_id_client;
        }
    }

    public function render()
    {
        return view('livewire.admin.create-edit-modal');
    }
}
