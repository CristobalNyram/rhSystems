<!-- funcion para guardar los datos -->

<script type="text/javascript">
    $(document).ready(()=>{
      
          $('#form_estudio_seccionDatosPersonales_formato_gabtubos').submit((event)=>{
            event.preventDefault();
          
            var selectEstado = $('#est_id_nombre_formato_gabtubos');

            if (selectEstado == null || selectEstado == undefined || selectEstado.val() == null || selectEstado.val() == undefined || selectEstado.val() == "" || selectEstado.val() < 0 || selectEstado.val()=="-1") {
              Swal.fire({title:"AVISO",text:"Debes seleccionar el ESTADO",type:"warning"})
                                                                 .then((value) => {
                                                                 
                                                                     });
              return false;
            }


            let formulario=$("#form_estudio_seccionDatosPersonales_formato_gabtubos");
            let $form = $(this);
            let url_enviar="<?php echo $this->url->get('datocomprobatorio/ajax_set_update/') ?>";
    
                  $.ajax({
                          type: "POST",
                          url: url_enviar,
                          data: formulario.serialize(),
                          success: function(res)
                          {   
                            if(res[0]==2)
                             {
                              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                          .then((value) => {

                                            fnestudioespecifico_formato_gabtubos(res['ese_id']);

                                             $('#link_seccion_datos_escolares_gabtubos').trigger('click');
                                          });
                        
                             }
                           else
                           {
                            Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                                                 .then((value) => {
                                                                    location.reload();  
                                                                     });
                           }

                         
                          },
                          error: function(res)
                          { 
                          
                          }
                });
            
          });
        
    
    });
    </script>