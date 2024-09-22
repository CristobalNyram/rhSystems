{% include "/consulta/script-index-js_vac.volt" %}

<style>
   .grupo-filtro__titulo {
    padding: 0.35rem .8rem;
    font-weight: bold;
   cursor: grab;

    }
    .grupo-filtro__line {
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
    margin: 2px .8rem;
    }
     #draggable {
      width: 150px;
      height: 150px;
      padding: 0.5em;
      background-color: #4286f4;
      color: white;
      text-align: center;
      cursor: move;
    }
</style>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script type="text/javascript">
  $(document).ready(function() {
    $('#form_editar_vac_general input, #form_editar_vac_general textarea').prop('readonly', true);
    // Deshabilitar los elementos Select2
    $('#form_editar_vac_general select').prop('disabled', true);
    // Refrescar Select2 para que los cambios surtan efecto
    $('#form_editar_vac_general select').select2();
    $('#form_editar_vac_general button').hide();
    $('#form_editar_vac_general a').hide();

  });
	function principal(){
        document.getElementById("listadoprincipal").innerHTML="";
        urlreloadprincipal="<?php echo $this->url->get('consulta/tabla_vac/') ?>";
         $.post(urlreloadprincipal, $('#indexprincipal').serialize() , function(data)
        {
            $('#listadoprincipal').html(data);
            let nombrearchivo= document.getElementById("nombrearchivo").value;
              var table=$('#datatable-buttons').DataTable({
                "pageLength": 100,
                "order": [0, 'desc'],
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
        			
              buttons: [
                {
                    extend: 'excelHtml5',
                    title: nombrearchivo
                }, 
                {
                  extend: 'pdfHtml5',
                  orientation: 'landscape',
                  pageSize: 'LEGAL',
                
                },
                'colvis'
              ]
              
    		    });
            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

            document.getElementById('busqueda').style.display = 'none';
            document.getElementById('busqueda-filtros').style.display = 'none';
             
        }).done(function() { 
          
        }).fail(function() {
          $('#otrabusqueda').show('slow');

        })
    }

    function fnmostrarbusqueda(){
    
      $('#busqueda').show('slow');
      $('#busqueda-filtros').show('slow');

      document.getElementById('otrabusqueda').style.display = 'none';
    }
</script>


<div class="row">
  <div class="col-6" id="">
          <h4 class="header-title header-title-crm" style="color:#16345E ;">Consulta vacante<i class="mdi mdi-shield-search" style="color:#16345E ;"></i> </h4>
  </div>
  <div class="col-6">
    <div class="text-right">
    </div>
  </div>
</div>
<div class="mt-3" id="container-busqueda-main">

    <div id="container-busqueda" class="container-d-flex-and-block" >
      {% if acceso.verificar(18,rol_id)==1 %}

         			{# constainer filtros inicio #}
              {% include "/consulta/complementosvac/opciones_filtos_vac.volt" %}
         			{# constainer filtros fin #}

	            {# constainer formulario#}
              {% include "/consulta/complementosvac/form_base_vac.volt" %}
         			{# constainer formular #}
        {% endif %}
      </div>
    </div>


    <div id="listadoprincipal" class="busqueda-item" >
       
    </div>
    
        <!-- end content -->

    <!-- END content-page -->

</div>

{# includes inicio  js#}
{% include "/consulta/complementosvac/includes_vac.volt" %}

{#  include fin js #}
        <!-- END wrapper -->
       



