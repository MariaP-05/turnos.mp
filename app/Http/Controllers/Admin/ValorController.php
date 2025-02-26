<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Valor;
use App\Models\Obra_social;
use App\Models\Practica;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 

class ValorController extends Controller
{
    public function index()
    {
        
        $valores = Valor::all();

        return view('admin.valores.index', compact('valores'));
    }

    public function create()
    {
        $obras_sociales = Obra_social::orderBy('denominacion_amigable')->pluck('denominacion_amigable', 'id')->all();
        $obras_sociales = array('' => trans('message.select')) + $obras_sociales;

        $practicas = Practica::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $practicas = array('' => trans('message.select')) + $practicas;

           return view('admin.valores.edit', compact( 'obras_sociales', 'practicas'));
    }

    public function store(Request $request)
    {

        try {
            $valor = new Valor($request->all());

            $valor->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.valores.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.valores.index');
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
        $valor = Valor::findOrFail($id);
        
        
        $obras_sociales = Obra_social::orderBy('denominacion_amigable')->pluck('denominacion_amigable', 'id')->all();
        $obras_sociales = array('' => trans('message.select')) + $obras_sociales;

        $practicas = Practica::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $practicas = array('' => trans('message.select')) + $practicas;

           return view('admin.valores.edit', compact( 'obras_sociales', 'practicas','valor'));
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
            $valor = Valor::findOrFail($id);


            $valor->valor = $request->valor;
            $valor->id_practica = $request->id_practica;
            $valor->fecha_desde = $request->fecha_desde;
            $valor->id_obra_social = $request->id_obra_social;
            

            $valor->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.valores.index');
        } catch (QueryException  $ex) {

            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.valores.index');
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
           
            Valor::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.valores.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.valores.index');
        }
    }
   
}