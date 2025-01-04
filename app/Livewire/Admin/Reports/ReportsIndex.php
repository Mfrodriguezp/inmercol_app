<?php

namespace App\Livewire\Admin\Reports;

use App\Http\Controllers\Admin\ReportController;
use Livewire\Component;

class ReportsIndex extends Component
{
    public $title;
    public $report_type;
    public $reportName = '';
    public $dataOption; //Selección de forma en la cual saldrá la tabla de Juicios

     // Validación del formulario
     protected $rules = [
        'reportName' => 'required|min:8'
    ];

    public function mount(){
        $this->title = "Reportes";
        $this->report_type = 1;
        $this->dataOption = "standar";
    }

    public function generateReport()
    {
        $this->validate();

        try {
            return redirect()->action(
                [ReportController::class, 'getReport'],
                ['testIdentified' => $this->reportName,
                'dataOption'=>$this->dataOption]
            );
            $this->reset('reportName');
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => 'Hubo un error al generar el reporte.'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.reports.reports-index');
    }
}
