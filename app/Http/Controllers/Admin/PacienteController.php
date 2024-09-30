<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Localidad;
use App\Models\Obra_social;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use PDF;
use File;
use Response;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();

        return view('admin.pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $localidades = Localidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $localidades = array('' => trans('message.select')) + $localidades;


        $obras_sociales = Obra_social::orderBy('denominacion_amigable')->pluck('denominacion_amigable', 'id')->all();
        $obras_sociales = array('' => trans('message.select')) + $obras_sociales;

        return view('admin.pacientes.edit', compact('localidades' , 'obras_sociales'));


    }

    public function store(Request $request) //guardar nuevo
    {

        try {
            $paciente = new Paciente($request->all());

            $paciente->save();

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.pacientes.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.pacientes.index');
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
        $paciente = Paciente::findOrFail($id);
        

        $localidades = Localidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $localidades = array('' => trans('message.select')) + $localidades;

        $obras_sociales = Obra_social::orderBy('denominacion_amigable')->pluck('denominacion_amigable', 'id')->all();
        $obras_sociales = array('' => trans('message.select')) + $obras_sociales;
       
        return view('admin.pacientes.edit', compact('paciente',  'localidades' , 'obras_sociales'));
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
           
            $paciente = Paciente::findOrFail($id);
           
            $paciente->nombre = $request->nombre;
            $paciente->dni = $request->dni;
            $paciente->direccion = $request->direccion;
            $paciente->id_localidad = $request->id_localidad;
            $paciente->telefono = $request->telefono;
            $paciente->mail = $request->mail;
            $paciente->fecha_nacimiento =$request->fecha_nacimiento;
            $paciente->id_obra_social = $request->id_obra_social;
            $paciente->numero_afiliado = $request->numero_afiliado;
            
            
            
            
           
           
            $paciente->save();
            //;
          //  dd($paciente->save());
            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.pacientes.index');
        } catch (QueryException  $ex) {

            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.pacientes.index');
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
           
            Paciente::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.pacientes.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.pacientes.index');
        }
    }
