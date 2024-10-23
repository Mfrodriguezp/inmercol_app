<?php

namespace App\Livewire\Judments;

use App\Livewire\Admin\EvaluatedsIndex;
use App\Models\EvaluatedFragance;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Models\EnvironmentalCondition;
use Illuminate\Support\Facades\DB;
class JudmentsIndex extends Component
{
    use  WithPagination;
    public $title;
    public function mount()
    {
        $this->title = "Pruebas de sustantividad";
    }

    public function validateDataEnvironmental(Int $control, Int $idEvaluated, String $carrier, Int $judges)
    {
        #Query para validar si existe un control de Temperatura y humedad ya insertado
        $validationEnvironmental = EnvironmentalCondition::where('evaluated_fragances_id_evaluated_fragance', $idEvaluated)
            ->where('carrier', $carrier)
            ->count('control_'.$control.'_temp_start');
        
        #Query para validar si existen juicios sobre el id de evaluación y el control
        $validationJudments = DB::table('judments')
                            ->where('evaluated_fragances_id_evaluated_fragance', '=', $idEvaluated)
                            ->where('carrier_type', '=', $carrier)
                            ->whereNotNull('qualification_control_' . intval($control) . '_frag_1')
                            ->count('qualification_control_' . intval($control) . '_frag_1');
        
        if ($validationEnvironmental != 0 && $validationJudments < 8 ) {
            #Redirección hacia el formulario de calificación de los jueces
            return redirect()->route('admin.judments.judment', [
                'carrier' => $carrier,
                'control' => $control,
                'idEvaluated' => $idEvaluated,
                'judges' => $judges
            ]);
        } else {
            #Envío de variables a la vista de Temperatura y Humedad 
            return redirect()->route('admin.environmentals.index')->with([
                'control' => $control,
                'carrier' => $carrier,
                'idEvaluated' => $idEvaluated,
                'judges' => $judges
            ]);
        }
    }

    public function render()
    {
        //Se cargan las evaluaciones de fragancia de esta forma para poder paginar con livewire
        return view('livewire.judments.judments-index', [
            'evaluateds' => EvaluatedFragance::where('status_evaluation', '=', 'En curso')->paginate(1),
        ]);
    }
}
