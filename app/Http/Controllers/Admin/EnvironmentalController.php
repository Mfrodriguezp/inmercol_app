<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnvironmentalCondition;
use App\Models\EvaluatedFragance;
use App\Models\Project;

class EnvironmentalController extends Controller
{
   
    
    public function index()
    {
        return view('admin.environmentals.index');
    }

    public function store(Request $request){
        $idEvaluated = $request->input('idEvaluated'); //Evaluación de Fragancia
        $control = $request->input('control'); //Control
        $carrier = $request->input('carrier'); //Portador
        $temperature = $request->input('temperature');//Temperatura
        $temperature = str_replace(',', '.',$temperature); // Reemplazo de coma por punto
        $humiditity = $request->input('humidity'); //Humedad
        $judges = $request->input('judges'); //Número de jueces
        $carrier_name = $request->input('carrier_name'); //Nombre del Portador
        
        #Query para validar si existe un control de Temperatura y humedad ya insertado
        
        $validation = EnvironmentalCondition::where('evaluated_fragances_id_evaluated_fragance', $idEvaluated)
            ->where('carrier', $carrier)
            ->count('control_'.$control.'_temp_start');
        
        if($validation!=0){
            #Inserción de Humedad y temperatura al finalizar los juicios
            $queryInsert = EnvironmentalCondition::updateOrCreate(
                [
                    'evaluated_fragances_id_evaluated_fragance' => $idEvaluated,
                    'carrier' => $carrier,
                ],
                [
                    'control_'.$control.'_temp_end' => $temperature,
                    'control_'.$control.'_humidity_end' => $humiditity
                ]
            );

            //Update del status de cada control
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
                            /*
                            $upd_last_evaluation = Project::find($idProject);
                            $upd_last_evaluation->last_evaluation = now('America/Bogota');
                            $upd_last_evaluation->save();
                            break;
                            */
                    }
                    break;
            }

            return redirect()->route('admin.judments.index')
                        ->with('ok', 'El control ' . $control . ' del portador ' . $carrier_name . ' ha sido guardado correctamente.');
        }else{
            #Inserción de Humedad y temperatura al iniciar los juicios
            $queryInsert = EnvironmentalCondition::updateOrCreate(
                [
                    'evaluated_fragances_id_evaluated_fragance' => $idEvaluated,
                    'carrier' => $carrier,
                ],
                [
                    'control_'.$control.'_temp_start' => $temperature,
                    'control_'.$control.'_humidity_start' => $humiditity
                ]
            );

            return redirect()->route('admin.judments.judment', [
                'carrier' => $carrier,
                'control' => $control,
                'idEvaluated' => $idEvaluated,
                'judges' => $judges
            ]);
        }
    }
}
