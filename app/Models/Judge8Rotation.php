<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge8Rotation extends Model
{
    use HasFactory;

    public $table = "judges_8_rotations";
    public $timestamps = false;
    protected $fillable =[
        'judment_1',
        'judment_2',
        'judment_3',
        'judment_4',
        'judment_5',
        'judment_6',
        'judment_7',
        'judment_8'
    ];

    //Relación muchos a muchos con start_8_evaluations
    public function startEvaluations(){
        return $this->belongsToMany(Start8Evaluation::class);
    }
}
