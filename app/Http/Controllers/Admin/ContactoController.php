<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Contacto;
use App\Models\Localidad;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_2($id_paciente)
    {
        $contactos = Contacto:: where('id_paciente', $id_paciente)->get();

        $paciente = Paciente::findOrFail($id_paciente);

        return view('admin.contactos.index', compact('contactos', 'id_paciente','paciente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_2($id_paciente)
    {
        $localidades = Localidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $localidades = array('' => trans('message.select')) + $localidades;
        
        $paciente = Paciente::findOrFail($id_paciente);

        return view('admin.contactos.edit', compact('localidades','paciente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        try {

        $contacto = new Contacto($request->all());  
        
        // ucwords(strtolower($variable)); para poner la primer letra en mayuscula de cada palabra y el resto en minusculas
        $contacto->nombre = ucwords (strtolower($request->nombre));
        
        $contacto->direccion = (ucfirst($request->direccion));
        
        $contacto->mail = (strtolower ($request->mail));
        
        $contacto->relacion = ucfirst (strtolower($request->relacion));
        //divido las observaciones en oraciones 
        $cadenas =  explode(". ", $request->observacion);
        $contacto->observacion = null; //pongo la observacion en null para evitar repeticiones
        foreach($cadenas as $cadena )
        {
            if($contacto->observacion != null) //si ya tiene algun valor agrrego . espacio nueva oracion
            {
                $contacto->observacion = $contacto->observacion . '. '. ucfirst($cadena );
            }
            else
            {//si no tiene ningun valor solo nueva oracion (es la primer oracion)
                $contacto->observacion = ucfirst($cadena );
            }
           
        }



            $contacto->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.contactos.index_2', $request->id_paciente);
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.contactos.index_2', $request->id_paciente);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contacto = Contacto::findOrFail($id);

        $localidades = Localidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $localidades = array('' => trans('message.select')) + $localidades;

        $paciente = Paciente::findOrFail($contacto->id_paciente);
        
        return view('admin.contactos.edit', compact('contacto','localidades','paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
        $contacto = Contacto::findOrFail($id);

        $contacto->nombre = ucwords (strtolower($request->nombre));
        $contacto->dni = $request->dni;
        $contacto->direccion = (ucfirst($request->direccion));
        $contacto->id_localidad = $request->id_localidad; 
        $contacto->telefono = $request->telefono;
        $contacto->telefono_aux= $request->telefono_aux;
        $contacto->mail = (strtolower ($request->mail));
        $contacto->fecha_nacimiento = $request->fecha_nacimiento;
        $contacto->relacion = ucfirst (strtolower($request->relacion));
        //divido las observaciones en oraciones 
        $cadenas =  explode(". ", $request->observacion);
        $contacto->observacion = null; //pongo la observacion en null para evitar repeticiones
        foreach($cadenas as $cadena )
        {
            if($contacto->observacion != null) //si ya tiene algun valor agrrego . espacio nueva oracion
            {
                $contacto->observacion = $contacto->observacion . '. '. ucfirst($cadena );
            }
            else
            {//si no tiene ningun valor solo nueva oracion (es la primer oracion)
                $contacto->observacion = ucfirst($cadena );
            }
           
        }


        $contacto->save();

        session()->flash('alert-success', trans('message.successaction'));
        return redirect()->route('admin.contactos.index_2', $request->id_paciente);
    } catch (QueryException  $ex) {

        session()->flash('alert-danger', $ex->getMessage());
        return redirect()->route('admin.contactos.index_2', $request->id_paciente);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacto =  Contacto::find($id);
        try {
          
            Contacto::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.contactos.index_2', $contacto->id_paciente);
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.contactos.index_2', $contacto->id_paciente);
        }
    }
}
