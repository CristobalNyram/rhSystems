<!-- scripts inciio -->

<script>
    function fnCargarTablaCatVacantes(emp_id=0,reload_titulo=1)
    {             

      
                  url="<?php echo $this->url->get('catvacante/tabla_catvacante_empresa/') ?>";
                  url+=emp_id;
                  $.post(url, $(this).serialize() , function(data)
                    {        
                       
                                $('#catvacante_empresa_listado').empty();
                                $('#catvacante_empresa_listado').html(data);
  
                                $('#catvacante_empresa_table').DataTable(
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
                      if(reload_titulo=='1'){
                        obtenerDatosEmpresa(emp_id,'catvacante-empresa-modal-mensaje');
                        $('#emp_id-catvacante-empresa-modal-mensaje').val(emp_id);
                      }

                        
                      }).fail(function() {
                      })
                              
                  
             
  
  
    
    }
  

    
    
    </script>


<div class="modal fade" id="catvacante-empresa-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel"> -->
            <div class="modal-header">
              <h5 id="catvacante-empresa-modal-mensaje"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <input type="hidden" id="emp_id-catvacante-empresa-modal-mensaje">
              <div class="row ml-2">
                <div class="" onclick="fnNuevoCatVacantesModal($('#emp_id-catvacante-empresa-modal-mensaje').val())">
                    {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'),"data-toggle":"modal","data-target":"#asignar-catvacante-modal","title":"Agregar") }}
                </div>
                <span class="ml-3 h6  text-success">Agregar vacantes</span>
  
              </div>
  
              
  
            
            <div class="modal-body">
              <!-- <br /> -->
              <!-- <h2><div id="cliente_recibo"></div></h2> -->
              <!-- <h2><div id="descripcion_recibo"></div></h2> -->
              
              <div id="catvacante_empresa_listado">
              </div>
            </div>
          <!-- </div> -->
        <!-- </div> -->
      </div>
    </div>
  </div>

{% include "/empresa/acciones/catvacantes/asignar-catvacante-modal-js.volt" %}
{% include "/empresa/acciones/catvacantes/editar-catvacante-modal-js.volt" %}

{% include "/empresa/acciones/catvacantes/borrar-catvacante-js.volt" %}
{% include "/empresa/acciones/catvacantes/ajax-get-detalle-empresa-js.volt" %}
