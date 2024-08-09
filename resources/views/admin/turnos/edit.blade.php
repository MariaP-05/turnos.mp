@extends('adminlte::page')

@section('title', 'Nueva Turno')


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

                    @if(isset($turno))
                    {{ Form::model($turno,['route'=>['admin.turnos.update', $turno->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @else
                    {{ Form::open(['route' => 'admin.turnos.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @endif

                    @if(isset($turno->id))
                    <div class="row  col-md-12">
                    <div class="form-group col-md-6">
                        <label for="id">{{ trans('message.code') }}</label>
                        {{ Form::text('id', null, array('id' => 'id','class' => 'form-control','placeholder'=>"id", 'readonly')) }}
                    </div>
                    </div>
                    @endif
                   
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_paciente">Paciente</label>
                            {{ Form::select('id_paciente', $pacientes, null,  array('id' => 'id_paciente','class' => 'form-control select2')) }}
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_institucion">Institución</label>
                                {{ Form::select('id_institucion', $instituciones, null,  array('id' => 'id_institucion','class' => 'form-control select2')) }}
                                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        
                    </div>                   

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                        <label for="id_profesional">Profesional</label>
                            {{ Form::select('id_profesional', $profesionales, null,  array('id' => 'id_profesional','class' => 'form-control select2')) }}
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="col-md-6 form-group has-feedback">
                                <label for="fecha">Fecha</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {{ Form::text('fecha',isset($valor->fecha) ? $valor->fecha : null,  array('id' => 'fecha','class' => 'form-control')) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                        </div>
                    </div>
                    <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="hora_inicio">Horario inicio</label>
                                {{ Form::time('hora_inicio', null, array('id' => 'hora_inicio','class' => 'form-control')) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="hora_fin">Horario fin</label>
                            {{ Form::time('hora_fin', null, array('id' => 'hora_fin','class' => 'form-control')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div> 
                    
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="descripcion">Descripción</label>
                            {{ Form::text('descripcion', null, array('id' => 'descripcion','class' => 'form-control','placeholder' => trans('Descripción'))) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div> 
                    
                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-danger" href="{{route('admin.turnos.index')}}">{{ trans('message.close') }}</a>
                        <button type="submit" class="btn btn-primary">{{ trans('message.save') }}</button>
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


@stop