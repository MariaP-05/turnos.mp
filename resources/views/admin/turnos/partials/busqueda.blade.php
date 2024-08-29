<link href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
    rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet" />
<link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"  />

<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}">
<div class="cadr-body">
    <br>
    <div class="form-group col-sm-12" place-items= "center">
        <h4 class="box-title">Búsqueda</h4>
    </div>
    <hr>
    <div class="box-body">
        {{ Form::open(['route' => 'admin.turnos.index', 'method' => 'GET', 'role' => 'form']) }}
        <div class="form-group col-sm-12">
            <div class="row ">

                <div class="form-group col-sm-6">
                    <label for="fec_desde">
                        Fecha Desde
                    </label>
                    <div class="input-group date">
                        {{ Form::text('fec_desde', $fecha_desde, ['id' => 'fec_desde', 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group col-sm-6">
                    <label for="fec_hasta">
                        Fecha Hasta
                    </label>
                    <div class="input-group date">

                        {{ Form::text('fec_hasta', $fecha_hasta, ['id' => 'fec_hasta', 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label for="id_estado_turnos">Estado</label>
                    {{ Form::select('id_estado_turnos', $estado_turnos, $id_estado_turnos, ['id' => 'id_estado_turnos', 'class' => 'form-control select2']) }}
                </div>


                <div class="col-md-6 form-group">
                    <label for="id_profesional">Profesional</label>
                    {{ Form::select('id_profesional', $profesionales, $id_profesional, ['id' => 'id_profesional', 'class' => 'form-control select2']) }}
                </div>


            </div>
        </div>
    </div>
    <div class="box-footer form-group">
        <div class="form-group pull-rigth col-sm-6" place-items= "center">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </div>
    {{ Form::close() }}
</div>
{{ Form::open(['method' => 'GET', 'role' => 'form']) }}

{{ Form::hidden('fec_desde') }}
{{ Form::hidden('fec_hasta') }}
{{ Form::hidden('id_estado_turnos') }}
</div>
<br>
