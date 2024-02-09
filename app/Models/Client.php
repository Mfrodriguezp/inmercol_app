<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_client';
    public $timestamps = false;
    protected $fillable = [
        'client_name',
        'contac_number',
        'client_agent'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
