{% set veintiynueve= acceso.verificar(29,rol_id) %}

<script>
    

  function fnCargarTablaCitas(vac_id=0)
    {             

      
                  url="<?php echo $this->url->get('cita/vac_exc_cit_tabla/') ?>";
                  url+=vac_id;
                  $.post(url, $(this).serialize() , function(data)
                    {        
                       
                                $('#vac_cit_tabla_listado').empty();
                                $('#vac_cit_tabla_listado').html(data);

                                pintartabla("#td_vac_cit_tabla");

                            
                              
                    }).done(function() { 

                      let inputBoton=` 
                                                <span class="ml-3 h6  text-success" >Agregar citas</span>
                                  
                                                <div class="row ml-2">

                                                    <div class="">
                                                        <a href="#" data-toggle="modal" data-target="#crear_cit_general-modal" title="Agregar cita" onclick="fnCrearCita(${vac_id})">
                                                          {{ image("assets/images/small/boton.svg", "alt": "Agregar ", "height": "50", 'class':'boton-plus') }}   
                                                          </a>   
                                                    </div>
                                      
                                                  </div>
                                                `;

              {% if veintiynueve==1 %}
                                      $('#btnAgregarCita').html(inputBoton);

              {% endif %}

                          fnGetDetalleVac(vac_id)
                          .then(function(res) {
                              let data=res.data;
                              let mensaje=`Citas  de la vacante ${data.cav_nombre} folio ${data.vac_id} - empresa: ${data.emp_nombre} `+generateBadgeVacEstatusHTML(data.vac_estatus);
                              $('#vac_cit_tabla-titulo').html(mensaje);
                          })
                          .catch(function(error) {
                              alert(error);
                          });
                    }).fail(function() {
                    })
                    
                  
             
  
  
    
    }
  

</script>
 <div class="modal fade" id="vac_cit_tabla-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel"> -->
            <div class="modal-header">
              <h5> <div id="vac_cit_tabla-titulo"></div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="row ml-2">
                <div id="btnAgregarCita">
                </div>
  
              </div>
  
              

            <div class="modal-body">
             
              <input type="hidden" name="vac_id" id="vac_id-cita">

              <div id="vac_cit_tabla_listado">
              </div>
            </div>
        
      </div>
    </div>
  </div>


 