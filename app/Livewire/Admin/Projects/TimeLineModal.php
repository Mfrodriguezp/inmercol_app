<?php

namespace App\Livewire\Admin\Projects;

use App\Models\Project;
use LivewireUI\Modal\ModalComponent;

class TimeLineModal extends ModalComponent
{

    public Project $project;
    public $id_project;
    
    public function mount(){
        $this->id_project=$this->project->id_project;
    }

/**
 * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
 */
public static function modalMaxWidth(): string
{
    return '7xl';
}


    public function render()
    {
        return view('livewire.admin.projects.time-line-modal');
    }
}
