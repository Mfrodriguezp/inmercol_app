<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvironmentalCondition extends Model
{
    use HasFactory;
    public $table = "environmental_conditions";
    public $timestamps = false;
    protected $fillable =[
        'evaluated_fragances_id_evaluated_fragance',
        'carrier',
        'control_1_temp_start',
        'control_1_temp_end',
        'control_1_humidity_start',
        'control_1_humidity_end',
        'control_2_temp_start',
        'control_2_temp_end',
        'control_2_humidity_start',
        'control_2_humidity_end',
        'control_3_temp_start',
        'control_3_temp_end',
        'control_3_humidity_start',
        'control_3_humidity_end',
        'control_4_temp_start',
        'control_4_temp_end',
        'control_4_humidity_start',
        'control_4_humidity_end',
    ];

    //Uno a muchos inverso evaluación de fragancia
    public function evaluatedFragance()
    {
        return $this->belongsTo(EvaluatedFragance::class);
    }
}
