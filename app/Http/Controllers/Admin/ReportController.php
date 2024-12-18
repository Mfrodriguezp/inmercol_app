<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvaluatedFragance;
use Illuminate\Http\Request;
use App\Exports\ConsolidReport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function getReport($testIdentifier, $dataOption)
    {

        //Obtener id del código de evaluación.
        $dataEvaluated = EvaluatedFragance::where('test_identifier', $testIdentifier)
            ->first();

        $nameReport = $dataEvaluated->test_identifier;

        // Generar y descargar el archivo Excel
        return Excel::download(
            new ConsolidReport($dataEvaluated->id_evaluated_fragance, $dataOption,$dataEvaluated->projects_id_project,$dataEvaluated->benchmark),
            $nameReport.'.xlsx'
        );
    }
}
