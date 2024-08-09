<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Profesional;
use App\Models\Profesion;
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
      

        $profesiones = Profesion::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $profesiones = array('' => trans('message.select')) + $profesiones;

        return view('admin.profesionales.edit', compact('profesiones'));
        
    }

    public function store(Request $request)
    {

        try {
            $profesional = new Profesional($request->all());            
           
            $profesional->save();
           
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
        
        $profesiones = Profesion::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $profesiones = array('' => trans('message.select')) + $profesiones;

        return view('admin.profesionales.edit', compact('profesional','profesiones'));
        
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
            
                $profesional->nombre = $request->nombre;
                $profesional->cuit = $request->cuit;
                $profesional->telefono = $request->telefono;
                $profesional->mail = $request->mail;
                $profesional->id_profesion = $request->id_profesion;
                $profesional->matricula = $request->matricula;
                
                $profesional->save();

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