/*    // Generate TXT
    public function createTXT()
    {
      //  $pacientes = paciente::get();
        $pacientes = pacienteServicios::select('id_paciente')->groupby('id_paciente')->get();

       // dd( $pacientes , $pacientes_2);
        $fecha_cobro = new Carbon();
        $fecha_cobro->firstOfMonth();
        $fecha_cobro->addDays(9);

        $fecha_presentacion = new Carbon();

        if ($fecha_cobro->format('l') == 'Sunday' || $fecha_cobro->format('l') == 'Saturday') {
            $searchDay = 'Monday';
            $fecha_cobro = Carbon::createFromTimeStamp(strtotime("next $searchDay", $fecha_cobro->timestamp));
        }

        $cantidad_pacientes = count($pacientes);
        $cantidad_pacientes = str_pad($cantidad_pacientes, 6, "0", STR_PAD_LEFT);


        $importe_total = 0;
        foreach ($pacientes as $paciente) {
          //  dd($paciente->id_paciente);
            $paciente = paciente::find($paciente->id_paciente);
            $importe_cobrar = 0;
            $t =0;
            $valores = [];
            foreach ($paciente->pacienteServicios as $servicio) { 
               $fecha_hasta = new Carbon($servicio->fecha_hasta);
                if ($fecha_hasta  >= $fecha_presentacion || is_null($servicio->fecha_hasta)) {
                    $valor = ServicioValor::where('id_servicio', $servicio->id_servicio)
                        ->where('fecha', '<=', $fecha_cobro)
                        ->OrderBy('fecha', 'desc')->first();
                    $importe_cobrar += $valor->valor;
                    $t++;
                    $valores[]=$valor->valor;
                }
                 
            }
           
            if($paciente->descuento > 0)
            {
                $importe_cobrar = $importe_cobrar - ($importe_cobrar  * 10 /100 );
            }
  
            $whole = (int)floor($importe_cobrar);      // 1
            $fraction = ($importe_cobrar - $whole) * 1000; // .25
            $fraction = (int)$fraction;
            //formatear a 14 digitos ultimos 3 digitos son decimales
            $whole = str_pad($whole, 11, "0", STR_PAD_LEFT);
            $fraction = str_pad($fraction, 3, "0", STR_PAD_LEFT);
            $importe_total += $importe_cobrar;

            //cbu formatear a 22 caracteres con 00 delante 
            $paciente->cbu = substr($paciente->cbu, 0, 22);
            $paciente->cbu = str_pad($paciente->cbu, 22, "0", STR_PAD_LEFT);


            //id paciente formatear a 12 caracteres con 0 delante 
            $numero_paciente = substr($paciente->id, 0, 10);
            $numero_paciente = str_pad($numero_paciente, 10, "0", STR_PAD_LEFT);
            //cuit formatear a 11 caracteres con 0 delante 
            $paciente->cuit = substr($paciente->cuit, 0, 11);
            $paciente->cuit = str_pad($paciente->cuit, 11, "0", STR_PAD_LEFT);
            //denominacion formatear a 16 caracteres completar con espacios al final
            $paciente->denominacion = str_replace('Ñ','N', strtoupper($paciente->denominacion));
            $paciente->denominacion = substr($paciente->denominacion, 0, 16);
            $paciente->denominacion = str_pad($paciente->denominacion, 16, ' ', STR_PAD_RIGHT);

            $linea[] =   $paciente->Tipopaciente->codigo . '0000' . $paciente->cbu . '01' . $whole . $fraction .
                $fecha_cobro->format('Ymd') . $numero_paciente . $paciente->cuit . $paciente->denominacion . 'GEOSECURITY' 
               ;
        }

        $whole = (int)floor($importe_total);      // 1
        $fraction = ($importe_total - $whole) * 1000; // .25
        $fraction = (int)$fraction;
        //formatear a 14 digitos ultimos 3 digitos son decimales
        $whole = str_pad($whole, 11, "0", STR_PAD_LEFT);
        $fraction = str_pad($fraction, 3, "0", STR_PAD_LEFT); 
       
        $cabecera[] = '999604520101' . $fecha_presentacion->format('Ymd') . '000001' . $whole . $fraction
            . $cantidad_pacientes . 'SERVICIO            ' . $fecha_presentacion->format('Ymd')
            .'                                                                                                                                                       ' . PHP_EOL;

        foreach ($linea as $lin) {
            $cabecera[] = $lin.            '                                                                                                                             ' . PHP_EOL;
        }
        // $cabecera[] = $linea;
        //   $data = json_encode( $linea);        
        $data =  $cabecera;
        File::put(public_path('/archivo.txt'), $data);
        return Response::download(public_path('/archivo.txt'), 'TXT_'.$fecha_cobro->format('m-Y').'.txt');
    }

  

    public function createPDF()
    {
        $pacientes = paciente::get();
        $fecha_presentacion = new Carbon();
                $data = [
            'pacientes' => $pacientes ,
            'fecha_presentacion' =>  $fecha_presentacion
        ]; 
        $pdf = PDF::loadView('admin.pacientes.createPDF', $data);
         
       
        return $pdf->download('Listado_Servicios_Activos.pdf') ;
    }
     */
    /*
    $pacientes = paciente::get();
        //$linea = '';
        foreach($pacientes as $paciente)
        {
            $linea[] =   $paciente->id.'00000'.$paciente->denominacion.'00012300 1500.23';
        }
       // $data =$dat;
      /*    $data = [
            'lineas' => $linea,
            'date' => date('m/d/Y') 
        ]; 
            
        $pdf = PDF::loadView('admin.pacientes.createPDF', $data);
     
        return $pdf->download('probando.pdf') ;*/
   
}
