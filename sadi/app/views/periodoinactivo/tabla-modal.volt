<!-- scripts inciio -->

<script>
    function fnCargarTablaDatoPeriodoInactivo(id=0,ese_id_cargar=0)
    {             

         
                  url="<?php echo $this->url->get('periodoinactivo/tabla/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {        
                       
                                $('#dato_periodoinactivo_listado').empty();
                                $('#dato_periodoinactivo_listado').html(data);
  
                                $('#dato_periodoinactivo_table').DataTable(
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
  
    function fnRe_CargarTablaDatoPeriodoInactivo(id=0)
    {             
             
             
                url="<?php echo $this->url->get('periodoinactivo/tabla/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {                               

                                $('#dato_periodoinactivo_listado').empty();
                                $('#dato_periodoinactivo_listado').html(data);
  
                                $('#dato_periodoinactivo_table').DataTable(
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


{% include "/periodoinactivo/agregar-modal-js.volt" %}
{% include "/periodoinactivo/editar-modal-js.volt" %}
{% include "/periodoinactivo/eliminar-js.volt" %}