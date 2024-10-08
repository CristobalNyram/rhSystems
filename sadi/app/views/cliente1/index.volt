<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('cliente/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            var table=$('#td_cliente').DataTable({
                "pageLength": 100,
                scrollY:        "300px",
                scrollX:        true,
                scrollCollapse: true,
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
            });
            table.buttons().container()
                .appendTo('#td_cliente_wrapper .col-md-6:eq(0)');
        }).done(function() { 
        }).fail(function() {
        })
    });
</script>

<div class="row">
  <div class="col-sm-6">
    <h4 class="header-title header-title-crm">Mis estudios</h4>
  </div>
</div>


<div class="mt-3">
    <div class="card card-crm">
        <div id="listado">
        </div>
    </div>
</div>