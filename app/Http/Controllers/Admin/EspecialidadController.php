<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 

class EspecialidadController extends Controller
{
    public function index()
    {
        
        $especialidades = Especialidad::all();

        return view('admin.especialidades.index', compact('especialidades'));
    }

    public function create()
    {
            return view('admin.especialidades.edit');
    }

    public function store(Request $request)
    {
        try {
            $especialidad = new Especialidad($request->all());
            $especialidad->denominacion = ucwords (strtolower ($request->denominacion));

            
            $especialidad->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.especialidades.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.especialidades.index');
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
        $especialidad = Especialidad::findOrFail($id);

        return view('admin.especialidades.partials.myModal', compact('especialidades'))->render();
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        
        return view('admin.especialidades.edit', compact('especialidad'));
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
            $especialidad = Especialidad::findOrFail($id);


            $especialidad->denominacion = ucwords (strtolower ($request->denominacion));
            

            $especialidad->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.especialidades.index');
        } catch (QueryException  $ex) {

            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.especialidades.index');
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
           
            Especialidad::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.especialidades.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.especialidades.index');
        }
    }
   
}
