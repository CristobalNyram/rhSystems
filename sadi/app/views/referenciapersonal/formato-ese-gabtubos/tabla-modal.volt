<!-- scripts inciio -->

<script>
    function fnCargarTablaDatoReferenciaPersonal_formato_gabtubos(id=0,ese_id_cargar=0)
    {             

         
                  url="<?php echo $this->url->get('referenciapersonal/tablagabtubos/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {        
                       
                                $('#dato_referenciapersonal_listado_formato_gabtubos').empty();
                                $('#dato_referenciapersonal_listado_formato_gabtubos').html(data);
  
                                $('#dato_referenciapersonal_table_formato_gabtubos').DataTable(
                                  {
                                                "pageLength": 100,
                                  
                                       
                                                order:[0,'asc'],
                              
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
  
    function fnRe_CargarTablaDatoReferenciaPersonal_formato_gabtubos(id=0)
    {             
             
             
                url="<?php echo $this->url->get('referenciapersonal/tabla/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {                               

                                $('#dato_referenciapersonal_listado').empty();
                                $('#dato_referenciapersonal_listado').html(data);
  
                                $('#dato_referenciapersonal_table').DataTable(
                                  {    "pageLength": 10,
                                                order:[0,'asc'],
                                
                                order:[0,'asc'],
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


{% include "/referenciapersonal/formato-ese-gabtubos/agregar-modal-js.volt" %}
{% include "/referenciapersonal/formato-ese-gabtubos/editar-modal-js.volt" %}
{% include "/referenciapersonal/formato-ese-gabtubos/eliminar-js.volt" %}