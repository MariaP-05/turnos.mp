 
<div class="cadr-body">
    <br>
    <div class="form-group col-sm-12" place-items= "center">
        <h4 class="box-title">Búsqueda</h4>
    </div>
    <hr>
    <div class="box-body">
        {{ Form::open(['route' => 'admin.turnos.cronograma', 'method' => 'GET', 'role' => 'form']) }}
        <div class="form-group col-sm-12">
            <div class="row ">

                <div class="form-group col-sm-6">
                    <label for="fec_desde">
                        Fecha Desde
                    </label>
                    <div class="input-group date">
                        {{ Form::text('fec_desde', $fecha_desde->format('d-m-Y'), ['id' => 'fec_desde', 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group col-sm-6">
                    <label for="fec_hasta">
                        Fecha Hasta
                    </label>
                    <div class="input-group date">

                        {{ Form::text('fec_hasta', $fecha_hasta->format('d-m-Y'), ['id' => 'fec_hasta', 'class' => 'form-control']) }}
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

                
                <div class="col-md-6 form-group">
                    <label for="id_institucion">Institución</label>
                        {{ Form::select('id_institucion', $instituciones, $id_institucion,  ['id' => 'id_institucion','class' => 'form-control select2']) }}
                          
                    </div> 

                    <div class="col-md-6 form-group has-feedback">
                            <label for="duracion_completa">Duración Completa del Turno</label>
                            {{ Form::select('duracion_completa',[ 'No' => 'No', 'Si' => 'Si'], null, array('id' => 'duracion_completa','class' => 'form-control') )}}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>      
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

</div>

