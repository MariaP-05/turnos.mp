<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Profesional extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'nombre', 'cuit', 'id_especialidad', 'mail', 'telefono', 'matricula',
'hora_inicio','hora_fin','minutos_hab'];

    protected $table = 'profesionales';

    public function Especialidad()
    {
        return $this->belongsTo('App\Models\Especialidad', 'id_especialidad');
    }
}
