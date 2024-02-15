<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudmentCounter extends Model
{
    use HasFactory;

    public $table = "judments_counter";
    public $timestamps = false;
    protected $fillable =[
        'judment_number'
    ];
}
