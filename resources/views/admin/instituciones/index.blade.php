@extends('adminlte::page')

@section('title', 'Lista de Instituciones')

@section('content_header')
    <h1>Instituciones</h1>
@stop

@section('content')
<div class="card">
    <a  href="{{route('admin.instituciones.create')}}"
    title="Crear Nueva Institución" 
    style="position:fixed;	width:60px;	height:60px; top:57px;	right:40px;
    background-color:#FFF;	color:#25d366;	border-radius:50px;	text-align:center;
    font-size:30px;	box-shadow: 2px 2px 3px #999; z-index:100;" 
    target="_blank"
    onMouseOver="this.style.color='#FFF'; this.style.background = '#25d366'"
    onMouseOut="this.style.color='#25d366'; this.style.background = '#fff'">
        <i class="fa fa-plus" style="margin-top:16px"></i>
    </a>
<div class="cadr-body">
    <div class="form-group col-sm-12">
        <div class="row">
            <br>
        </div>
    <table id="instituciones" class="table table-striped col-sm-12">
        <thead class="bg-secondary text-white">
            <tr>
                <th>Id</th>
                <th>Nombre</th>    
                <th>Teléfono</th>  
                <th>Dirección</th>     
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($instituciones as $institucion)
            <tr>
                <td>{{$institucion->id}}</td>
                <td>{{$institucion->nombre}}</td>
                <td>{{$institucion->telefono}}</td>
                <td>{{$institucion->direccion}}</td>             
                <td>
                    <div class="row">
                        <div class="col-md-2 form-group has-feedback">
                            <form method="post" action="{{route('admin.instituciones.destroy',$institucion->id)}}">
                                @method('delete')
                                @csrf
                                <button type="button" class="btn btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-2 form-group has-feedback">
                             <form method="get" action="{{route('admin.instituciones.edit',$institucion->id)}}">
                             <button type="button" class="btn btn-outline-primary">
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
    <script > 
        $(document).ready(function () {
            $('#instituciones').DataTable({
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