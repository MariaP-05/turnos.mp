@extends('adminlte::page')

@section('title', 'Nuevo Contacto')


@section('content_header')

    <h1>Contactos</h1>

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

                        @if (isset($contacto))
                            {{ Form::model($contacto, ['route' => ['admin.contactos.update', $contacto->id], 'method' => 'PUT', 'role' => 'form', 'data-toggle' => 'validator', 'files' => true]) }}
                        @else
                            {{ Form::open(['route' => 'admin.contactos.store', 'method' => 'POST', 'role' => 'form', 'data-toggle' => 'validator', 'files' => true]) }}
                        @endif

                        @if (isset($contacto->id))
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
                                <label for="relacion">Relación</label>
                                {{ Form::text('relacion', null, ['id' => 'relacion', 'class' => 'form-control', 'placeholder' => trans('relacion')]) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <div class="input-group date">

                                    {{ Form::text('fecha_nacimiento', isset($valor->fecha_nacimiento) ? $valor->fecha_nacimiento : null, ['id' => 'fecha_nacimiento', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa']) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="dni">DNI</label>
                                {{ Form::text('dni', null, ['id' => 'dni', 'class' => 'form-control', 'placeholder' => 'DNI']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="telefono">Telefono</label>
                                {{ Form::text('telefono', null, ['id' => 'telefono', 'class' => 'form-control', 'placeholder' => '0341353222']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="telefono_aux">Teléfono Auxiliar</label>
                                {{ Form::text('telefono_aux', null, ['id' => 'telefono_aux', 'class' => 'form-control', 'placeholder' => '0341353222']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>


                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="direccion">Direccion</label>
                                {{ Form::text('direccion', null, array('id' => 'direccion','class' => 'form-control','placeholder' => 'Direccion')) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="id_localidad">Localidad</label>
                                {{ Form::select('id_localidad', $localidades, null,  array('id' => 'id_localidad','class' => 'form-control select2')) }}
                            </div>
                        </div>

                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="mail">{{trans('message.email')}}</label>
                                {{ Form::text('mail', null, array('id' => 'mail','class' => 'form-control','placeholder' => trans('message.email'),'pattern' => '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$'))}}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="observacion">Observacion</label>
                                {{ Form::text('observacion', null, ['id' => 'observacion', 'class' => 'form-control', 'placeholder' => trans('observacion')]) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        {{ Form::hidden('id_paciente', $paciente->id) }}


                        <div class="box-footer col-md-6 form-group pull-right ">
                            <a type="button" class="btn btn-outline-danger" href="{{route('admin.pacientes.index')}}">{{ trans('message.close') }}</a>
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
     
    <script src="{{ asset('admin1/contactos/edit.js') }}"></script>
    
    @stop
