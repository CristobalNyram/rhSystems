<!-- scripts inciio -->

<script>
    function fnCargarTablaDatoAntecedentesgrupofamiliardetalles(id=0,ese_id_cargar=0)
    {             

         
        
                  url="<?php echo $this->url->get('antecedentegrupofamiliar/tabla_agf/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {                               

                                $('#datoantecedentesgrupofamiliardetalleslistado').empty();
                                $('#datoantecedentesgrupofamiliardetalleslistado').html(data);
  
                                $('#dato_antecedentesgrupofamiliardetalles_table').DataTable(
                                  {
                                    "pageLength": 100,
                                      // scrollCollapse: true,
                                    
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
  
    function fnRe_cargarTablaDatoAntecedentesgrupofamiliardetalles(id=0)
    {             
             
             
                url="<?php echo $this->url->get('antecedentegrupofamiliar/tabla_agf/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {                               

                                $('#datoantecedentesgrupofamiliardetalleslistado').empty();
                                $('#datoantecedentesgrupofamiliardetalleslistado').html(data);
  
                                $('#dato_antecedentesgrupofamiliardetalles_table').DataTable(
                                  {    "pageLength": 100,
                                
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
  
  

{% include "/antecedentegrupofamiliar/agregar-modal-js.volt" %}
{% include "/antecedentegrupofamiliar/editar-modal-js.volt" %}
{% include "/antecedentegrupofamiliar/eliminar-js.volt" %}

