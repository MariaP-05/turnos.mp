<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Localidad;
use App\Models\Obra_social;
use App\Models\Profesional;
use App\Models\Sesion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use PDF;
use File;

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

        $profesionales = Profesional::orderBy('nombre')->pluck('nombre', 'id')->all();
        $profesionales = array('' => trans('message.select')) + $profesionales;

        $obras_sociales = Obra_social::orderBy('denominacion_amigable')->pluck('denominacion_amigable', 'id')->all();
        $obras_sociales = array('' => trans('message.select')) + $obras_sociales;

        return view('admin.pacientes.edit', compact('localidades', 'obras_sociales', 'profesionales'));
    }

    public function store(Request $request) //guardar nuevo
    {

        try {
            $paciente = new Paciente($request->all());

            $paciente->save();

            $this->store_files_contenedor($request, $paciente->id);

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
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);

        $profesionales = Profesional::orderBy('nombre')->pluck('nombre', 'id')->all();
        $profesionales = array('' => trans('message.select')) + $profesionales;

        $localidades = Localidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $localidades = array('' => trans('message.select')) + $localidades;

        $obras_sociales = Obra_social::orderBy('denominacion_amigable')->pluck('denominacion_amigable', 'id')->all();
        $obras_sociales = array('' => trans('message.select')) + $obras_sociales;

        $eva = $this->cantidad_archivos($id, 'Archivo_Adjunto', 15);

        return view('admin.pacientes.edit', compact('paciente','eva',  'localidades', 'obras_sociales', 'profesionales'));
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
            $paciente->fecha_nacimiento = $request->fecha_nacimiento;
            $paciente->id_obra_social = $request->id_obra_social;
            $paciente->numero_afiliado = $request->numero_afiliado;


            $paciente->save();

            $cantidad =  count($request->id_profesional);
            $cantidad--;

            $sesion = new Sesion();
            $sesion->id_paciente = $paciente->id;
            $fecha = new Carbon();
            $sesion->fecha_inicio  = $fecha->format('Y-m-d');
            $sesion->id_profesional = $request->id_profesional[$cantidad];
            $sesion->cantidad_recetada = $request->cantidad_recetada[$cantidad];
            $sesion->cantidad_turnos_reales = $request->cantidad_turnos_reales[$cantidad];
            $sesion->cantidad_turnos_realizados = $request->cantidad_turnos_realizados[$cantidad];

            $sesion->save();

            $this->store_files_contenedor($request, $paciente->id);

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


//files


public function store_files_contenedor_files(Request $request, $id)
{
   
    $eva = count($this->cantidad_archivos($id, 'Archivo_Adjunto', 15)) + 1;      
    $this->store_files($request, $id, $eva, 'Archivo_Adjunto', 'Archivo_Adjunto');       

    return redirect()->back();
}

public function store_files_contenedor(Request $request, $id)
{
    $archivos = count($this->cantidad_archivos($id, 'Archivo_Adjunto', 15)) + 1;     
    $this->store_files($request, $id, $archivos, 'Archivo_Adjunto', 'Archivo_Adjunto');

    return redirect()->back();
}
public function cantidad_archivos($id, $nombre, $largo)
{
    $path = public_path() . '/storage/pacientes/' . $id . '/archivos/'; //Declaramos un  variable con la ruta donde guardaremos los archivos

    $archivos = array();
    $i = 1;

    if (file_exists($path)) {
        $files = File::allFiles($path);

        foreach ($files as $file) {
            $var = explode(".", $file->getFilename());
            $tipo =  substr($var[0], -$largo);
            if ($tipo == $nombre) {
                $archivos[$i]['nombre'] = $file->getFilename();
                $archivos[$i]['tamaño'] = $file->getSize();
                $archivos[$i]['extension'] = $file->getExtension();
                $i++;
            }
        }
    }
    return $archivos;
}

public function delete_file(Request $request, $id, $file_name)
{
    $directorio = public_path() . '/storage/pacientes/' . $id . '/archivos/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
    File::delete($directorio . $file_name);

    return redirect()->back();
}

public function store_files(Request $request, $id, $i, $nombre_archivo, $nuevo)
{
    foreach ($_FILES[$nombre_archivo]['tmp_name'] as $key => $tmp_name) {

        if ($_FILES[$nombre_archivo]["name"][$key]) {
            $var = explode(".", $_FILES[$nombre_archivo]['name'][$key]);
            $cant = count($var);
            $esten = $cant - 1;

            $filename = $nuevo . '.' . $var[$esten]; //Obtenemos el nombre original del archivo

            $source = $_FILES[$nombre_archivo]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

            $direct = public_path() . '/storage/pacientes/'; //Declaramos un  variable con la ruta donde guardaremos los archivos

            if (!file_exists($direct)) {
                mkdir($direct, 0777) or die("No se puede crear el directorio comuniquese con el area de sistemas");
            }
            $director = $direct . $id . '/'; //Declaramos un  variable con la ruta donde guardaremos los archivos

            if (!file_exists($director)) {
                mkdir($director, 0777) or die("No se puede crear el directorio comuniquese con el area de sistemas");
            }

            $directorio = $director. '/archivos/'; //Declaramos un  variable con la ruta donde guardaremos los archivos

            if (!file_exists($directorio)) {
                mkdir($directorio, 0777) or die("No se puede crear el directorio comuniquese con el area de sistemas");
            }

            $dir = opendir($directorio); //Abrimos el directorio de destino
            $fecha =  Carbon::now()->format('d-m-Y');
            $filename =  '_' . $fecha . '_' . $filename;
            $z = $this->verificar_archivo($id ,$filename,$i );
           
            while ($z == 1 )
            {
                $i++;
                $z = $this->verificar_archivo($id ,$filename, $i);
            }

            $target_path = $directorio . $i .$filename; //Indicamos la ruta de destino, así como el nombre del archivo
            move_uploaded_file($source, $target_path);

            closedir($dir);
        }
        $i++;
       
    }
    return redirect()->back()->with('message', 'Operation Successful !');
    //return redirect()->route('admin.comunicaciones.archivos', ['id' => $id]);
}

public function verificar_archivo($id, $nombre, $i)
{
    $path = public_path() . '/storage/pacientes/' . $id . '/archivos/'; //Declaramos un  variable con la ruta donde guardaremos los archivos

    $z=0;

    if (file_exists($path)) {
        $files = File::allFiles($path);

        foreach ($files as $file) {
           
            if ($file->getFilename() == $i.$nombre) {
              $z=1;
            }
        }
    }
    return  $z;
}

public function archivos($id)
{
    $i = 1;
    $eva = $this->cantidad_archivos($id, 'Archivo_Adjunto', 15);
   
    $paciente = Paciente::find($id);
    $puede_eliminar = true;
    $puede_modificar = false;        
     
    return view('admin.pacientes.archivos', compact('id','eva','i','puede_eliminar',
    'puede_modificar' ));
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
