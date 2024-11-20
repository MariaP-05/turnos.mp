<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Historia_clinica extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *  Schema::create('sesiones', function (Blueprint $table) {
      

     */
    protected $fillable = ['id_paciente', 'id_user', 'observacion', 'fecha'];

    protected $table = 'historias_clinicas';

    public function Paciente()
    {
        return $this->belongsTo('App\Models\Paciente', 'id_paciente');
    }
  
    public function User()
    {
        return $this->hasMany('App\Models\User', 'id_user');
    }

    public function setFechaAttribute($value)
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
        $this->attributes['fecha']=$p;
    }
  
    public function getFechaAttribute($value)
    {
        $value = $value !== null ? new Carbon($value) : null;
        $value = $value !== null ? $value->format('d-m-Y') : null;
      
        return $value;
    } 
 
    
    

}
