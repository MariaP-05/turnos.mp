@extends('adminlte::page')

@section('title', 'Nuevo Servicios')


@section('content_header')
<h1>Servicios</h1>
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

                    @if(isset($servicio))
                    {{ Form::model($servicio,['route'=>['admin.servicios.update', $servicio->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @else
                    {{ Form::open(['route' => 'admin.servicios.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @endif

                    @if(isset($servicio->id))
                    <div class="row  col-md-12">
                    <div class="form-group col-md-6">
                        <label for="id">{{ trans('message.code') }}</label>
                        {{ Form::text('id', null, array('id' => 'id','class' => 'form-control','placeholder'=>"id", 'readonly')) }}
                    </div>
                    </div>
                    @endif
                   
                    <div class="row  col-md-12">
                        <div class="col-md-12 form-group has-feedback">
                            <label for="nombre">{{trans('message.name')}}</label>
                            {{ Form::text('nombre', null, array('id' => 'nombre','class' => 'form-control','placeholder' => trans('message.name'), 'required')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                    </div>                   

                    <div class="row  col-md-12">
                 
                        <div class="col-md-12 form-group has-feedback">
                            <label for="descripcion">Descripcion</label>
                            {{ Form::text('descripcion', null, array('id' => 'descripcion','class' => 'form-control','placeholder' => 'Descripcion', 'required')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>      

                    
                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-danger" href="{{route('admin.servicios.index')}}">{{ trans('message.close') }}</a>
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