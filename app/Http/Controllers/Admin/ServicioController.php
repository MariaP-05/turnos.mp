<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Servicio; 
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
 

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all(); 

        return view('admin.servicios.index', compact('servicios'));
    }

    public function create()
    {
        
        return view('admin.servicios.edit' );
    }

    public function store(Request $request)
    {
       
       try {
            $servicio = new Servicio($request->all());
             
            $servicio->save();
 
            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.servicios.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.servicio.index');
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
        $servicio = Servicio::findOrFail($id);
        
         
        
        return view('admin.servicios.edit', compact('servicio'  ));
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
            $servicio = Servicio::findOrFail($id);          
             
             
                $servicio->nombre = $request->nombre;
                $servicio->descripcion = $request->descripcion;
               
                $servicio->save();
                
                session()->flash('alert-success', trans('message.successaction'));
                return redirect()->route('admin.servicios.index');
        } catch (QueryException  $ex) {
            
                session()->flash('alert-danger', $ex->getMessage());
                return redirect()->route('admin.servicios.index');
           
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
           
            Servicio::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.servicios.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.servicios.index');
        }
    }
}