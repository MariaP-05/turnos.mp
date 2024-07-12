<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;
/*use Illuminate\Database\Carbon;*/

class Cliente extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['denominacion', 'denominacion_amigable','observaciones','cuit','direccion','telefono','celular','nombre_contacto',
    'mail','mail_2', 'id_localidad' ,'fecha_nacimiento'      
    ];
    protected $table = 'clientes';

    public function Localidad()
    {
        return $this->belongsTo('App\Models\Localidad', 'id_localidad');
    }
/*
    public function TipoCliente()
    {
        return $this->belongsTo('App\Models\TipoCliente', 'id_tipo_cliente');
    }
*/
    public function Polizas()
    {
        return $this->hasMany('App\Models\Poliza', 'id_cliente');
    }
/*
    public function setFechaNacimientoAttribute($value)
    {
        $this->attributes['fecha_nacimiento'] = trim($value) !== '' ? Carbon::createFromFormat('d-m-Y', $value)->toDateString()  : null;
    }

   public function getFechaNacimientoAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    } */
}
