<!-- scripts inciio -->


<script>
    function fnCargarTablaDatoEmpleosOcultos_formato_gabencognv(id=0)
    {             
        
                 url="<?php echo $this->url->get('empleooculto/tabla_gabencognv/') ?>";
                  url+=id;
           
            
                    $.post(url, $(this).serialize() , function(data)
                    {
                        
                        $('#dato_empleo_oculto_general_listado_gabencognv').empty();
                        $('#dato_empleo_oculto_general_listado_gabencognv').html(data);
  
                            $('#dato_empleo_oculto_general_table_gabencognv').DataTable(
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


{% include "/empleooculto/formato-ese-gabencognv/editar-modal-js.volt" %}
{% include "/empleooculto/formato-ese-gabencognv/agregar-modal-js.volt" %}
{% include "/empleooculto/eliminar-js.volt" %}