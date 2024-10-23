<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Estado
 *
 * @mixin \Eloquent
 */

class TipoTurno extends Model
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
    protected $fillable = ['denominacion','color','color_class','color_clarito','alerta'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipos_turno';
}