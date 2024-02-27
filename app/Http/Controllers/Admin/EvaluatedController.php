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
        //Validación de rotación
        $id_project = $request->input('projects_id_project');

        //Query para extraer la rotación de fragancia
        $last_evaluated = EvaluatedFragance::all()
            ->where('projects_id_project', '=', $id_project)
            ->sortByDesc('id_evaluated_fragance')
            ->take(1)
            ->pluck('rot_fragance_aplication')
            ->first();

        //Asignación de valorpara la rotación de aplicación de fragancia
        $rotation = 0;
        if (is_null($last_evaluated)) {
            $rotation = 1;
        } elseif ($last_evaluated == 4) {
            $rotation = 1;
        } else {
            $rotation += $last_evaluated;
            $rotation++;
        }

        //Lógica para rotación insertar rotación de jueces
        $random_judges_a = []; //Array de rotaciones de jueces portadores a
        $random_judges_b = []; //Array de rotaciones de jueces portadores b
        $start_rotation_a = []; //array para rotación de brazo_portadores a
        $start_rotation_b = []; //array para rotación de brazo_portadores b

        
        for ($i = 1; $i < 5; $i++) {
            //Ingreso de valores en la primera rotación de jueces
            if (count($random_judges_a) == 0) {
                $rand = rand(1, 97); //Creación de número aleatorio
                array_push($random_judges_a, $rand);
            } else {
                $rand = rand(1, 97); //Creación de número aleatorio
                while (in_array($rand, $random_judges_a)) {
                    $rand = rand(1, 97);
                }
                array_push($random_judges_a, $rand);
            }

            //Ingreso de valores en la segunda rotación de jueces
            $rand = rand(1, 97);//Creación de número aleatorio
            if (count($random_judges_b) == 0 && !in_array($rand, $random_judges_a)) {
                array_push($random_judges_b, $rand);
            } else {
                $rand = rand(1, 97); //Creación de número aleatorio
                while (in_array($rand, $random_judges_b) || in_array($rand, $random_judges_a)) {
                    $rand = rand(1, 97);
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

        //var_dump($random_judges_a,$random_judges_b,$start_rotation_a,$start_rotation_b);
        //die();
        //Inserción de datos en la tabla de relación de datos para rotación de jueces

        $rotation_judges_a_control_1 = DB::table('judges_8_rotations_has_start_8_evaluations')
        ->where('control','=',1)
        ->where('carrier','=','a')
        ->update([
            'judges_8_rotations_id'=>$random_judges_a[0],
            'start_8_evaluations_id'=>$start_rotation_a[0]
        ]);

        $rotation_judges_a_control_2 = DB::table('judges_8_rotations_has_start_8_evaluations')
        ->where('control','=',2)
        ->where('carrier','=','a')
        ->update([
            'judges_8_rotations_id'=>$random_judges_a[1],
            'start_8_evaluations_id'=>$start_rotation_a[1]
        ]);

        $rotation_judges_a_control_3 = DB::table('judges_8_rotations_has_start_8_evaluations')
        ->where('control','=',3)
        ->where('carrier','=','a')
        ->update([
            'judges_8_rotations_id'=>$random_judges_a[2],
            'start_8_evaluations_id'=>$start_rotation_a[2]
        ]);

        $rotation_judges_a_control_4 = DB::table('judges_8_rotations_has_start_8_evaluations')
        ->where('control','=',4)
        ->where('carrier','=','a')
        ->update([
            'judges_8_rotations_id'=>$random_judges_a[3],
            'start_8_evaluations_id'=>$start_rotation_a[3]
        ]);

        $rotation_judges_b_control_1 = DB::table('judges_8_rotations_has_start_8_evaluations')
        ->where('control','=',1)
        ->where('carrier','=','b')
        ->update([
            'judges_8_rotations_id'=>$random_judges_b[0],
            'start_8_evaluations_id'=>$start_rotation_b[0]
        ]);

        $rotation_judges_b_control_2 = DB::table('judges_8_rotations_has_start_8_evaluations')
        ->where('control','=',2)
        ->where('carrier','=','b')
        ->update([
            'judges_8_rotations_id'=>$random_judges_b[1],
            'start_8_evaluations_id'=>$start_rotation_b[1]
        ]);

        $rotation_judges_b_control_3 = DB::table('judges_8_rotations_has_start_8_evaluations')
        ->where('control','=',3)
        ->where('carrier','=','b')
        ->update([
            'judges_8_rotations_id'=>$random_judges_b[2],
            'start_8_evaluations_id'=>$start_rotation_b[2]
        ]);

        $rotation_judges_b_control_4 = DB::table('judges_8_rotations_has_start_8_evaluations')
        ->where('control','=',4)
        ->where('carrier','=','b')
        ->update([
            'judges_8_rotations_id'=>$random_judges_b[3],
            'start_8_evaluations_id'=>$start_rotation_b[3]
        ]);



        //Data Del formulario
        $record = [
            'tb' => $request->input('tb'),
            'projects_id_project' => $request->input('projects_id_project'),
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
            'tb' => $request->input('tb'),
            'projects_id_project' => $request->input('projects_id_project'),
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
            ->update($record/*[
                'tb' => $request->input('tb'),
                'projects_id_project' => $request->input('projects_id_project'),
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
            ]*/);

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
