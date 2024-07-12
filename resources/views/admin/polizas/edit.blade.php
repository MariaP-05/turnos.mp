@extends('adminlte::page')

@section('title', 'Nueva Poliza')


@section('content_header')
<h1>Polizas</h1>
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

                    @if(isset($poliza))
                    {{ Form::model($poliza,['route'=>['admin.polizas.update', $poliza->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @else
                    {{ Form::open(['route' => 'admin.polizas.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @endif

                    @if(isset($poliza->id))
                    <div class="row  col-md-12">
                    <div class="form-group col-md-6">
                        <label for="id">{{ trans('message.code') }}</label>
                        {{ Form::text('id', null, array('id' => 'id','class' => 'form-control','placeholder'=>"id", 'readonly')) }}
                    </div>
                    </div>
                    @endif
                   
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_compania">Compañia</label>
                            {{ Form::select('id_compania', $companias, null,  array('id' => 'id_compania','class' => 'form-control select2')) }}
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                    </div>                   

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                        <label for="id_cliente">Cliente</label>
                            {{ Form::select('id_cliente', $clientes, null,  array('id' => 'id_cliente','class' => 'form-control select2')) }}
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                        <label for="id_seccion">Sección</label>
                            {{ Form::select('id_seccion', $secciones, null,  array('id' => 'id_seccion','class' => 'form-control select2')) }}
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>      

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="numero_poliza">Número Poliza</label>
                            {{ Form::text('numero_poliza', null, array('id' => 'numero_poliza','class' => 'form-control')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                    </div> 

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                                <label for="vigencia_desde">Vigencia desde</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {{ Form::text('vigencia_desde',isset($valor->vigencia_desde) ? $valor->vigencia_desde : null,  array('id' => 'vigencia_desde','class' => 'form-control')) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                
                        </div>
                            <div class="col-md-6 form-group has-feedback">
                                <label for="vigencia_hasta">Vigencia hasta</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {{ Form::text('vigencia_hasta',isset($valor->vigencia_hasta) ? $valor->vigencia_hasta : null,  array('id' => 'vigencia_hasta','class' => 'form-control')) }}
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                    </div>

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="vehiculo">Vehículo</label>
                            {{ Form::text('vehiculo', null, array('id' => 'vehiculo','class' => 'form-control')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="marca">Marca</label>
                            {{ Form::text('marca', null, array('id' => 'marca','class' => 'form-control')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div> 

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                        <label for="id_forma_pago">Forma de Pago</label>
                            {{ Form::select('id_forma_pago', $formas_pago, null,  array('id' => 'id_forma_pago','class' => 'form-control select2')) }}
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="cantidad_cuotas">Cantidad de Cuotas</label>
                            {{ Form::text('cantidad_cuotas', null, array('id' => 'cantidad_cuotas','class' => 'form-control')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div> 
                    
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                        <label for="id_productor">Productor</label>
                            {{ Form::select('id_productor', $productores, null,  array('id' => 'id_productor','class' => 'form-control select2')) }}
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="cobertura">Cobertura</label>
                            {{ Form::text('cobertura', null, array('id' => 'cobertura','class' => 'form-control')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div> 
                    
                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-danger" href="{{route('admin.polizas.index')}}">{{ trans('message.close') }}</a>
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