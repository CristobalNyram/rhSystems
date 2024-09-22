{% set veintiynueve= acceso.verificar(29,rol_id) %}
{% set ochentayuno= acceso.verificar(81,rol_id) %}

<script>
    

  function fnCargarTablaExcGeneral_cit(vac_id=0, config ={})
    {     

      $(`#${config.id_div_contenedor}`).html("Cargando...");

       if (!config.hasOwnProperty('id_div_contenedor')) {
              config.id_div_contenedor = "rel_vac_exc_ci_general_tabla_listado";
        }

        if (config.hasOwnProperty('mostrarCrearCita')) {
              if( config.mostrarCrearCita=="1"){
                $('#btnAgregarCita_rel_vac_exc_tabla').show();

              }else{
                $('#btnAgregarCita_rel_vac_exc_tabla').hide();

              }
        }else{
          $('#btnAgregarCita_rel_vac_exc_tabla').show();

        }
      
                  url="<?php echo $this->url->get('expedientecan/rel_vac_tabla/') ?>";
                  url+=vac_id;
                  $.post(url, $(this).serialize() , function(data)
                    {        
                                $(`#${config.id_div_contenedor}`).empty();
                                $(`#${config.id_div_contenedor}`).html("");

                                $(`#${config.id_div_contenedor}`).html(data);
                                let nombretabla="#td_rel_vac_tabla";
                                if ($.fn.DataTable.isDataTable(nombretabla)) {
                                  $(nombretabla).DataTable().destroy();
                                  $(nombretabla).empty();

                                }
                                let table = $(nombretabla).DataTable({
                                  "pageLength": 100,
                                  scrollY: "300px",
                                  scrollX: true,
                                  // responsive: true,
                                  // autoWidth: true,
                                  scrollCollapse: true,
                                  // "colResize": true,
                                  "initComplete": function( settings, json ) {
                                  
                                        var primeraColumna = this.api().column(0).header();
                                        var ultimaColumna = this.api().column(-1).header(); // -1 representa la última columna
                                        $(primeraColumna).on('dblclick', function() {
                                          $(ultimaColumna).on('dblclick', function() {
                                              
                                         });
                                                
                                        });

                                                           
                                  },
                                  columnDefs: [
                                              { width: 'auto' } 
                                          ],
                                  order :[4,"asc"],
                                  "language": {
                                      "sProcessing": "Procesando...",
                                      "sLengthMenu": "Mostrar _MENU_ registros",
                                      "sZeroRecords": "No se encontraron resultados",
                                      "sEmptyTable": "Ningún dato disponible en esta tabla",
                                      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                                      "sSearch": "Buscar:",
                                      "sInfoThousands": ",",
                                      "sLoadingRecords": "Cargando...",
                                      "oPaginate": {
                                          "sFirst": "Primero",
                                          "sLast": "Último",
                                          "sNext": "Siguiente",
                                          "sPrevious": "Anterior"
                                      },
                                      "oAria": {
                                          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                      },
                                      "buttons": {
                                          "copy": "Copiar",
                                          "colvis": "Personalizar",
                                          "excel": "Excel",
                                          "pdf": "PDF",
                                          "print": "PDF"
                                      },
                                  },
                                  buttons: ['excel', {
                                      extend: 'pdfHtml5',
                                      orientation: 'landscape',
                                      pageSize: 'LEGAL',
                                      exportOptions: {
                                          columns: ":visible"
                                      },
                                      title: 'Usuarios'
                                  }, 'colvis'],
                                   
                              });

                             table.buttons().container().appendTo(nombretabla + '_wrapper .col-md-6:eq(0)');       
                             table.on('draw.dt', function () {
                                  var primeraColumna = table.column(0).header();
                                  var primerElemento = $(primeraColumna);
                                  $(primerElemento).trigger('dblclick');
                                  $(primerElemento).trigger('change');     
                            });
                            var primeraColumna2 = table.column(0).header();
                            var primerElemento2 = $(primeraColumna2);
                            $(primerElemento2).trigger('dblclick');
                            $(primerElemento2).trigger('change');    
                            setTimeout(function() {
                                var ultimaColumna = table.column(4).header(); 
                                var ultimoElemento = $(ultimaColumna);
                                $(ultimoElemento).trigger('click');
                                $(ultimoElemento).trigger('click');
                            }, 1500); 
                                        
                    }).done(function() { 

                      let inputBoton=` 
                                                <span class="ml-3 h6  text-success" >Agregar citas</span>
                                  
                                                <div class="row ml-2">

                                                    <div class="">
                                                        <a href="#" data-toggle="modal" data-target="#crear_cit_general-modal" title="Agregar cita" onclick="fnCrearCita(${vac_id},fnCargarTablaExcGeneral_cit)">
                                                          {{ image("assets/images/small/boton.svg", "alt": "Agregar ", "height": "50", 'class':'boton-plus') }}   
                                                          </a>   
                                                    </div>
                                      
                                                  </div>
                                                `;
                      let inputBoton_ver_estadisticas=` 
                                                <span class="ml-3 h6  text-warning" >Estadísticas</span>
                                  
                                                <div class="row ml-2" style="
                                                      display: flex;
                                                      align-items: center;
                                                      justify-content: end;
                                                ">

                                                    <div class="">
                                                        <a href="#" data-toggle="modal" data-target="#estadisticas_vac_info-modal" title="Estadísticas de la vacante" onclick="fnEstadisticasVacante(${vac_id},fnCargarTablaExcGeneral_cit)">
                                                          {{ image("assets/images/small/iconos/metricas.svg", "alt": "Metricas ", "height": "50", 'class':'boton-plus img-metricas') }}   
                                                          </a>   
                                                    </div>
                                      
                                                  </div>
                                                `;

                      {% if veintiynueve==1 %}
                          $('#btnAgregarCita_rel_vac_exc_tabla').html(inputBoton);
                      {% endif %}

                      {% if ochentayuno==1 %}
                          $('#btnVerEstadisticas_rel_vac_exc_tabla').html(inputBoton_ver_estadisticas);
                      {% endif %}              
                          fnGetDetalleVac(vac_id)
                          .then(function(res) {
                              let data=res.data;
                              let mensaje=`Citas  de la vacante ${data.cav_nombre} folio ${data.vac_id} - empresa: ${data.emp_nombre} `+generateBadgeVacEstatusHTML(data.vac_estatus);
                              $('#rel_vac_exc_tabla-titulo').html(mensaje);
                          })
                          .catch(function(error) {
                              alert(error);
                          });
                    }).fail(function() {
                    })
                    
                  
             
  
  
    
    }
  

</script>
 <div class="modal fade" id="rel_vac_exc_tabla-modal" tabindex="-1"  aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-grande  modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel"> -->
            <div class="modal-header">
              <h5> <div id="rel_vac_exc_tabla-titulo"></div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="row ml-2"  
              style="
                    display: flex;
                    justify-content: space-between;
              ">
                <div id="btnAgregarCita_rel_vac_exc_tabla">
                </div>
                <div id="btnVerEstadisticas_rel_vac_exc_tabla" 
                style="
                  margin-right: 26px;
                ">
                </div>
  
              </div>
  
              

            <div class="modal-body">
             
              <input type="hidden" name="vac_id" id="vac_id-rel_vac_exc_tabla">

              <div id="rel_vac_exc_ci_general_tabla_listado" style="width:100%;">
              </div>
            </div>
        
      </div>
    </div>
  </div>

  {% include "/cita/acciones/cit-modal-editar-js.volt" %}
  {% include "/cita/acciones/cit-modal-crear-js.volt" %}
  {% include "/cita/acciones/cit-script-llenar-select-val.volt" %}
