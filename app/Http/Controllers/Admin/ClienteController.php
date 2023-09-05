<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banco;
use App\Models\Cliente;
use App\Models\Localidad;
use App\Models\TipoCliente;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
 

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all(); 

        return view('admin.clientes.index', compact('clientes'));
    }

    public function create()
    {
        $bancos = Banco::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $bancos = array('' => trans('message.select')) + $bancos;

        $localidades = Localidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $localidades = array('' => trans('message.select')) + $localidades;

        $tipos_cliente = TipoCliente::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $tipos_cliente = array('' => trans('message.select')) + $tipos_cliente;

        return view('admin.clientes.edit', compact('bancos','localidades', 'tipos_cliente'));
    }

    public function store(Request $request)
    {
       
       try {
            $cliente = new Cliente($request->all());
            
            if($cliente->estado == 'on')
            {
                $cliente->estado =1;
            }
            else
            {
                $cliente->estado =0;
            }
           
            $cliente->save();
 
            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.clientes.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.clientes.index');
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
        $cliente = Cliente::findOrFail($id);
        if($cliente->estado == '1')
        {
            $cliente->estado = 'on';
        }
        
        $bancos = Banco::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $bancos = array('' => trans('message.select')) + $bancos;

        $localidades = Localidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $localidades = array('' => trans('message.select')) + $localidades;
        
        $tipos_cliente = TipoCliente::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $tipos_cliente = array('' => trans('message.select')) + $tipos_cliente;

        
        return view('admin.clientes.edit', compact('cliente','bancos','localidades', 'tipos_cliente' ));
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
            $cliente = Cliente::findOrFail($id);          
             
             
                $cliente->denominacion = $request->denominacion;
                $cliente->denominacion_amigable = $request->denominacion_amigable;
                $cliente->cbu = $request->cbu;
                $cliente->id_localidad = $request->id_localidad;
                $cliente->id_banco = $request->id_banco;
                $cliente->mail = $request->mail;

                $cliente->cuit = $request->cuit;
                $cliente->observaciones = $request->observaciones;
                $cliente->mail_2 = $request->mail_2;

                $cliente->direccion = $request->direccion;
                $cliente->telefono = $request->telefono;
                $cliente->telefono_2 = $request->telefono_2;

                $cliente->nombre_contacto = $request->nombre_contacto;
                $cliente->cuenta_corriente = $request->cuenta_corriente;
                $cliente->id_tipo_cliente = $request->id_tipo_cliente;
                if($cliente->estado == 'on')
                {
                    $cliente->estado =1;
                }
                else
                {
                    $cliente->estado =0;
                }
                $cliente->save();
                
                session()->flash('alert-success', trans('message.successaction'));
                return redirect()->route('admin.clientes.index');
        } catch (QueryException  $ex) {
            
                session()->flash('alert-danger', $ex->getMessage());
                return redirect()->route('admin.clientes.index');
           
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
           
            Cliente::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.clientes.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.clientes.index');
        }
    }
}