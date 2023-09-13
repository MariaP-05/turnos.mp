<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Cliente;
use App\Models\ClienteServicios;
use App\Models\Servicio;
use App\Models\TipoCliente;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
 

class ClienteServiciosController extends Controller
{
    public function index()
    {
        $cliente_servicios = ClienteServicios::all();  

        return view('admin.cliente_servicios.index', compact('cliente_servicios'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $clientes = array('' => trans('message.select')) + $clientes;

        $servicios = Servicio::orderBy('nombre')->pluck('nombre', 'id')->all();
        $servicios = array('' => trans('message.select')) + $servicios;
         
        return view('admin.cliente_servicios.edit', compact('clientes','servicios'));
    }

    public function store(Request $request)
    {
       
      // try {
            $cliente_servicios = new ClienteServicios($request->all());
             
            $cliente_servicios->save();
 
            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.cliente_servicios.index');
    /*    } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.cliente_servicios.index');
        }*/
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
        $cliente_servicios = ClienteServicios::findOrFail($id);         
        
        $clientes = Cliente::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $clientes = array('' => trans('message.select')) + $clientes;

        $servicios = Servicio::orderBy('nombre')->pluck('nombre', 'id')->all();
        $servicios = array('' => trans('message.select')) + $servicios;
       
        
        return view('admin.cliente_servicios.edit', compact('clientes','servicios', 'cliente_servicios' ));
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
                $cliente_servicios = ClienteServicios::findOrFail($id);        
             
                $cliente_servicios->id_cliente = $request->id_cliente;
                $cliente_servicios->id_servicio = $request->id_servicio;
                $cliente_servicios->fecha_desde = $request->fecha_desde;
                $cliente_servicios->fecha_hasta = $request->fecha_hasta;
                $cliente_servicios->observaciones = $request->observaciones;
                
                $cliente_servicios->save();
                
                session()->flash('alert-success', trans('message.successaction'));
                return redirect()->route('admin.cliente_servicios.index');
        } catch (QueryException  $ex) {
            
                session()->flash('alert-danger', $ex->getMessage());
                return redirect()->route('admin.cliente_servicios.index');
           
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
           
            ClienteServicios::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.cliente_servicios.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.cliente_servicios.index');
        }
    }
}