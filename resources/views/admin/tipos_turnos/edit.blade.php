@extends('adminlte::page')

@section('title', 'Nuevo Tipo de Turno')


@section('content_header')
<h1>Tipos de Turno</h1>
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

                    @if(isset($tipos_turno))
                    {{ Form::model($tipos_turno,['route'=>['admin.tipos_turnos.update', $tipos_turno->id],'method' => 'PUT', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @else
                    {{ Form::open(['route' => 'admin.tipos_turnos.store','method'=>'POST', 'role'=>'form', 'data-toggle'=>'validator']) }}
                    @endif

                    @if(isset($tipos_turno->id))
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
                            <label for="color">Color</label>
                            <div class="input-group">
                                <input id="color" name="color" type="color" value=
                                {{ isset($tipos_turno->color) ? $tipos_turno->color : "#ff0000" }} />
                            </div>
                        </div>
                    </div>        

                <div class="box-footer col-md-6 form-group pull-right ">
                   <a type="button" class="btn btn-outline-danger" href="{{route('admin.tipos_turnos.index')}}">{{ trans('message.close') }}</a>
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

@stop