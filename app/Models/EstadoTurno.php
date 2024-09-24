<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Estado
 *
 * @mixin \Eloquent
 */

class EstadoTurno extends Model
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
    protected $fillable = ['denominacion','icono','color','color_class','color_clarito'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estados_turnos';
}