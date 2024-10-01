<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Sesion extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *  Schema::create('sesiones', function (Blueprint $table) {
      

     */
    protected $fillable = ['id_paciente', 'id_profesional', 'cantidad_recetada' ,
     'cantidad_turnos_reales', 'cantidad_turnos_realizados', 'fecha_inicio','fecha_fin'
     ];

    protected $table = 'sesiones';

    public function Paciente()
    {
        return $this->belongsTo('App\Models\Paciente', 'id_paciente');
    }
  
    public function Profesional()
    {
        return $this->belongsTo('App\Models\Profesional', 'id_profesional');
    }

    public function setFechaInicioAttribute($value)
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
        $this->attributes['fecha_inicio']=$p;
    }
  
    public function getFechaInicioAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    } 
 
    public function setFechaFinAttribute($value)
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
        $this->attributes['fecha_fin']=$p;
    }
  
    public function getFechaFinAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    } 

}
