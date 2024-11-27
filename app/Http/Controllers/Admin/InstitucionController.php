<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class InstitucionController extends Controller
{
    public function index()
    {
        //$this->insert_servicios();
        $instituciones = Institucion::all();

        return view('admin.instituciones.index', compact('instituciones'));
    }

    public function create()
    {
        return view('admin.instituciones.edit');
    }

    public function store(Request $request)
    {

        try {
            $institucion = new Institucion($request->all());

            $institucion->nombre = ucwords(strtolower($request->nombre));
            $institucion->direccion = (ucfirst($request->direccion));
            $cadenas =  explode(". ", $request->observacion);
            $institucion->observacion = null; //pongo la observacion en null para evitar repeticiones
            foreach ($cadenas as $cadena) {
                if ($institucion->observacion != null) //si ya tiene algun valor agrrego . espacio nueva oracion
                {
                    $institucion->observacion = $institucion->observacion . '. ' . ucfirst($cadena);
                } else { //si no tiene ningun valor solo nueva oracion (es la primer oracion)
                    $institucion->observacion = ucfirst($cadena);
                }
            }


            $institucion->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.instituciones.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.instituciones.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institucion = Institucion::findOrFail($id);

        return view('admin.instituciones.edit', compact('institucion'));
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
            $institucion = Institucion::findOrFail($id);


            $institucion->nombre = ucwords(strtolower($request->nombre));
            $institucion->telefono = $request->telefono;
            $institucion->direccion = (ucfirst($request->direccion));
            $cadenas =  explode(". ", $request->observacion);
            $institucion->observacion = null; //pongo la observacion en null para evitar repeticiones
            foreach ($cadenas as $cadena) {
                if ($institucion->observacion != null) //si ya tiene algun valor agrrego . espacio nueva oracion
                {
                    $institucion->observacion = $institucion->observacion . '. ' . ucfirst($cadena);
                } else { //si no tiene ningun valor solo nueva oracion (es la primer oracion)
                    $institucion->observacion = ucfirst($cadena);
                }
            }


            $institucion->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.instituciones.index');
        } catch (QueryException  $ex) {

            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.instituciones.index');
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

            Institucion::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.instituciones.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.instituciones.index');
        }
    }
}
