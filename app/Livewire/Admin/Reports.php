<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Reports extends Component
{
    //Parameters
    public $title ="Reportes";

    public function render()
    {
        return view('livewire.admin.reports');
    }
}
