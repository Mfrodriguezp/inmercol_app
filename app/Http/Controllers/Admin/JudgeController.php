<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Judge;

class JudgeController extends Controller
{

    //Función index página judges
    public function index()
    {
        return view('admin.judges.index');
    }
    //Funcion para crear
    public function store(Request $request)
    {
        $judge_name = $request->input('judge_name');
        $judge_number = $request->input('judge_number');

        $judge = Judge::create([
            'judge_name' => $judge_name,
            'judge_number' => $judge_number
        ]);

        return redirect()->route('admin.judges.index')
            ->with('ok', 'Juez Creado Satisfactoriamente');
    }

    //Función para editar juez
    public function update(Request $request)
    {
        $id = $request->input('id');
        $judge_name = $request->input('judge_name');
        $judge_number = $request->input('judge_number');
        //Query para actualizar Juez
        $judge= Judge::where('id_judge', $id)
        ->update([
            'judge_name' => $judge_name,
            'judge_number' => $judge_number
        ]);

        return redirect()->route('admin.judges.index')
            ->with('ok', 'Juez Actualizado!');

    }

    public function destroy($judge){
        
        
        $judge=Judge::find($judge);
        $judge->delete();
        
        return redirect()->route('admin.judges.index')
            ->with('ok', 'Registro Eliminado!');
    }
}
