@extends('adminlte::page')

@section('title', 'Lista de Polizas')

@section('content_header')
    <h1>Polizas</h1>
@stop

@section('content')
<div class="card">

<div class="cadr-body">
        <div class="form-group col-sm-6">
            <form method="get" action="{{route('admin.polizas.create')}}">
                @method('add')
                @csrf
                <button type="submit" class="btn btn-success">{{ trans('message.add') }}</button>
            </form>
        </div>
    <table id="polizas" class="table table-striped col-sm-12">
        <thead class="bg-primary text-white">
            <tr>
                <th>Id</th>
                <th>Compañía</th>
                <th>Cliente</th>
                <th>Sección</th>
                <th>Número de Poliza</th>
                <th>Vigencia desde</th>
                <th>Vigencia hasta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($polizas as $poliza)
            <tr>
                <td>{{$poliza->id}}</td>
                <td>{{isset($poliza->Compania) ? $poliza->Compania->denominacion : ""}}</td>
                <td>{{isset($poliza->Cliente) ? $poliza->Cliente->denominacion : ""}}</td>
                <td>{{isset($poliza->Seccion) ? $poliza->Seccion->denominacion : ""}}</td>
                <td>{{$poliza->numero_poliza}}</td>
                <td>{{$poliza->vigencia_desde}}</td>
                <td>{{$poliza->vigencia_hasta}}</td>
                <td>
                <form method="post" action="{{route('admin.polizas.destroy',$poliza->id)}}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <form method="get" action="{{route('admin.polizas.edit',$poliza->id)}}">

                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </form>
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
    <script > 
        $(document).ready(function () {
            $('#polizas').DataTable({
                "language": {
                    "search":   "Buscar",
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
                  
    

                }
                , order: [[ 0, 'desc' ]]
             }
             
             );

    
        });
</script>

   

@stop