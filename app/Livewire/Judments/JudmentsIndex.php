<?php

namespace App\Livewire\Judments;

use App\Livewire\Admin\EvaluatedsIndex;
use App\Models\EvaluatedFragance;
use Livewire\Component;
use Livewire\WithPagination;

class JudmentsIndex extends Component
{
    use  WithPagination;
    public $title = "Pruebas de sustantividad";
    /*public EvaluatedFragance $evaluateds;
    public $control_1_a,$control_2_a,$control_3_a,$control_4_a;
    public $control_1_b,$control_2_b,$control_3_b,$control_4_b;*/
    public function mount()
    {
        /*
        if (isset($evaluateds)) {
            
            //Portador A
            $this->control_1_a = $this->evaluateds->control_1_a;
            $this->control_2_a = $this->evaluateds->control_2_a;
            $this->control_3_a = $this->evaluateds->control_3_a;
            $this->control_4_a = $this->evaluated->control_4_a;
            //Portador B
            $this->control_1_b = $this->evaluated->control_1_b;
            $this->control_2_b = $this->evaluated->control_2_b;
            $this->control_3_b = $this->evaluated->control_3_b;
            $this->control_4_b = $this->evaluated->control_4_b;
        }*/
    }

    public function render()
    {
        return view('livewire.judments.judments-index',[
            'evaluateds' => EvaluatedFragance::where('status_evaluation', '=','En curso')->paginate(1),
        ]);
    }
}
