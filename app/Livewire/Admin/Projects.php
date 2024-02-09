<?php

namespace App\Livewire\Admin;

use App\Models\Client;
use App\Models\Project;
use Livewire\Component;

class Projects extends Component
{
    public $projects; //save projects
    public $title = "Proyectos";
    public $createModal = false;
    public $project_name, $id_client = "", $client_name;
    public $checked = false;
    public $clients; // Show 

    public function mount()
    {
        //Llamada de listado de clientes para crear nuevos proyectos
        $this->clients = Client::all();
        $this->projects = Project::all();//Almacenar los datos de project
    }

    public function createProject()
    {
        //Validación de creación cliente nuevo
        if ($this->checked) {
            $newClient = Client::create([
                'client_name' => $this->client_name
            ]);
            //extracción del id_client del último registro creado
            $id_client = Client::all(['id_client'])->sortByDesc('id_client')->splice(0, 1);
            $id = $id_client->value('id_client');
            //Insert para crear nuevo proyecto con el id extraido
            $data = Project::create([
                'project_name' => $this->project_name,
                'id_client' => $id,
            ]);
            $this->reset([
                'project_name',
                'createModal'
            ]);

            //Envío de mensaje creación de usario satisfactoria
            session()->flash('status', 'Proyecto Creado Correctamente!');
            $this->redirect('/dashboard/projects');
        } else {
            $data = Project::create(
                $this->only('project_name', 'id_client')
            );
            $this->reset([
                'project_name',
                'createModal'
            ]);
            session()->flash('status', 'Proyecto Creado Correctamente!');
            $this->redirect('/dashboard/projects');
        }
    }

    public function editProject($id){
        $projects = Project::all();
        $project = $projects->find($id);
        $createModal =$this->createModal=true;
    }

    public function render()
    {
        return view('livewire.admin.projects');
    }
}
