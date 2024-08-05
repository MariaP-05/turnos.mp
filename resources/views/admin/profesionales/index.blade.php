@extends('adminlte::page')

@section('title', 'Lista de Profesionales')

@section('content_header')
    <h1>Profesionales</h1>
@stop

@section('content')
<div class="card">

<div class="cadr-body">
        <div class="form-group col-sm-6">
            <form method="get" action="{{route('admin.profesionales.create')}}">
                @method('add')
                @csrf
                <button type="submit" class="btn btn-success">{{ trans('message.add') }}</button>
            </form>
        </div>
    <table id="profesionales" class="table table-striped col-sm-12">
        <thead class="bg-primary text-white">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>CUIT</th>       
                <th>Matricula</th> 
                <th>Profesión</th> 
                <th>Teléfono</th> 
                <th>{{trans('message.email')}}</th>                               
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profesionales as $profesional)
            <tr>
                <td>{{$profesional->id}}</td>
                <td>{{$profesional->nombre}}</td>
                <td>{{$profesional->CUIT}}</td>
                <td>{{$profesional->matricula}}</td>
                <td>{{$profesional->telefono}}</td>
                <td>{{$profesional->mail}}</td>
                <td>{{isset($profesional->profesion) ? $profesional->profesion->denominacion : ""}}</td>

                
                
                <form method="post" action="{{route('admin.profesionales.destroy',$profesional->id)}}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <form method="get" action="{{route('admin.profesionales.edit',$profesional->id)}}">

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
            $('#profesionales').DataTable({
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