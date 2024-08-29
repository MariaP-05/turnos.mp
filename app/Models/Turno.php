<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Turno extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_paciente', 'id_profesional', 'fecha' , 'hora_inicio', 'hora_fin' , 
    'id_estado_turnos' , 'id_institucion', 'descripcion'  ];

    protected $table = 'turnos';

    public function Paciente()
    {
        return $this->belongsTo('App\Models\Paciente', 'id_paciente');
    }
  
    public function Profesional()
    {
        return $this->belongsTo('App\Models\Profesional', 'id_profesional');
    }

    public function Institucion()
    {
        return $this->belongsTo('App\Models\Institucion', 'id_institucion');
    }

    public function EstadoTurno()
    {
        return $this->belongsTo('App\Models\EstadoTurno', 'id_estado_turnos');
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

    public static function search(Request $request)
    {
        $query = Turno::query();        

        if (isset($request->fec_desde)) {
            $fecha_d= new Carbon($request->fec_desde); 
            $query = $query->where('fecha', '>=', $fecha_d->format('Y-m-d'));
        }

        if (isset($request->fec_hasta)) {
            $fecha_h= new Carbon($request->fec_hasta);
            $query = $query->where('fecha', '<=', $fecha_h->format('Y-m-d'));
        }
        
        if (isset($request->id_estado_turnos)){
            $query= $query->where('id_estado_turnos', '=' , $request->id_estado_turnos); 
        }

        if (isset($request->id_profesional)){
            $query= $query->where('id_profesional', '=' , $request->id_profesional); 
        }


       return  $query = $query->orderby('id', 'desc') ;

    }
 /* se utiliza para elegir cuándo se puede editar
 
    public function canEdit()
    {
        return(
            $this->estado === "Programado" || $this->estado === "Cancelado" ||$this->estado ==="Consulta" || $this->estado === "Tratamiento"
        );
    }

*/

}
