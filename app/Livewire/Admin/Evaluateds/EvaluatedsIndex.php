<?php

namespace App\Livewire\Admin\Evaluateds;

use App\Models\Project;
use Livewire\Component;
use App\Models\RotationAplicationFragance;
use Illuminate\Support\Facades\DB;

class EvaluatedsIndex extends Component
{

    public $title;
    public $rotationCarriers;

    public function mount()
    {
        $this->title = "Evaluaciones";

        //Captura de aplicación de fragancias en los portadores
        $this->rotationCarriers = DB::table('rotation_aplication_fragances')
            ->select()
            ->orderBy('idrotation_aplication_fragances', 'desc')
            ->take(1)
            ->first();
    }

    public function render()
    {
        return view('livewire.admin.evaluateds.evaluateds-index');
    }
}
