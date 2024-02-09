<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Project;
use App\Models\EvaluatedFragance;

class Evaluateds extends Component
{

    public $title="Evaluaciones de fragancias";
    public $openModal =false;
    public $id_project,$fragance_name_1,$fragance_counter_1, $fragance_ms_1,$fragance_test_code_1;
    public $fragance_name_2,$fragance_counter_2, $fragance_ms_2,$fragance_test_code_2;
    public $number_judges,$rot_aplication_fragance;
    public $name_carrier_a,$name_carrier_b;
    public $projects;
    public function mount(){
        $this->projects = Project::all();
    }

    public function addEvaluated(){
        //$p::all(['id_client'])->sortByDesc('id_client')->splice(0, 1);
            //Insert para crear nuevo proyecto con el id extraido
            $data = EvaluatedFragance::create([
                'project_name' => $this->project_name,
                'id_client' => $this->id_project
            ]);
            $this->reset([
                'project_name',
                'createModal'
            ]);

            //Envío de mensaje creación de usario satisfactoria
            session()->flash('status', 'Proyecto Creado Correctamente!');
            $this->redirect('/dashboard/projects');
    }

    public function render()
    {
        return view('livewire.admin.evaluateds');
    }
}
