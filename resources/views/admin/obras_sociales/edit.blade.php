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
                            <label for="denominacion">Denominación</label>
                            {{ Form::text('denominacion', null, array('id' => 'denominacion','class' => 'form-control','placeholder' => trans('message.denomination'), 'required')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="denominacion_amigable">Denominación amigable</label>
                            {{ Form::text('denominacion_amigable', null, array('id' => 'denominacion_amigable','class' => 'form-control','placeholder' => 'Denominación amigable', 'required')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="telefono">Teléfono</label>
                            {{ Form::text('telefono', null, array('id' => 'telefono','class' => 'form-control','placeholder' => 'Telefono')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 form-group has-feedback">
                            <label for="direccion">Dirección</label>
                            {{ Form::text('direccion', null, array('id' => 'direccion','class' => 'form-control','placeholder' => 'Direccion')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                    </div>
                    <div class="row  col-md-12">
                        <label>Fecha de Presentacion de Factura</label>


                        <div class="col-md-3 form-group has-feedback">
                            <label>Del</label>
                            {{ Form::number('fecha_presentacion_desde', null, array('id' => 'fecha_presentacion_desde','class' => 'form-control','placeholder' => '1')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-3 form-group has-feedback">
                            <label>Al</label>
                            {{ Form::number('fecha_presentacion_hasta', null, array('id' => 'fecha_presentacion_hasta','class' => 'form-control','placeholder' => '10')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>


                        <div class="col-md-6 form-group has-feedback">
                            <label for="periodo_informe">Periodo de Presentacion de Informes</label>
                            {{ Form::select('periodo_informe',[ '' => 'Seleccione', 'Mensual' => 'Mensual'
                                , 'Bimestral' => 'Bimestral'
                                , 'Trimestral' => 'Trimestral'
                                , 'Cuatrimestral' => 'Cuatrimestral'
                                , 'Semestr ' => 'Semestral'
                                , 'Anual' => 'Anual' 
                                ], null, array('id' => 'alerta','class' => 'form-control') )}}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                    </div>
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="cuit">CUIT</label>
                            {{ Form::text('cuit', null, array('id' => 'cuit','class' => 'form-control','placeholder' => 'CUIT')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row  col-md-12">
                        <div class="col-md-12  form-group has-feedback">
                            <label for="observacion">Observaciones </label>
                            <textarea class="form-control" name="observacion" id="observacion" rows="3">{{isset($obra_social) ? $obra_social->observacion : ''}}</textarea>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                                  
                    </div>





                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-outline-danger" href="{{route('admin.obras_sociales.index')}}">{{ trans('message.close') }}</a>
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


@stop