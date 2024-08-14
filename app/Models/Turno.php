<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Turno extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_paciente', 'id_profesional', 'fecha' , 'hora_inicio', 'hora_fin' , 
    'id_estado_turnos' , 'id_institucion', 'descripcion'  ];

    protected $table = 'turnos';

    public function Paciente()
    {
        return $this->belongsTo('App\Models\Paciente', 'id_paciente');
    }
  
    public function Profesional()
    {
        return $this->belongsTo('App\Models\Profesional', 'id_profesional');
    }

    public function Institucion()
    {
        return $this->belongsTo('App\Models\Institucion', 'id_institucion');
    }

    public function setFechaAttribute($value)
    {
        if(trim($value) !== '')
        {
            $p = new Carbon($value);
            $p = $p->format('Y-m-d');
        }
        else
        {
            $p = null;
        }
        $this->attributes['fecha']=$p;
    }

   public function getFechaAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    }


 /* se utiliza para elegir cuándo se puede editar
 
    public function canEdit()
    {
        return(
            $this->estado === "Programado" || $this->estado === "Cancelado" ||$this->estado ==="Consulta" || $this->estado === "Tratamiento"
        );
    }

*/

}
