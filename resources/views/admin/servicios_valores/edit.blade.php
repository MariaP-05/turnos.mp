@extends('adminlte::page')

@section('title', 'Nuevo Valor de Servicio')


@section('content_header')
<h1>Valor de Servicio</h1>
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

                    @if(isset($valor))
                    {{ Form::model($valor,['route'=>['admin.servicios_valores.update', $valor->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @else
                    {{ Form::open(['route' => 'admin.servicios_valores.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @endif

                    @if(isset($valor->id))
                    <div class="row  col-md-12">
                    <div class="form-group col-md-6">
                        <label for="id">{{ trans('message.code') }}</label>
                        {{ Form::text('id', null, array('id' => 'id','class' => 'form-control','placeholder'=>"id", 'readonly')) }}
                    </div>
                    </div>
                    @endif
                    <div class="row  col-md-12">
                    <div class="col-xs-6 form-group has-feedback">
                    <label for="id_servicio">Servicio</label>
                            {{ Form::select('id_servicio', $servicios, null,  array('id' => 'id_servicio','class' => 'form-control select2')) }}
                            </div>      
                            <div class="col-xs-6 form-group has-feedback">
                                <label for="fecha">Fecha Vigencia</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {{ Form::text('fecha',isset($valor->fecha) ? $valor->fecha : null,  array('id' => 'fecha','class' => 'form-control','placeholder' => 'dd-mm-aaaa', 'required')) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                    </div>                   
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                        <label for="valor">Importe</label>
                                    {{ Form::number('valor', isset($valor->valor) ? $valor->valor : 0, array('class' => 'form-control', 'required')) }}
                                   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                    </div>    
                     
                    
                    

                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-danger" href="{{route('admin.servicios_valores.index')}}">{{ trans('message.close') }}</a>
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