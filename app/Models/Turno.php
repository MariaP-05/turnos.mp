<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Turno extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_paciente', 'id_profesional', 'fecha' , 'hora_inicio', 'hora_fin' , 'id_lugar', 'descripcion'  ];

    protected $table = 'turnos';

    public function Paciente()
    {
        return $this->belongsTo('App\Models\Paciente', 'id_paciente');
    }
  
    public function Profesional()
    {
        return $this->belongsTo('App\Models\Profesional', 'id_profesional');
    }

    public function Lugar()
    {
        return $this->belongsTo('App\Models\Lugar', 'id_lugar');
    }

    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = trim($value) !== '' ? Carbon::createFromFormat('d-m-Y', $value)->toDateString()  : null;
    }

   public function getFechaAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    }
}
