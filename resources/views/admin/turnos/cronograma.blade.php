@extends('adminlte::page')

@section('title', 'Cronograma de Turnos')

@section('content_header')
    <h1>Turnos</h1>
@stop

@section('content')
    <div class="card">
        <a href="{{ route('admin.turnos.create') }}" title="Crear Nuevo Turno"
            style="position:fixed;	width:60px;	height:60px; top:57px;	right:40px;
background-color:#FFF;	color:#25d366;	border-radius:50px;	text-align:center;
font-size:30px;	box-shadow: 2px 2px 3px #999; z-index:100;"
            target="_blank" onMouseOver="this.style.color='#FFF'; this.style.background = '#25d366'"
            onMouseOut="this.style.color='#25d366'; this.style.background = '#fff'">
            <i class="fa fa-plus" style="margin-top:16px"></i>
        </a>



        @include('admin.turnos.partials.busqueda_cronograma')
        {{ Form::hidden('fec_desde') }}
        {{ Form::hidden('fec_hasta') }}
        {{ Form::hidden('id_estado_turnos') }}
        {{ Form::hidden('id_profesional') }}
        {{ Form::hidden('id_institucion') }}

    </div>

    <div class="card">
        <div class="cadr-body">
            <div class="form-group col-sm-12">
                <div class="row">
                    <div class="form-group col-10">
                        <table id="turnos" class="table table-striped col-sm-12">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>Hora/Dia</th>
                                    @foreach ($dias as $dia)
                                        <th>{{ $dia->format('d') }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($horas as $hora)
                                    @foreach ($minutos as $minuto)
                                        <tr>
                                            <th> {{ $hora . ':' . $minuto }} </th>
                                            @foreach ($dias as $dia)
                                                <td>
                                                    @foreach ($turnos[$dia->format('d')][$hora][$minuto] as $turno)
                                                        <div class= "col-md-12 form-group">
                                                            <div class="row">

                                                                <form method="get"
                                                                    action="{{ route('admin.turnos.cambiar_estado', [$turno->id, 3]) }}">

                                                                    <button type="submit"
                                                                        class="info-box-icon btn-secondary"
                                                                        style="border-radius: 50%; width:30px;	height:30px;"
                                                                        onMouseOver="this.style.background='#0d6efd'; this.style.border='#0d6efd' "
                                                                        onMouseOut="this.style.background = '#6C757D'; this.style.border='#6C757D'"
                                                                        title="Turno Realizado">
                                                                        <i class="fa fa-calendar-check"></i>
                                                                    </button>

                                                                </form>

                                                                <form method="get"
                                                                    action="{{ route('admin.turnos.cambiar_estado', [$turno->id, 2]) }}">
                                                                    <button type="submit"
                                                                        class="info-box-icon btn-secondary"
                                                                        style="border-radius: 50%; width:30px;	height:30px; "
                                                                        onMouseOver="this.style.background='#dc3545'; this.style.border='#dc3545'"
                                                                        onMouseOut="this.style.background = '#6C757D'; this.style.border='#6C757D'"
                                                                        title="Turno Cancelado">
                                                                        <i class="fa fa-calendar-minus"></i>
                                                                    </button>
                                                                </form>

                                                                <div class= "col-md-10">
                                                                    <a href="{{ route('admin.turnos.edit', $turno->id) }}"
                                                                        title="Editar Turno" target="_blank"
                                                                        style=" color:black; border-color:
                                    {{ $turno->id_estado_turnos != 1
                                        ? $turno->EstadoTurno->color
                                        : (isset($turno->TipoTurno)
                                            ? $turno->TipoTurno->color
                                            : null) }}
                                    ; border-bottom-width:8px"
                                                                        class="btn btn-outline float-left">
                                                                        {{ isset($turno)
                                                                            ? (isset($turno->Paciente) ? 'PAC: ' . $turno->Paciente->nombre : null) .
                                                                                ' ' .
                                                                                (isset($turno->Profesional) ? 'PRO: ' . $turno->Profesional->nombre : null)
                                                                            : null }}
                                                                    </a>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group col-2">
                        <table class="table table-striped col-sm-12">
                            <br>
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>Tipos de Turnos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="list-group" style="padding: 1em">
                                    @foreach ($tipos_turno as $tipo_turno)
                                    <th class="list-group-item" style="  
                                      border-radius:50px;
                                      border-color:{{ $tipo_turno->color}};
                                      text-align:center; text-transform:uppercase; font-size:12px;
                                      border-width:8px">

                                     
                                     {{$tipo_turno->denominacion}}</th>
                                   @endforeach
                                 
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
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

 
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"> </script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"> </script>
        

 
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
                    searching: false,
                    lengthChange: false,
                    pageLength: 60,
                    order: [
                        [0, 'asc']
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
