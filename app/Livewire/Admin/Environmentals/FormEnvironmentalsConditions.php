<?php

namespace App\Livewire\Admin\Environmentals;

use Livewire\Component;

class FormEnvironmentalsConditions extends Component
{
    public $control,$carrier,$idEvaluated,$judges,$carrier_name;


    public function mount()
    {
        $this->control = session('control');
        $this->carrier = session('carrier');
        $this->idEvaluated = session('idEvaluated');
        $this->judges = session('judges');
        $this->carrier_name = session('carrier_name');
    }
    
    public function render()
    {
        return view('livewire.admin.environmentals.form-environmentals-conditions');
    }
}
