@extends('adminlte::page')

@section('title', 'Lista de Tipos de Turnos')

@section('content_header')
    <h1>Tipos de Turnos</h1>
@stop

@section('content')
    <div class="card">
        <a href="{{ route('admin.tipos_turno.create') }}" title="Crear Nuevo Tipo de Turno"
            style="position:fixed;	width:60px;	height:60px; top:57px;	right:40px;
    background-color:#FFF;	color:#25d366;	border-radius:50px;	text-align:center;
    font-size:30px;	box-shadow: 2px 2px 3px #999; z-index:100;"
            target="_blank" onMouseOver="this.style.color='#FFF'; this.style.background = '#25d366'"
            onMouseOut="this.style.color='#25d366'; this.style.background = '#fff'">
            <i class="fa fa-plus" style="margin-top:16px"></i>
        </a>
        <div class="cadr-body">
            <div class="form-group col-sm-12">
                <div class="row">
                    <br>
                </div>
                <table id="tipos_turno" class="table table-striped col-sm-12">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Id</th>
                            <th>Denominación</th>
                            <th>Color</th>
                            <th>Alerta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipos_turno as $tipos_turno)
                            <tr>
                                <td>{{ $tipos_turno->id }}</td>
                                <td>{{ $tipos_turno->denominacion }}</td>
                                <td><input id="color" name="color" type="color"
                                        value={{ isset($tipos_turno->color) ? $tipos_turno->color : '#ff0000' }}
                                        @disabled(true) /></td>
                                <td>{{$tipos_turno->alerta}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-2 form-group">
                                            <form method="post"
                                                action="{{ route('admin.tipos_turno.destroy', $tipos_turno->id) }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger"
                                                    title="Eliminar Tipo de Turno">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <form method="get"
                                                action="{{ route('admin.tipos_turno.edit', $tipos_turno->id) }}">
                                                <button type="submit" class="btn btn-outline-primary"
                                                    title="Editar Tipo de Turno">
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
    @stop

    @section('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    @stop

    @section('js')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#tipos_turno').DataTable({
                        "language": {
                            "search": "Buscar",
                            "lengthMenu": "Mostrar _MENU_ registros por pagina",
                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "paginate": {
                                "first": "Primero",
                                "last": "Último",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            },
                            "zeroRecords": "No se encontraron resultados",
                            "emptyTable": "Ningún dato disponible en esta tabla",
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "infoPostFix": "",
                            "url": "",
                            "infoThousands": ",",
                            "loadingRecords": "Cargando...",
                            "aria": {
                                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sortDescending": ": Activar para ordenar la columna de manera descendente"
                            }




                        },

                        responsive: true,
                        autowith: false,
                        order: [
                            [0, 'desc']
                        ]
                    }

                );
            });
        </script>

    @stop
