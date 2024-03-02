<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EvaluatedFragance;
use App\Models\Judment;
use Illuminate\Support\Facades\DB;
use App\Models\JudmentCounter;
use App\Models\Project;
use Seld\PharUtils\Timestamps;

class JudmentController extends Controller
{
    public function index()
    {
        return view('admin.judments.index');
    }

    public function judment($control, $carrier, $judges, $judmentNumber, $idEvaluated)
    {

        switch ($judges) {
            case '8':
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
                            ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                            ->first();
                        //Query para extracción de los datos de la evaluación portador A
                        $evaluated = DB::table('evaluated_fragances')
                            ->join(
                                'rotation_aplication_fragances',
                                'evaluated_fragances.id_evaluated_fragance',
                                '=',
                                'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                            )
                            ->where('id_evaluated_fragance', "=", $idEvaluated)
                            ->select([
                                'id_evaluated_fragance',
                                'projects_id_project as id_proyecto',
                                'fragance_test_code_1 as codigo_test_fragancia_1',
                                'code_1_test_a as codigo_portador_a_fragancia_1',
                                'fragance_test_code_2 as codigo_test_fragancia_2',
                                'code_2_test_a as codigo_portador_a_fragancia_2',
                                'evaluated_fragances.name_carrier_a as nombre_portador_a',
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
                            ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                            ->first();

                        /*Query para validar los códigos de test de fragancia
                         y códigos de fragracias para los portadores
                        */
                        //Query para extracción de los datos de la evaluación portador B
                        $evaluated = DB::table('evaluated_fragances')
                            ->join(
                                'rotation_aplication_fragances',
                                'evaluated_fragances.id_evaluated_fragance',
                                '=',
                                'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                            )
                            ->where('id_evaluated_fragance', '=', $idEvaluated)
                            ->select([
                                'id_evaluated_fragance',
                                'projects_id_project as id_proyecto',
                                'fragance_test_code_1 as codigo_test_fragancia_1',
                                'code_1_test_b as codigo_portador_b_fragancia_1',
                                'fragance_test_code_2 as codigo_test_fragancia_2',
                                'code_2_test_b as codigo_portador_b_fragancia_2',
                                'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                'rotation_aplication_fragances.fragance_carrier_b_arm_right as codigo_brazo_derecho',
                                'rotation_aplication_fragances.fragance_carrier_b_arm_left as codigo_brazo_izquierdo'
                            ])
                            ->orderBy('id_evaluated_fragance', 'desc')
                            ->first();
                        break;
                }
                break;
            case '12':
                switch ($carrier) {
                    case 'a':
                        //query para validación del primer Juez para enviarla a la vista
                        $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                            ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                            ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                            ->select([
                                'judges_12_rotations.judment_1 as juez',
                                'start_12_evaluations.judge_1_a as brazo_inicial'
                            ])
                            ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                            ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                            ->first();
                        //Query para extracción de los datos de la evaluación portador A
                        $evaluated = DB::table('evaluated_fragances')
                            ->join(
                                'rotation_aplication_fragances',
                                'evaluated_fragances.id_evaluated_fragance',
                                '=',
                                'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                            )
                            ->where('id_evaluated_fragance', "=", $idEvaluated)
                            ->select([
                                'id_evaluated_fragance',
                                'projects_id_project as id_proyecto',
                                'fragance_test_code_1 as codigo_test_fragancia_1',
                                'code_1_test_a as codigo_portador_a_fragancia_1',
                                'fragance_test_code_2 as codigo_test_fragancia_2',
                                'code_2_test_a as codigo_portador_a_fragancia_2',
                                'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                            ])
                            ->orderBy('id_evaluated_fragance', 'desc')
                            ->first();
                        break;
                    case 'b':
                        //query para validación del primer Juez para enviarla a la vista
                        $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                            ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                            ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                            ->select([
                                'judges_12_rotations.judment_1 as juez',
                                'start_12_evaluations.judge_1_b as brazo_inicial'
                            ])
                            ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                            ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                            ->first();
                        /*Query para validar los códigos de test de fragancia
                         y códigos de fragracias para los portadores
                        */
                        //Query para extracción de los datos de la evaluación portador B
                        $evaluated = DB::table('evaluated_fragances')
                            ->join(
                                'rotation_aplication_fragances',
                                'evaluated_fragances.id_evaluated_fragance',
                                '=',
                                'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                            )
                            ->where('id_evaluated_fragance', '=', $idEvaluated)
                            ->select([
                                'id_evaluated_fragance',
                                'projects_id_project as id_proyecto',
                                'fragance_test_code_1 as codigo_test_fragancia_1',
                                'code_1_test_b as codigo_portador_b_fragancia_1',
                                'fragance_test_code_2 as codigo_test_fragancia_2',
                                'code_2_test_b as codigo_portador_b_fragancia_2',
                                'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                'rotation_aplication_fragances.fragance_carrier_b_arm_right as codigo_brazo_derecho',
                                'rotation_aplication_fragances.fragance_carrier_b_arm_left as codigo_brazo_izquierdo'
                            ])
                            ->orderBy('id_evaluated_fragance', 'desc')
                            ->first();
                        break;
                }
                break;
        }

        //Retorno de vista de formulario con la primera rotación de jueces
        return view('admin.judments.judment', [
            'rotationJudges' => $rotationJudges, //Juez que inicia y el brazo inicial
            'carrier' => $carrier,
            'control' => $control,
            'evaluated' => $evaluated,
            'counter' => $judmentNumber,
            'number_judges' => $judges,
            'message' => null
        ]);
    }

    public function saveJudment(Request $request)
    {
        $carrier = $request->input('carrier');
        $carrier_name = $request->input('carrier_name');
        $counter = $request->input('counter');
        $control = $request->input('marking_type');
        $idEvaluated = $request->input('id_evaluated_fragance');
        $idProject = $request->input('id_proyecto');
        $number_judges = $request->input('number_judges');
        switch ($number_judges) {
            case 8:
                if ($counter < 9) {
                    //inserción del juicios de 1 al 7
                    switch ($control) {
                        case 1:
                            //recolección de datos
                            $quality1 = [
                                'projects_id_project' => $request->input('id_proyecto'),
                                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                'judges_id_judge' => $request->input('id_judge'),
                                'fragance_code' => $request->input('fragance_code_test_1'),
                                'carrier_type' => $request->input('carrier'),
                                'qualification_control_1' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'projects_id_project' => $request->input('id_proyecto'),
                                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                'judges_id_judge' => $request->input('id_judge'),
                                'fragance_code' => $request->input('fragance_code_test_2'),
                                'carrier_type' => $request->input('carrier'),
                                'qualification_control_1' => $request->input('quality_2')
                            ];
                            //Inserción de la calificación del primer código
                            $judment1 = Judment::create($quality1);
                            //Inserción de la calificación del segundo código
                            $judment2 = Judment::create($quality2);
                            break;
                        case 2:
                            //Captura de los datos para inserción
                            $quality1 = [
                                'qualification_control_2' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_2' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                        case 3:
                            //Captura de los datos para inserción
                            $quality1 = [
                                'qualification_control_3' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_3' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                        case 4:
                            $quality1 = [
                                'qualification_control_4' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_4' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                    }
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                                        ->where('judges_8_rotations_has_start_8_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                        'counter' => $counter,
                        'number_judges' => $number_judges, // Total de jueces para la evaluacion
                        'message' => 'Evaluación registrada satisfactoriamente'
                    ]);
                } else {
                    //Inserción del juicio 8
                    switch ($control) {
                        case 1:
                            //recolección de datos
                            $quality1 = [
                                'projects_id_project' => $request->input('id_proyecto'),
                                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                'judges_id_judge' => $request->input('id_judge'),
                                'fragance_code' => $request->input('fragance_code_test_1'),
                                'carrier_type' => $request->input('carrier'),
                                'qualification_control_1' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'projects_id_project' => $request->input('id_proyecto'),
                                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                'judges_id_judge' => $request->input('id_judge'),
                                'fragance_code' => $request->input('fragance_code_test_2'),
                                'carrier_type' => $request->input('carrier'),
                                'qualification_control_1' => $request->input('quality_2')
                            ];
                            //Inserción de la calificación del primer código
                            $judment1 = Judment::create($quality1);
                            //Inserción de la calificación del segundo código
                            $judment2 = Judment::create($quality2);
                            break;
                        case 2:
                            //Captura de los datos para inserción
                            $quality1 = [
                                'qualification_control_2' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_2' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                        case 3:
                            //Captura de los datos para inserción
                            $quality1 = [
                                'qualification_control_3' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_3' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                        case 4:
                            $quality1 = [
                                'qualification_control_4' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_4' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                    }


                    switch ($carrier) {
                        case 'a':
                            switch ($control) {
                                case 1:
                                    //Actualización de estatus activate finish del primer control portador a    
                                    $update_control_1_a = EvaluatedFragance::find($idEvaluated);
                                    $update_control_1_a->control_1_a = 'finish';
                                    $update_control_1_a->save();
                                    //Update de status de pending a activate segundo control
                                    $update_control_2_a = EvaluatedFragance::find($idEvaluated);
                                    $update_control_2_a->control_2_a = 'activate';
                                    $update_control_2_a->save();
                                    break;
                                case 2:
                                    //Actualización de estatus del segundo control portador a    
                                    $upd_control_2_a = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_2_a->control_2_a = 'finish';
                                    $upd_control_2_a->save();
                                    //Update de status de pending a activate tercer control
                                    $update_control_3_a = EvaluatedFragance::find($idEvaluated);
                                    $update_control_3_a->control_3_a = 'activate';
                                    $update_control_3_a->save();
                                    break;
                                case 3:
                                    //Actualización de estatus del tercer control portador a    
                                    $upd_control_3_a = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_3_a->control_3_a = 'finish';
                                    $upd_control_3_a->save();
                                    //Update de status de pending a activate cuarto control
                                    $update_control_4_a = EvaluatedFragance::find($idEvaluated);
                                    $update_control_4_a->control_4_a = 'activate';
                                    $update_control_4_a->save();
                                    break;
                                case 4:
                                    //Actualización de estatus del último control portador a    
                                    $upd_control_4_a = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_4_a->control_4_a = 'finish';
                                    $upd_control_4_a->save();
                                    break;
                            }
                            break;
                        case 'b':
                            switch ($control) {
                                case 1:
                                    //Actualización de estatus del primer control portador a    
                                    $upd_control_1_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_1_b->control_1_b = 'finish';
                                    $upd_control_1_b->save();
                                    //Update de status de pending a activate segundo control
                                    $upd_control_2_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_2_b->control_2_b = 'activate';
                                    $upd_control_2_b->save();
                                    break;
                                case 2:
                                    //Actualización de estatus del segundo control portador a    
                                    $upd_control_2_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_2_b->control_2_b = 'finish';
                                    $upd_control_2_b->save();
                                    //Update de status de pending a activate tercer control
                                    $upd_control_3_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_3_b->control_3_b = 'activate';
                                    $upd_control_3_b->save();
                                    break;
                                case 3:
                                    //Actualización de estatus del primer control portador a    
                                    $upd_control_3_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_3_b->control_3_b = 'finish';
                                    $upd_control_3_b->save();
                                    //Update de status de pending a activate tercer control
                                    $upd_control_4_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_4_b->control_4_b = 'activate';
                                    $upd_control_4_b->save();
                                    break;
                                case 4:
                                    //Actualización de estatus del cuarto control portador b    
                                    $upd_control_4_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_4_b->control_4_b = 'finish';
                                    $upd_control_4_b->save();

                                    //Actualición del estado de la evaluación de fragancia
                                    $upd_status_evaluated = EvaluatedFragance::find($idEvaluated);
                                    $upd_status_evaluated->status_evaluation = "Finalizado";
                                    $upd_status_evaluated->save();

                                    //Actualización de la fecha/hora ultima evaluación en la tabla project
                                    $upd_last_evaluation = Project::find($idProject);
                                    $upd_last_evaluation->last_evaluation = now('America/Bogota');
                                    $upd_last_evaluation->save();
                                    break;
                            }
                            break;
                    }
                    return redirect()->route('admin.judments.index')
                        ->with('message', 'El control ' . $control . ' del portador ' . $carrier_name . ' ha sido guardado correctamente.');
                }
                break;
            case 12:
                if ($counter < 13) {
                    //inserción del juicios de 1 al 11
                    switch ($control) {
                        case 1:
                            //recolección de datos
                            $quality1 = [
                                'projects_id_project' => $request->input('id_proyecto'),
                                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                'judges_id_judge' => $request->input('id_judge'),
                                'fragance_code' => $request->input('fragance_code_test_1'),
                                'carrier_type' => $request->input('carrier'),
                                'qualification_control_1' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'projects_id_project' => $request->input('id_proyecto'),
                                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                'judges_id_judge' => $request->input('id_judge'),
                                'fragance_code' => $request->input('fragance_code_test_2'),
                                'carrier_type' => $request->input('carrier'),
                                'qualification_control_1' => $request->input('quality_2')
                            ];
                            //Inserción de la calificación del primer código
                            $judment1 = Judment::create($quality1);
                            //Inserción de la calificación del segundo código
                            $judment2 = Judment::create($quality2);
                            break;
                        case 2:
                            //Captura de los datos para inserción
                            $quality1 = [
                                'qualification_control_2' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_2' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                        case 3:
                            //Captura de los datos para inserción
                            $quality1 = [
                                'qualification_control_3' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_3' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                        case 4:
                            $quality1 = [
                                'qualification_control_4' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_4' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                    }

                    //validación de parámetros para siguiente juez
                    switch ($carrier) {
                        case 'a':
                            switch ($counter) {
                                case 2:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_2 as juez',
                                            'start_12_evaluations.judge_2_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 3:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_3 as juez',
                                            'start_12_evaluations.judge_3_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 4:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_4 as juez',
                                            'start_12_evaluations.judge_4_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 5:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_5 as juez',
                                            'start_12_evaluations.judge_5_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 6:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_6 as juez',
                                            'start_12_evaluations.judge_6_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 7:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_7 as juez',
                                            'start_12_evaluations.judge_7_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 8:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_8 as juez',
                                            'start_12_evaluations.judge_8_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 9:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_9 as juez',
                                            'start_12_evaluations.judge_9_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 10:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_10 as juez',
                                            'start_12_evaluations.judge_10_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 11:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_11 as juez',
                                            'start_12_evaluations.judge_11_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 12:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_12 as juez',
                                            'start_12_evaluations.judge_12_a as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_a_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_a_fragancia_2',
                                            'evaluated_fragances.name_carrier_a as nombre_portador_a',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                            }
                            break;
                        case 'b':
                            switch ($counter) {
                                case 2:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_2 as juez',
                                            'start_12_evaluations.judge_2_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 3:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_3 as juez',
                                            'start_12_evaluations.judge_3_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 4:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_4 as juez',
                                            'start_12_evaluations.judge_4_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 5:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_5 as juez',
                                            'start_12_evaluations.judge_5_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 6:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_6 as juez',
                                            'start_12_evaluations.judge_6_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 7:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_7 as juez',
                                            'start_12_evaluations.judge_7_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 8:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_8 as juez',
                                            'start_12_evaluations.judge_8_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 9:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_9 as juez',
                                            'start_12_evaluations.judge_9_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 10:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_10 as juez',
                                            'start_12_evaluations.judge_10_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 11:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_11 as juez',
                                            'start_12_evaluations.judge_11_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
                                        ->first();
                                    break;
                                case 12:
                                    //query para validación del Juez para enviarla a la vista
                                    $rotationJudges = DB::table('judges_12_rotations_has_start_12_evaluations')
                                        ->join('judges_12_rotations', 'judges_12_rotations_has_start_12_evaluations.judges_12_rotations_id', '=', 'judges_12_rotations.id')
                                        ->join('start_12_evaluations', 'judges_12_rotations_has_start_12_evaluations.start_12_evaluations_id', '=', 'start_12_evaluations.id')
                                        ->select([
                                            'judges_12_rotations.judment_12 as juez',
                                            'start_12_evaluations.judge_12_b as brazo_inicial'
                                        ])
                                        ->where('judges_12_rotations_has_start_12_evaluations.control', '=', $control)
                                        ->where('judges_12_rotations_has_start_12_evaluations.carrier', '=', $carrier)
                                        ->first();
                                    //Query para extracción de los datos de la evaluación portador A
                                    $evaluated = DB::table('evaluated_fragances')
                                        ->join(
                                            'rotation_aplication_fragances',
                                            'evaluated_fragances.id_evaluated_fragance',
                                            '=',
                                            'rotation_aplication_fragances.evaluated_fragances_id_evaluated_fragance'
                                        )
                                        ->where('id_evaluated_fragance', '=', $idEvaluated)
                                        ->select([
                                            'id_evaluated_fragance',
                                            'projects_id_project as id_proyecto',
                                            'fragance_test_code_1 as codigo_test_fragancia_1',
                                            'code_1_test_a as codigo_portador_b_fragancia_1',
                                            'fragance_test_code_2 as codigo_test_fragancia_2',
                                            'code_2_test_a as codigo_portador_b_fragancia_2',
                                            'evaluated_fragances.name_carrier_b as nombre_portador_b',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_right as codigo_brazo_derecho',
                                            'rotation_aplication_fragances.fragance_carrier_a_arm_left as codigo_brazo_izquierdo'
                                        ])
                                        ->orderBy('id_evaluated_fragance', 'desc')
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
                        'counter' => $counter,
                        'number_judges' => $number_judges, // Total de jueces para la evaluacion
                        'message' => 'Evaluación registrada satisfactoriamente'
                    ]);
                } else {
                    //inserción del juicio 12
                    switch ($control) {
                        case 1:
                            //recolección de datos
                            $quality1 = [
                                'projects_id_project' => $request->input('id_proyecto'),
                                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                'judges_id_judge' => $request->input('id_judge'),
                                'fragance_code' => $request->input('fragance_code_test_1'),
                                'carrier_type' => $request->input('carrier'),
                                'qualification_control_1' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'projects_id_project' => $request->input('id_proyecto'),
                                'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                'judges_id_judge' => $request->input('id_judge'),
                                'fragance_code' => $request->input('fragance_code_test_2'),
                                'carrier_type' => $request->input('carrier'),
                                'qualification_control_1' => $request->input('quality_2')
                            ];
                            //Inserción de la calificación del primer código
                            $judment1 = Judment::create($quality1);
                            //Inserción de la calificación del segundo código
                            $judment2 = Judment::create($quality2);
                            break;
                        case 2:
                            //Captura de los datos para inserción
                            $quality1 = [
                                'qualification_control_2' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_2' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                        case 3:
                            //Captura de los datos para inserción
                            $quality1 = [
                                'qualification_control_3' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_3' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                        case 4:
                            $quality1 = [
                                'qualification_control_4' => $request->input('quality_1')
                            ];
                            $quality2 = [
                                'qualification_control_4' => $request->input('quality_2')
                            ];
                            //Inserción de la calificació para el control 2 de la fragancia 1
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_1'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality1);
                            //Inserción de la calificació para el control 2 de la fragancia 2
                            $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                ->where('carrier_type', $request->input('carrier'))
                                ->where('fragance_code', $request->input('fragance_code_test_2'))
                                ->where('judges_id_judge',$request->input('id_judge'))
                                ->update($quality2);
                            break;
                    }

                    switch ($carrier) {
                        case 'a':
                            switch ($control) {
                                case 1:
                                    //Actualización de estatus activate finish del primer control portador a    
                                    $update_control_1_a = EvaluatedFragance::find($idEvaluated);
                                    $update_control_1_a->control_1_a = 'finish';
                                    $update_control_1_a->save();
                                    //Update de status de pending a activate segundo control
                                    $update_control_2_a = EvaluatedFragance::find($idEvaluated);
                                    $update_control_2_a->control_2_a = 'activate';
                                    $update_control_2_a->save();
                                    break;
                                case 2:
                                    //Actualización de estatus del segundo control portador a    
                                    $upd_control_2_a = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_2_a->control_2_a = 'finish';
                                    $upd_control_2_a->save();
                                    //Update de status de pending a activate tercer control
                                    $update_control_3_a = EvaluatedFragance::find($idEvaluated);
                                    $update_control_3_a->control_3_a = 'activate';
                                    $update_control_3_a->save();
                                    break;
                                case 3:
                                    //Actualización de estatus del tercer control portador a    
                                    $upd_control_3_a = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_3_a->control_3_a = 'finish';
                                    $upd_control_3_a->save();
                                    //Update de status de pending a activate cuarto control
                                    $update_control_4_a = EvaluatedFragance::find($idEvaluated);
                                    $update_control_4_a->control_4_a = 'activate';
                                    $update_control_4_a->save();
                                    break;
                                case 4:
                                    //Actualización de estatus del último control portador a    
                                    $upd_control_4_a = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_4_a->control_4_a = 'finish';
                                    $upd_control_4_a->save();
                                    break;
                            }
                            break;
                        case 'b':
                            switch ($control) {
                                case 1:
                                    //Actualización de estatus del primer control portador a    
                                    $upd_control_1_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_1_b->control_1_b = 'finish';
                                    $upd_control_1_b->save();
                                    //Update de status de pending a activate segundo control
                                    $upd_control_2_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_2_b->control_2_b = 'activate';
                                    $upd_control_2_b->save();
                                    break;
                                case 2:
                                    //Actualización de estatus del segundo control portador a    
                                    $upd_control_2_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_2_b->control_2_b = 'finish';
                                    $upd_control_2_b->save();
                                    //Update de status de pending a activate tercer control
                                    $upd_control_3_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_3_b->control_3_b = 'activate';
                                    $upd_control_3_b->save();
                                    break;
                                case 3:
                                    //Actualización de estatus del primer control portador a    
                                    $upd_control_3_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_3_b->control_3_b = 'finish';
                                    $upd_control_3_b->save();
                                    //Update de status de pending a activate tercer control
                                    $upd_control_4_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_4_b->control_4_b = 'activate';
                                    $upd_control_4_b->save();
                                    break;
                                case 4:
                                    //Actualización de estatus del cuarto control portador b    
                                    $upd_control_4_b = EvaluatedFragance::find($idEvaluated);
                                    $upd_control_4_b->control_4_b = 'finish';
                                    $upd_control_4_b->save();

                                    //Actualición del estado de la evaluación de fragancia
                                    $upd_status_evaluated = EvaluatedFragance::find($idEvaluated);
                                    $upd_status_evaluated->status_evaluation = "Finalizado";
                                    $upd_status_evaluated->save();

                                    //Actualización de la fecha/hora ultima evaluación en la tabla project
                                    $upd_last_evaluation = Project::find($idProject);
                                    $upd_last_evaluation->last_evaluation = now('America/Bogota');
                                    $upd_last_evaluation->save();
                                    break;
                            }
                            break;
                    }
                    return redirect()->route('admin.judments.index')
                        ->with('message', 'El control ' . $control . ' del portador ' . $carrier_name . ' ha sido guardado correctamente.');
                }
                break;
        }
    }
}
