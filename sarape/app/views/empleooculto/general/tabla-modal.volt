<!-- scripts inciio -->
<script>
    function fnCargarTablaDatoEmpleosOcultos(id=0,config={})
    {   
        if (!config.hasOwnProperty('id_div_contenedor')) 
        {
              config.id_div_contenedor = "dato_empleo_oculto_general_listado";
        }
        if (!config.hasOwnProperty('tabla_cargando')) {
              config.tabla_cargando = "dato_empleo_oculto_general_mensaje";
        }
        $(`#${config.id_div_contenedor}`).empty();

                 url="<?php echo $this->url->get('empleooculto/tabla/') ?>";
                 url+=id;
                    $.post(url, $(this).serialize() , function(data)
                    {
                        $(`#${config.id_div_contenedor}`).html(data);    
                        pintartabla("#dato_empleo_oculto_general_table",0,config);  
                              
                    }).done(function() { 
                      $("#"+config.tabla_cargando).hide();
                    }).fail(function() {
                    })
             
    }
    </script>
{% include "/empleooculto/general/editar-modal-js.volt" %}
{% include "/empleooculto/general/agregar-modal-js.volt" %}
{% include "/empleooculto/eliminar-js.volt" %}