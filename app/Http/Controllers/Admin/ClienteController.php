<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Auth;
use Validator;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('admin.clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('admin.clientes.edit');
    }

    public function store(Request $request)
    {
        try {
            $cliente = new Cliente($request->all());
             
            $cliente->save();

        
       //     $request->session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.clientes.index');
        } catch (QueryException  $ex) {
          //  $request->session()->flash('alert-danger', $ex->getMessage());
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
        
        return view('admin.clientes.edit', compact('cliente' ));
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
                $cliente->estado = $request->estado;
                $cliente->save();
           
        } catch (QueryException  $ex) {
            
                //$request->session()->flash('alert-danger', $ex->getMessage());
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

          //  $request->session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.clientes.index');
        } catch (QueryException  $ex) {
            //$request->session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.clientes.index');
        }
    }
}