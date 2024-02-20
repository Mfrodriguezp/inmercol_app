<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EvaluatedFragance;
use App\Models\Judment;
use Illuminate\Support\Facades\DB;
use App\Models\JudmentCounter;

class JudmentController extends Controller
{
    public function index()
    {
        return view('admin.judments.index');
    }

    public function judment($control, $carrier, $judges, $judmentNumber,$idEvaluated)
    {
        //reset del contador de paso de jueces
        $judmentCounter = JudmentCounter::find($judmentNumber);
        $judmentCounter->judment_number = 1;
        $judmentCounter->save();

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
                    ->first();
                //Query para extracción de los datos de la evaluación portador A
                $evaluated = DB::table('evaluated_fragances')
                    ->join(
                        'rotation_aplication_fragances',
                        'evaluated_fragances.id_evaluated_fragance',
                        '=',
                        'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                    )
                    ->where('id_evaluated_fragance',"=",$idEvaluated)
                    ->select([
                        'id_evaluated_fragance',
                        'projects_id_project as id_proyecto',
                        'fragance_test_code_1 as codigo_test_fragancia_1',
                        'code_1_test_a as codigo_portador_a_fragancia_1',
                        'fragance_test_code_2 as codigo_test_fragancia_2',
                        'code_2_test_a as codigo_portador_a_fragancia_2',
                        'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                        'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                    ])
                    ->orderBy('id_evaluated_fragance', 'desc')
                    ->first();
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
                    ->first();

                /*Query para validar los códigos de test de fragancia
                 y códigos de fragracias para los portadores
                */
                //Query para extracción de los datos de la evaluación portador A
                $evaluated = DB::table('evaluated_fragances')
                    ->join(
                        'rotation_aplication_fragances',
                        'evaluated_fragances.id_evaluated_fragance',
                        '=',
                        'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                    )
                    ->where('id_evaluated_fragance','=',$idEvaluated)
                    ->select([
                        'id_evaluated_fragance',
                        'projects_id_project as id_proyecto',
                        'fragance_test_code_1 as codigo_test_fragancia_1',
                        'code_1_test_b as codigo_portador_b_fragancia_1',
                        'fragance_test_code_2 as codigo_test_fragancia_2',
                        'code_2_test_b as codigo_portador_b_fragancia_2',
                        'rotation_aplication_fragances.fragance_carrier_b_arm_right as codigo_brazo_derecho',
                        'rotation_aplication_fragances.fragance_carrier_b_arm_left as codigo_brazo_izquierdo'
                    ])
                    ->orderBy('id_evaluated_fragance', 'desc')
                    ->first();
                break;
        }

        //Retorno de vista de formulario con la primera rotación de jueces
        return view('admin.judments.judment', [
            'rotationJudges' => $rotationJudges, //Juez que inicia y el brazo inicial
            'carrier' => $carrier,
            'control' => $control,
            'evaluated' => $evaluated,
            'counter' => $judmentNumber
        ]);
    }

    public function saveJudment(Request $request)
    {
        $carrier = $request->input('carrier');
        $counter = $request->input('counter');
        $control = $request->input('marking_type');
        $controlTransform = ''; //var for transform number a C1,C2,C3,C4. 
        if ($counter < 8) {
            //Concateniación de la "C" a cada control
            $controlTransform = strval($control);
            $controlTransform = 'C'.$controlTransform;
            //recolección de datos
            $quality1 = [
                'projects_id_project' => $request->input('id_proyecto'),
                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                'judges_id_judge' => $request->input('id_judge'),
                'fragance_code' => $request->input('fragance_code_test_1'),
                'carrier_type' => $request->input('carrier'),
                'marking_type' => $controlTransform,
                'qualification' => $request->input('quality_1')
            ];
            $quality2 = [
                'projects_id_project' => $request->input('id_proyecto'),
                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                'judges_id_judge' => $request->input('id_judge'),
                'fragance_code' => $request->input('fragance_code_test_2'),
                'carrier_type' => $request->input('carrier'),
                'marking_type' => $controlTransform,
                'qualification' => $request->input('quality_2')
            ];
            //Inserción de la calificación del primer código
            $judment1 = Judment::create($quality1);
            //Inserción de la calificación del segundo código
            $judment2 = Judment::create($quality2);

            //validación de parámetros para siguiente juez
            switch ($carrier) {
                case 'a':
                    switch ($counter) {
                        case 2:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_2 as juez',
                                    'start_8_evaluations.judge_2_a as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_a_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_a_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 3:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_3 as juez',
                                    'start_8_evaluations.judge_3_a as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_a_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_a_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 4:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_4 as juez',
                                    'start_8_evaluations.judge_4_a as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_a_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_a_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 5:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_5 as juez',
                                    'start_8_evaluations.judge_5_a as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_a_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_a_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 6:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_6 as juez',
                                    'start_8_evaluations.judge_6_a as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_a_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_a_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 7:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_7 as juez',
                                    'start_8_evaluations.judge_7_a as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_a_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_a_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 8:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_8 as juez',
                                    'start_8_evaluations.judge_8_a as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_a_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_a_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                    }
                    break;
                case 'b':
                    switch ($counter) {
                        case 2:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_2 as juez',
                                    'start_8_evaluations.judge_2_b as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_b_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_b_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 3:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_3 as juez',
                                    'start_8_evaluations.judge_3_b as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_b_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_b_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 4:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_4 as juez',
                                    'start_8_evaluations.judge_4_b as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_b_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_b_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 5:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_5 as juez',
                                    'start_8_evaluations.judge_5_b as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_b_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_b_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 6:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_6 as juez',
                                    'start_8_evaluations.judge_6_b as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_b_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_b_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 7:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_7 as juez',
                                    'start_8_evaluations.judge_7_b as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_b_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_b_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                        case 8:
                            //query para validación del Juez para enviarla a la vista
                            $rotationJudges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->join('judges_8_rotations', 'judges_8_rotations_has_start_8_evaluations.judges_8_rotations_id', '=', 'judges_8_rotations.id')
                                ->join('start_8_evaluations', 'judges_8_rotations_has_start_8_evaluations.start_8_evaluations_id', '=', 'start_8_evaluations.id')
                                ->select([
                                    'judges_8_rotations.judment_8 as juez',
                                    'start_8_evaluations.judge_8_b as brazo_inicial'
                                ])
                                ->where('judges_8_rotations_has_start_8_evaluations.control', '=', $control)
                                ->first();
                            //Query para extracción de los datos de la evaluación portador A
                            $evaluated = DB::table('evaluated_fragances')
                                ->join(
                                    'rotation_aplication_fragances',
                                    'evaluated_fragances.id_evaluated_fragance',
                                    '=',
                                    'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                )
                                ->select([
                                    'id_evaluated_fragance',
                                    'projects_id_project as id_proyecto',
                                    'fragance_test_code_1 as codigo_test_fragancia_1',
                                    'code_1_test_a as codigo_portador_b_fragancia_1',
                                    'fragance_test_code_2 as codigo_test_fragancia_2',
                                    'code_2_test_a as codigo_portador_b_fragancia_2',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                    'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                ])
                                ->orderBy('id_evaluated_fragance', 'desc')
                                ->take(1)
                                ->first();
                            break;
                    }
                    break;
            }
            //Retorno de vista de formulario con el siguiente juez
            return view('admin.judments.judment', [
                'rotationJudges' => $rotationJudges, //Juez que inicia y el brazo inicial
                'carrier' => $carrier, //portador
                'control' => $control,
                'evaluated' => $evaluated, //Datata para el formulario
                'counter' => $counter
            ]);
        } else {
            //Concateniación de la "C" a cada control
            $controlTransform = strval($control);
            $controlTransform = 'C'.$controlTransform;
            //recolección de datos
            $quality1 = [
                'projects_id_project' => $request->input('id_proyecto'),
                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                'judges_id_judge' => $request->input('id_judge'),
                'fragance_code' => $request->input('fragance_code_test_1'),
                'carrier_type' => $request->input('carrier'),
                'marking_type' => $controlTransform,
                'qualification' => $request->input('quality_1')
            ];
            $quality2 = [
                'projects_id_project' => $request->input('id_proyecto'),
                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                'judges_id_judge' => $request->input('id_judge'),
                'fragance_code' => $request->input('fragance_code_test_2'),
                'carrier_type' => $request->input('carrier'),
                'marking_type' => $controlTransform,
                'qualification' => $request->input('quality_2')
            ];
            //Inserción de la calificación del primer código
            $judment1 = Judment::create($quality1);
            //Inserción de la calificación del segundo código
            $judment2 = Judment::create($quality2);

            switch ($carrier) {
                case 'a':
                    switch ($control) {
                        case 1:
                            $id_evaluated = EvaluatedFragance::all(['id_evaluated_fragance'])
                                ->sortByDesc('id_evaluated_fragance')
                                ->take(1)
                                ->first();
                            $id = $id_evaluated->id_evaluated_fragance;
                            //Actualización de estatus activate finish del primer control portador a    
                            $update_control_1_a = EvaluatedFragance::find($id);
                            $update_control_1_a->control_1_a = 'finish';
                            $update_control_1_a->save();
                            //Update de status de pending a activate segundo control
                            $update_control_2_a = EvaluatedFragance::find($id);
                            $update_control_2_a->control_2_a = 'activate';
                            $update_control_2_a->save();
                            break;
                        case 2:
                            $id_evaluated = EvaluatedFragance::all(['id_evaluated_fragance'])
                                ->sortByDesc('id_evaluated_fragance')
                                ->take(1)
                                ->first();
                            $id = $id_evaluated->id_evaluated_fragance;
                            //Actualización de estatus del segundo control portador a    
                            $upd_control_2_a = EvaluatedFragance::find($id);
                            $upd_control_2_a->control_2_a = 'finish';
                            $upd_control_2_a->save();
                            //Update de status de pending a activate tercer control
                            $update_control_3_a = EvaluatedFragance::find($id);
                            $update_control_3_a->control_3_a = 'activate';
                            $update_control_3_a->save();
                            break;
                        case 3:
                            $id_evaluated = EvaluatedFragance::all(['id_evaluated_fragance'])
                                ->sortByDesc('id_evaluated_fragance')
                                ->take(1)
                                ->first();
                            $id = $id_evaluated->id_evaluated_fragance;
                            //Actualización de estatus del tercer control portador a    
                            $upd_control_3_a = EvaluatedFragance::find($id);
                            $upd_control_3_a->control_3_a = 'finish';
                            $upd_control_3_a->save();
                            //Update de status de pending a activate cuarto control
                            $update_control_4_a = EvaluatedFragance::find($id);
                            $update_control_4_a->control_4_a = 'activate';
                            $update_control_4_a->save();
                            break;
                        case 4:
                            $id_evaluated = EvaluatedFragance::all(['id_evaluated_fragance'])
                                ->sortByDesc('id_evaluated_fragance')
                                ->take(1)
                                ->first();
                            $id = $id_evaluated->id_evaluated_fragance;
                            //Actualización de estatus del último control portador a    
                            $upd_control_4_a = EvaluatedFragance::find($id);
                            $upd_control_4_a->control_4_a = 'finish';
                            $upd_control_4_a->save();
                            break;
                    }
                    break;
                case 'b':
                    switch ($control) {
                        case 1:
                            $id_evaluated = EvaluatedFragance::all(['id_evaluated_fragance'])
                                ->sortByDesc('id_evaluated_fragance')
                                ->take(1)
                                ->first();
                            $id = $id_evaluated->id_evaluated_fragance;
                            //Actualización de estatus del primer control portador a    
                            $upd_control_1_b = EvaluatedFragance::find($id);
                            $upd_control_1_b->control_1_b = 'finish';
                            $upd_control_1_b->save();
                            //Update de status de pending a activate segundo control
                            $upd_control_2_b = EvaluatedFragance::find($id);
                            $upd_control_2_b->control_2_b = 'activate';
                            $upd_control_2_b->save();
                            break;
                        case 2:
                            $id_evaluated = EvaluatedFragance::all(['id_evaluated_fragance'])
                                ->sortByDesc('id_evaluated_fragance')
                                ->take(1)
                                ->first();
                            $id = $id_evaluated->id_evaluated_fragance;
                            //Actualización de estatus del segundo control portador a    
                            $upd_control_2_b = EvaluatedFragance::find($id);
                            $upd_control_2_b->control_2_b = 'finish';
                            $upd_control_2_b->save();
                            //Update de status de pending a activate tercer control
                            $upd_control_3_b = EvaluatedFragance::find($id);
                            $upd_control_3_b->control_3_b = 'activate';
                            $upd_control_3_b->save();
                            break;
                        case 3:
                            $id_evaluated = EvaluatedFragance::all(['id_evaluated_fragance'])
                                ->sortByDesc('id_evaluated_fragance')
                                ->take(1)
                                ->first();
                            $id = $id_evaluated->id_evaluated_fragance;
                            //Actualización de estatus del primer control portador a    
                            $upd_control_3_b = EvaluatedFragance::find($id);
                            $upd_control_3_b->control_3_b = 'finish';
                            $upd_control_3_b->save();
                            //Update de status de pending a activate tercer control
                            $upd_control_4_b = EvaluatedFragance::find($id);
                            $upd_control_4_b->control_4_b = 'activate';
                            $upd_control_4_b->save();
                            break;
                        case 4:
                            $id_evaluated = EvaluatedFragance::all(['id_evaluated_fragance'])
                                ->sortByDesc('id_evaluated_fragance')
                                ->take(1)
                                ->first();
                            $id = $id_evaluated->id_evaluated_fragance;
                            //Actualización de estatus del primer control portador a    
                            $upd_control_4_b = EvaluatedFragance::find($id);
                            $upd_control_4_b->control_4_b = 'finish';
                            $upd_control_4_b->save();
                            break;
                    }
                    break;
            }
            return redirect()->route('admin.judments.index');
        }
    }
}
