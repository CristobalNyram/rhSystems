
<!-- scripts inciio -->

<script>
    function fnCargarTablaDatoBienInmuebleDetallesFormatoTruper(id=0)
    {             

         
                  url="<?php echo $this->url->get('bieninmuebledetalles/tabla_truper/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {        
                       
                                $('#dato_bieninmuebledetalles_truper_listado').empty();
                                $('#dato_bieninmuebledetalles_truper_listado').html(data);
  
                                $('#dato_bieninmuebledetalles_truper_table').DataTable(
                                  {
                                                "pageLength": 100,
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

{% include "/bieninmuebledetalles/formato-ese-truper/agregar-modal-js.volt" %}
{% include "/bieninmuebledetalles/formato-ese-truper/editar-modal-js.volt" %}