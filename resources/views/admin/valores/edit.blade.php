@extends('adminlte::page')

@section('title', 'Nuevo Valor')


@section('content_header')

    <h1>Valores</h1>

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

                        @if (isset($valor))
                            {{ Form::model($valor, ['route' => ['admin.valores.update', $valor->id], 'method' => 'PUT', 'role' => 'form', 'data-toggle' => 'validator', 'files' => true]) }}
                        @else
                            {{ Form::open(['route' => 'admin.valores.store', 'method' => 'POST', 'role' => 'form', 'data-toggle' => 'validator', 'files' => true]) }}
                        @endif

                        @if (isset($valor->id))
                            <div class="row  col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="id">{{ trans('message.code') }}</label>
                                    {{ Form::text('id', null, ['id' => 'id', 'class' => 'form-control', 'placeholder' => 'id', 'readonly']) }}
                                </div>
                            </div>
                        @endif

                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="valor">Valor</label>
                                {{ Form::text('valor', null, ['id' => 'valor', 'class' => 'form-control', 'placeholder' => trans('valor')]) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="fecha_desde">Fecha desde</label>
                                <div class="input-group date">

                                    {{ Form::text('fecha_desde', isset($valor->fecha_desde) ? $valor->fecha_desde : null, ['id' => 'fecha_desde', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa']) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>

                            </div>
                        </div>


                        <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="id_obra_social">Obra Social</label>
                                {{ Form::select('id_obra_social', $obras_sociales, null, ['id' => 'id_obra_social', 'class' => 'form-control select2']) }}

                            </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="id_practica">Práctica</label>
                                {{ Form::select('id_practica', $practicas, null, ['id' => 'id_practica', 'class' => 'form-control select2']) }}

                            </div>

                        </div>

                        

                        

                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-outline-danger" href="{{route('admin.valores.index')}}">{{ trans('message.close') }}</a>
                        <button type="submit" class="btn btn-outline-primary">{{ trans('message.save') }}</button>
                    </div>




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
<script src="{{ asset('admin1/valores/edit.js') }}"></script>       
        
@stop
