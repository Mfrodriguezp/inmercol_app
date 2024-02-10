<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $table = "projects";
    protected $primaryKey = 'id_project';
    public $timestamps = false;
    protected $fillable =[
        'project_name',
        'id_analisys',
        'clients_id_client',
        'status',
        'date_creation',
        'last_evaluation',
    ];

    //Relación uno a muchos inversa con clientes
    public function client(){
        return $this->belongsTo(Client::class);
    }
    //Uno a muchos con Juicios, un proyecto, puede tener muchos juicios
    public function judments(){
        return $this->hasMany(Judment::class);
    }
    //Uno a muchos con Juicios, un proyecto, puede tener muchos juicios
    public function evaluatedFragances(){
        return $this->hasMany(EvaluatedFragance::class);
    }
}
