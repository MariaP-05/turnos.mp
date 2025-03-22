@extends('adminlte::page')

@section('title', 'Nueva Institución')


@section('content_header')
    <h1>Nueva Institución</h1>
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

                        @if (isset($institucion))
                            {{ Form::model($institucion, ['route' => ['admin.instituciones.update', $institucion->id], 'method' => 'PUT', 'role' => 'form', 'data-toggle' => 'validator']) }}
                        @else
                            {{ Form::open(['route' => 'admin.instituciones.store', 'method' => 'POST', 'role' => 'form', 'data-toggle' => 'validator']) }}
                        @endif

                        @if (isset($institucion->id))
                            <div class="row  col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="id">Id</label>
                                    {{ Form::text('id', null, ['id' => 'id', 'class' => 'form-control', 'placeholder' => 'id', 'readonly']) }}
                                </div>
                            </div>
                        @endif
                        <div class="row  col-md-12">
                                <div class="col-md-6 form-group has-feedback">
                                    <label for="nombre">Nombre</label>
                                    {{ Form::text('nombre', null, array('id' => 'nombre','class' => 'form-control','placeholder' => trans('Nombre'), 'required')) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="col-md-6 form-group has-feedback">
                                    <label for="telefono">Teléfono</label>
                                    {{ Form::text('telefono', null, ['id' => 'telefono', 'class' => 'form-control', 'placeholder' => 'Telefono']) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                        
                            </div>

                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="direccion">Dirección</label>
                                {{ Form::text('direccion', null, ['id' => 'direccion', 'class' => 'form-control', 'placeholder' => 'Direccion']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                    
                            <div class="col-md-6  form-group has-feedback">
                            <label for="cuit">CUIT</label>
                                {{ Form::text('cuit', null, ['id' => 'cuit', 'class' => 'form-control', 'placeholder' => 'CUIT']) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>

                        </div>
                        <div class="row  col-md-12">
                        <div class="col-md-12  form-group has-feedback">
                                <label for="observacion">Observaciones </label>
                                <textarea class="form-control" name="observacion" id="observacion" rows="3">{{ isset($institucion) ? $institucion->observacion : '' }}</textarea>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            </div>
                        <div class="box-footer col-md-6 form-group pull-right ">
                            <a type="button" class="btn btn-outline-danger"
                                href="{{ route('admin.instituciones.index') }}">{{ trans('message.close') }}</a>
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
