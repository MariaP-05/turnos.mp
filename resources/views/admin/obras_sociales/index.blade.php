@extends('adminlte::page')

@section('title', 'Lista de Obras Sociales')

@section('content_header')
    <h1>Obras Sociales</h1>
@stop

@section('content')
<div class="card">
    <a  href="{{route('admin.obras_sociales.create')}}"
  title="Crear Nueva Obra Social" 
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
    <table id="obras_sociales" class="table table-striped col-sm-12">
        <thead class="bg-secondary text-white">
            <tr>
                <th>Id</th>
                <th>Denominación</th>
                <th>Denominación Amigable</th>
                <th>CUIT</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($obras_sociales as $obra_social)
            <tr>
                <td>{{$obra_social->id}}</td>
                <td>{{$obra_social->denominacion}}</td>
                <td>{{$obra_social->denominacion_amigable}}</td>
                <td>{{$obra_social->cuit}}</td>
                <td>{{$obra_social->telefono}}</td>
                <td>{{$obra_social->direccion}}</td>
                <td>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <form method="post" action="{{route('admin.obras_sociales.destroy',$obra_social->id)}}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger" title="Eliminar Obra Social">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6 form-group">
                             <form method="get" action="{{route('admin.obras_sociales.edit',$obra_social->id)}}">
                             <button type="submit" class="btn btn-outline-primary" title="Editar Obra Social">
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
    
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"> </script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"> </script>
    <script > 
        $(document).ready(function () {
            $('#obras_sociales').DataTable({
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
               autowith:false ,
               order: [[ 0, 'desc' ]]
             }
             
             );

    
        });
</script>

   

@stop