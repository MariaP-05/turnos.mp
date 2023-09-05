<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteServicios extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_cliente', 'id_servicio','fecha_desde','fecha_hasta',
    'observaciones'      ];

    protected $table = 'clientes_servicios';

    public function Cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'id_cliente');
    }

    public function Servicio()
    {
        return $this->belongsTo('App\Models\Servicio', 'id_servicio');
    }

    public function setFechaDesdeAttribute($value)
    {
        $this->attributes['fecha_desde'] = trim($value) !== '' ? Carbon::createFromFormat('d-m-Y', $value)->toDateString()  : null;
    }

    public function getFechaDesdeAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    }

    public function setFechaHastaAttribute($value)
    {
        $this->attributes['fecha_hasta'] = trim($value) !== '' ? Carbon::createFromFormat('d-m-Y', $value)->toDateString()  : null;
    }

    public function getFechaHastaAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    }
}
