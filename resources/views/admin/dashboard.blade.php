@extends('adminlte::page')
@section('title', 'Pagina Principal')

@section('css')

@stop

@section('content_header')
<h1>Atención de Turnos</h1>

@stop

@section('content')
    <p>Sistema de Gestión de Turnos</p>
    
        <a href="{{ route('admin.turnos.create') }}" title="Crear Nuevo Turno"
            style="position:fixed;	width:60px;	height:60px; top:60px;	right:40px;
        background-color:#FFF;	color:#25d366;	border-radius:50px;	text-align:center;
        font-size:30px;	box-shadow: 2px 2px 3px #999; z-index:100;"
            target="_blank" onMouseOver="this.style.color='#FFF'; this.style.background = '#25d366'"
            onMouseOut="this.style.color='#25d366'; this.style.background = '#fff'">
            <i class="fa fa-plus" style="margin-top:16px"></i>
        </a>

        <a href="{{ route('admin.pacientes.create') }}" title="Crear Nuevo Paciente"
            style="position:fixed;	width:60px;	height:60px; top:130px;	right:40px;
    background-color:#FFF;	color:#25d366;	border-radius:50px;	text-align:center;
    font-size:30px;	box-shadow: 2px 2px 3px #999; z-index:100;"
            target="_blank" onMouseOver="this.style.color='#FFF'; this.style.background = '#25d366'"
            onMouseOut="this.style.color='#25d366'; this.style.background = '#fff'">
            <i class="fa fa-account-setting-03" style="margin-top:16px"></i>
        </a>


    <div class="row">
        <div class="col-lg-3 col-md-6 col-xs-12">
            <marquee direction="up" behavior="alternate" loop="6">
                <div class="info-box bg-green ">
                    <span class="info-box-icon"><a target="_blank" class="info-box-icon btn-success">
                            <i class="fa fa-calendar-plus"></i></a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-number">Turnos Programados</span>
                        <span class="myDIV info-box-text">{{ $cantidad_programados }}</span>
                        <span class="info-box-text">{{ $fecha_mes }}</span>
                    </div>
                </div>
            </marquee>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <marquee direction="up" behavior="alternate" loop="6">
                <div class="info-box bg-red ">
                    <span class="info-box-icon"><a target="_blank" class="info-box-icon btn-danger">
                            <i class="fa fa-calendar-minus"></i></a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-number">Turnos Cancelados</span>
                        <span class="myDIV info-box-text">{{ $cantidad_cancelados }}</span>
                        <span class="info-box-text">{{ $fecha_mes }}</span>
                    </div>
                </div>
            </marquee>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <marquee direction="up" behavior="alternate" loop="6">
                <div class="info-box bg-primary">
                    <span class="info-box-icon"><a target="_blank" class="info-box-icon btn-primary">
                            <i class="fa fa-calendar-check"></i></a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-number">Turnos Realizados</span>
                        <span class="myDIV info-box-text">{{ $cantidad_realizados }}</span>
                        <span class="info-box-text">Desde el {{ $fecha_mes->format('d-m') }}</span>
                    </div>
                </div>
            </marquee>
        </div>

    </div>

@stop

@section('css')
@stop


@section('js')


@stop
