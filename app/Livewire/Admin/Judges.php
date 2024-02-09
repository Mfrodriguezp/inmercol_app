<?php

namespace App\Livewire\Admin;

use App\Models\Judge;
use Livewire\Component;

class Judges extends Component
{

    //Params
    public $title ="Jueces";
    public $judge_name, $judge_number; //Data Judges
    public $createModal=false; //Enable-Disable Form Modal

    public function createJudge()
    {
            //Insert para crear nuevo proyecto con el id extraido
            $data = Judge::create([
                'judge_number'=>$this->judge_number,
                'judge_name' => $this->judge_name
            ]);
            $this->reset([
                'judge_name',
                'judge_number',
                'createModal'
            ]);

            //Envío de mensaje creación de usario satisfactoria
            session()->flash('status', 'Registro creado correctamente!');
            $this->redirect('/dashboard/judges');
        }

    public function render()
    {
        return view('livewire.admin.judges');
    }
}
