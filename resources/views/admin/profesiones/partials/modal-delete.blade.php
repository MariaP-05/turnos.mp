<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{Form::open(array('id'=>'modal-form','method'=>'DELETE'))}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Eliminando Agenda</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>¿Desea eliminar <span id="modal-desc"></span>?
                        </h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row ">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('message.close') }}</button>
                            {{Form::submit('Eliminar', array('class' => 'btn btn-primary'))}}
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>