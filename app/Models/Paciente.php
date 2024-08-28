<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    protected $fillable = ['nombre','dni','direccion','telefono','celular','mail', 'id_localidad' ,'fecha_nacimiento',
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
    
/*
    public function Polizas()
    {
        return $this->hasMany('App\Models\Poliza', 'id_cliente');
    }*/

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
