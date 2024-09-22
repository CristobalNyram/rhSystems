<!-- scripts inciio -->


<script>
    function fnCargarTablaDatoReferenciaLaboral(id=0, config ={})
    {     
      
      if (!config.hasOwnProperty('id_div_contenedor')) {
              config.id_div_contenedor = "dato_referencialaboral_listado";
      }
          
      if (!config.hasOwnProperty('tabla_cargando')) {
      config.tabla_cargando = "dato_referencialaboral_listado_mensaje";
      }
      $(`#${config.id_div_contenedor}`).empty();      

          url="<?php echo $this->url->get('referencialaboral/tabla/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {                                     
                               $(`#${config.id_div_contenedor}`).html(data);
                                pintartabla("#dato_referencialaboral_table",1,config);//esta funcion se encuentra en layouts/funciones-generales
                               
                    }).done(function() { 
                                    $("#"+config.tabla_cargando).hide();

                    }).fail(function() {
                    })
                    
                
    }    
    </script>


{% include "/referencialaboral/general/agregar-modal-js.volt" %}
{% include "/referencialaboral/general/editar-modal-js.volt" %}
{% include "/referencialaboral/eliminar-general-js.volt" %}
{% include "/referencialaboral/general/orden-arriba-abajo-js.volt" %}
