<script>

function consultar_tabla_reporte_respuestas(){
                    let url_respuestas="<?php echo $this->url->get('encuestacalidad/respuestas_tabla/') ?>";
                    $('#listado-encuestas').show();
                      $.post(url_respuestas, $('#form_encuestas_respuestas').serialize() , function(data)
                      {

                          
                          $('#listado-encuestas').html(data);
                            var table=$('#datatable-buttons').DataTable({
                              "pageLength": 100,
                              "order": [0, 'desc'],
                              scrollY:        "300px",
                              scrollX:        true,
                              scrollCollapse: true,
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
                                "oAria": {
                                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                },
                                "buttons": {
                                    "copy": "Copiar",
                                    "colvis": "Personalizar",
                                    "excel":"Excel",
                                    "pdf":"PDF",
                                    "print":"PDF"

                                }
                            },
                            
                            buttons: [
                              {
                                  extend: 'excelHtml5',
                                  // title: nombrearchivo
                              }, 
                              {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                              
                              },
                              {
                                text: "Reporte pastel",
                                action: function ( e, dt, node, config ) {
                                  fnConsultarReporteRespuestasEstadisticasPDF($('#enc_fecha-reporte'),0,$('#inv_id-reporte'));
                                  }
                              },
                              {
                                text: "Reporte barras",
                                action: function ( e, dt, node, config ) {
                                  fnConsultarReporteRespuestasEstadisticasPDF($('#enc_fecha-reporte'),1,$('#inv_id-reporte'));
                                  }
                              },
                              {
                                text: "Reporte sin detalle",
                                action: function ( e, dt, node, config ) {
                                  fnImprimirReporteConHtml($('#enc_fecha-reporte'));
                                  }
                              }
                              ,
                              'colvis'
                              
                            ]
                            
                          });
                          table.buttons().container()
                              .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

                         // document.getElementById('busqueda').style.display = 'none';
                         $('.busqueda').hide('slow');
                         $('#otrabusqueda').show('slow');

                        //document.getElementById('otrabusqueda').style.display = 'block';
                          // document.getElementById('listadoultimaspolizas').style.display = 'none';

                      }).done(function() { 

                      }).fail(function() {
                    });

      
}

</script>