<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluatedFragance extends Model
{
    use HasFactory;
    public $table = "evaluated_fragances";
    public $primaryKey= 'id_evaluated_fragance';
    public $timestamps = false;
    protected $fillable =[
        'projects_id_project',
        'test_identifier',
        'fragance_name_1',
        'fragance_counter_1',
        'fragance_ms_1',
        'fragance_test_code_1',
        'fragance_name_2',
        'fragance_counter_2',
        'fragance_ms_2',
        'fragance_test_code_2',
        'number_judges',
        'rot_fragance_aplication',
        'name_carrier_a',
        'name_carrier_b',
        'benchmark',
        'control_1_a',
        'control_2_a',
        'control_3_a',
        'control_4_a',
        'control_1_b',
        'control_2_b',
        'control_3_b',
        'control_4_b',
        'code_1_test_a',
        'code_2_test_a',
        'code_1_test_b',
        'code_2_test_b',
        'status_evaluation'
    ];


    //Uno a muchos inversa con Proyectos, muchas evaluaciones pueden ser de un proyecto
    public function project(){
        return $this->belongsTo(Project::class);
    }
    //Relación uno a mucho con  Juicios
    public function judments(){
        return $this->hasMany(Judment::class);
    }
    //Relación uno a mucho con  Rotación para aplicación de fragancias en portadores
    public function rotationAplicationFrangances(){
        return $this->hasMany(RotationAplicationFragance::class);
    }
    //Relacion Uno a mucho en condiciones ambientales de la prueba
    public function environmentalConditions(){
        return $this->hasMany(EnvironmentalCondition::class);
    }
}
