<?php

namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCliente extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'denominacion','codigo'   ];

    protected $table = 'tipos_cliente';

    
}
