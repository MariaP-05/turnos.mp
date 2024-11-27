<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Profesional;
use App\Models\Especialidad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 

class ProfesionalController extends Controller
{
    public function index()
    {
        $profesionales = Profesional::all();
 
        return view('admin.profesionales.index', compact('profesionales'));
    }

    public function create()
    {
    
        $especialidades = Especialidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $especialidades = array('' => trans('message.select')) + $especialidades;

        $intervalo = '00'; //env('MINUTOS');
        while ($intervalo < 60) {
            $minutos[$intervalo] = $intervalo;
            $intervalo += env('MINUTOS');
        }

        $horas = [];
        $hora_inico = intval(env('HORA_INICIO'));
        while ($hora_inico  <=  env('HORA_FIN')) {
            $horas[$hora_inico] = $hora_inico;
            $hora_inico++;
        }

        return view('admin.profesionales.edit', compact('especialidades','horas','minutos'));
        
    }

    public function store(Request $request)
    {

        try {
            $profesional = new Profesional($request->all());  
            
            $profesional->nombre = ucwords(strtolower($request->nombre));
            $profesional->mail = (strtolower ($request->mail));
           
            $profesional->save();

            $usuario = new User();
            $usuario->password = bcrypt($profesional->cuit); //Hash::make('callefalsa123')
            $usuario->name = $profesional->nombre;
            $usuario->email = $profesional->mail;
            $usuario->email_verified_at = Carbon::now();
            $usuario->id_profesional = $profesional->id;
            
            $usuario->save();
           
            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.profesionales.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.profesionales.index');
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    { 
        $profesional = Profesional::findOrFail($id);
        
        $especialidades = Especialidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $especialidades = array('' => trans('message.select')) + $especialidades;

        $intervalo = '00'; //env('MINUTOS');
        while ($intervalo < 60) {
            $minutos[$intervalo] = $intervalo;
            $intervalo += env('MINUTOS');
        }

        $horas = [];
        $hora_inico = intval(env('HORA_INICIO'));
        while ($hora_inico  <=  env('HORA_FIN')) {
            $horas[$hora_inico] = $hora_inico;
            $hora_inico++;
        }


        return view('admin.profesionales.edit', compact('profesional','especialidades','minutos','horas'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
                $profesional = Profesional::findOrFail($id);
            
                $profesional->nombre = ucwords(strtolower($request->nombre));
                $profesional->cuit = $request->cuit;
                $profesional->telefono = $request->telefono;
                $profesional->mail = (strtolower ($request->mail));
                $profesional->id_especialidad = $request->id_especialidad;
                $profesional->matricula = $request->matricula;
                $profesional->hora_inicio = $request->hora_inicio;
                $profesional->hora_fin = $request->hora_fin;
                $profesional->minutos_hab = $request->minutos_hab;
                
                $profesional->save();

                $usuario = User::firstOrNew(['id_profesional' =>  $profesional->id]);
                //$usuario = User::where('id_profesional',$profesional->id )->first;
                $usuario->password = bcrypt($profesional->cuit); //Hash::make('callefalsa123')
                $usuario->name = $profesional->nombre;
                $usuario->email = $profesional->mail;
                $usuario->email_verified_at = Carbon::now();
                $usuario->id_profesional = $profesional->id;
                
                $usuario->save();
                session()->flash('alert-success', trans('message.successaction'));
                return redirect()->route('admin.profesionales.index');
        } catch (QueryException  $ex) {
            
                 session()->flash('alert-danger', $ex->getMessage());
                return redirect()->route('admin.profesionales.index');
           
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Request $request, $id)
    {
        try {
           
            
            Profesional::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.profesionales.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.profesionales.index');
        }
    }

}
