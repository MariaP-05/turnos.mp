@extends('adminlte::page')

@section('title', 'Nuevo Profesional')


@section('content_header')
<h1>Nuevo Profesional</h1>
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

                    @if(isset($profesional))
                    {{ Form::model($profesional,['route'=>['admin.profesionales.update', $profesional->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @else
                    {{ Form::open(['route' => 'admin.profesionales.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @endif

                    @if(isset($profesional->id))
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="id">Id</label>
                            {{ Form::text('id', null, array('id' => 'id','class' => 'form-control','placeholder'=>"id", 'readonly')) }}
                        </div>
                    </div>
                    @endif
                    <div class="row col-md-12">
                    <div class="col-md-6 form-group has-feedback">
                            <label for="cuit">CUIT</label>
                            {{ Form::text('cuit', null, array('id' => 'cuit','class' => 'form-control','placeholder' => 'CUIT')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 form-group has-feedback">
                            <label for="nombre">Nombre</label>
                            {{ Form::text('nombre', null, array('id' => 'nombre','class' => 'form-control','placeholder' => 'Nombre')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="row col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="matricula">Matrícula</label>
                            {{ Form::text('matricula', null, array('id' => 'matricula','class' => 'form-control','placeholder' => 'Matricula')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="telefono">Teléfono</label>
                            {{ Form::text('telefono', null, array('id' => 'telefono','class' => 'form-control','placeholder' => 'Telefono')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>



                    <div class="row col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="mail">Mail</label>
                            {{ Form::text('mail', null, array('id' => 'mail','class' => 'form-control','placeholder' => 'Mail')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_profesion">Profesion</label>
                            {{ Form::select('id_profesion', $profesiones, null,  array('id' => 'id_profesion','class' => 'form-control select2')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
      
                </div>


                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-danger" href="{{route('admin.profesionales.index')}}">{{ trans('message.close') }}</a>
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