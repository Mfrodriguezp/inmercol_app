<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RotationAplicationFragance extends Model
{
    use HasFactory;
    protected $primaryKey = 'idrotation_aplication_fragances';
    protected $fillable =[
        'fragance_carrier_a_arm_right',
        'fragance_carrier_a_arm_left',
        'fragance_carrier_b_arm_right',
        'fragance_carrier_b_arm_left',
        'evaluated_fragances_id_evaluated_fragance'
    ];

    //Uno a muchos inversa con Juicios, muchas rotaciones pueden pertenecer a una evaluación de fragancias
    public function evaluatedFragance(){
        return $this->belongsTo(EvaluatedFragance::class);
    }

}
