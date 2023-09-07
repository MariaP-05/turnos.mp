@extends('adminlte::page')

@section('title', 'Lista de Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
<div class="card">

<div class="cadr-body">
        <div class="form-group col-sm-6">
            <form method="get" action="{{route('admin.clientes.create')}}">
                @method('add')
                @csrf
                <button type="submit" class="btn btn-success">{{ trans('message.add') }}</button>
            </form>
        </div>
    <table id="clientes" class="table table-striped col-sm-12">
        <thead class="bg-primary text-white">
            <tr>
                <th>Id</th>
                <th>Denominacion</th>
                <th>CUIT / CUIL</th>
                <th>CBU</th>
                <th>Telefono</th>
                <th>{{trans('message.email')}}</th>
                <th>Servicios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente->id}}</td>
                <td>{{$cliente->denominacion}}</td>
                <td>{{$cliente->cuit}}</td>
                <td>{{$cliente->cbu}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>{{$cliente->mail}}</td>
                <td>@foreach($cliente->ClienteServicios as $servicios)
                {{$servicios->Servicio->nombre}}</br>
                @endforeach
                   
                </td>
                <td>
                <form method="post" action="{{route('admin.clientes.destroy',$cliente->id)}}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <form method="get" action="{{route('admin.clientes.edit',$cliente->id)}}">

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
   
<link   rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
></link>

<link   rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"
></link>
<link   rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css"
></link>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"> </script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"> </script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"> </script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"> </script>

<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"> </script>
    <script > 
        $(document).ready(function () {
            $('#clientes').DataTable({
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
                  
    

                },
               
                responsive: true,
    autowith:false
   
             }
             
             );
 
        });
</script>


   

@stop