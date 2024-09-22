<script>

function consultar_tabla_reporte_respuestas(){
                    let url_respuestas="<?php echo $this->url->get('encuestacalidadreporte/respuestas_vdos_tabla/') ?>";
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
                                  fnConsultarReporteRespuestasEstadisticasPDF($('#form_encuestas_respuestas'),0);
                                  }
                              },
                              {
                                text: "Reporte barras",
                                action: function ( e, dt, node, config ) {
                                  fnConsultarReporteRespuestasEstadisticasPDF($('#form_encuestas_respuestas'),1);
                                  }
                              },
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
function fnConsultarReporteRespuestasEstadisticasPDF(form_id="", tipo_reporte=0) {
    let url_data = "<?php echo $this->url->get('encuestacalidadreporte/respuesta_estadisticas_servicio_calidad_pdf/') ?>";
    let data = form_id.serialize();
    data += '&tipo_reporte=' + tipo_reporte;
    let target = "target='_blank'";
    let form = $('<form action="' + url_data + '" method="post" ' + target + '></form>');
    form.append('<input type="hidden" name="data" value="' + data + '">');
    $('body').append(form);
    form.submit();
}

</script>