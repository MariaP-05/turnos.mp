<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banco;
use App\Models\Cliente;
use App\Models\ClienteServicios;
use App\Models\Localidad;
use App\Models\ServicioValor;
use App\Models\TipoCliente;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use PDF;
use File;
use Response;

class ClienteController extends Controller
{
    public function index()
    {
        //$this->insert_servicios();
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

        return view('admin.clientes.edit', compact('bancos', 'localidades', 'tipos_cliente'));
    }

    public function store(Request $request)
    {

        try {
            $cliente = new Cliente($request->all());

            if ($cliente->estado == 'on') {
                $cliente->estado = 1;
            } else {
                $cliente->estado = 0;
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
        if ($cliente->estado == '1') {
            $cliente->estado = 'on';
        }

        $bancos = Banco::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $bancos = array('' => trans('message.select')) + $bancos;

        $localidades = Localidad::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $localidades = array('' => trans('message.select')) + $localidades;

        $tipos_cliente = TipoCliente::orderBy('denominacion')->pluck('denominacion', 'id')->all();
        $tipos_cliente = array('' => trans('message.select')) + $tipos_cliente;


        return view('admin.clientes.edit', compact('cliente', 'bancos', 'localidades', 'tipos_cliente'));
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
            $cliente->descuento = $request->descuento;
            if ($cliente->estado == 'on') {
                $cliente->estado = 1;
            } else {
                $cliente->estado = 0;
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

    // Generate TXT
    public function createTXT()
    {
        $clientes = Cliente::get();

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
            $importe_cobrar = 0;
            foreach ($cliente->ClienteServicios as $servicio) {
                // dd($servicio->fecha_hasta);
                if ($servicio->fecha_hasta >= $fecha_presentacion || is_null($servicio->fecha_hasta)) {
                    $valor = ServicioValor::where('id_servicio', $servicio->id_servicio)
                        ->where('fecha', '<=', $fecha_cobro)
                        ->OrderBy('fecha', 'desc')->first();
                    $importe_cobrar += $valor->valor;
                }
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
            $cliente->denominacion = substr($cliente->denominacion, 0, 16);
            $cliente->denominacion = str_pad($cliente->denominacion, 16, " ", STR_PAD_RIGHT);

            $linea[] =   $cliente->TipoCliente->codigo . '0000' . $cliente->cbu . '01' . $whole . $fraction .
                $fecha_cobro->format('Ymd') . $numero_cliente . $cliente->cuit . $cliente->denominacion . 'GEOSECURITY' . PHP_EOL;
        }

        $whole = (int)floor($importe_total);      // 1
        $fraction = ($importe_total - $whole) * 1000; // .25
        $fraction = (int)$fraction;
        //formatear a 14 digitos ultimos 3 digitos son decimales
        $whole = str_pad($whole, 11, "0", STR_PAD_LEFT);
        $fraction = str_pad($fraction, 3, "0", STR_PAD_LEFT);

        $cabecera[] = '999604520101' . $fecha_presentacion->format('Ymd') . '000001' . $whole . $fraction
            . $cantidad_clientes . 'SERVICIO            ' . $fecha_presentacion->format('Ymd') . PHP_EOL;

        foreach ($linea as $lin) {
            $cabecera[] = $lin;
        }
        // $cabecera[] = $linea;
        //   $data = json_encode( $linea);        
        $data =  $cabecera;
        File::put(public_path('/archivo.txt'), $data);
        return Response::download(public_path('/archivo.txt'), 'TXT_'.$fecha_cobro->format('m-Y').'.txt');
    }

    public function insert_servicios()
    {
        $clientes = Cliente::get();
        //$clientes = Cliente::where('id', '<=', 10)->get();
        foreach ($clientes as $cliente) {
            $servicio = new ClienteServicios();

            $servicio->id_cliente = $cliente->id;
            $servicio->id_servicio = 1; //monitoreo
           // $servicio->id_servicio = 4; //chip
            $servicio->fecha_desde = '01-01-2023';
            $servicio->observaciones = 'Creado Automaticamente';
            $servicio->save();
        }
    }
}
