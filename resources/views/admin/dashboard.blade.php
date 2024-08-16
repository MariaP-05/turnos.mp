@extends('adminlte::page')
@section('title', 'Pagina Principal')

@section('css')

@stop

@section('content_header')
    <h1>Atención de Turnos</h1>
    
@stop

@section('content')
    <p>Sistema de Gestión de Turnos</p>

    <div class="row">

        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><a target="_blank" class="info-box-icon btn-success">
                    <i class="fa fa-calendar"></i></a>
                </span>
                <div class="info-box-content">
                    <span class="info-box-number">Turnos Programados</span>
                    <span class="myDIV info-box-text">{{$cantidad_programados}}</span>
                    <span class="info-box-text">{{$fecha_mes}}</span>

                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><a target="_blank" class="info-box-icon btn-danger">
                    <i class="fa fa-calendar"></i></a>
                </span>
                <div class="info-box-content">
                    <span class="info-box-number">Turnos Cancelados</span>
                    <span class="myDIV info-box-text">{{$cantidad_cancelados}}</span>
                    <span class="info-box-text">{{$fecha_mes}}</span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><a target="_blank" class="info-box-icon btn-primary">
                    <i class="fa fa-calendar"></i></a>
                </span>
                <div class="info-box-content">
                    <span class="info-box-number">Turnos Realizados</span>
                    <span class="myDIV info-box-text">{{$cantidad_realizados}}</span>
                    <span class="info-box-text">Desde el {{$fecha_mes->format('d-m')}}</span>
                </div>
                
            </div>
        </div>
        
    </div>
@stop

@section('css')
@stop


@section('js')


@stop