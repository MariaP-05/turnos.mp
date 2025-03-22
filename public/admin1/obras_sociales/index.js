$('#EliminarModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('¿Desea eliminar a ' + recipient.denominacion + '?' )  
      });
  
  
$('#VerModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Vizualizando Obra Social ' + recipient.nombre)
    modal.find('.denominacion').val(recipient.denominacion)
    modal.find('.denominacion_amigable').val(recipient.denominacion_amigable)
    modal.find('.cuit').val(recipient.cuit)
    modal.find('.telefono').val(recipient.telefono)
    modal.find('.direccion').val(recipient.direccion)
    modal.find('.observacion').val(recipient.observacion)
    modal.find('.fecha_presentacion_desde').val(recipient.fecha_presentacion_desde)
    modal.find('.fecha_presentacion_hasta').val(recipient.fecha_presentacion_hasta)
    modal.find('.periodo_informe').val(recipient.periodo_informe)
  }); 
  
  
$(document).ready(function() {
    $('#obras_sociales').DataTable({
            "language": {
                "search": "Buscar",
                "lengthMenu": "Obras Sociales por pagina _MENU_ ",
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