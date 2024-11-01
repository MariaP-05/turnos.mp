<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Paciente extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre','dni','direccion','telefono','celular','mail', 'id_localidad' 
                                ,'fecha_nacimiento',
                           'id_obra_social' , 'numero_afiliado'];
                           
    protected $table = 'pacientes';

    public function Localidad()
    {
        return $this->belongsTo('App\Models\Localidad', 'id_localidad');
    }

    public function Obra_social()
    {
        return $this->belongsTo('App\Models\Obra_social', 'id_obra_social');
    }
    
    public function Sesiones()
    {
        return $this->hasMany('App\Models\Sesion', 'id_paciente');
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

    public static function countFiles($id)
    {
        $path = public_path() . '/storage/pacientes/' . $id . '/archivos/*'; //Declaramos un  variable con la ruta donde guardaremos los archivos
        $i = 0;
        foreach (glob("$path") as $filename) {
            $i++;
        }
        return ' ' . $i;
    }
}
