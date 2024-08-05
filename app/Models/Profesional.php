<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Profesional extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'nombre', 'cuit', 'id_profesion', 'mail', 'telefono', 'matricula'];

    protected $table = 'profesionales';

    public function Profesion()
    {
        return $this->belongsTo('App\Models\Profesion', 'id_profesion');
    }
}
