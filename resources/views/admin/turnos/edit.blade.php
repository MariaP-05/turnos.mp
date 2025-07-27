@extends('adminlte::page')

@section('title', 'Nuevo Turno')


@section('content_header')
    <h1>Turnos</h1>

@stop

@section('content')
    <div class="card">
        <div class="cadr-body">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">

                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        @if (isset($turno->id))
                            {{ Form::model($turno, ['route' => ['admin.turnos.update', $turno->id], 'method' => 'PUT', 'role' => 'form', 'data-toggle' => 'validator']) }}
                        @else
                            {{ Form::open(['route' => 'admin.turnos.store', 'method' => 'POST', 'role' => 'form', 'data-toggle' => 'validator']) }}
                        @endif

                        @if (isset($turno->id))
                            <div class="row  col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="id">{{ trans('message.code') }}</label>
                                    {{ Form::text('id', null, ['id' => 'id', 'class' => 'form-control', 'placeholder' => 'id', 'readonly']) }}
                                </div>
                            </div>
                        @endif

                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="id_paciente">Paciente</label>
                                @if (isset($turno->id_paciente))
                                    {{ Form::select('id_paciente', $pacientes, $turno->id_paciente, ['id' => 'id_paciente', 'class' => 'form-control select2']) }}
                                @else
                                    {{ Form::select('id_paciente', $pacientes, null, ['id' => 'id_paciente', 'class' => 'form-control select2']) }}
                                @endif
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="id_institucion">Institución</label>
                                {{ Form::select('id_institucion', $instituciones, null, ['id' => 'id_institucion', 'class' => 'form-control select2']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>

                        </div>

                        <div class="row  col-md-12">

                            @if (!isset(Auth::user()->Profesional))
                                <div class="col-md-6 form-group has-feedback">
                                    <label for="id_profesional">Profesional</label>
                                    {{ Form::select('id_profesional', $profesionales, null, ['id' => 'id_profesional', 'class' => 'form-control select2']) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            @endif
                            <div class="col-md-6 form-group has-feedback">
                                <label for="fecha">Fecha</label>
                                <div class="input-group date">

                                    {{ Form::text('fecha', isset($fecha) ? $fecha : null, ['id' => 'fecha', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa']) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="hora_inicio">Horario inicio</label>
                                <div class="row">
                                    <div class="col-md-3 form-group has-feedback">

                                        {{ Form::select('hora_inicio', $horas, isset($hora) ? $hora : null, ['id' => 'hora_inicio', 'class' => 'form-control']) }}
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-3 form-group has-feedback">

                                        {{ Form::select('minuto_inicio', $minutos, isset($minuto) ? $minuto : null, ['id' => 'minuto_inicio', 'class' => 'form-control']) }}
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <label for="hora_fin">Horario Fin</label>
                                    </div>
                                    <div class="col-md-6 ">
                                        <label for="repetir">Cantidad de Turnos Fijos</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 form-group has-feedback">

                                        {{ Form::select('hora_fin', $horas, isset($hora_hasta) ? $hora_hasta : null, ['id' => 'hora_fin', 'class' => 'form-control']) }}
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-3 form-group has-feedback">

                                        {{ Form::select('minuto_fin', $minutos, isset($minuto) ? $minuto : null, ['id' => 'minuto_fin', 'class' => 'form-control']) }}
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 form-group has-feedback">

                                        {{ Form::number('repetir', 0, ['id' => 'repetir', 'class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row  col-md-12">
                                <div class="col-md-6 form-group has-feedback">
                                    <label for="id_tipos_turno">Tipo de Turnos </label>
                                    {{ Form::select('id_tipos_turno', $tipos_turno, null, ['id' => 'id_tipos_turno', 'class' => 'form-control select2']) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                @if (isset($turno->id))
                                    <div class="col-md-6 form-group has-feedback">
                                        <label for="id_estado_turnos">Estado</label>
                                        {{ Form::select('id_estado_turnos', $estado_turnos, null, ['id' => 'id_estado_turnos', 'class' => 'form-control select2']) }}
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                @endif

                            </div>

                            <div class="row  col-md-12">
                                <div class="col-md-6 form-group has-feedback">
                                    <label for="id_practica">Práctica</label>
                                    {{ Form::select('id_practica', $practicas, null, ['id' => 'id_practica', 'class' => 'form-control select2']) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12  form-group has-feedback">
                                    <label for="observacion">Observaciones </label>
                                    <textarea class="form-control" name="observacion" id="observacion" rows="3">{{isset($turno) ? $turno->observacion : ''}}</textarea>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>



                        <div class="box-footer col-md-6 form-group pull-right ">
                            <a type="button" class="btn btn-outline-danger"
                                href="{{ route('admin.turnos.index') }}">{{ trans('message.close') }}</a>
                            <button type="submit" class="btn btn-outline-primary">{{ trans('message.save') }}</button>
                        </div>
                        {{ Form::close() }}
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>


        </div>
    </div>
@stop

@section('css')
@stop


@section('js')

    <script src="{{ asset('admin1/turnos/edit.js') }}"></script>

@stop
