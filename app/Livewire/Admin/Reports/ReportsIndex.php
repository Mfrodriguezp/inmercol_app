<?php

namespace App\Livewire\Admin\Reports;

use Livewire\Component;

class ReportsIndex extends Component
{
    public $title ="Reportes";

    public function render()
    {
        return view('livewire.admin.reports.reports-index');
    }
}
