<?php

namespace App\Livewire\Manager;

use Livewire\Component;

class ProjectsIndex extends Component
{
    public $title ="Proyectos";

    public function render()
    {
        return view('livewire.manager.projects-index');
    }
}
