<!-- scripts inciio -->

<script>
  function fnCargarDatogrupofamiliardetallesTrabajanCompaniaFormatoTruper(id=0)
  {             
         let div_contenedor=$('#datogrupofamiliardetalles_trabajancompania_formato_truper_listado');
         let tabla_html=$('#datogrupofamiliardetalle_trabajancompania_formato_truper_table');

      
                url="<?php echo $this->url->get('datogrupofamiliardetalles/trabajancompania_tabla_truper/') ?>";
                url+=id;
                $.post(url, $(this).serialize() , function(data)
                  {      
                                     
                          div_contenedor.empty();
                             div_contenedor.html(data);

                             $('#datogrupofamiliardetalle_trabajancompania_formato_truper_table').DataTable(
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
                  });
                
           


  
  }

</script>

{% include "/datogrupofamiliardetalles/formato-ese-truper/formato-trabajancompania/agregar-modal-js.volt" %}
{% include "/datogrupofamiliardetalles/formato-ese-truper/formato-trabajancompania/editar-modal-js.volt" %}
