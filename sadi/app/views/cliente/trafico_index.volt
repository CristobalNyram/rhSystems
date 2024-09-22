<!-- permisos -->
<script type="text/javascript">
  

  $(document).ready(function() {
    divListado = document.getElementById('listado');
    url="<?php echo $this->url->get('cliente/trafico_tabla/') ?>";
    $.post(url, $(this).serialize() , function(data)
    {
      divListado.innerHTML=data;
      var table=$('#td_empresa').DataTable({
        "pageLength": 100,
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        columnDefs: [
          { "visible": false, "targets": 0 }
        ],
        order:[4,'asc'],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sSearch":         "Buscar:",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Personalizar",
                "excel":"Excel",
                "pdf":"PDF",
                "print":"PDF"

            }
        },
        
        buttons: [{
            extend: 'excelHtml5',
            exportOptions: {
                columns: ':visible'
            },
            title: 'Tráfico investigador'
          }, 
          {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'LEGAL',
            exportOptions: {
                columns: ":visible"
            }
          },
          'colvis'
        ]
      });
      table.buttons().container()
            .appendTo('#td_empresa_wrapper .col-md-6:eq(0)');
    }).done(function() { 
    }).fail(function() {
    })
  });
</script>
  
  <div class="row">
    <div class="col-sm-6">
      <h4 class="header-title header-title-crm ">Tráfico investigador
      </h4>
    </div>
    <div class="col-sm-5">
    
    </div>
    <div class="col-sm-1">
    <div class="text-left">
     
    </div>
      </div>
  </div>
  
  
  <div class="mt-3">
      <div class="card card-crm">
          <div id="listado">
          </div>
      </div>
  </div> 
<!-- helper js inicio  -->
{% include "/calificacionfinalgrupo/script-ajax-get-todos-by-grupo.volt" %}
<!-- helper js inicio  -->

{% include "/comentarioese/modales-js.volt" %}
{% include "/archivo/modal-js.volt" %}
{% include "/empresa/ajax-get-alias.volt" %}

{% include "/estudio/verdetalles.volt" %}
{% include "/estudio/cancelar.volt" %}

{% include "/estudio/regresar_estatus-modal-js.volt" %}
{% include "/estudio/trafico_modal-js.volt" %}
{% include "/estudio/editarverificacion.volt" %}
{% include "/estudio/vercompletoese-modal.volt" %}
{% include "/estudio/editarestudiosocioeconomico.volt" %}
{% include "/estudio/editarsupervivencia.volt" %}
{% include "/estudio/asignaranalista-trafico-investigador-modal-js.volt" %}
{% include "/estudio/asignaranalista-obtener-detalles-modal-js.volt" %}


<!-- diferentes formatos de ese -->
{% include "/formatoese/formato-gabtubos.volt" %}
{% include "/formatoese/formato-gabencognv.volt" %}
{% include "/formatoese/formato-truper.volt" %}
