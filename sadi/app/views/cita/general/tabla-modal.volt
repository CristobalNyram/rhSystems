<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>


<script>
    $(document).ready(function() {
    $('.timeInput').clockpicker({
      placement: 'bottom',
      align: 'left',
      donetext: 'Aceptar',
      autoclose: true
    });
  });

    function fnCargarCitasESEModal(ese_id=0){
        $('#btnAgregarCita').html('');
        $('#btnAgregarCita').show();
        url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";
        let titulo_modal=$('#msae_citas');
        $('#ese_id-cita').val(ese_id);
        $.ajax({
            type: "POST",
            url: url_enviar_ese_data+ese_id,
            success: function(res)
            {

              if(res.length>0){
                let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

                titulo_modal.html(` <i class="mdi mdi-calendar-multiple mdi-18px btn-icon" style="color: blue;"></i> Citas del estudio No. ${ese_id} ${mensaje_empresa_candidato}`);
               
                fnCargarDatosTablaCitaESE(ese_id);
                
              }
             
            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
              
            }
          });


    }
    function fnCargarDatosTablaCitaESE(ese_id=0)
    {             
  
           
        
                  url="<?php echo $this->url->get('cita/tabla_general/') ?>";
                  url+=ese_id;
                  $.post(url, $(this).serialize() , function(data)
                    {      
               
                                       
                                $('#cita_listado').empty();
                                $('#cita_listado').html(data);
  
                                $('#cita_table').DataTable(
                                {
                                  "pageLength": 100,
                                    "columnDefs": [
                                      { "targets": 3, "render": $.fn.dataTable.render.text() }  // Columna 0
                                    ],
                                  "order": [[0, 'desc']],
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
                    }).done(function(res) { 

                             let  url_envia_verificar_data="<?php echo $this->url->get('cita/ajax_get_count_registro/') ?>";

                                      $.ajax({
                                          type: "POST",
                                          url: url_envia_verificar_data+ese_id,
                                          success: function(res)
                                          {
                                            if(res.count_data<=0){
                                              let inputBoton=` 
                                                <span class="ml-3 h6  text-success" >Agregar cita</span>
                                  
                                                <div class="row ml-2">

                                                    <div class="">
                                                        <a href="#" data-toggle="modal" data-target="#agregar-cita-modal" title="Agregar cita" onclick="fnCrearCita(${ese_id})">
                                                          {{ image("assets/images/small/boton.svg", "alt": "Agregar ", "height": "50", 'class':'boton-plus') }}   
                                                          </a>   
                                                    </div>
                                      
                                                  </div>
                                                `;
                                                $('#btnAgregarCita').html(inputBoton);
                                            }else{
                                              $('#btnAgregarCita').html('');

                                            }
                                          
                                          
                                          },
                                          error: function(data)
                                          {
                                            alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+res); 
                                            
                                          }
                                        });
                  

                    
                     

                    }).fail(function() {
                    });
                  
             
  
  
    
    }
  
  
    
    </script>
  
  <div class="modal fade" id="cita-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel"> -->
            <div class="modal-header">
              <h5><div id="msae_citas"></div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="row ml-2">
                <div id="btnAgregarCita">
                </div>
  
              </div>
  
              

            <div class="modal-body">
             
              <input type="hidden" name="ese_id" id="ese_id-cita">

              <div id="cita_listado">
              </div>
            </div>
        
      </div>
    </div>
  </div>
{% include "/cita/general/re-agendar-modal-js.volt" %}
{% include "/cita/general/agendar-modal-js.volt" %}
{% include "/cita/general/agregar-comentario-modal-js.volt" %}

