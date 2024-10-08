@extends('adminlte::page')

@section('title', 'Nueva Obra Social')


@section('content_header')
<h1>Obras Sociales</h1>
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

                    @if(isset($obra_social))
                    {{ Form::model($obra_social,['route'=>['admin.obras_sociales.update', $obra_social->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @else
                    {{ Form::open(['route' => 'admin.obras_sociales.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @endif

                    @if(isset($obra_social->id))
                    <div class="row  col-md-12">
                    <div class="form-group col-md-6">
                        <label for="id">{{ trans('message.code') }}</label>
                        {{ Form::text('id', null, array('id' => 'id','class' => 'form-control','placeholder'=>"id", 'readonly')) }}
                    </div>
                    </div>
                    @endif
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="denominacion">{{trans('message.denomination')}}</label>
                            {{ Form::text('denominacion', null, array('id' => 'denominacion','class' => 'form-control','placeholder' => trans('message.denomination'), 'required')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="denominacion_amigable">{{trans('denominacion_amigable')}}</label>
                            {{ Form::text('denominacion_amigable', null, array('id' => 'denominacion_amigable','class' => 'form-control','placeholder' => trans('denominacion_amigable'), 'required')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>    
                    </div>

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="telefono">Teléfono</label>
                            {{ Form::text('telefono', null, array('id' => 'telefono','class' => 'form-control','placeholder' => 'Telefono')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="direccion">Dirección</label>
                                {{ Form::text('direccion', null, array('id' => 'direccion','class' => 'form-control','placeholder' => 'Direccion')) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                           
                        </div>
                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="cuit">CUIT</label>
                                {{ Form::text('cuit', null, array('id' => 'cuit','class' => 'form-control','placeholder' => 'cuit')) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                                </div>
                    

                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-danger" href="{{route('admin.obras_sociales.index')}}">{{ trans('message.close') }}</a>
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