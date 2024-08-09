<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profesion;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 

class ProfesionController extends Controller
{
    public function index()
    {
        //$this->insert_servicios();
        $profesiones = Profesion::all();

        return view('admin.profesiones.index', compact('profesiones'));
    }

    public function create()
    {
            return view('admin.profesiones.edit');
    }

    public function store(Request $request)
    {
        try {
            $profesion = new Profesion($request->all());
            $profesion->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.profesiones.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.profesiones.index');
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
        $profesion = Profesion::findOrFail($id);
        
        return view('admin.profesiones.edit', compact('profesion'));
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
            $profesion = Profesion::findOrFail($id);


            $profesion->denominacion = $request->denominacion;
            

            $profesion->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.profesiones.index');
        } catch (QueryException  $ex) {

            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.profesiones.index');
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
           
            Profesion::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.profesiones.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.profesiones.index');
        }
    }
   
}
