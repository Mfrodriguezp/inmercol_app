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
        /*$last_evaluated = DB::table('evaluated_fragances')
            ->where('projects_id_project', '=', $id_project)
            ->orderBy('id_evaluated_fragance', 'desc')
            ->take(1)
            ->pluck('rot_fragance_aplication')
            ->first();*/

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
            $rotation ++;
        }

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
        /*
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
        ];*/
        //Query para actualizar Evaluación de fragancia
        $evaluated = EvaluatedFragance::where('id_evaluated_fragance', $id)
            ->update([
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
            ]);

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
