<?php

namespace App\Livewire\Judments;

use App\Models\EvaluatedFragance;
use Livewire\Component;

class JudmentsIndex extends Component
{
    public $title = "Pruebas de sustantividad";
    public $evaluated;

    public function mount(){
        $this->evaluated=EvaluatedFragance::where('status_evaluation','En curso')
        ->orderByDesc('id_evaluated_fragance','desc')
        ->limit(1)
        ->get();
    }

    public function render()
    {
        return view('livewire.judments.judments-index');
    }
}
