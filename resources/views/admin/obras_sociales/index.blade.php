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
                <td>{{$obra_social->telefono}}
                    <a href="https://api.whatsapp.com/send?phone=549{{$obra_social->telefono}}" title="Enviar Mensaje"   >
                        <img src="{{asset('img/whatsapp.png') }}" style=" width:20px;	height:20px;  "	 />
                    </a>
                </td>
                <td>{{$obra_social->direccion}}</td>
                <td>
                    <div class="row">
                        <div class="col-md-4 form-group">
                        <form method="post" action="{{ route('admin.obras_sociales.destroy', $obra_social->id) }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger"
                                                    title="Eliminar Obra Social">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                        </div>
                        <div class="col-md-4 form-group">
                             <form method="get" action="{{route('admin.obras_sociales.edit',$obra_social->id)}}">
                             <button type="submit" class="btn btn-outline-primary" title="Editar Obra Social">
                                    <i class="fa fa-edit"></i>
                             </button>
                            </form>
                        </div>
                        <div class="col-md-4 form-group">
                        <button type="button" class="btn btn-outline-warning"
                                    title="Ver datos Obra Social"
                                        onMouseOver="this.style.color='#FFF'" onMouseOut="this.style.color= '#fa7101'"
                                        data-toggle="modal" data-target="#VerModal"
                                        data-whatever="{{ $obra_social }}">
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
@include('admin.obras_sociales.partials.ver')
</div>
@stop

@section('css')
   @stop

@section('js')
 
<script src="{{ asset('admin1/obras_sociales/index.js') }}"></script>
   

@stop