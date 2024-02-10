<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('admin.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project_name = $request->input('project_name');
        $id_client = intval($request->input('id_client'));
        $client_name = $request->input('client_name');
        $id_analisys = $request->input('id_analisys');
        //var_dump($client_name);
        //die();
        if (is_null($client_name)) {
            /*$Proyecto = DB::table('projects')
                ->insert([
                    'project_name' => $project_name,
                    'id_analisys' => $id_analisys,
                    'clients_id_client' => $id_client
                ]);*/
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
            /*$Proyecto = DB::table('projects')
                ->insert([
                    'project_name' => $project_name,
                    'id_analisys' => $id_analisys,
                    'clients_id_client' => $id_client
                ]);*/
            $proyecto = Project::create([
                'project_name' => $project_name,
                'id_analisys' => $id_analisys,
                'clients_id_client' => $id_client
            ]);
            session()->flash('status', 'Proyecto creado satisfactoriamente');
            return redirect()->to('/projects');
        }
        /*$nuevaFruta = DB::table('frutas')->insert([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'fecha' => date('Y-m-d')
        ]);*/
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
