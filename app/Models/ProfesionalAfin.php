<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfesionalAfin extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'nombre', 'id_especialidad', 'mail', 'telefono', 'matricula',
'direccion','observaciones'];

    protected $table = 'profesionales_afines';

    public function Especialidad()
    {
        return $this->belongsTo('App\Models\Especialidad', 'id_especialidad');
    }
}
