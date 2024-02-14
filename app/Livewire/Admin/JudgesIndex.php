<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class JudgesIndex extends Component
{
    public $title;

    public function mount(){
        $this->title="Jueces"; //Title Section
    }

    public function render()
    {
        return view('livewire.admin.judges-index');
    }
}
