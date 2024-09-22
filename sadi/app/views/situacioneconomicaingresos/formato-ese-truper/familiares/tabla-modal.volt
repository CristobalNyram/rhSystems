<!-- scripts inciio -->

<script>
    function fnCargarTablaDatoSituacioneEconomicaIngresosFamiliares_FormatoTruper(id=0)
    {             

        
                  url="<?php echo $this->url->get('situacioneconomicaingresos/tabla_truper_ingresosfamiliares/') ?>";
                  url+=id;
                  $.post(url, $(this).serialize() , function(data)
                    {        
                                
                                $('#dato_situacioneconomicaingresos_familiar_truper_listado').empty();
                                $('#dato_situacioneconomicaingresos_familiar_truper_listado').html(data);
  
                                $('#dato_situacioneconomicaingresos_familiar_truper_table').DataTable(
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


{% include "/situacioneconomicaingresos/formato-ese-truper/familiares/agregar-modal-js.volt" %}
{% include "/situacioneconomicaingresos/formato-ese-truper/familiares/editar-modal-js.volt" %}
{% include "/situacioneconomicaingresos/formato-ese-truper/familiares/eliminar-js.volt" %}
