
{# constainer filtros inicio #}
{% include "/consulta/script-index-js_exc.volt" %}
{% include "/consulta/complementos/script_style_exc.volt" %}
{# constainer filtros fin #}

<script type="text/javascript">

	function principal(){
        document.getElementById("listadoprincipal").innerHTML="";
        urlreloadprincipal="<?php echo $this->url->get('consulta/tabla/') ?>";
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
          <h4 class="header-title header-title-crm" style="color:#16345E ;">Consulta expedientes <i class="mdi mdi-shield-search" style="color:#16345E ;"></i> </h4>
  </div>
  <div class="col-6">
    <div class="text-right">
      <!-- <a href="#"><img src="dist/assets/images/small/boton.svg" class="boton-plus" height="60"></a> -->
    </div>
  </div>
</div>
<div class="mt-3" id="container-busqueda-main">

    <div id="container-busqueda" class="container-d-flex-and-block" >
      {% if acceso.verificar(37,rol_id)==1 %}

         			{# constainer filtros inicio #}
              {% include "/consulta/complementos/opciones_filtos_exc.volt" %}
         			{# constainer filtros fin #}

	            {# constainer formulario#}
              {% include "/consulta/complementos/form_base_exc.volt" %}
         			{# constainer formular #}
      {% endif %}

      </div>
    </div>


    <div id="listadoprincipal" class="busqueda-item" >
       
    </div>
    
        <!-- end content -->

    <!-- END content-page -->

</div>

{% include "/consulta/complementos/includes_exc.volt" %}

<!-- END wrapper -->
       



