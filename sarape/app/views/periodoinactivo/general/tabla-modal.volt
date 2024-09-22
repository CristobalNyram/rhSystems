<!-- scripts inciio -->

<script>
               
      function fnCargarTablaDatoPeriodoInactivo(id=0,config={}){
        if (!config.hasOwnProperty('id_div_contenedor')) {
              config.id_div_contenedor = "dato_periodoinactivo_listado";
        }
        if (!config.hasOwnProperty('tabla_cargando')) {
              config.tabla_cargando = "dato_periodoinactivo_mensaje";
        }
        $(`#${config.id_div_contenedor}`).empty();

                  url="<?php echo $this->url->get('periodoinactivo/tabla/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {        
                                $(`#${config.id_div_contenedor}`).html(data); 
                                pintartabla("#dato_periodoinactivo_table",0,config);
                              
                    }).done(function() { 
                          $("#"+config.tabla_cargando).hide();
                    }).fail(function() {
                    })
    }
  
   
    
    </script>


{% include "/periodoinactivo/general/agregar-modal-js.volt" %}
{% include "/periodoinactivo/general/editar-modal-js.volt" %}
{% include "/periodoinactivo/eliminar-js.volt" %}