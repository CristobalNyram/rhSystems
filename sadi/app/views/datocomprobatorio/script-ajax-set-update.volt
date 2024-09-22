<!-- funcion para guardar los datos -->

<script type="text/javascript">
    $(document).ready(()=>{
      
          $('#form_estudio_seccionDatosPersonales').submit((event)=>{
            event.preventDefault();
            let formulario=$("#form_estudio_seccionDatosPersonales");
            let $form = $(this);
            var selectEstado = $('#est_id_nombre_ver_completo');

            if (selectEstado == null || selectEstado == undefined || selectEstado.val() == null || selectEstado.val() == undefined || selectEstado.val() == "" || selectEstado.val() < 0 || selectEstado.val()=="-1") {
              Swal.fire({title:"AVISO",text:"Debes seleccionar el ESTADO",type:"warning"})
                                                                .then((value) => {
                                                                    });
              return false;
            }
            
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
                                            fnestudioespecifico(res['ese_id']);
                                            $('#profile-tab-md-2').trigger('click');
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