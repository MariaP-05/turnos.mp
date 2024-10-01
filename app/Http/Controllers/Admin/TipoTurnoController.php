<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoTurno;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 

class TipoTurnoController extends Controller
{
    public function index()
    {
        
        $tipos_turno = TipoTurno::all();

        return view('admin.tipos_turno.index', compact('tipos_turno'));
    }

    public function create()
    {
            return view('admin.tipos_turno.edit');
    }

    public function store(Request $request)
    {

        try {
            $tipos_turno = new TipoTurno($request->all());


            $tipos_turno->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.tipos_turno.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.tipos_turno.index');
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
        $tipos_turno = TipoTurno::findOrFail($id);
        
        return view('admin.tipos_turno.edit', compact('tipos_turno'));
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
            $tipos_turno = TipoTurno::findOrFail($id);


            $tipos_turno->denominacion = $request->denominacion;
            $tipos_turno->color = $request->color;
            

            $tipos_turno->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.tipos_turno.index');
        } catch (QueryException  $ex) {

            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.tipos_turno.index');
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
           
            TipoTurno::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.tipos_turno.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.tipos_turno.index');
        }
    }
   
}