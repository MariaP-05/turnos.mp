<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Practica;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 

class PracticaController extends Controller
{
    public function index()
    {
        
        $practicas = Practica::all();

        return view('admin.practicas.index', compact('practicas'));
    }

    public function create()
    {
            return view('admin.practicas.edit');
    }

    public function store(Request $request)
    {

        try {
            $practica = new Practica($request->all());
            $practica->denominacion = strtoupper( strtolower($request->denominacion));

            $practica->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.practicas.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.practicas.index');
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
        $practica = Practica::findOrFail($id);
        
        return view('admin.practicas.edit', compact('practica'));
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
            $practica = Practica::findOrFail($id);


            $practica->denominacion = strtoupper( strtolower($request->denominacion));
                      

            $practica->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.practicas.index');
        } catch (QueryException  $ex) {

            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.practicas.index');
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
           
            Practica::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.practicas.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.practicas.index');
        }
    }
   
}