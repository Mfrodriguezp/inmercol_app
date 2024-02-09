<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_judge';
    public $timestamps = false;
    protected $fillable =[
        'judge_number',
        'judge_name'
    ];

    public function judments(){
        return $this->hasMany(Judment::class);
    }
}
