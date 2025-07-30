@extends('adminlte::page')

@section('title', 'Lista de Contactos')

@section('content_header')
<h1>Contactos del Paciente: {{$paciente->nombre}}</h1>
@stop

@section('content')
<div class="card">
    <a href="{{ route('admin.contactos.create_2',$id_paciente) }}" title="Crear Nuevo Contacto"
        style="position:fixed;	width:60px;	height:60px; top:57px;	right:40px;
    background-color:#FFF;	color:#25d366;	border-radius:50px;	text-align:center;
    font-size:30px;	box-shadow: 2px 2px 3px #999; z-index:100;"
         onMouseOver="this.style.color='#FFF'; this.style.background = '#25d366'"
        onMouseOut="this.style.color='#25d366'; this.style.background = '#fff'">
        <i class="fa fa-plus" style="margin-top:16px"></i>
    </a>

    <div class="card-body">
        <div class="form-group col-sm-12">
            <div class="row">
                <br>
            </div>

            <table id="contactos" class="table table-striped col-sm-12">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>Id</th>
                        <th>Nombre y Apellido</th>
                        <th>Relación</th>
                        <th>DNI</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Telefono</th> 
                        <th>Telefono Auxiliar</th> 
                        <th>Mail</th> 
                        <th>Dirección</th>
                        <th>Localidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($contactos as $contacto)
                <tr>
                    <td>{{ $contacto->id }}</td>
                    <td>{{ $contacto->nombre }}</td>
                    <td>{{ $contacto->relacion }}</td>
                    <td>{{ $contacto->dni }}</td>
                    <td>{{ $contacto->fecha_nacimiento }}</td>
                    <td>{{ $contacto->telefono }}
                    <a href="https://api.whatsapp.com/send?phone=549{{$contacto->telefono}}" title="Enviar Mensaje"   >
                        <img src="{{asset('img/whatsapp.png') }}" style=" width:20px;	height:20px;  "	/>
                    </a>
                    </td>
                    <td>{{ $contacto->telefono_aux }}
                    <a href="https://api.whatsapp.com/send?phone=549{{$contacto->telefono_aux}}" title="Enviar Mensaje"  >
                        <img src="{{asset('img/whatsapp.png') }}" style=" width:20px;	height:20px;  "  />
                    </a>
                    </td>
                    <td>{{$contacto->mail}}</td>
                    <td>{{$contacto->direccion}}</td>
                    <td>{{isset($contacto->Localidad) ? $contacto->Localidad->denominacion : ""}}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-4 form-group">
                        <form method="post" action="{{route('admin.contactos.destroy',$contacto->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" title="Eliminar Contacto">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                    <div class="col-md-4 form-group">
                                    <form method="get" action="{{route('admin.contactos.edit',$contacto->id)}}">
        
                                        <button type="submit" class="btn btn-outline-primary" title="Editar Contacto">
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
  @stop

@section('js')
   
<script src="{{ asset('admin1/contactos/index.js') }}"></script>
   

@stop