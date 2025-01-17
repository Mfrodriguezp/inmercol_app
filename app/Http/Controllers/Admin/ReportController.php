<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvaluatedFragance;
use Illuminate\Http\Request;
use App\Exports\ConsolidReport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function getReport($testIdentifier, $dataOption)
    {
        try {
            // Obtener id del código de evaluación
            $dataEvaluated = EvaluatedFragance::where('test_identifier', $testIdentifier)
                ->first();

            if (!$dataEvaluated) {
                return redirect()->route('admin.reports.index')
                    ->with('error', 'La evaluación no existe!');
            }

            $nameReport = $dataEvaluated->test_identifier;
            $filePath = 'reports/' . $nameReport . '.xlsx';

            // Generar y almacenar el archivo Excel temporalmente
            Excel::store(
                new ConsolidReport(
                    $dataEvaluated->id_evaluated_fragance,
                    $dataOption,
                    $dataEvaluated->projects_id_project,
                    $dataEvaluated->benchmark
                ),
                $filePath,
                'local'
            );

            // Preparar la respuesta manualmente
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $nameReport . '.xlsx"',
            ];

            // Descargar el archivo con los headers específicos
            return response()->file(
                storage_path("app/{$filePath}"),
                $headers
            )->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            Log::error('Error en getReport: ' . $e->getMessage());
            return redirect()->route('admin.reports.index')
                ->with('error', 'Error al generar el reporte: ' . $e->getMessage());
        }
    }
}
