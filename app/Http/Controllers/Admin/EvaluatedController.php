<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Livewire\Admin\Evaluateds;
use Illuminate\Http\Request;
use App\Models\EvaluatedFragance;
use App\Models\RotationAplicationFragance;
use Illuminate\Support\Facades\DB;

class EvaluatedController extends Controller
{
    public function index()
    {
        return view('admin.evaluateds.index');
    }

    //Funcion para crear
    public function store(Request $request)
    {
        $number_judges = $request->input('number_judges'); // Input de número de jueces
        /*---------Validación de rotación--------------*/
        $id_project = $request->input('projects_id_project');

        //Query para extraer la rotación de fragancia
        $last_evaluated = EvaluatedFragance::all()
            ->where('projects_id_project', '=', $id_project)
            ->sortByDesc('id_evaluated_fragance')
            ->take(1)
            ->pluck('rot_fragance_aplication')
            ->first();

        //Asignación de valor para la rotación de aplicación de fragancia
        $rotation = 0;
        if (is_null($last_evaluated)) {
            $rotation = 1;
        } elseif ($last_evaluated == 4) {
            $rotation = 1;
        } else {
            $rotation += $last_evaluated;
            $rotation++;
        }

        /*

        Aleatorización de jueces y brazo inicial

        $random_judges_a = []; //Array de rotaciones de jueces portadores a
        $random_judges_b = []; //Array de rotaciones de jueces portadores b
        $start_rotation_a = []; //array para rotación de brazo_portadores a
        $start_rotation_b = []; //array para rotación de brazo_portadores b

        //Creación de rotación de jueces según su cantidad (8 o 12 Jueces)
        switch ($number_judges) {
            case 8:
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
                break;
            case 12:
                //Eliminación de la tabla de rotacion de jueces para limpiarla
                $delete_rotations_judges = DB::table('judges_12_rotations_has_start_12_evaluations')
                    ->delete();

                //Selección de rotaciones aleatorias para inseción en la tabla de muchos a muchos
                for ($i = 1; $i < 5; $i++) {
                    //Ingreso de valores en la primera rotación de jueces
                    if (count($random_judges_a) == 0) {
                        $rand = rand(1, 400); //Creación de número aleatorio
                        array_push($random_judges_a, $rand);
                    } else {
                        $rand = rand(1, 400); //Creación de número aleatorio
                        while (in_array($rand, $random_judges_a)) {
                            $rand = rand(1, 400);
                        }
                        array_push($random_judges_a, $rand);
                    }

                    //Ingreso de valores en la segunda rotación de jueces
                    $rand = rand(1, 400); //Creación de número aleatorio
                    if (count($random_judges_b) == 0 && !in_array($rand, $random_judges_a)) {
                        array_push($random_judges_b, $rand);
                    } else {
                        $rand = rand(1, 400); //Creación de número aleatorio
                        while (in_array($rand, $random_judges_b) || in_array($rand, $random_judges_a)) {
                            $rand = rand(1, 400);
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

                    //Ingreso de valores en la rotacion de brazos portador a
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

                $rotation_12_judges = DB::table('judges_12_rotations_has_start_12_evaluations')
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
                break;
        }
        */

        //Data Del formulario
        $record = [

            'projects_id_project' => $request->input('projects_id_project'),
            'test_identifier' => $request->input('test_identifier'),
            'fragance_name_1' => $request->input('fragance_name_1'),
            'fragance_counter_1' => $request->input('fragance_counter_1'),
            'fragance_ms_1' => $request->input('fragance_ms_1'),
            'fragance_test_code_1' => $request->input('fragance_test_code_1'),
            'fragance_name_2' => $request->input('fragance_name_2'),
            'fragance_counter_2' => $request->input('fragance_counter_2'),
            'fragance_ms_2' => $request->input('fragance_ms_2'),
            'fragance_test_code_2' => $request->input('fragance_test_code_2'),
            'number_judges' => $request->input('number_judges'),
            'rot_fragance_aplication' => $rotation,
            'name_carrier_a' => $request->input('name_carrier_a'),
            'name_carrier_b' => $request->input('name_carrier_b'),
            'code_1_test_a' => $request->input('code_1_test_a'),
            'code_2_test_a' => $request->input('code_2_test_a'),
            'code_1_test_b' => $request->input('code_1_test_b'),
            'code_2_test_b' => $request->input('code_2_test_b')
        ];

        $evaluated = EvaluatedFragance::create($record);

        return redirect()->route('admin.evaluateds.index')
            ->with('success', 'Evaluación Creada Satisfactoriamente')
            ->with('info', 'Aplicación de Fragancias para Portadores');
    }

    //Función para editar juez
    public function update(Request $request)
    {
        //Id de la evaluación de fragancia
        $id = $request->input('id');

        //Datos del formulario para enviar
        $record = [
            'projects_id_project' => $request->input('projects_id_project'),
            'test_identifier' => $request->input('test_identifier'),
            'fragance_name_1' => $request->input('fragance_name_1'),
            'fragance_counter_1' => $request->input('fragance_counter_1'),
            'fragance_ms_1' => $request->input('fragance_ms_1'),
            'fragance_test_code_1' => $request->input('fragance_test_code_1'),
            'fragance_name_2' => $request->input('fragance_name_2'),
            'fragance_counter_2' => $request->input('fragance_counter_2'),
            'fragance_ms_2' => $request->input('fragance_ms_2'),
            'fragance_test_code_2' => $request->input('fragance_test_code_2'),
            'number_judges' => $request->input('number_judges'),
            'name_carrier_a' => $request->input('name_carrier_a'),
            'name_carrier_b' => $request->input('name_carrier_b'),
            'code_1_test_a' => $request->input('code_1_test_a'),
            'code_2_test_a' => $request->input('code_2_test_a'),
            'code_1_test_b' => $request->input('code_1_test_b'),
            'code_2_test_b' => $request->input('code_2_test_b')
        ];
        //Query para actualizar Evaluación de fragancia
        $evaluated = EvaluatedFragance::where('id_evaluated_fragance', $id)
            ->update($record);

        return redirect()->route('admin.evaluateds.index')
            ->with('success', 'Evaluación de Fragancia Actualizada Satisfactoriamente');
    }

    public function destroy($evaluated)
    {


        $evaluated = EvaluatedFragance::find($evaluated);
        $evaluated->delete();

        return redirect()->route('admin.evaluateds.index')
            ->with('success', 'Registro Eliminado Satisfactoriamente');
    }
}
