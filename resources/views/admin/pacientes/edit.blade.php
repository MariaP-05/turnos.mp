@extends('adminlte::page')

@section('title', 'Nuevo Paciente')


@section('content_header')

<h1>Pacientes</h1>

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

                    @if(isset($paciente))
                    {{ Form::model($paciente,['route'=>['admin.pacientes.update', $paciente->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator', 'files'=> true]) }}
                    @else
                    {{ Form::open(['route' => 'admin.pacientes.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator', 'files'=> true]) }}
                    @endif

                    @if(isset($paciente->id))
                    <div class="row  col-md-12">
                        <div class="form-group col-md-6">
                            <label for="id">{{ trans('message.code') }}</label>
                            {{ Form::text('id', null, array('id' => 'id','class' => 'form-control','placeholder'=>"id", 'readonly')) }}
                        </div>
                    </div>
                    @endif

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="nombre">Nombre</label>
                            {{ Form::text('nombre', null, array('id' => 'nombre','class' => 'form-control','placeholder' => trans('nombre'))) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <div class="input-group date">

                                {{ Form::text('fecha_nacimiento',isset($valor->fecha_nacimiento) ? $valor->fecha_nacimiento : null,  array('id' => 'fecha_nacimiento','class' => 'form-control','placeholder' => 'dd-mm-aaaa')) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                                      
                        </div>
                    </div>

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="dni">DNI</label>
                            {{ Form::text('dni', null, array('id' => 'dni','class' => 'form-control','placeholder' => 'DNI')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="telefono">Telefono</label>
                            {{ Form::text('telefono', null, array('id' => 'telefono','class' => 'form-control','placeholder' => '0341353222')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>


                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_obra_social">Obra Social</label>
                            {{ Form::select('id_obra_social', $obras_sociales, null,   array('id' => 'id_obra_social', 'class' =>'form-control select2' )) }}

                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="numero_afiliado">Número de Afiliado</label>
                            {{ Form::text('numero_afiliado', null, array('id' => 'numero_afiliado','class' => 'form-control','placeholder' => 'Numero de Afiliado')) }}
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
                            <label for="id_localidad">Localidad</label>
                            {{ Form::select('id_localidad', $localidades, null,  array('id' => 'id_localidad','class' => 'form-control select2')) }}
                        </div>
                    </div>

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="direccion">Direccion</label>
                            {{ Form::text('direccion', null, array('id' => 'direccion','class' => 'form-control','placeholder' => 'Direccion')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                    </div>
                   
                    <hr style="background-color:blue ; height: 2px"> </hr>
                    <h3>Nuevas Sesiones</h3>
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="cantidad_recetada">Cantidad Recetadas</label>
                            {{ Form::text('cantidad_recetada[]', null, array('id' => 'cantidad_recetada','class' => 'form-control')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="cantidad_turnos_reales">Cantidad Reales</label>
                            {{ Form::text('cantidad_turnos_reales[]', null, array('id' => 'cantidad_turnos_reales','class' => 'form-control')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="cantidad_turnos_realizados">Cantidad Realizadas</label>
                            {{ Form::text('cantidad_turnos_realizados[]', null, array('id' => 'cantidad_turnos_realizados','class' => 'form-control')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_profesional">Profesional</label>
                            {{ Form::select('id_profesional[]', $profesionales, null,  array('id' => 'id_profesional','class' => 'form-control select2')) }}
                        </div>
                    </div>
                        

                    @if(isset($paciente->Sesiones))
                    @if(count($paciente->Sesiones) > 0)
                    <hr style="background-color:blue ; height: 2px">
                    </hr>
                    <h3>Historial de Sesiones</h3>
                    @endif
                    @foreach($paciente->Sesiones as $sesion)

                    <div class="row col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="cantidad_recetada">Cantidad Recetadas</label>
                            {{ Form::text('cantidad_recetada[]', $sesion->cantidad_recetada, array('id' => 'cantidad_recetada','class' => 'form-control', 'disabled')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="cantidad_turnos_reales">Cantidad Reales</label>
                            {{ Form::text('cantidad_turnos_reales[]', $sesion->cantidad_turnos_reales, array('id' => 'cantidad_turnos_reales','class' => 'form-control', 'disabled')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="cantidad_turnos_realizados">Cantidad Realizadas</label>
                            {{ Form::text('cantidad_turnos_realizados[]', $sesion->cantidad_turnos_realizados, array('id' => 'cantidad_turnos_realizados','class' => 'form-control', 'disabled')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_profesional">Profesional</label>
                            {{ Form::select('id_profesional[]', $profesionales, $sesion->id_profesional,  array('id' => 'id_profesional','class' => 'form-control select2' , 'disabled')) }}
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <div class="input-group date">
                                {{ Form::text('fecha_inicio',isset($sesion->fecha_inicio) ? $sesion->fecha_inicio : null,  array('id' => 'fecha_inicio','class' => 'form-control','placeholder' => 'dd-mm-aaaa',  'disabled')) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="fecha_fin">Fecha de Fin</label>
                            <div class="input-group date">
                                {{ Form::text('fecha_fin',isset($sesion->fecha_fin) ? $sesion->fecha_fin : null,  array('id' => 'fecha_fin','class' => 'form-control','placeholder' => 'dd-mm-aaaa',  'disabled')) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                    <hr style="background-color:LightBlue ; height: 1px">
                    </hr>
                    @endforeach


                    @endif

                    <hr style="background-color:blue ; height: 2px"> </hr>
                    <div class="info-card bg-secondary col-md-12" style="padding: 1em">
                    <label for="Archivo_Adjunto">Archivos Adjuntos</label>
                            <input type="file" class="form-control" title="Arrastre el Archivo o Haga click para seleccionar" id="Archivo_Adjunto[]" name="Archivo_Adjunto[]" multiple="">
                           
                            </div>
                            <hr style="background-color:blue ; height: 2px"> </hr>
<div class="box-footer col-md-6 form-group pull-right ">
    <a type="button" class="btn btn-outline-danger" href="{{route('admin.pacientes.index')}}">{{ trans('message.close') }}</a>
    <button type="submit" class="btn btn-outline-primary">{{ trans('message.save') }}</button>
</div>
<hr style="background-color:blue ; height: 2px"> </hr>
<div class="info-card bg-secondary col-md-12" style="padding: 1em">
<label for="Archivo_Adjunto">Archivos Adjuntos</label>
                            @foreach($eva as $archivo)
                    <div class="info-card bg-secondary col-lg-12 col-md-6 col-xs-6">
                        <div class="card-header">
                            
                             
                            <a href="{{route('admin.pacientes.delete_file',['id'=>$paciente->id, 'file_name'=>$archivo['nombre']])}}"
                                class="btn btn-xs btn-danger float-right" title="Eliminar" role="button">
                                <i class="fa fa-trash"></i></a>
                               
                           
                        </div>
                        <div class="card-body">
                            @if($archivo['extension'] !== 'jpg' && $archivo['extension'] !== 'jpeg'
                            && $archivo['extension'] !== 'gif' && $archivo['extension'] !== 'png'
                            && $archivo['extension'] !== 'tiff' && $archivo['extension'] !== 'tif'
                            && $archivo['extension'] !== 'raw' && $archivo['extension'] !== 'bmp'
                            && $archivo['extension'] !== 'psd' )

                            @if($archivo['extension'] !== 'xls' && $archivo['extension'] !== 'doc'
                            && $archivo['extension'] !== 'xlsx' && $archivo['extension'] !== 'docx')

                            <embed name="plugin" src="{{url('storage/pacientes/'.$paciente->id.'/archivos/'.$archivo['nombre'])}}"
                                type="application/pdf" style="width: 100%; height: 500px ">
                            @else
                            <img src="{{url('storage/pacientes/'.$paciente->id.'/archivos/'.$archivo['nombre'])}}" style="width: 100% ; height: auto " class="center-block">
                            @endif
                            @else
                            <img src="{{url('storage/pacientes/'.$paciente->id.'/archivos/'.$archivo['nombre'])}}" style="width: 100% ; height: auto " class="center-block">

                            @endif
                        </div>

                        <a type="button"
                            href="{{url('storage/pacientes/'.$paciente->id.'/archivos/'.$archivo['nombre'])}}"
                            target="_blank" class="btn-secondary" title="{{$archivo['nombre']}}">
                            <p><span>{{$archivo['nombre']}}</span>
                            </p>
                        </a>
                    </div>
                    @endforeach
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
    <script src="{{ asset('admin1/pacientes/edit.js') }}"></script>
    @stop