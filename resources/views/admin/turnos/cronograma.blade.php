@extends('adminlte::page')

@section('title', 'Lista de Turnos')

@section('content_header')
    <h1>Turnos</h1>
@stop

@section('content')
     
    <div class="card">
        <div class="cadr-body">
            <div class="form-group col-sm-12">
                <div class="row">

                    <br>
                </div>
                <table id="turnos" class="table table-striped col-sm-12">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Id</th>
                            <th>Paciente</th>
                            <th>Profesional</th>
                            <th>Institución</th>
                            <th>Fecha</th>
                            <th>Horario inicio</th>
                            <th>Horario fin</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($turnos as $turno)
                            <tr>
                                <td>{{ $turno->id }}</td>
                                <td>{{ isset($turno->Paciente) ? $turno->Paciente->nombre : '' }}</td>
                                <td>{{ isset($turno->Profesional) ? $turno->Profesional->nombre : '' }}</td>
                                <td>{{ isset($turno->Institucion) ? $turno->Institucion->nombre : '' }}</td>
                                <td>{{ $turno->fecha }}</td>
                                <td>{{ $turno->hora_inicio }}</td>
                                <td>{{ $turno->hora_fin }}</td>
                                <td>{{ $turno->descripcion }}</td>
                                <td>{{ isset($turno->EstadoTurno) ? $turno->EstadoTurno->denominacion : '' }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-5 form-group">
                                            <form method="post" action="{{ route('admin.turnos.destroy', $turno->id) }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger"
                                                    title="Eliminar Turno">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <form method="get" action="{{ route('admin.turnos.edit', $turno->id) }}">
                                                <button type="submit" class="btn btn-outline-primary" title="Editar Turno">
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

        
        <script>
            $(document).ready(function() {
                $('#turnos').DataTable({
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
                        order: [
                            [0, 'desc']
                        ]
                    }

                );


            });

            $(document).ready(function() {

                $('.select2').select2();

                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '<Ant',
                    nextText: 'Sig>',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov',
                        'Dic'
                    ],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd/mm/yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                };

                $.datepicker.setDefaults($.datepicker.regional['es']);

                $("#fec_desde").datepicker({
                    todayBtn: "linked",
                    language: 'es',
                    autoclose: true,
                    todayHighlight: true,
                    dateFormat: 'dd-mm-yy'
                });


                $("#fec_hasta").datepicker({
                    todayBtn: "linked",
                    language: 'es',
                    autoclose: true,
                    todayHighlight: true,
                    dateFormat: 'dd-mm-yy'
                });
            });
        </script>





    @stop