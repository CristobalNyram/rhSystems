<!-- scripts inciio -->

<script>
  function fnCargarDatogrupofamiliardetallesVivenONoVivenFormatoTruper(id=0)
  {             
         let div_contenedor=$('#datogrupofamiliardetalles_viven_formato_truper_listado');

      
                url="<?php echo $this->url->get('datogrupofamiliardetalles/viven_tabla_truper/') ?>";
                url+=id;
                $.post(url, $(this).serialize() , function(data)
                  {      
                                     
                          div_contenedor.empty();
                             div_contenedor.html(data);

                           $('#datogrupofamiliardetalle_viven_formato_truper_table').DataTable(
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

{% include "/datogrupofamiliardetalles/formato-ese-truper/formato-vivencon/agregar-modal-js.volt" %}
{% include "/datogrupofamiliardetalles/formato-ese-truper/formato-vivencon/editar-modal-js.volt" %}

{% include "/datogrupofamiliardetalles/script-ajax-select-estatuscontacto.volt" %}
{% include "/datogrupofamiliardetalles/formato-ese-truper/script-ajax-selects-dinamicos.volt" %}
