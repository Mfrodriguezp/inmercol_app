<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index');
    }


    public function store(Request $request)
    {
        $project_name = $request->input('project_name');
        $id_client = intval($request->input('id_client'));
        $client_name = $request->input('client_name');
        $id_analisys = $request->input('id_analisys');
        //var_dump($client_name);
        //die();
        if (is_null($client_name)) {
            $proyecto = Project::create([
                'project_name' => $project_name,
                'id_analisys' => $id_analisys,
                'clients_id_client' => $id_client
            ]);
            return redirect()->action([ProjectController::class, 'index'])
                ->with('success', 'Proyecto Creado Correctamente!');
        } else {

            $newClient = Client::create([
                'client_name' => $client_name
            ]);

            //extracción del id_client del último registro creado
            $id_client = Client::all(['id_client'])->sortByDesc('id_client')->splice(0, 1);
            $id = $id_client->value('id_client');

            //Insert para crear nuevo proyecto con el id extraido
            $proyecto = Project::create([
                'project_name' => $project_name,
                'id_analisys' => $id_analisys,
                'clients_id_client' => $id
            ]);
            return redirect()->action([ProjectController::class, 'index'])
                ->with('success', 'Proyecto Creado Correctamente!');
        }
    }

    public function update(Request $request)
    {
        //Data recibida desde el formulario para update
        $id = $request->input('id');
        $id_analisys = $request->input('id_analisys');
        $project_name = $request->input('project_name');
        $id_client = $request->input('id_client');

        //Insert de data para el upate del proyecto
        $project = Project::where('id_project', $id)
            ->update([
                'id_analisys'=>$id_analisys,
                'project_name'=>$project_name,
            'clients_id_client'=>$id_client
            ]);

            return redirect()->action([ProjectController::class, 'index'])
                ->with('success', 'Proyecto Actualizado Correctamente!');
            
    }

    public function destroy(string $id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect()->action([ProjectController::class, 'index'])
            ->with('success', 'Proyecto Eliminado Correctamente!');
    }
}
