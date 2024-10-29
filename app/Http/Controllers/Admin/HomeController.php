<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $fecha_mes = new Carbon();
        $fecha_mes -> addDays(-30);

        if(isset(Auth::user()->Profesional))
        {
            //si es profesional 
            $cantidad_programados = Turno::where('id_estado_turnos', 1)
            -> where('fecha','>=', $fecha_mes->format('Y-m-d'))
            -> where('id_profesional', Auth::user()->id_profesional)
            ->count();
    
            $cantidad_cancelados = Turno::where('id_estado_turnos', 2)
            -> where('fecha','>=', $fecha_mes->format('Y-m-d'))
            -> where('id_profesional', Auth::user()->id_profesional)
            ->count();
    
            $cantidad_realizados = Turno::where('id_estado_turnos', 3)
            -> where('fecha','>=', $fecha_mes->format('Y-m-d'))
            -> where('id_profesional', Auth::user()->id_profesional)
            ->count();
        }
        else
        {

            $cantidad_programados = Turno::where('id_estado_turnos', 1)
            -> where('fecha','>=', $fecha_mes->format('Y-m-d'))
            ->count();
    
            $cantidad_cancelados = Turno::where('id_estado_turnos', 2)
            -> where('fecha','>=', $fecha_mes->format('Y-m-d'))
            ->count();
    
            $cantidad_realizados = Turno::where('id_estado_turnos', 3)
            -> where('fecha','>=', $fecha_mes->format('Y-m-d'))
            ->count();
        }
       

        return view('admin.dashboard', compact('cantidad_programados','fecha_mes' , 'cantidad_cancelados', 'cantidad_realizados'));
    }
}