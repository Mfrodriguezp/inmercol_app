<?php

namespace App\Livewire\Judments;

use Livewire\Component;

class JudmentsIndex extends Component
{
    public $title = "Pruebas de sustantividad";

    public function render()
    {
        return view('livewire.judments.judments-index');
    }
}
