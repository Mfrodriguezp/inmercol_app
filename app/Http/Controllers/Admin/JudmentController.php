<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EvaluatedFragance;
use Illuminate\Support\Facades\DB;
use App\Models\JudmentCounter;

class JudmentController extends Controller
{
    public function index()
    {
        return view('admin.judments.index');
    }

    public function judment($control, $carrier, $judges)
    {

        switch ($carrier) {
            case 'a':
                //query para validación del primer Juez para enviarla a la vista
                $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                    ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                    ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                    ->select([
                        'judges_8_rotations.judment_1 as juez',
                        'start_8_evaluations.judge_1_a as brazo_inicial'
                    ])
                    ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                    ->get();
                break;
            case 'b':
                //query para validación del primer Juez para enviarla a la vista
                $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                    ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                    ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                    ->select([
                        'judges_8_rotations.judment_1 as juez',
                        'start_8_evaluations.judge_1_b as brazo_inicial'
                    ])
                    ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                    ->get();
                break;
        }

        //Update del valor inicial de los jueces
        $judmentCounter = JudmentCounter::find(1);
        $judmentCounter->judment_number = 1;
        $judmentCounter->save();

        //Retorno de vista de formulario con la primera rotación de jueces
        return view('admin.judments.judment', [
            'rotationJudges' => $rotationJudges,
            'carrier' => $carrier,
            'control'=>$control
        ]);
    }
}
