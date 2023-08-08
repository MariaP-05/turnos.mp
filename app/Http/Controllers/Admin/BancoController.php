<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banco;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 

class BancoController extends Controller
{
    public function index()
    {
        $bancos = Banco::all();

        return view('admin.bancos.index', compact('bancos'));
    }

    public function create()
    {
        return view('admin.bancos.edit');
    }

    public function store(Request $request)
    {
       
        try {
            $banco = new Banco($request->all());
           

            $banco->save();
 
       //     $request->session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.bancos.index');
        } catch (QueryException  $ex) {
          //  $request->session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.bancos.index');
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
        $banco = Banco::findOrFail($id);
        
        return view('admin.bancos.edit', compact('banco' ));
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
            
            $banco = Banco::findOrFail($id);
            
                $banco->denominacion = $request->denominacion;
                $banco->direccion = $request->direccion;
                $banco->telefono = $request->telefono;
                $banco->contacto = $request->contacto;
                $banco->mailcontacto = $request->mailcontacto;
                
                $banco->save();
 
        } catch (QueryException  $ex) {
            
                //$request->session()->flash('alert-danger', $ex->getMessage());
                return redirect()->route('admin.bancos.index');
           
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
           
            Banco::destroy($id);

          //  $request->session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.bancos.index');
        } catch (QueryException  $ex) {
            //$request->session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.bancos.index');
        }
    }
}