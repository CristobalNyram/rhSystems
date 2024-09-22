<script>
    function fnCargarTablaDatoReferenciaLaboral_formato_gabencognv(id=0,ese_id_cargar=0)
    {             
                  url="<?php echo $this->url->get('referencialaboral/tablagabtencognv/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {    
                  
                                $('#dato_referencialaboral_listado_formato_gabencognv').empty();
                                $('#dato_referencialaboral_listado_formato_gabencognv').html(data);
                                $('#dato_referencialaboral_table_gabencognv').DataTable(
                                  {             
                                    scrollY:        "300px",
                                    scrollX:        true,
                                    scrollCollapse: true,
                                    "pageLength": 100,   
                                    order:[1,'asc'],
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
                                  
                                    },
                                
                               
                                });    
                    }).done(function() { 
                    }).fail(function() {
                    })
    }
  
    function fnRe_CargarTablaDatoReferenciaLaboral_formato_gabencognv(id=0)
    {             
                  url="<?php echo $this->url->get('referencialaboral/tablagabencognv/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {                               

                                $('#dato_referencialaboral_listado_formato_gabencognv').empty();
                                $('#dato_referencialaboral_listado_formato_gabencognv').html(data);
                                $('#dato_referencialaboral_table_formato_gabencognv').DataTable(
                                  {   
                                      "pageLength": 100,
                                      order:[1,'asc'],
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
                                    
                                      },
                                 });    
                    }).done(function() { 
                    }).fail(function() {
                    })  
    }
</script>
{% include "/referencialaboral/formato-ese-gabencognv/agregar-modal-js.volt" %}
{% include "/referencialaboral/formato-ese-gabencognv/editar-modal-js.volt" %}
{% include "/referencialaboral/formato-ese-gabencognv/eliminar-js.volt" %}
{% include "/referencialaboral/general/orden-arriba-abajo-js.volt" %}
