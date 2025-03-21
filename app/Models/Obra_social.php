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
    protected $fillable = [ 'denominacion' , 'denominacion_amigable' , 'cuit',
     'telefono' , 'direccion' , 'observacion', 'fecha_presentacion_desde' , 
     'fecha_presentacion_hasta' , 'periodo_informe'  ];
      
    protected $table = 'obras_sociales';

    
}
