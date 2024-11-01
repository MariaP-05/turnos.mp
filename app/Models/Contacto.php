<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contacto extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['nombre','dni','direccion','telefono', 'telefono_aux',
    'mail', 'id_localidad',
     'id_paciente' 
        ,'fecha_nacimiento' , 'relacion', 'observacion'];

    protected $table = 'contactos';

    public function Localidad()
    {
        return $this->belongsTo('App\Models\Localidad', 'id_localidad');
    }

    public function Paciente()
    {
        return $this->belongsTo('App/Models/Paciente' , 'id_paciente');
    }

    public function setFechaNacimientoAttribute($value)
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
        $this->attributes['fecha_nacimiento']=$p;
    }
  
    public function getFechaNacimientoAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    } 
}
