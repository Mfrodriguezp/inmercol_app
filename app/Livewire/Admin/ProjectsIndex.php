<?php

namespace App\Livewire\Admin;
use Livewire\Component;
use App\Models\Project;


class ProjectsIndex extends Component
{
    public $title;
    public $projects;

    public function mount(){
        $this->title = "Proyectos";
        $this->projects=Project::all();
    }

    public function render()
    {
        return view('livewire.admin.projects-index');
    }
}
