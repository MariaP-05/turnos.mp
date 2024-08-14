@extends('adminlte::page')

@section('title', 'Nueva Turno')


@section('content_header')
<h1>Turnos</h1>
<link href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet"/>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js" ></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet"/>
<link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

                    @if(isset($turno))
                    {{ Form::model($turno,['route'=>['admin.turnos.update', $turno->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @else
                    {{ Form::open(['route' => 'admin.turnos.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @endif

                    @if(isset($turno->id))
                    <div class="row  col-md-12">
                    <div class="form-group col-md-6">
                        <label for="id">{{ trans('message.code') }}</label>
                        {{ Form::text('id', null, array('id' => 'id','class' => 'form-control','placeholder'=>"id", 'readonly')) }}
                    </div>
                    </div>
                    @endif
                   
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_paciente">Paciente</label>
                            {{ Form::select('id_paciente', $pacientes, null,  array('id' => 'id_paciente','class' => 'form-control select2')) }}
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="id_institucion">Institución</label>
                                {{ Form::select('id_institucion', $instituciones, null,  array('id' => 'id_institucion','class' => 'form-control select2')) }}
                                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        
                    </div>                   

                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                        <label for="id_profesional">Profesional</label>
                            {{ Form::select('id_profesional', $profesionales, null,  array('id' => 'id_profesional','class' => 'form-control select2')) }}
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        
                        <div class="col-md-6 form-group has-feedback">
                            <label for="fecha">Fecha</label>
                            <div class="input-group date">
                                
                                {{ Form::text('fecha',isset($valor->fecha) ? $valor->fecha : null,  array('id' => 'fecha','class' => 'form-control','placeholder' => 'dd-mm-aaaa')) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row  col-md-12">
                            <div class="col-md-6 form-group has-feedback">
                                <label for="hora_inicio">Horario inicio</label>
                                {{ Form::time('hora_inicio', null, array('id' => 'hora_inicio','class' => 'form-control')) }}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 form-group has-feedback">
                            <label for="hora_fin">Horario fin</label>
                            {{ Form::time('hora_fin', null, array('id' => 'hora_fin','class' => 'form-control')) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div> 
                    
                    <div class="row  col-md-12">
                        <div class="col-md-6 form-group has-feedback">
                            <label for="descripcion">Descripción</label>
                            {{ Form::text('descripcion', null, array('id' => 'descripcion','class' => 'form-control','placeholder' => trans('Descripción'))) }}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div> 
                    
                    <div class="box-footer col-md-6 form-group pull-right ">
                        <a type="button" class="btn btn-outline-danger" href="{{route('admin.turnos.index')}}">{{ trans('message.close') }}</a>
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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script type="text/javascript"> 
    $(document).ready(function() {
       
        $('.select2').select2();  
    
        $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: '<Ant',
      nextText: 'Sig>',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      weekHeader: 'Sm',
      dateFormat: 'dd/mm/yy',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: ''
    };
    
    $.datepicker.setDefaults($.datepicker.regional['es']);
     
      $("#fecha").datepicker(
        {
           todayBtn: "linked",
           language: 'es',
           autoclose: true,
           todayHighlight: true,
           dateFormat: 'dd-mm-yy' 
       }
      );
      
         
    });
    </script>

@stop