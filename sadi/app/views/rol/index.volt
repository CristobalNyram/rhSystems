<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('rol/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            var table=$('#td_rol').DataTable({
                "pageLength": 50,
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
                      "colvis": "Visibilidad",
                      "excel":"Excel",
                      "pdf":"PDF",
                      "print":"PDF"

                  }
                },

                buttons: ['excel', 
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
                .appendTo('#td_aseguradora_wrapper .col-md-6:eq(0)');
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fnelim(pue)
    {
        var urleliminarpue="<?php echo $this->url->get('rol/eliminar/') ?>";
        var urlindexpue="<?php echo $this->url->get('rol/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el rol con clave "+pue+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarpue+pue,
            success: function(res)
            {
              if(res[0]=='1')
              {
                window.location=urlindexpue;
              }
              else
              {
                alertify.alert("Error","Ocurrio un error al eliminar el registro");
              }
            }
          });
        }, function()
        { 
        }).set('labels', {ok:'Eliminar', cancel:'Cancelar'}); 
    }  
</script>
<div class="row">
  <div class="col-6">
    <h4 class="header-title header-title-crm">Roles</h4>
  </div>
  <div class="col-6">
    <div class="text-right">
        {{ link_to('rol/nuevo', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'60')) }}
      <!-- <a href="#"><img src="dist/assets/images/small/boton.svg" class="boton-plus" height="60"></a> -->
    </div>
  </div>
</div>
<div class="mt-3">
    <div class="card card-crm">
        <div id="listado">
        </div>
    </div>
</div>