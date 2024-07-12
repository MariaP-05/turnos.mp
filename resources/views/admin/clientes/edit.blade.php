@extends('adminlte::page')

@section('title', 'Nuevo Cliente')


@section('content_header')
<h1>Clientes</h1>
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

                    @if(isset($cliente))
                    {{ Form::model($cliente,['route'=>['admin.clientes.update', $cliente->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @else
                    {{ Form::open(['route' => 'admin.clientes.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @endif

                    @if(isset($cliente->id))
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
                            {{ Form::text('denominacion', null, array('id' => 'denominacion','class' => 'form-control','placeholder' => trans('message.denomination'))) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-xs-6 form-group has-feedback">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {{ Form::text('fecha_nacimiento',isset($valor->fecha_nacimiento) ? $valor->fecha_nacimiento : null,  array('id' => 'fecha_nacimiento','class' => 'form-control','placeholder' => 'dd-mm-aaaa')) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                        </div>
                    </div>                        

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="cuit">CUIT/CUIL</label>
                            {{ Form::text('cuit', null, array('id' => 'cuit','class' => 'form-control','placeholder' => 'CUIT / CUIL')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>   
                    </div> 

                    <div class="row  col-md-12">
                    <div class="col-md-6 form-group has-feedback">                        
                            <label for="id_localidad">Localidad</label>
                            {{ Form::select('id_localidad', $localidades, null,  array('id' => 'id_localidad','class' => 'form-control select2')) }}
                            
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="direccion">Direccion</label>
                            {{ Form::text('direccion', null, array('id' => 'direccion','class' => 'form-control','placeholder' => 'Direccion')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                       
                    </div>      
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">                        
                            <label for="telefono">Telefono</label>
                            {{ Form::text('telefono', null, array('id' => 'telefono','class' => 'form-control','placeholder' => '0341353222')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                        <label for="celular">Celular</label>
                            {{ Form::text('celular', null, array('id' => 'celular','class' => 'form-control','placeholder' => '0341353222')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div> 
                    </div> 
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">                        
                            <label for="mail">{{trans('message.email')}}</label>
                                {{ Form::text('mail', null, array('id' => 'mail','class' => 'form-control','placeholder' => trans('message.email'),'pattern' => '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$'))}}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                             </div>
                        <div class="col-md-6 form-group has-feedback">
                        <label for="mail_2">{{trans('message.email')}} Auxiliar</label>
                                {{ Form::text('mail_2', null, array('id' => 'mail_2','class' => 'form-control','placeholder' => trans('message.email'). ' Auxiliar','pattern' => '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$'))}}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                             </div>
                    </div> 
                   

                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-danger" href="{{route('admin.clientes.index')}}">{{ trans('message.close') }}</a>
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