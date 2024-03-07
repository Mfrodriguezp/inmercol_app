<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judment extends Model
{
    use HasFactory;
    public $table ='judments';
    protected $primaryKey = 'id_judment';
    public $timestamps = false;
    protected $fillable = [
        'projects_id_project',
        'evaluated_fragances_id_evaluated_fragance',
        'judges_id_judge',
        'fragance_1',
        'carrier_type',
        'qualification_control_1_frag_1',
        'qualification_control_2_frag_1',
        'qualification_control_3_frag_1',
        'qualification_control_4_frag_1',
        'fragance_2',
        'qualification_control_1_frag_2',
        'qualification_control_2_frag_2',
        'qualification_control_3_frag_2',
        'qualification_control_4_frag_2',
        'evaluation_date'
    ];

    public function judge()
    {
        return $this->belongsTo(Judge::class);
    }
    //Uno a muchos inverso Proyecto
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    //Uno a muchos inverso evaluación de fragancia
    public function evaluatedFragance()
    {
        return $this->belongsTo(EvaluatedFragance::class);
    }

}
