<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluatedFragance extends Model
{
    use HasFactory;
    public $table = "evaluated_fragances";
    public $primarKey= 'id_evaluated_fragance';
    public $timestamps = false;
    protected $fillable =[
        'tb',
        'projects_id_project',
        'fragance_name_1',
        'fragance_counter_1',
        'fragance_ms_1',
        'fragance_test_code_1',
        'fragance_name_2',
        'fragance_counter_2',
        'fragance_ms_2',
        'fragance_test_code_2',
        'rot_fragance_aplication',
        'name_carrier_a',
        'name_carrier_b',
        'control_1',
        'control_2',
        'control_3',
        'control_4',
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
}
