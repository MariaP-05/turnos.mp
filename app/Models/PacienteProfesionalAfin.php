<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class PacienteProfesionalAfin extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_profesional_afin', 'id_paciente', 'fecha_desde', 'fecha_hasta'];


    protected $table = 'profesionales_afines';

    public function Paciente()
    {
        return $this->belongsTo('App\Models\Paciente', 'id_paciente');
    }
    public function ProfesionalAfin()
    {
        return $this->belongsTo('App\Models\ProfesionalAfin', 'id_profesional_afin');
    }
}
