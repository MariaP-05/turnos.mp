<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['denominacion', 'denominacion_amigable','observaciones','
    cuit','cbu','id_banco','direccion','telefono','telefono_2','nombre_contacto',
    'mail','mail_2', 'id_localidad','estado','cuenta_corriente' ,'id_tipo_cliente'       
    ];
    protected $table = 'clientes';

    public function Localidad()
    {
        return $this->belongsTo('App\Localidad', 'id_localidad');
    }

    public function Banco()
    {
        return $this->belongsTo('App\Banco', 'id_banco');
    }
}
