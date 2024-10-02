<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EstadoTurno;
use App\Models\Turno;
use App\Models\Paciente;
use App\Models\Institucion;
use App\Models\Profesional;
use App\Models\TipoTurno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class TurnoController extends Controller
{
    public function index(Request $request)
    {
        $turnos = Turno::search($request)->get();

        // $turnos = Turno::all();
        $fecha_desde = null;

        if (isset($request->fec_desde)) {
            $fecha_desde = $request->fec_desde;
        }
        $fecha_hasta = null;

        if (isset($request->fec_hasta)) {
            $fecha_hasta = $request->fec_hasta;
        }

        $estado_turnos = EstadoTurno::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $estado_turnos = array('' => trans('message.select')) + $estado_turnos;

        if (isset($request->id_estado_turnos)) {
            $id_estado_turnos = $request->id_estado_turnos;
        } else {
            $id_estado_turnos = null;
        }

        $tipos_turno = TipoTurno::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $tipos_turno = array('' => trans('message.select')) + $tipos_turno;

        if (isset($request->id_tipos_turno)) {
            $id_tipos_turno = $request->id_tipos_turno;
        } else {
            $id_tipos_turno = null;
        }


        $profesionales = Profesional::orderBy('nombre')->pluck('nombre', 'id')->all();
        $profesionales = array('' => trans('message.select')) + $profesionales;

        if (isset($request->id_profesional)) {
            $id_profesional = $request->id_profesional;
        } else {
            $id_profesional = null;
        }


        $instituciones = Institucion::orderBy('nombre')->pluck('nombre', 'id')->all();
        $instituciones = array('' => trans('message.select')) + $instituciones;

        if (isset($request->id_institucion)) {
            $id_institucion = $request->id_institucion;
        } else {
            $id_institucion = null;
        }

        return view('admin.turnos.index', compact(
            'turnos',
            'fecha_desde',
            'fecha_hasta',
            'estado_turnos',
            'id_estado_turnos',
            'tipos_turno',
            'id_tipos_turno',
            'profesionales',
            'id_profesional',
            'instituciones',
            'id_institucion'
        ));
    }

    public function create()
    {
        
        $intervalo = '00'; //env('MINUTOS');
        while ($intervalo < 60) {
            $minutos[$intervalo] = $intervalo;
            $intervalo += env('MINUTOS');
        }

        $horas = [];
        $hora_inico = intval(env('HORA_INICIO'));
        while ($hora_inico  <=  env('HORA_FIN')) {
            $horas[$hora_inico] = $hora_inico;
            $hora_inico++;
        }

        $pacientes = Paciente::orderBy('nombre')->pluck('nombre', 'id')->all();
        $pacientes = array('' => trans('message.select')) + $pacientes;

        $profesionales = Profesional::orderBy('nombre')->pluck('nombre', 'id')->all();
        $profesionales = array('' => trans('message.select')) + $profesionales;

        $instituciones = Institucion::orderBy('nombre')->pluck('nombre', 'id')->all();
        $instituciones = array('' => trans('message.select')) + $instituciones;

        $tipos_turno = TipoTurno::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $tipos_turno = array('' => trans('message.select')) + $tipos_turno;
        

        return view('admin.turnos.edit', compact(
            'pacientes',
            'profesionales',
            'instituciones',
            'tipos_turno',
            'horas',
            'minutos'
        ));
    }

    public function store(Request $request)
    {

        try {
            $turno = new turno($request->all());
            $turno->id_estado_turnos = 1;

            $turno->save();
            
            if($request->repetir >= 1)
            {
                $i = 0;
                $fecha = new Carbon($turno->fecha);
                while($i < $request->repetir)
                {
                    $fecha->addDays(7);
                    $turno_2 = new turno($request->all());
                    $turno_2->id_estado_turnos = 1;
                    $turno_2->fecha = $fecha->format('Y-m-d');
                    $turno_2->save();
                    $i++;
                }

            }
            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.turnos.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.turnos.index');
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
        $intervalo = '00'; //env('MINUTOS');
        while ($intervalo < 60) {
            $minutos[$intervalo] = $intervalo;
            $intervalo += env('MINUTOS');
        }

        $horas = [];
        $hora_inico = intval(env('HORA_INICIO'));
        while ($hora_inico  <=  env('HORA_FIN')) {
            $horas[$hora_inico] = $hora_inico;
            $hora_inico++;
        }

        $turno = turno::findOrFail($id);

        $pacientes = Paciente::orderBy('nombre')->pluck('nombre', 'id')->all();
        $pacientes = array('' => trans('message.select')) + $pacientes;

        $profesionales = Profesional::orderBy('nombre')->pluck('nombre', 'id')->all();
        $profesionales = array('' => trans('message.select')) + $profesionales;

        $instituciones = Institucion::orderBy('nombre')->pluck('nombre', 'id')->all();
        $instituciones = array('' => trans('message.select')) + $instituciones;

        $estado_turnos = EstadoTurno::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $estado_turnos = array('' => trans('message.select')) + $estado_turnos;

        $tipos_turno = TipoTurno::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $tipos_turno = array('' => trans('message.select')) + $tipos_turno;

        return view('admin.turnos.edit', compact(
            'turno',
            'pacientes',
            'profesionales',
            'instituciones',
            'estado_turnos',
            'tipos_turno',
            'horas',
            'minutos'
        ));
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
            $turno = Turno::findOrFail($id);

            $turno->id_paciente = $request->id_paciente;
            $turno->id_profesional = $request->id_profesional;
            $turno->fecha = $request->fecha;

            $turno->hora_inicio = $request->hora_inicio;
            $turno->hora_fin = $request->hora_fin;
            $turno->minuto_inicio = $request->minuto_inicio;
            $turno->minuto_fin = $request->minuto_fin;

            $turno->id_institucion = $request->id_institucion;
            $turno->id_tipos_turno = $request->id_tipos_turno;
            $turno->id_estado_turnos = $request->id_estado_turnos;

            $turno->save();

            if($request->repetir >= 1)
            {
                $i = 0;
                $fecha = new Carbon($turno->fecha);
                while($i < $request->repetir)
                {
                    $fecha->addDays(7);
                    $turno_2 = new turno($request->all());
                    $turno_2->id_estado_turnos = 1;
                    $turno_2->fecha = $fecha->format('Y-m-d');
                    $turno_2->save();
                    $i++;
                }

            }

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.turnos.index');
        } catch (QueryException  $ex) {

            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.turnos.index');
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

            Turno::destroy($id);

            session()->flash('alert-success', trans('message.successaction'));
            return redirect()->route('admin.turnos.index');
        } catch (QueryException  $ex) {
            session()->flash('alert-danger', $ex->getMessage());
            return redirect()->route('admin.turnos.index');
        }
    }


    public function createTurnoPaciente($id_paciente)
    {
        $intervalo = '00'; //env('MINUTOS');
        while ($intervalo < 60) {
            $minutos[$intervalo] = $intervalo;
            $intervalo += env('MINUTOS');
        }

        $horas = [];
        $hora_inico = intval(env('HORA_INICIO'));
        while ($hora_inico  <=  env('HORA_FIN')) {
            $horas[$hora_inico] = $hora_inico;
            $hora_inico++;
        }

        $turno = new turno();

        $turno->id_paciente = $id_paciente;

        $pacientes = Paciente::orderBy('nombre')->pluck('nombre', 'id')->all();
        $pacientes = array('' => trans('message.select')) + $pacientes;

        $profesionales = Profesional::orderBy('nombre')->pluck('nombre', 'id')->all();
        $profesionales = array('' => trans('message.select')) + $profesionales;

        $instituciones = Institucion::orderBy('nombre')->pluck('nombre', 'id')->all();
        $instituciones = array('' => trans('message.select')) + $instituciones;

        $estado_turnos = EstadoTurno::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $estado_turnos = array('' => trans('message.select')) + $estado_turnos;

        $tipos_turno = TipoTurno::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $tipos_turno = array('' => trans('message.select')) + $tipos_turno;


        return view('admin.turnos.edit', compact('turno', 'pacientes', 'profesionales', 'instituciones',
        'horas', 'minutos', 'estado_turnos', 'tipos_turno'));
    }


    public function cronograma(Request $request)
    {
        //
        $intervalo = '00'; //env('MINUTOS');
        while ($intervalo < 60) {
            $minutos[$intervalo] = $intervalo;
            $intervalo += env('MINUTOS');
        }

        $horas = [];
        $hora_inico = intval(env('HORA_INICIO'));
        while ($hora_inico  <=  env('HORA_FIN')) {
            if ($hora_inico < 10) {
                $hora_inico = '0' . $hora_inico;
            }
            $horas[$hora_inico] = $hora_inico;
            $hora_inico++;
        }
        //definir horas laborales para poner el en cronograma       

        if (isset($request->fec_desde)) {
            $fecha_desde = new Carbon($request->fec_desde);
        } else {
            $fecha_desde = Carbon::today();
        }

        $fecha = new Carbon($fecha_desde);
        if (isset($request->fec_hasta)) {
            $fecha_hasta = new Carbon($request->fec_hasta);
            // $fecha_hasta->addDays(1);
        } else {
            $fecha_hasta = new Carbon($fecha_desde);
            $fecha_hasta->addDays(7);
        }

        $dias = [];

        while ($fecha <= $fecha_hasta) {
            $dias[] = new Carbon($fecha);
            $fecha->addDays(1);
        }

        $turnos =  [];

        foreach ($dias as $dia) {
            $bandera = new Carbon($dia);
            $bandera->addDays(1);

            $time_desde = new Carbon($dia);
            $time_hasta = new Carbon($dia);
            foreach ($horas as $hora) {
                $time_desde->hour($hora);
                $time_hasta->hour($hora);
                foreach ($minutos as $minuto) {
                    $time_desde->minute($minuto);
                    if ($minuto == 45) {
                        $time_hasta->hour($hora + 1);
                        $time_hasta->minute(0);
                    } else {
                        $time_hasta->minute($minuto + env('MINUTOS'));
                    }


                    $query = Turno::search_dia($request)
                        ->where('fecha', '>=', $dia->format('Y-m-d'))
                        ->where('fecha', '<', $bandera->format('Y-m-d'));
                    
                    switch ($minuto) {
                        case 00:
                           
                            $query = $query->where(function ($query) use ($time_desde, $time_hasta) {
                                $query
                                ->where('hora_inicio', '>=',  intval($time_desde->format('H')))
                                    ->where('minuto_inicio', '>=', intval( $time_desde->format('i')))
        
                                    ->where('hora_inicio', '<=',  intval($time_hasta->format('H')))
                                    ->where('minuto_inicio', '<',  intval($time_hasta->format('i'))) //15
                                  
                                   ->orWhere('hora_fin', '>=',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<',  intval($time_desde->format('H')))
                                    ->where('minuto_fin', '>',  intval($time_desde->format('i'))) //00

                                    ->orWhere('hora_fin', '>',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<',  intval($time_desde->format('H')))
                                    ->where('minuto_fin', '>=',  intval($time_desde->format('i'))) //00
                                    ;
                            });
                            
                        default:
                        $query = $query->where(function ($query) use ($time_desde, $time_hasta) {
                            $query
                                ->where('hora_inicio', '>=',  intval($time_desde->format('H')))
                                ->where('minuto_inicio', '>=', intval( $time_desde->format('i')))        
                                ->where('hora_inicio', '<=',  intval($time_hasta->format('H')))
                                ->where('minuto_inicio', '<',  intval($time_hasta->format('i'))) //15
                              
                               ->orWhere('hora_fin', '>=',  intval($time_desde->format('H')))
                                ->where('hora_inicio', '<',  intval($time_desde->format('H')))
                                ->where('minuto_fin', '>',  intval($time_desde->format('i'))) //00

                                ->orWhere('hora_fin', '>',  intval($time_desde->format('H')))
                                ->where('hora_inicio', '<=',  intval($time_desde->format('H')))
                                ->where('minuto_inicio', '<=',  intval($time_desde->format('i'))) //00

                                ->orWhere('hora_fin', '>',  intval($time_desde->format('H')))
                                ->where('hora_inicio', '<',  intval($time_desde->format('H')))


                                ->orWhere('hora_fin',  intval($time_desde->format('H')))
                                ->where('hora_inicio', intval($time_desde->format('H')))
                                ->where('minuto_fin', '>',  intval($time_desde->format('i')))
                                ;
                        }); 
                        $turnos[$dia->format('d')][$hora][$minuto] =  $query->get();

                            //24-09-24 quedo andando bien las 00 con un tercer or
                       /*     break;
                        case 15:
                            $query = $query->where(function ($query) use ($time_desde, $time_hasta) {
                                $query
                                    ->where('hora_inicio', '>=',  intval($time_desde->format('H')))
                                    ->where('minuto_inicio', '>=', intval( $time_desde->format('i')))        
                                    ->where('hora_inicio', '<=',  intval($time_hasta->format('H')))
                                    ->where('minuto_inicio', '<',  intval($time_hasta->format('i'))) //15
                                  
                                   ->orWhere('hora_fin', '>=',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<',  intval($time_desde->format('H')))
                                    ->where('minuto_fin', '>',  intval($time_desde->format('i'))) //00

                                    ->orWhere('hora_fin', '>',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<=',  intval($time_desde->format('H')))
                                    ->where('minuto_inicio', '<=',  intval($time_desde->format('i'))) //00

                                    ->orWhere('hora_fin', '>=',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<',  intval($time_desde->format('H')))
                                    ->where('minuto_fin', '<',  intval($time_hasta->format('i')))
                                    ->where('minuto_fin', '>=',  intval($time_desde->format('i'))) //00
                                 //
                                    ->orWhere('hora_fin', '>',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<',  intval($time_desde->format('H')))
                                   ;
                            }); 
                            break;
                        case 30:
                            $query = $query->where(function ($query) use ($time_desde, $time_hasta) {
                                $query
                                    ->where('hora_inicio', '>=',  intval($time_desde->format('H')))
                                    ->where('minuto_inicio', '>=', intval( $time_desde->format('i')))        
                                    ->where('hora_inicio', '<=',  intval($time_hasta->format('H')))
                                    ->where('minuto_inicio', '<',  intval($time_hasta->format('i'))) //15
                                  
                                   ->orWhere('hora_fin', '>=',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<',  intval($time_desde->format('H')))
                                    ->where('minuto_fin', '>',  intval($time_desde->format('i'))) //00

                                    ->orWhere('hora_fin', '>',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<=',  intval($time_desde->format('H')))
                                    ->where('minuto_inicio', '<=',  intval($time_desde->format('i'))) //00

                                    ->orWhere('hora_fin', '>',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<',  intval($time_desde->format('H')))


                                    ->orWhere('hora_fin',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', intval($time_desde->format('H')))
                                    ->where('minuto_fin', '>',  intval($time_desde->format('i')))
                                    ;
                            }); 
                              break;
                        case 45:
                            $query = $query->where(function ($query) use ($time_desde, $time_hasta) {
                                $query
                                    ->where('hora_inicio', '>=',  intval($time_desde->format('H')))
                                    ->where('minuto_inicio', '>=', intval( $time_desde->format('i')))        
                                    ->where('hora_inicio', '<=',  intval($time_hasta->format('H')))
                                    ->where('minuto_inicio', '<',  intval($time_hasta->format('i'))) //15
                                  
                                   ->orWhere('hora_fin', '>=',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<',  intval($time_desde->format('H')))
                                    ->where('minuto_fin', '>',  intval($time_desde->format('i'))) //00

                                    ->orWhere('hora_fin', '>',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<=',  intval($time_desde->format('H')))
                                    ->where('minuto_inicio', '<=',  intval($time_desde->format('i'))) //00

                               
                                   ->orWhere('hora_fin', '>',  intval($time_desde->format('H')))
                                    ->where('hora_inicio', '<',  intval($time_desde->format('H')))
                                   ;
                            });//12 30  14 00           14 30
                            
                            
                            $turnos[$dia->format('d')][$hora][$minuto] =  $query->get();

                         /*   if($dia->format('d') == 27 && $hora == 15 && $minuto = '15' )
                            {
                           //     dd($time_desde->format('H'), $time_desde->format('i'), intval($time_hasta->format('i')), $turnos[$dia->format('d')][$hora][$minuto] , $time_desde, $time_hasta , $dia, $bandera);
                            }  
                              break; */
                    }
                   


                   
                }
            }
        }
//dd( $minutos,$turnos);


        $estado_turnos = EstadoTurno::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $estado_turnos = array('' => trans('message.select')) + $estado_turnos;

        if (isset($request->id_estado_turnos)) {
            $id_estado_turnos = $request->id_estado_turnos;
        } else {
            $id_estado_turnos = null;
        }


        $profesionales = Profesional::orderBy('nombre')->pluck('nombre', 'id')->all();
        $profesionales = array('' => trans('message.select')) + $profesionales;

        if (isset($request->id_profesional)) {
            $id_profesional = $request->id_profesional;
        } else {
            $id_profesional = null;
        }


        $instituciones = Institucion::orderBy('nombre')->pluck('nombre', 'id')->all();
        $instituciones = array('' => trans('message.select')) + $instituciones;

        if (isset($request->id_institucion)) {
            $id_institucion = $request->id_institucion;
        } else {
            $id_institucion = null;
        }

        return view('admin.turnos.cronograma', compact(
            'turnos',
            'dias',
            'fecha_hasta',
            'fecha_desde',
            'estado_turnos',
            'id_estado_turnos',
            'profesionales',
            'id_profesional',
            'instituciones',
            'id_institucion',
            'horas',
            'minutos'
        ));
    }



    /*    // Generate TXT
    public function createTXT()
    {
      //  $clientes = Cliente::get();
        $clientes = ClienteServicios::select('id_cliente')->groupby('id_cliente')->get();

       // dd( $clientes , $clientes_2);
        $fecha_cobro = new Carbon();
        $fecha_cobro->firstOfMonth();
        $fecha_cobro->addDays(9);

        $fecha_presentacion = new Carbon();

        if ($fecha_cobro->format('l') == 'Sunday' || $fecha_cobro->format('l') == 'Saturday') {
            $searchDay = 'Monday';
            $fecha_cobro = Carbon::createFromTimeStamp(strtotime("next $searchDay", $fecha_cobro->timestamp));
        }

        $cantidad_clientes = count($clientes);
        $cantidad_clientes = str_pad($cantidad_clientes, 6, "0", STR_PAD_LEFT);


        $importe_total = 0;
        foreach ($clientes as $cliente) {
          //  dd($cliente->id_cliente);
            $cliente = Cliente::find($cliente->id_cliente);
            $importe_cobrar = 0;
            $t =0;
            $valores = [];
            foreach ($cliente->ClienteServicios as $servicio) { 
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
           
            if($cliente->descuento > 0)
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
            $cliente->cbu = substr($cliente->cbu, 0, 22);
            $cliente->cbu = str_pad($cliente->cbu, 22, "0", STR_PAD_LEFT);


            //id cliente formatear a 12 caracteres con 0 delante 
            $numero_cliente = substr($cliente->id, 0, 10);
            $numero_cliente = str_pad($numero_cliente, 10, "0", STR_PAD_LEFT);
            //cuit formatear a 11 caracteres con 0 delante 
            $cliente->cuit = substr($cliente->cuit, 0, 11);
            $cliente->cuit = str_pad($cliente->cuit, 11, "0", STR_PAD_LEFT);
            //denominacion formatear a 16 caracteres completar con espacios al final
            $cliente->denominacion = str_replace('Ñ','N', strtoupper($cliente->denominacion));
            $cliente->denominacion = substr($cliente->denominacion, 0, 16);
            $cliente->denominacion = str_pad($cliente->denominacion, 16, ' ', STR_PAD_RIGHT);

            $linea[] =   $cliente->TipoCliente->codigo . '0000' . $cliente->cbu . '01' . $whole . $fraction .
                $fecha_cobro->format('Ymd') . $numero_cliente . $cliente->cuit . $cliente->denominacion . 'GEOSECURITY' 
               ;
        }

        $whole = (int)floor($importe_total);      // 1
        $fraction = ($importe_total - $whole) * 1000; // .25
        $fraction = (int)$fraction;
        //formatear a 14 digitos ultimos 3 digitos son decimales
        $whole = str_pad($whole, 11, "0", STR_PAD_LEFT);
        $fraction = str_pad($fraction, 3, "0", STR_PAD_LEFT); 
       
        $cabecera[] = '999604520101' . $fecha_presentacion->format('Ymd') . '000001' . $whole . $fraction
            . $cantidad_clientes . 'SERVICIO            ' . $fecha_presentacion->format('Ymd')
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
        $clientes = Cliente::get();
        $fecha_presentacion = new Carbon();
                $data = [
            'clientes' => $clientes ,
            'fecha_presentacion' =>  $fecha_presentacion
        ]; 
        $pdf = PDF::loadView('admin.clientes.createPDF', $data);
         
       
        return $pdf->download('Listado_Servicios_Activos.pdf') ;
    }
     */
    /*
    $clientes = Cliente::get();
        //$linea = '';
        foreach($clientes as $cliente)
        {
            $linea[] =   $cliente->id.'00000'.$cliente->denominacion.'00012300 1500.23';
        }
       // $data =$dat;
      /*    $data = [
            'lineas' => $linea,
            'date' => date('m/d/Y') 
        ]; 
            
        $pdf = PDF::loadView('admin.clientes.createPDF', $data);
     
        return $pdf->download('probando.pdf') ;*/
}
