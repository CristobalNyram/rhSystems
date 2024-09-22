<!-- funcion para guardar los datos -->

<script type="text/javascript">
    $(document).ready(()=>{
      
          $('#form_estudio_seccionDatosPersonales_formato_ese_truper').submit((event)=>{
            event.preventDefault();
            let formulario=$("#form_estudio_seccionDatosPersonales_formato_ese_truper");
            let $form = $(this);
            let url_enviar="<?php echo $this->url->get('datospersonalesese/ajax_set_update_formato_truper/') ?>";
            // let ese_id=  $('#ese_formato_ese_truper_ese_id');
            var selectEstado = $('#formato_truper_est_id');
            if (selectEstado == null || selectEstado == undefined || selectEstado.val() == null || selectEstado.val() == undefined || selectEstado.val() == "" || selectEstado.val() < 0 || selectEstado.val()=="-1") {
              Swal.fire({title:"AVISO",text:"Debes seleccionar el ESTADO",type:"warning"})
                                                                 .then((value) => {
                                                                
                                                                   });
              return false;
             }

    
               $.ajax({
                          type: "POST",
                          url: url_enviar,
                          data: formulario.serialize(),
                          success: function(res)
                          {   

                            if(res[0]=='2'){
                              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                          .then((value) => {
                                            fnGetDatosPersonalesTrupper(res['ese_id']);
                                            $('#link_domicilio_formato_truper').trigger('click');

                                            

                                          });
                        
                             }
                            else{
                              Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                                                  .then((value) => {
                                                                      location.reload();  
                                                                      });
                            }
                           
                         
                          },
                          error: function(res)
                          { 
                            alert('Error al procesar la petición...');
                          }
                });
            
          });
        
    
    });
    </script>