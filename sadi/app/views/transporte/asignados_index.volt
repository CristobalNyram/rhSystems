{% include "/transporte/archivo-js.volt" %}

<script type="text/javascript">
      $(document).ready(function() {

        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('transporte/asignados_tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            var table=$('#td_transporte').DataTable({
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
              
              buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
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
    }
    
    
    );
</script>





<div class="row">
  <div class="col-sm-6">
    <h4 class="header-title header-title-crm">{{titular}}</h4>
  </div>


</div>
<div class="mt-3">
    <div class="card card-crm">
        <div id="listado">
        </div>
    </div>
</div>


<div class="modal fade" id="archivos-transporte-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabel"> 
              <div id="mensaje_modal_archivo">          

              </div>
              w
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


            <div class="col-2">
                <div class="text-left">
                  {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#archivonuevo-modal", "title":"Agregar archivo") }} 
                </div>
              </div>
              
              <div class="modal-body">
                <!-- <br /> -->
                <!-- <h2><div id="cliente_recibo"></div></h2> -->
                <!-- <h2><div id="descripcion_recibo"></div></h2> -->
                
                <div id="archivoslistado">
                </div>
  
    
            
         </div>
                    
        
        </div>
      </div>
    </div>
  </div>
  

 

  


{% include "/transporte/comprobar-modal.volt" %}

{% include "/transporte/editar-modal-js.volt" %}
{% include "/transporte/solicitar-modal-js.volt" %}
{% include "/transporte/archivo-modales-js.volt" %}

{% include "/archivo/leer-archivo.volt" %}

