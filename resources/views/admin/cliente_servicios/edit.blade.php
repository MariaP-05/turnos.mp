@extends('adminlte::page')

@section('title', 'Nuevo Servicio del Cliente')


@section('content_header')
<h1>Nuevo Servicio del Cliente</h1>
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

                    @if(isset($cliente_servicios))
                    {{ Form::model($cliente_servicios,['route'=>['admin.cliente_servicios.update', $cliente_servicios->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @else
                    {{ Form::open(['route' => 'admin.cliente_servicios.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @endif

                    @if(isset($cliente_servicios->id))
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="id">{{ trans('message.code') }}</label>
                            {{ Form::text('id', null, array('id' => 'id','class' => 'form-control','placeholder'=>"id", 'readonly')) }}
                        </div>
                    </div>
                    @endif
                    <div class="row col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_cliente">Cliente</label>
                            {{ Form::select('id_cliente', $clientes, null,  array('id' => 'id_cliente','class' => 'form-control select2')) }}
                        </div>

                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_servicio">Servicio</label>
                            {{ Form::select('id_servicio', $servicios, null,  array('id' => 'id_servicio','class' => 'form-control select2')) }}
                        </div>
                    </div>

                    <div class="row col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="fecha_desde">Fecha Desde</label>
                            <div class="input-group date" data-provide="datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ Form::text('fecha_desde',isset($cliente_servicios->fecha_desde) ? $cliente_servicios->fecha_desde : null,  array('id' => 'fecha_desde','class' => 'form-control','placeholder' => 'dd-mm-aaaa', 'required')) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="fecha_hasta">Fecha Hasta</label>
                            <div class="input-group date" data-provide="datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ Form::text('fecha_hasta',isset($cliente_servicios->fecha_hasta) ? $cliente_servicios->fecha_hasta : null,  array('id' => 'fecha_hasta','class' => 'form-control','placeholder' => 'dd-mm-aaaa' )) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row col-md-12">
                        <div class="col-md-12  form-group has-feedback">
                            <label for="observaciones">Observaciones </label>
                            <textarea class="form-control" name="observaciones" id="observaciones" rows="3">{{isset($cliente) ? $cliente->observaciones : ''}}</textarea>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>



                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-danger" href="{{route('admin.cliente_servicios.index')}}">{{ trans('message.close') }}</a>
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