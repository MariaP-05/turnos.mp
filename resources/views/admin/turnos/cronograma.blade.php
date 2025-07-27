@extends('adminlte::page')

@section('title', 'Cronograma de Turnos')

@section('content_header')
<h1>Turnos</h1>
@stop

@section('content')
<div class="card">
    <a href="{{ route('admin.turnos.create') }}" title="Crear Nuevo Turno"
        style="position:fixed;	width:60px;	height:60px; top:57px;	right:40px;
            background-color:#FFF;	color:#25d366;	border-radius:50px;	text-align:center;
            font-size:30px;	box-shadow: 2px 2px 3px #999; z-index:100;"
        target="_blank" onMouseOver="this.style.color='#FFF'; this.style.background = '#25d366'"
        onMouseOut="this.style.color='#25d366'; this.style.background = '#fff'">
        <i class="fa fa-plus" style="margin-top:16px"></i>
    </a>

    <a href="{{ route('admin.pacientes.create') }}" title="Crear Nuevo Paciente"
        style="position:fixed;	width:60px;	height:60px; top:130px;	right:40px;
             background-color:#FFF;	color:#25d366;	border-radius:50px;	text-align:center;
             font-size:30px;	box-shadow: 2px 2px 3px #999; z-index:100;"
        target="_blank" onMouseOver="this.style.color='#FFF'; this.style.background = '#25d366'"
        onMouseOut="this.style.color='#25d366'; this.style.background = '#fff'">
        <i class="fa fa-user-plus" style="margin-top:16px"></i>
    </a>


    @include('admin.turnos.partials.busqueda_cronograma')
    {{ Form::hidden('fec_desde') }}
    {{ Form::hidden('fec_hasta') }}
    {{ Form::hidden('id_estado_turnos') }}
    {{ Form::hidden('id_profesional') }}
    {{ Form::hidden('id_institucion') }}

</div>

<div class="card">
    <div class="cadr-body">
        <div class="form-group col-sm-12">
            <div class="row">
                <div class="form-group col-lg-10 col-md-9 col-sm-8">
                    <table id="turnos" class="table table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th style="border-right: solid 2px; border-left: solid 2px; border-color:#999;">Hora/Dia</th>
                                @foreach ($dias as $dia)
                                <th style="border-right: solid 2px; border-left: solid 2px; border-color:#999;">
                                    {{ ucfirst($dia->locale('es_Ar')->isoFormat('ddd D')) }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horas as $hora)
                            @foreach ($minutos as $minuto)
                            <tr>
                                <th style="border-right: solid 2px; border-left: solid 2px; border-color:#999;">
                                    {{ $hora . ':' . $minuto }}
                                </th>
                                @foreach ($dias as $dia)
                                <td style="border-right: solid 2px; border-left: solid 2px; border-color:#999;">
                                    @foreach ($turnos[$dia->format('d')][$hora][$minuto] as $turno)

                                    <div class="form-group col-lg-12">
                                        <div class="row">
                                            <div class=" col-lg-2 col-md-4 col-sm-4">
                                                <form method="get"
                                                    action="{{ route('admin.turnos.cambiar_estado', [$turno->id, 3]) }}">

                                                    <button type="submit"
                                                        class="info-box-icon btn-secondary"
                                                        style="border-radius: 50%; width:30px;	height:30px;"
                                                        onMouseOver="this.style.background='gray'; this.style.border='gray' "
                                                        onMouseOut="this.style.background = '#6C757D'; this.style.border='#6C757D'"
                                                        title="Turno Realizado">
                                                        <i class="fa fa-calendar-check"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class=" col-lg-2 col-md-4 col-sm-4">
                                                <form method="get"
                                                    action="{{ route('admin.turnos.cambiar_estado', [$turno->id, 2]) }}">
                                                    <button type="submit"
                                                        class="info-box-icon btn-secondary"
                                                        style="border-radius: 50%; width:30px;	height:30px; "
                                                        onMouseOver="this.style.background='#dc3545'; this.style.border='#dc3545'"
                                                        onMouseOut="this.style.background = '#6C757D'; this.style.border='#6C757D'"
                                                        title="Turno Cancelado">
                                                        <i class="fa fa-calendar-minus"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class=" col-lg-8 col-md-12 col-sm-12">
                                                <a href="{{ route('admin.turnos.edit', $turno->id) }}"
                                                    title="Editar Turno" target="_blank"
                                                    style=" color:black; border-color:
                                                                          {{ $turno->id_estado_turnos != 1
                                                                              ? $turno->EstadoTurno->color
                                                                              : (isset($turno->TipoTurno)
                                                                                  ? $turno->TipoTurno->color
                                                                                  : null) }}
                                                                            ; border-bottom-width:8px"
                                                    class="btn btn-outline float-left">
                                                    {{ isset($turno)
                                                                            ? (isset($turno->Paciente) ? 'PAC: ' . $turno->Paciente->nombre : null) .
                                                                                ' ' .
                                                                                (isset($turno->Profesional) ? 'PRO: ' . $turno->Profesional->nombre : null)
                                                                            : null }}
                                                </a>

                                            </div>
                                        </div>

                                    </div>
                                    @endforeach


                                    <a href="{{ route('admin.turnos.create_fecha', ['hora' => $hora, 'minuto' => $minuto, 'fecha' => $dia->format('d-m-Y')]) }}" title="Crear Nuevo Turno" class="btn btn-outline-success">
                                        <i class="fa fa-plus success"></i>
                                    </a>


                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="form-group col-lg-2 col-md-3 col-sm-4">
                    <br>
                    <div class="container text-center">

                        <div class="bg-secondary text-white">
                            <div class="p-3" style="text-transform:uppercase; font-weight: bolder">Tipos de Turnos
                            </div>
                        </div>
                        <div class="list-group" style="padding: 1em">
                            @foreach ($tipos_turno as $tipo_turno)
                            <div class="list-group-item"
                                style="border-radius:50px; border-color:{{ $tipo_turno->color }}; text-align:center; 
                                            text-transform:uppercase; font-weight: bolder; font-size:12px; border-width:6px; padding: 2px;">
                                {{ $tipo_turno->denominacion }}
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script src="{{ asset('admin1/turnos/cronograma.js') }}"></script>

@stop