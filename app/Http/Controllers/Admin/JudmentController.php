<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EvaluatedFragance;
use App\Models\Judment;
use Illuminate\Support\Facades\DB;
use App\Models\JudmentCounter;
use App\Models\Project;

class JudmentController extends Controller
{
    public function index()
    {
        return view('admin.judments.index');
    }

    public function judment($control, $carrier, $judges, $idEvaluated)
    {
        switch ($judges) {
            case '8':
                switch ($carrier) {
                    case 'a':
                        $validation = DB::table('judments')
                            ->where('evaluated_fragances_id_evaluated_fragance', '=', $idEvaluated)
                            ->where('carrier_type', '=', $carrier)
                            ->whereNotNull('qualification_control_' . intval($control) . '_frag_1')
                            ->count('qualification_control_' . intval($control) . '_frag_1');
                        if ($validation == 0) {
                            $judmentNumber = 1;
                            /**
                             * Aleatoriedad de Jueces y rotación de brazos
                             */

                            $random_judges_a = []; //Array de rotaciones de jueces portadores a
                            $random_judges_b = []; //Array de rotaciones de jueces portadores b
                            $start_rotation_a = []; //array para rotación de brazo_portadores a
                            $start_rotation_b = []; //array para rotación de brazo_portadores b

                            //Eliminación de la tabla de rotacion de jueces para limpiarla
                            $delete_rotations_judges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->delete();

                            //Selección de rotaciones aleatorias para inseción en la tabla de muchos a muchos
                            for ($i = 1; $i < 5; $i++) {
                                //Ingreso de valores en la primera rotación de jueces
                                if (count($random_judges_a) == 0) {
                                    $rand = rand(1, 100); //Creación de número aleatorio
                                    array_push($random_judges_a, $rand);
                                } else {
                                    $rand = rand(1, 100); //Creación de número aleatorio
                                    while (in_array($rand, $random_judges_a)) {
                                        $rand = rand(1, 100);
                                    }
                                    array_push($random_judges_a, $rand);
                                }

                                //Ingreso de valores en la segunda rotación de jueces
                                $rand = rand(1, 100); //Creación de número aleatorio
                                if (count($random_judges_b) == 0 && !in_array($rand, $random_judges_a)) {
                                    array_push($random_judges_b, $rand);
                                } else {
                                    $rand = rand(1, 100); //Creación de número aleatorio
                                    while (in_array($rand, $random_judges_b) || in_array($rand, $random_judges_a)) {
                                        $rand = rand(1, 100);
                                    }
                                    array_push($random_judges_b, $rand);
                                }

                                //Ingreso de valores en la rotacion de brazos portador a
                                if (count($start_rotation_a) == 0) {
                                    $rand = rand(1, 4); //Creación de número aleatorio
                                    array_push($start_rotation_a, $rand);
                                } else {
                                    $rand = rand(1, 4); //Creación de número aleatorio
                                    while (in_array($rand, $start_rotation_a)) {
                                        $rand = rand(1, 4);
                                    }
                                    array_push($start_rotation_a, $rand);
                                }

                                //Ingreso de valores en la rotacion de brazos portador b
                                if (count($start_rotation_b) == 0) {
                                    $rand = rand(1, 4); //Creación de número aleatorio
                                    array_push($start_rotation_b, $rand);
                                } else {
                                    $rand = rand(1, 4); //Creación de número aleatorio
                                    while (in_array($rand, $start_rotation_b)) {
                                        $rand = rand(1, 4);
                                    }
                                    array_push($start_rotation_b, $rand);
                                }
                            }

                            //Inserción de datos en la tabla de relación de datos para rotación de jueces

                            $rotation_8_judges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->insert(
                                    [
                                        [
                                            'control' => 1,
                                            'judges_8_rotations_id' => $random_judges_a[0],
                                            'start_8_evaluations_id' => $start_rotation_a[0],
                                            'carrier' => "a"
                                        ],
                                        [
                                            'control' => 2,
                                            'judges_8_rotations_id' => $random_judges_a[1],
                                            'start_8_evaluations_id' => $start_rotation_a[1],
                                            'carrier' => "a"
                                        ],
                                        [
                                            'control' => 3,
                                            'judges_8_rotations_id' => $random_judges_a[2],
                                            'start_8_evaluations_id' => $start_rotation_a[2],
                                            'carrier' => "a"
                                        ],
                                        [
                                            'control' => 4,
                                            'judges_8_rotations_id' => $random_judges_a[3],
                                            'start_8_evaluations_id' => $start_rotation_a[3],
                                            'carrier' => "a"
                                        ],
                                        [
                                            'control' => 1,
                                            'judges_8_rotations_id' => $random_judges_b[0],
                                            'start_8_evaluations_id' => $start_rotation_b[0],
                                            'carrier' => "b"
                                        ],
                                        [
                                            'control' => 2,
                                            'judges_8_rotations_id' => $random_judges_b[1],
                                            'start_8_evaluations_id' => $start_rotation_b[1],
                                            'carrier' => "b"
                                        ],
                                        [
                                            'control' => 3,
                                            'judges_8_rotations_id' => $random_judges_b[2],
                                            'start_8_evaluations_id' => $start_rotation_b[2],
                                            'carrier' => "b"
                                        ],
                                        [
                                            'control' => 4,
                                            'judges_8_rotations_id' => $random_judges_b[3],
                                            'start_8_evaluations_id' => $start_rotation_b[3],
                                            'carrier' => "b"
                                        ]
                                    ]
                                );

                            //Aleatoriedad de jueces y rotación de brazos ^^
                        } else {
                            $judmentNumber = $validation + 1;
                        }

                        switch ($judmentNumber) {
                            case 1:
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
                                break;
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
                                break;
                        }

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
                                'test_identifier',
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
                        $validation = DB::table('judments')
                            ->where('evaluated_fragances_id_evaluated_fragance', '=', $idEvaluated)
                            ->where('carrier_type', '=', $carrier)
                            ->whereNotNull('qualification_control_' . intval($control) . '_frag_1')
                            ->count('qualification_control_' . intval($control) . '_frag_1');
                        if ($validation == 0) {
                            $judmentNumber = 1;
                            /**
                             * Aleatoriedad de Jueces y rotación de brazos
                             */

                            $random_judges_a = []; //Array de rotaciones de jueces portadores a
                            $random_judges_b = []; //Array de rotaciones de jueces portadores b
                            $start_rotation_a = []; //array para rotación de brazo_portadores a
                            $start_rotation_b = []; //array para rotación de brazo_portadores b

                            //Eliminación de la tabla de rotacion de jueces para limpiarla
                            $delete_rotations_judges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->delete();

                            //Selección de rotaciones aleatorias para inseción en la tabla de muchos a muchos
                            for ($i = 1; $i < 5; $i++) {
                                //Ingreso de valores en la primera rotación de jueces
                                if (count($random_judges_a) == 0) {
                                    $rand = rand(1, 100); //Creación de número aleatorio
                                    array_push($random_judges_a, $rand);
                                } else {
                                    $rand = rand(1, 100); //Creación de número aleatorio
                                    while (in_array($rand, $random_judges_a)) {
                                        $rand = rand(1, 100);
                                    }
                                    array_push($random_judges_a, $rand);
                                }

                                //Ingreso de valores en la segunda rotación de jueces
                                $rand = rand(1, 100); //Creación de número aleatorio
                                if (count($random_judges_b) == 0 && !in_array($rand, $random_judges_a)) {
                                    array_push($random_judges_b, $rand);
                                } else {
                                    $rand = rand(1, 100); //Creación de número aleatorio
                                    while (in_array($rand, $random_judges_b) || in_array($rand, $random_judges_a)) {
                                        $rand = rand(1, 100);
                                    }
                                    array_push($random_judges_b, $rand);
                                }

                                //Ingreso de valores en la rotacion de brazos portador a
                                if (count($start_rotation_a) == 0) {
                                    $rand = rand(1, 4); //Creación de número aleatorio
                                    array_push($start_rotation_a, $rand);
                                } else {
                                    $rand = rand(1, 4); //Creación de número aleatorio
                                    while (in_array($rand, $start_rotation_a)) {
                                        $rand = rand(1, 4);
                                    }
                                    array_push($start_rotation_a, $rand);
                                }

                                //Ingreso de valores en la rotacion de brazos portador b
                                if (count($start_rotation_b) == 0) {
                                    $rand = rand(1, 4); //Creación de número aleatorio
                                    array_push($start_rotation_b, $rand);
                                } else {
                                    $rand = rand(1, 4); //Creación de número aleatorio
                                    while (in_array($rand, $start_rotation_b)) {
                                        $rand = rand(1, 4);
                                    }
                                    array_push($start_rotation_b, $rand);
                                }
                            }

                            //Inserción de datos en la tabla de relación de datos para rotación de jueces

                            $rotation_8_judges = DB::table('judges_8_rotations_has_start_8_evaluations')
                                ->insert(
                                    [
                                        [
                                            'control' => 1,
                                            'judges_8_rotations_id' => $random_judges_a[0],
                                            'start_8_evaluations_id' => $start_rotation_a[0],
                                            'carrier' => "a"
                                        ],
                                        [
                                            'control' => 2,
                                            'judges_8_rotations_id' => $random_judges_a[1],
                                            'start_8_evaluations_id' => $start_rotation_a[1],
                                            'carrier' => "a"
                                        ],
                                        [
                                            'control' => 3,
                                            'judges_8_rotations_id' => $random_judges_a[2],
                                            'start_8_evaluations_id' => $start_rotation_a[2],
                                            'carrier' => "a"
                                        ],
                                        [
                                            'control' => 4,
                                            'judges_8_rotations_id' => $random_judges_a[3],
                                            'start_8_evaluations_id' => $start_rotation_a[3],
                                            'carrier' => "a"
                                        ],
                                        [
                                            'control' => 1,
                                            'judges_8_rotations_id' => $random_judges_b[0],
                                            'start_8_evaluations_id' => $start_rotation_b[0],
                                            'carrier' => "b"
                                        ],
                                        [
                                            'control' => 2,
                                            'judges_8_rotations_id' => $random_judges_b[1],
                                            'start_8_evaluations_id' => $start_rotation_b[1],
                                            'carrier' => "b"
                                        ],
                                        [
                                            'control' => 3,
                                            'judges_8_rotations_id' => $random_judges_b[2],
                                            'start_8_evaluations_id' => $start_rotation_b[2],
                                            'carrier' => "b"
                                        ],
                                        [
                                            'control' => 4,
                                            'judges_8_rotations_id' => $random_judges_b[3],
                                            'start_8_evaluations_id' => $start_rotation_b[3],
                                            'carrier' => "b"
                                        ]
                                    ]
                                );

                            //Aleatoriedad de jueces y rotación de brazos ^^
                        } else {
                            $judmentNumber = $validation + 1;
                        }

                        switch ($judmentNumber) {
                            case 1:
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
                                break;
                            case 2:
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
                                break;
                            case 3:
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
                                break;
                            case 4:
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
                                break;
                            case 5:
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
                                break;
                            case 6:
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
                                break;
                            case 7:
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
                                break;
                            case 8:
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
                                break;
                        }

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
                                'test_identifier',
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
                //Comprobación de calificaciones existentes con e id de evaluacion, portador y calificación en el control enviado
                $validation = DB::table('judments')
                    ->where('evaluated_fragances_id_evaluated_fragance', '=', $idEvaluated)
                    ->where('carrier_type', '=', $carrier)
                    ->whereNotNull('qualification_control_' . intval($control) . '_frag_1')
                    ->count('qualification_control_' . intval($control) . '_frag_1');
                if ($validation == 0) {
                    $judmentNumber = 1;
                    /**
                     * Aleatoriedad de Jueces y rotación de brazos
                     */

                    $random_judges_a = []; //Array de rotaciones de jueces portadores a
                    $random_judges_b = []; //Array de rotaciones de jueces portadores b
                    $start_rotation_a = []; //array para rotación de brazo_portadores a
                    $start_rotation_b = []; //array para rotación de brazo_portadores b

                    //Eliminación de la tabla de rotacion de jueces para limpiarla
                    $delete_rotations_judges = DB::table('judges_12_rotations_has_start_12_evaluations')
                        ->delete();

                    //Selección de rotaciones aleatorias para inseción en la tabla de muchos a muchos
                    for ($i = 1; $i < 5; $i++) {
                        //Ingreso de valores en la primera rotación de jueces
                        if (count($random_judges_a) == 0) {
                            $rand = rand(1, 100); //Creación de número aleatorio
                            array_push($random_judges_a, $rand);
                        } else {
                            $rand = rand(1, 100); //Creación de número aleatorio
                            while (in_array($rand, $random_judges_a)) {
                                $rand = rand(1, 100);
                            }
                            array_push($random_judges_a, $rand);
                        }

                        //Ingreso de valores en la segunda rotación de jueces
                        $rand = rand(1, 100); //Creación de número aleatorio
                        if (count($random_judges_b) == 0 && !in_array($rand, $random_judges_a)) {
                            array_push($random_judges_b, $rand);
                        } else {
                            $rand = rand(1, 100); //Creación de número aleatorio
                            while (in_array($rand, $random_judges_b) || in_array($rand, $random_judges_a)) {
                                $rand = rand(1, 100);
                            }
                            array_push($random_judges_b, $rand);
                        }

                        //Ingreso de valores en la rotacion de brazos portador a
                        if (count($start_rotation_a) == 0) {
                            $rand = rand(1, 4); //Creación de número aleatorio
                            array_push($start_rotation_a, $rand);
                        } else {
                            $rand = rand(1, 4); //Creación de número aleatorio
                            while (in_array($rand, $start_rotation_a)) {
                                $rand = rand(1, 4);
                            }
                            array_push($start_rotation_a, $rand);
                        }

                        //Ingreso de valores en la rotacion de brazos portador b
                        if (count($start_rotation_b) == 0) {
                            $rand = rand(1, 4); //Creación de número aleatorio
                            array_push($start_rotation_b, $rand);
                        } else {
                            $rand = rand(1, 4); //Creación de número aleatorio
                            while (in_array($rand, $start_rotation_b)) {
                                $rand = rand(1, 4);
                            }
                            array_push($start_rotation_b, $rand);
                        }
                    }

                    //Inserción de datos en la tabla de relación de datos para rotación de jueces

                    $rotation_8_judges = DB::table('judges_12_rotations_has_start_12_evaluations')
                        ->insert(
                            [
                                [
                                    'control' => 1,
                                    'judges_12_rotations_id' => $random_judges_a[0],
                                    'start_12_evaluations_id' => $start_rotation_a[0],
                                    'carrier' => "a"
                                ],
                                [
                                    'control' => 2,
                                    'judges_12_rotations_id' => $random_judges_a[1],
                                    'start_12_evaluations_id' => $start_rotation_a[1],
                                    'carrier' => "a"
                                ],
                                [
                                    'control' => 3,
                                    'judges_12_rotations_id' => $random_judges_a[2],
                                    'start_12_evaluations_id' => $start_rotation_a[2],
                                    'carrier' => "a"
                                ],
                                [
                                    'control' => 4,
                                    'judges_12_rotations_id' => $random_judges_a[3],
                                    'start_12_evaluations_id' => $start_rotation_a[3],
                                    'carrier' => "a"
                                ],
                                [
                                    'control' => 1,
                                    'judges_12_rotations_id' => $random_judges_b[0],
                                    'start_12_evaluations_id' => $start_rotation_b[0],
                                    'carrier' => "b"
                                ],
                                [
                                    'control' => 2,
                                    'judges_12_rotations_id' => $random_judges_b[1],
                                    'start_12_evaluations_id' => $start_rotation_b[1],
                                    'carrier' => "b"
                                ],
                                [
                                    'control' => 3,
                                    'judges_12_rotations_id' => $random_judges_b[2],
                                    'start_12_evaluations_id' => $start_rotation_b[2],
                                    'carrier' => "b"
                                ],
                                [
                                    'control' => 4,
                                    'judges_12_rotations_id' => $random_judges_b[3],
                                    'start_12_evaluations_id' => $start_rotation_b[3],
                                    'carrier' => "b"
                                ]
                            ]
                        );

                    //Aleatoriedad de jueces y rotación de brazos ^^
                } else {
                    $judmentNumber = $validation + 1;
                }
                switch ($judmentNumber) {
                    case 1:
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
                        break;
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
                        break;
                }

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
                        'test_identifier',
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
        //Retorno de vista de formulario con la primera rotación de jueces
        return view('admin.judments.judment', [
            'rotationJudges' => $rotationJudges, //Juez que comienza el juicio y el brazo inicial
            'carrier' => $carrier, //Portador A
            'control' => $control, //Control 1,2,3,4
            'evaluated' => $evaluated, //Datos de la evaluación de la fragancia
            'counter' => $judmentNumber, //Número del juicio que continúa
            'number_judges' => $judges, //número de jueces
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
        /**
         * Validación para identificar si la fragancia del brazo izquierdo
         * corresponde a la fragancia de código 1 en la tabla de EvaluatedFragance
         * Si si corresponde entonces se coloca en la columan izquierda la calificación 
         * y el código de la fragancia.
         * 
         * ---Validación si la fragancia 1 del juicio es igual a la fragancia 1 registrada en
         * la evaluación de fragancias
         * $validation_fragance_1 = EvaluatedFragance::where('fragance_test_code_1', '=', $request->input('fragance_code_test_1'))
                                ->where('id_evaluated_fragance', '=', $request->input('id_evaluated_fragance'))
                                ->count();
         *---Validación si la fragancia 1 del juicio es igual al benchmark
                    $validation_fragance_1 = EvaluatedFragance::where('benchmark', '=', $request->input('fragance_code_test_1'))
                    ->where('id_evaluated_fragance', '=', $request->input('id_evaluated_fragance'))
                    ->count();
         */
        $validation_fragance_1 = EvaluatedFragance::where('benchmark', '=', $request->input('fragance_code_test_1'))
            ->where('id_evaluated_fragance', '=', $request->input('id_evaluated_fragance'))
            ->count();
        switch ($number_judges) {
            case 8:
                if ($counter < 9) {
                    //inserción del juicios de 1 al 7
                    switch ($control) {
                        case 1:
                            if ($validation_fragance_1 == 0) {
                                //Inserción de la calificación del primer código
                                $judment1 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'fragance_1' => $request->input('fragance_code_test_1'),
                                        'carrier_type' => $request->input('carrier'),
                                    ],
                                    [
                                        'qualification_control_1_frag_1' => $request->input('quality_1')
                                    ]
                                );
                                //Inserción de la calificación del segundo código
                                $judment2 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    [
                                        'fragance_2' => $request->input('fragance_code_test_2'),
                                        'qualification_control_1_frag_2' => $request->input('quality_2')
                                    ]
                                );
                            } else {
                                //Inserción de la calificación del primer código
                                $judment1 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'fragance_1' => $request->input('fragance_code_test_2'),
                                        'carrier_type' => $request->input('carrier'),
                                    ],
                                    ['qualification_control_1_frag_1' => $request->input('quality_2')]
                                );
                                //Inserción de la calificación del segundo código
                                $judment2 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    [
                                        'fragance_2' => $request->input('fragance_code_test_1'),
                                        'qualification_control_1_frag_2' => $request->input('quality_1')
                                    ]
                                );
                            }
                            break;
                        case 2:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                            break;
                        case 3:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                            break;
                        case 4:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_2' => $request->input('quality_1')
                                    ]);
                            }
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
                                    break;
                            }
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
                                    'test_identifier',
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
                                    break;
                            }
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
                                    'test_identifier',
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
                    //Retorno de vista de formulario con el siguiente juez
                    return view('admin.judments.judment', [
                        'rotationJudges' => $rotationJudges, //Juez que inicia y el brazo inicial
                        'carrier' => $carrier, //portador
                        'control' => $control,
                        'evaluated' => $evaluated, //Datata para el formulario
                        'counter' => $counter,
                        'number_judges' => $number_judges, // Total de jueces para la evaluacion
                        'message' => 'Evaluación registrada!'
                    ]);
                } else {
                    //Inserción del juicio 8
                    switch ($control) {
                        case 1:
                            if ($validation_fragance_1 == 0) {
                                //Inserción de la calificación del primer código
                                $judment1 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'fragance_1' => $request->input('fragance_code_test_1'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    ['qualification_control_1_frag_1' => $request->input('quality_1')]
                                );
                                //Inserción de la calificación del segundo código
                                $judment2 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    [
                                        'fragance_2' => $request->input('fragance_code_test_2'),
                                        'qualification_control_1_frag_2' => $request->input('quality_2')
                                    ]
                                );
                            } else {
                                //Inserción de la calificación del primer código
                                $judment1 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'fragance_1' => $request->input('fragance_code_test_2'),
                                        'carrier_type' => $request->input('carrier'),
                                    ],
                                    ['qualification_control_1_frag_1' => $request->input('quality_2')]
                                );
                                //Inserción de la calificación del segundo código
                                $judment2 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    [
                                        'fragance_2' => $request->input('fragance_code_test_1'),
                                        'qualification_control_1_frag_2' => $request->input('quality_1')
                                    ]
                                );
                            }
                            break;
                        case 2:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                            break;
                        case 3:

                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                            break;
                        case 4:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                            break;
                    }
                    return redirect()->route('admin.environmentals.index')->with([
                        'control' => $control,
                        'carrier' => $carrier,
                        'idEvaluated' => $idEvaluated,
                        'judges' => 8,
                        'carrier_name' => $carrier_name
                    ]);
                }
                break;
            case 12:
                if ($counter < 13) {
                    //inserción del juicios de 1 al 11
                    switch ($control) {
                        case 1:
                            if ($validation_fragance_1 == 0) {
                                //Inserción de la calificación del primer código
                                $judment1 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'fragance_1' => $request->input('fragance_code_test_1'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    [
                                        'qualification_control_1_frag_1' => $request->input('quality_1')
                                    ]
                                );
                                //Inserción de la calificación del segundo código
                                $judment2 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    [
                                        'fragance_2' => $request->input('fragance_code_test_2'),
                                        'qualification_control_1_frag_2' => $request->input('quality_2')
                                    ]
                                );
                            } else {
                                //Inserción de la calificación del primer código
                                $judment1 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'fragance_1' => $request->input('fragance_code_test_2'),
                                        'carrier_type' => $request->input('carrier'),
                                    ],
                                    ['qualification_control_1_frag_1' => $request->input('quality_2')]
                                );
                                //Inserción de la calificación del segundo código
                                $judment2 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    [
                                        'fragance_2' => $request->input('fragance_code_test_1'),
                                        'qualification_control_1_frag_2' => $request->input('quality_1')
                                    ]
                                );
                            }
                            break;
                        case 2:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                            break;
                        case 3:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                            break;
                        case 4:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                    }

                    //validación de parámetros para siguiente juez
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
                            break;
                    }
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
                            'test_identifier',
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

                    //Retorno de vista de formulario con el siguiente juez
                    return view('admin.judments.judment', [
                        'rotationJudges' => $rotationJudges, //Juez que inicia y el brazo inicial
                        'carrier' => $carrier, //portador
                        'control' => $control,
                        'evaluated' => $evaluated, //Datata para el formulario
                        'counter' => $counter,
                        'number_judges' => $number_judges, // Total de jueces para la evaluacion
                        'message' => 'Evaluación registrada!'
                    ]);
                } else {
                    //inserción del juicio 12
                    switch ($control) {
                        case 1:
                            if ($validation_fragance_1 == 0) {
                                //Inserción de la calificación del primer código
                                $judment1 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'fragance_1' => $request->input('fragance_code_test_1'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    ['qualification_control_1_frag_1' => $request->input('quality_1')]
                                );
                                //Inserción de la calificación del segundo código
                                $judment2 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    [
                                        'fragance_2' => $request->input('fragance_code_test_2'),
                                        'qualification_control_1_frag_2' => $request->input('quality_2')
                                    ]
                                );
                            } else {
                                //Inserción de la calificación del primer código
                                $judment1 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'fragance_1' => $request->input('fragance_code_test_2'),
                                        'carrier_type' => $request->input('carrier'),
                                    ],
                                    ['qualification_control_1_frag_1' => $request->input('quality_2')]
                                );
                                //Inserción de la calificación del segundo código
                                $judment2 = Judment::updateOrCreate(
                                    [
                                        'projects_id_project' => $request->input('id_proyecto'),
                                        'evaluated_fragances_id_evaluated_fragance' => $request->input('id_evaluated_fragance'),
                                        'judges_id_judge' => $request->input('id_judge'),
                                        'carrier_type' => $request->input('carrier')
                                    ],
                                    [
                                        'fragance_2' => $request->input('fragance_code_test_1'),
                                        'qualification_control_1_frag_2' => $request->input('quality_1')
                                    ]
                                );
                            }
                            break;
                        case 2:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_2_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                            break;
                        case 3:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_3_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                            break;
                        case 4:
                            if ($validation_fragance_1 == 0) {

                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_1' => $request->input('quality_1')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_2' => $request->input('quality_2')
                                    ]);
                            } else {
                                //Inserción de la calificació para el control 2 de la fragancia 1
                                $judment1 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_1', $request->input('fragance_code_test_2'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_1' => $request->input('quality_2')
                                    ]);
                                //Inserción de la calificació para el control 2 de la fragancia 2
                                $judment2 = Judment::where('evaluated_fragances_id_evaluated_fragance', $request->input('id_evaluated_fragance'))
                                    ->where('carrier_type', $request->input('carrier'))
                                    ->where('fragance_2', $request->input('fragance_code_test_1'))
                                    ->where('judges_id_judge', $request->input('id_judge'))
                                    ->update([
                                        'qualification_control_4_frag_2' => $request->input('quality_1')
                                    ]);
                            }
                            break;
                    }

                    //Update de estados de los controles
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
                    return redirect()->route('admin.environmentals.index')->with([
                        'control' => $control,
                        'carrier' => $carrier,
                        'idEvaluated' => $idEvaluated,
                        'judges' => 12,
                        'carrier_name' => $carrier_name
                    ]);
                }
        }
    }
}
