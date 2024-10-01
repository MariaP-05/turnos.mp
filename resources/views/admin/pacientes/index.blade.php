@extends('adminlte::page')

@section('title', 'Lista de Pacientes')

@section('content_header')
    <h1>Pacientes</h1>
@stop

@section('content')
    <div class="card">
        <a href="{{ route('admin.pacientes.create') }}" title="Crear Nuevo Paciente"
            style="position:fixed;	width:60px;	height:60px; top:57px;	right:40px;
    background-color:#FFF;	color:#25d366;	border-radius:50px;	text-align:center;
    font-size:30px;	box-shadow: 2px 2px 3px #999; z-index:100;"
            target="_blank" onMouseOver="this.style.color='#FFF'; this.style.background = '#25d366'"
            onMouseOut="this.style.color='#25d366'; this.style.background = '#fff'">
            <i class="fa fa-plus" style="margin-top:16px"></i>
        </a>
        <div class="card-body">
            <div class="form-group col-sm-12">
                <div class="row">
                    <br>
                </div>
                <table id="pacientes" class="table table-striped col-sm-12">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Id</th>
                            <th>Nombre y Apellido</th>
                            <th>DNI</th>
                            <th>Obra Social</th>
                            <th>Número de Afiliado</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pacientes as $paciente)
                            <tr>
                                <td>{{ $paciente->id }}</td>
                                <td>{{ $paciente->nombre }}</td>
                                <td>{{ $paciente->dni }}</td>
                                <td>{{ isset($paciente->Obra_social) ? $paciente->Obra_social->denominacion : '' }}</td>
                                <td>{{ $paciente->numero_afiliado }}</td>
                                <td>{{ $paciente->telefono }}</td>

                                <td>
                                    <div class="row">
                                    <div class="col-md-4 form-group">
                                    <a  href="{{ route('admin.pacientes.archivos', $paciente->id) }}"
                                  
                                  class="btn btn-success" title="Archivos" role="button" target="_blank">
                                 <i class="fa fa-folder"><?php echo \App\Models\Paciente::countFiles($paciente->id); ?> </i> 
                             </a>
                                    </div>
                                        <div class="col-md-4 form-group">
                                            <form method="post"
                                                action="{{ route('admin.pacientes.destroy', $paciente->id) }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger"
                                                    title="Eliminar Paciente">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <form method="get"
                                                action="{{ route('admin.pacientes.edit', $paciente->id) }}">

                                                <button type="submit" class="btn btn-outline-primary"
                                                    title="Editar Paciente">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <form method="get"
                                                action="{{ route('admin.turnos.createTurnoPaciente', $paciente->id) }}">

                                                <button type="submit" class="btn btn-outline-success"
                                                    title="Crear Turno Paciente">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            @php
                                                $paciente->deno_obra =  isset($paciente->Obra_social) ? $paciente->Obra_social->denominacion : '' ;
                                                $paciente->deno_localidad = isset($paciente->Localidad) ? $paciente->Localidad->denominacion : '' ;
                                            @endphp
                                            <button type="button" class="btn btn-outline-warning"
                                                onMouseOver="this.style.color='#FFF'" onMouseOut="this.style.color= '#fa7101'"
                                                data-toggle="modal" data-target="#VerModal"
                                                data-whatever="{{ $paciente }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        @include('admin.pacientes.partials.ver')
    </div>

@stop


@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="{{ asset('admin1/pacientes/index.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    

@stop

 
