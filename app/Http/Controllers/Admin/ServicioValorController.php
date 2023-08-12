<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Servicio;
use App\Models\ServicioValor;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
 

class ServicioValorController extends Controller
{
    public function index()
    {
        $valores = ServicioValor::all(); 

        return view('admin.servicios_valores.index', compact('valores'));
    }

    public function create()
    {  
         $servicios = Servicio::orderBy('nombre')->pluck('nombre', 'id')->all();   
         $servicios = array('' => trans('message.select')) + $servicios;
        
        return view('admin.servicios_valores.edit', compact('servicios') );
    }

    public function store(Request $request)
    {
       
       try {
            $valor = new ServicioValor($request->all());
             
            $valor->save();
 
            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.servicios_valores.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.servicios_valores.index');
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
        $valor = ServicioValor::findOrFail($id);
        $servicios = Servicio::orderBy('nombre')->pluck('nombre', 'id')->all();   
        $servicios = array('' => trans('message.select')) + $servicios;
       
        
        return view('admin.servicios_valores.edit', compact('servicios','valor'  ));
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
            $valor = ServicioValor::findOrFail($id);          
             
             
                $valor->id_servicio = $request->id_servicio;
                $valor->fecha = $request->fecha;
                $valor->valor = $request->valor;
                
                $valor->save();
                
                session()->flash('alert-success', trans('message.successaction'));
                return redirect()->route('admin.servicios_valores.index');
        } catch (QueryException  $ex) {
            
                session()->flash('alert-danger', $ex->getMessage());
                return redirect()->route('admin.servicios_valores.index');
           
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
           
            ServicioValor::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.servicios_valores.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.servicios_valores.index');
        }
    }
}