<?php

namespace App\Livewire\Judments;

use App\Livewire\Admin\EvaluatedsIndex;
use App\Models\EvaluatedFragance;
use Livewire\Component;
use Livewire\WithPagination;

class JudmentsIndex extends Component
{
    use  WithPagination;
    public $title;
    public function mount()
    {
        $this->title = "Pruebas de sustantividad";
    }

    public function render()
    {
        //Se cargan las evaluaciones de fragancia de esta forma para poder paginar con livewire
        return view('livewire.judments.judments-index',[
            'evaluateds' => EvaluatedFragance::where('status_evaluation', '=','En curso')->paginate(1),
        ]);
    }
}
