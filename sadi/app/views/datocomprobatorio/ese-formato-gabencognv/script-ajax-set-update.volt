<!-- funcion para guardar los datos -->

<script type="text/javascript">
    $(document).ready(()=>{
      
          $('#form_estudio_seccionDatosPersonales_formato_gabencognv').submit((event)=>{
            event.preventDefault();
        

            let formulario=$("#form_estudio_seccionDatosPersonales_formato_gabencognv");
            let $form = $(this);
            let url_enviar="<?php echo $this->url->get('datocomprobatorio/ajax_set_update_formato_gabencognv/') ?>";
            
            var selectEstado = $('#est_id_nombre_formato_gabencognv');
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
                             
                            if(res[0]==2)
                             {
                            
                              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                          .then((value) => {
                                           /// fnestudioespecifico_formato_gabencognv(res['ese_id']);

                                           $('#link_seccion_ref_laborales_gabencognv').trigger('click');
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