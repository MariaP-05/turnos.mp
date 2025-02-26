<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * App\Estado
 *
 * @mixin \Eloquent
 */

class Valor extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['valor','fecha_desde', 'id_obra_social','id_practica'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'valores';

    public function Obra_social()
    {
        return $this->belongsTo('App\Models\Obra_social', 'id_obra_social');
    }

    public function Practica()
    {
        return $this->belongsTo('App\Models\Practica', 'id_practica');
    }

    public function setFecha_desdeAttribute($value)
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
        $this->attributes['fecha_desde']=$p;
    }
  
    public function getFecha_desdeAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    } 
}