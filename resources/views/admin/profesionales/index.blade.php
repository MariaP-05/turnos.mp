@extends('adminlte::page')

@section('title', 'Lista de Profesionales')

@section('content_header')
    <h1>Profesionales</h1>
@stop

@section('content')
    <div class="card">
        <a href="{{ route('admin.profesionales.create') }}" title="Crear Nuevo Profesional"
            style="position:fixed;	width:60px;	height:60px; top:57px;	right:40px;
    background-color:#FFF;	color:#25d366;	border-radius:50px;	text-align:center;
    font-size:30px;	box-shadow: 2px 2px 3px #999; z-index:100;"
             onMouseOver="this.style.color='#FFF'; this.style.background = '#25d366'"
            onMouseOut="this.style.color='#25d366'; this.style.background = '#fff'">
            <i class="fa fa-plus" style="margin-top:16px"></i>
        </a>

        <div class="cadr-body">
            <div class="form-group col-sm-12">
                <div class="row">
                    <br>
                </div>

                <table id="profesionales" class="table table-striped col-sm-12">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>CUIT</th>
                            <th>Especialidad</th>
                            <th>Matricula</th>
                            <th>Teléfono</th>
                            <th>Horario Laboral Inicio</th>
                            <th>Horario Laboral Fin</th>
                            <th>Minutos Habilitados</th>
                            <th>{{ trans('message.email') }}</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profesionales as $profesional)
                            <tr>
                                <td>{{ $profesional->id }}</td>
                                <td>{{ $profesional->nombre }}</td>
                                <td>{{ $profesional->cuit }}</td>
                                <td>{{ isset($profesional->Especialidad) ? $profesional->Especialidad->denominacion : '' }}
                                </td>
                                <td>{{ $profesional->matricula }}</td>
                                <td>{{ $profesional->telefono }}
                                <a href="https://api.whatsapp.com/send?phone=549{{$profesional->telefono}}" title="Enviar Mensaje"  >
                        <img src="{{asset('img/whatsapp.png') }}" style=" width:20px;	height:20px;  "	 />
                    </a>
                                </td>
                                <td>{{ $profesional->hora_inicio }}</td>
                                <td>{{ $profesional->hora_fin }}</td>
                                <td>{{ $profesional->minutos_hab }}</td>
                                <td>{{ $profesional->mail }}</td>

                                <td>
                                    <div class="row">
                                    <div class="col-md-6 form-group">
                                    <form method="post"
                                        action="{{ route('admin.profesionales.destroy', $profesional->id) }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger"
                                            title="Eliminar Profesional">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                        
                                        <div class="col-md-6 form-group">
                                            <form method="get"
                                                action="{{ route('admin.profesionales.edit', $profesional->id) }}">
                                                <button type="submit" class="btn btn-outline-primary"
                                                    title="Editar Profesional">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
       
    </div>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ asset('admin1/profesionales/index.js') }}"></script>
@stop
