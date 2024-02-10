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
    public $project_name, $id_client = "", $client_name;

    public function mount(){
        $this->clients=Client::all();
    }

    public function render()
    {
        return view('livewire.admin.create-edit-modal');
    }
}
