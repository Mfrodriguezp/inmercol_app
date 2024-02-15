<?php

namespace App\Livewire\Judments;

use Livewire\Component;

class Judment extends Component
{
    public $control,$carrier,$judges;

    public function mount(){
        $this->carrier;
        $this->control;
        $this->judges;
    }

    public function render()
    {
        return view('livewire.judments.judment',[
            'control'=>$this->control,
            'carrier'=>$this->carrier,
            'judges'=>$this->judges
        ]);
    }
}
