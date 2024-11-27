@extends('adminlte::page')

@section('title', 'Nuevo Paciente')


@section('content_header')

    <h1>Pacientes</h1>

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

                        @if (isset($paciente))
                            {{ Form::model($paciente, ['route' => ['admin.pacientes.update', $paciente->id], 'method' => 'PUT', 'role' => 'form', 'data-toggle' => 'validator', 'files' => true]) }}
                        @else
                            {{ Form::open(['route' => 'admin.pacientes.store', 'method' => 'POST', 'role' => 'form', 'data-toggle' => 'validator', 'files' => true]) }}
                        @endif

                        @if (isset($paciente->id))
                            <div class="row  col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="id">{{ trans('message.code') }}</label>
                                    {{ Form::text('id', null, ['id' => 'id', 'class' => 'form-control', 'placeholder' => 'id', 'readonly']) }}
                                </div>
                            </div>
                        @endif

                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="nombre">Nombre</label>
                                {{ Form::text('nombre', null, ['id' => 'nombre', 'class' => 'form-control', 'placeholder' => trans('nombre')]) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <div class="input-group date">

                                    {{ Form::text('fecha_nacimiento', isset($valor->fecha_nacimiento) ? $valor->fecha_nacimiento : null, ['id' => 'fecha_nacimiento', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa']) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>

                            </div>
                        </div>

                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="dni">DNI</label>
                                {{ Form::text('dni', null, ['id' => 'dni', 'class' => 'form-control', 'placeholder' => 'DNI']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="telefono">Telefono</label>
                                {{ Form::text('telefono', null, ['id' => 'telefono', 'class' => 'form-control', 'placeholder' => '0341353222']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>


                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="id_obra_social">Obra Social</label>
                                {{ Form::select('id_obra_social', $obras_sociales, null, ['id' => 'id_obra_social', 'class' => 'form-control select2']) }}

                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="numero_afiliado">Número de Afiliado</label>
                                {{ Form::text('numero_afiliado', null, ['id' => 'numero_afiliado', 'class' => 'form-control', 'placeholder' => 'Numero de Afiliado']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>

                        </div>

                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="mail">{{ trans('message.email') }}</label>
                                {{ Form::text('mail', null, ['id' => 'mail', 'class' => 'form-control', 'placeholder' => trans('message.email'), 'pattern' => '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="id_localidad">Localidad</label>
                                {{ Form::select('id_localidad', $localidades, null, ['id' => 'id_localidad', 'class' => 'form-control select2']) }}
                            </div>
                        </div>

                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="direccion">Direccion</label>
                                {{ Form::text('direccion', null, ['id' => 'direccion', 'class' => 'form-control', 'placeholder' => 'Direccion']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>

                        </div>

                        <hr style="background-color:blue ; height: 2px">
                        </hr>
                        <h3>Nuevas Sesiones</h3>
                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="cantidad_recetada">Cantidad Recetadas</label>
                                {{ Form::text('cantidad_recetada[]', null, ['id' => 'cantidad_recetada', 'class' => 'form-control']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="cantidad_turnos_reales">Cantidad Reales</label>
                                {{ Form::text('cantidad_turnos_reales[]', null, ['id' => 'cantidad_turnos_reales', 'class' => 'form-control']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="cantidad_turnos_realizados">Cantidad Realizadas</label>
                                {{ Form::text('cantidad_turnos_realizados[]', null, ['id' => 'cantidad_turnos_realizados', 'class' => 'form-control']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="id_profesional">Profesional</label>
                                {{ Form::select('id_profesional[]', $profesionales, null, ['id' => 'id_profesional', 'class' => 'form-control select2']) }}
                            </div>
                        </div>


                        @if (isset($paciente->Sesiones))
                            @if (count($paciente->Sesiones) > 0)
                                <hr style="background-color:blue ; height: 2px">
                                </hr>
                                <h3>Historial de Sesiones</h3>
                            @endif
                            @foreach ($paciente->Sesiones as $sesion)
                                <div class="row col-md-12">
                                    <div class="col-md-6 form-group has-feedback">
                                        <label for="cantidad_recetada">Cantidad Recetadas</label>
                                        {{ Form::text('cantidad_recetada[]', $sesion->cantidad_recetada, ['id' => 'cantidad_recetada', 'class' => 'form-control', 'disabled']) }}
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 form-group has-feedback">
                                        <label for="cantidad_turnos_reales">Cantidad Reales</label>
                                        {{ Form::text('cantidad_turnos_reales[]', $sesion->cantidad_turnos_reales, ['id' => 'cantidad_turnos_reales', 'class' => 'form-control', 'disabled']) }}
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="row  col-md-12">
                                    <div class="col-md-6 form-group has-feedback">
                                        <label for="cantidad_turnos_realizados">Cantidad Realizadas</label>
                                        {{ Form::text('cantidad_turnos_realizados[]', $sesion->cantidad_turnos_realizados, ['id' => 'cantidad_turnos_realizados', 'class' => 'form-control', 'disabled']) }}
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 form-group has-feedback">
                                        <label for="id_profesional">Profesional</label>
                                        {{ Form::select('id_profesional[]', $profesionales, $sesion->id_profesional, ['id' => 'id_profesional', 'class' => 'form-control select2', 'disabled']) }}
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-6 form-group has-feedback">
                                        <label for="fecha_inicio">Fecha de Inicio</label>
                                        <div class="input-group date">
                                            {{ Form::text('fecha_inicio', isset($sesion->fecha_inicio) ? $sesion->fecha_inicio : null, ['id' => 'fecha_inicio', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa', 'disabled']) }}
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group has-feedback">
                                        <label for="fecha_fin">Fecha de Fin</label>
                                        <div class="input-group date">
                                            {{ Form::text('fecha_fin', isset($sesion->fecha_fin) ? $sesion->fecha_fin : null, ['id' => 'fecha_fin', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa', 'disabled']) }}
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                                <hr style="background-color:LightBlue ; height: 1px">
                                </hr>
                            @endforeach


                        @endif
                        <hr style="background-color:blue ; height: 2px">
                        </hr>
                        <div class="info-card bg-secondary col-md-12" style="padding: 1em">
                            <label for="Archivo_Adjunto">Archivos Adjuntos</label>
                            <input type="file" class="form-control"
                                title="Arrastre el Archivo o Haga click para seleccionar" id="Archivo_Adjunto[]"
                                name="Archivo_Adjunto[]" multiple="">

                        </div>

                        <hr style="background-color:blue ; height: 2px">
                        </hr>
                        <h3>Seguimiento del Paciente - Observaciones</h3>
                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="observacion">Observaciones</label>
                                <textarea class="form-control" name="observacion" id="observacion" rows="1"></textarea>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>

                        <hr style="background-color:LightBlue ; height: 1px">
                        </hr>
                        <br>
                        <div class="box-footer col-md-6 form-group pull-right ">
                            <a type="button" class="btn btn-outline-danger"
                                href="{{ route('admin.pacientes.index') }}">{{ trans('message.close') }}</a>
                            <button type="submit" class="btn btn-outline-primary">{{ trans('message.save') }}</button>
                        </div>
                        <br>

                        <hr style="background-color:blue ; height: 3px">
                        </hr>

                        @if (isset($paciente->historias_clinicas))
                            @if (count($paciente->historias_clinicas) > 0)
                                <h3>Historial de Observaciones</h3>
                            @endif
                            <table id="historias_clinicas" class="table table-striped col-12">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>Observación</th>
                                        <th>Profesional</th>
                                        <th>Fecha</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach ($paciente->historias_clinicas as $historia_clinica)
                                    <tr>

                                        <td class="col-md-6 form-group"
                                            style="text-align:center">
                                            {{ $historia_clinica->observacion }}</td>
                                        <td class="col-md-2 form-group">
                                            {{ isset($historia_clinica->Profesional) ? $historia_clinica->Profesional->nombre : '' }}
                                        </td>
                                        <td class="col-md-3 form-group">{{ $historia_clinica->fecha }}</td>
                                        <td>
                                            <div class="col-md-3 form-group">
                                                <a href="{{route('admin.pacientes.delete_hc',['id'=>$historia_clinica-> id ])}}"
                                                    class="btn btn-xs btn-outline-danger float-right" title="Eliminar" role="button">
                                                    <i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach


                        @endif
                        </table>
                        <hr style="background-color:blue ; height: 2px">
                        </hr>




                        {{ Form::close() }}
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                </div>


            </div>
        </div>
    @stop

    @section('css')

    @stop

    @section('js')
        <script src="{{ asset('admin1/pacientes/edit.js') }}"></script>
    @stop
