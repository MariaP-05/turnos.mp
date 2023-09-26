@extends('adminlte::page')

@section('title', 'Lista de Servicios de los Clientes')

@section('content_header')
    <h1>Servicios de los Clientes</h1>
@stop

@section('content')
<div class="card">

<div class="cadr-body">
        <div class="form-group col-sm-6">
            <form method="get" action="{{route('admin.cliente_servicios.create')}}">
                @method('add')
                @csrf
                <button type="submit" class="btn btn-success">{{ trans('message.add') }}</button>
            </form>
        </div>
    <table id="cliente_servicios" class="table table-striped col-sm-12">
        <thead class="bg-primary text-white">
            <tr>
                <th>Id</th>
                <th>Cliente</th>
                <th>Servicio</th>       
                <th>Fecha Desde</th>                      
                <th>Fecha Hasta</th>          
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cliente_servicios as $servicio)
            <tr>
                <td>{{$servicio->id}}</td>
                <td>{{$servicio->Cliente->denominacion}}</td>
                <td>{{$servicio->Servicio->nombre}}</td>
                <td>{{$servicio->fecha_desde}}</td>
                <td>{{$servicio->fecha_hasta}}</td>
                
                <td>
                <form method="post" action="{{route('admin.cliente_servicios.destroy',$servicio->id)}}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <form method="get" action="{{route('admin.cliente_servicios.edit',$servicio->id)}}">

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
            $('#cliente_servicios').DataTable({
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
                  
    

                }, order: [[ 0, 'desc' ]]
    } 
             
             );

    
        });
</script>

   

@stop