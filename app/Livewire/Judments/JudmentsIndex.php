<?php

namespace App\Livewire\Judments;

use App\Models\EvaluatedFragance;
use Livewire\Component;

class JudmentsIndex extends Component
{
    public $title = "Pruebas de sustantividad";
    public $evaluated;
    public $control_1_a, $control_2_a;

    public function mount(){
        $this->evaluated=EvaluatedFragance::where('status_evaluation','En curso')
        ->orderByDesc('id_evaluated_fragance','desc')
        ->limit(1)
        ->first();
        $this->control_1_a=$this->evaluated->control_1_a;
        $this->control_2_a=$this->evaluated->control_2_a;
    }

    public function render()
    {
        return view('livewire.judments.judments-index');
    }
}
