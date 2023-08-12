<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
 
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicioValor extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_servicio', 'fecha','valor'     ];

    protected $table = 'servicios_valor';

    public function Servicio()
    {
        return $this->belongsTo('App\Models\Servicio', 'id_servicio');
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
