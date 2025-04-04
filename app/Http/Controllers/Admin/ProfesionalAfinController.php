<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ProfesionalAfin;
use App\Models\Especialidad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 

class ProfesionalAfinController extends Controller
{
    public function index()
    {
        $profesionales = ProfesionalAfin::all();
 
        return view('admin.profesionales_afines.index', compact('profesionales'));
    }

    public function create()
    {    
        $especialidades = Especialidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $especialidades = array('' => trans('message.select')) + $especialidades;
 
        return view('admin.profesionales_afines.edit', compact('especialidades'));
        
    }

    public function store(Request $request)
    {

        try {
            $profesional = new ProfesionalAfin($request->all());   
            
            $profesional->nombre = ucwords(strtolower($request->nombre));            
            $profesional->mail = (strtolower ($request->mail));
            $profesional->save(); 

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.profesionales_afines.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.profesionales_afines.index');
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
        $profesional = ProfesionalAfin::findOrFail($id);
        
        $especialidades = Especialidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $especialidades = array('' => trans('message.select')) + $especialidades;
 
        return view('admin.profesionales_afines.edit', compact('profesional','especialidades'));
        
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
            
                $profesional = ProfesionalAfin::findOrFail($id);
               
                $profesional->nombre = ucwords(strtolower($request->nombre));
                $profesional->direccion = $request->direccion;   
                $profesional->telefono = $request->telefono;     
                $profesional->id_especialidad = $request->id_especialidad; 
                $profesional->matricula = $request->matricula;      
                $profesional->mail = (strtolower ($request->mail));               
                $profesional->observaciones = $request->observaciones;  
                
                $profesional->save(); 
              
                session()->flash('alert-success', trans('message.successaction'));
                return redirect()->route('admin.profesionales_afines.index');
        } catch (QueryException  $ex) {
            
                 session()->flash('alert-danger', $ex->getMessage());
                return redirect()->route('admin.profesionales_afines.index');
           
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
            
            ProfesionalAfin::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.profesionales_afines.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.profesionales_afines.index');
        }
    }

}
