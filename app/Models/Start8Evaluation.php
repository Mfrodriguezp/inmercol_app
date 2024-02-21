<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Start8Evaluation extends Model
{
    use HasFactory;
    public $table = "start_8_evaluatios";
    public $timestamps = false;
    protected $fillable = [
        'judge_1_a',
        'judge_1_b',
        'judge_2_a',
        'judge_2_b',
        'judge_3_a',
        'judge_3_b',
        'judge_4_a',
        'judge_4_b',
        'judge_5_a',
        'judge_5_b',
        'judge_6_a',
        'judge_6_b',
        'judge_7_a',
        'judge_7_b',
        'judge_8_a',
        'judge_8_b'
    ];

    //relación muchos a muchos con judges_8_rotations
    public function judgeRotations()
    {
        return $this->belongsToMany(Judge8Rotation::class);
    }
}
