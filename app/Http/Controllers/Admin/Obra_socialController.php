<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obra_social;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 

class Obra_socialController extends Controller
{
    public function index()
    {
        $obras_sociales = Obra_social::all();

        return view('admin.obras_sociales.index', compact('obras_sociales'));
    }

    public function create()
    {
        return view('admin.obras_sociales.edit');
    }

    public function store(Request $request)
    {
       
        try {
            $obra_social = new Obra_social($request->all());
           

            $obra_social->save();
 
            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.obras_sociales.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.obras_sociales.index');
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
        $obra_social = Obra_social::findOrFail($id);
        
        return view('admin.obras_sociales.edit', compact('obra_social' ));
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
            
            $obra_social = Obra_social::findOrFail($id);
            
                $obra_social->denominacion = $request->denominacion;
                $obra_social->denominacion_amigable = $request->denominacion_amigable;
                $obra_social->cuit = $request->cuit;
                $obra_social->telefono = $request->telefono;
                $obra_social->direccion = $request->direccion;
                $obra_social->observacion = $request->observacion;
                
                $obra_social->save();

                session()->flash('alert-success', trans('message.successaction'));
                return redirect()->route('admin.obras_sociales.index');
        } catch (QueryException  $ex) {
            
                 session()->flash('alert-danger', $ex->getMessage());
                return redirect()->route('admin.obras_sociales.index');
           
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
           
            Obra_social::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.obras_sociales.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.obras_sociales.index');
        }
    }
}