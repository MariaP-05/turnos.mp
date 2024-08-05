<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Obra_social extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'denominacion' , 'cuit', 'telefono' , 'direccion'  ];
    protected $table = 'obras_sociales';

    /*
    public function Seccion()
    {
        return $this->belongsTo('App\Models\Seccion', 'id_seccion');
    }

    public function Forma_pago()
    {
        return $this->belongsTo('App\Models\Forma_pago', 'id_forma_pago');
    }

    public function Productor()
    {
        return $this->belongsTo('App\Models\Productor', 'id_productor');
    }

    public function Cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'id_cliente');
    }
    
    public function Compania()
    {
        return $this->belongsTo('App\Models\Compania', 'id_compania');
    }

    public function setVigenciaDesdeAttribute($value)
    {
        $this->attributes['vigencia_desde'] = trim($value) !== '' ? Carbon::createFromFormat('d-m-Y', $value)->toDateString()  : null;
    }

    public function getVigenciaDesdeAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    }

    public function setVigenciaHastaAttribute($value)
    {
        $this->attributes['vigencia_hasta'] = trim($value) !== '' ? Carbon::createFromFormat('d-m-Y', $value)->toDateString()  : null;
    }

    public function getVigenciaHastaAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    }*/
}
