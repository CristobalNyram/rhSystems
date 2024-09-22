<script>

$(function (){
          $('#form_encuestacalidadservicio').submit(function(event){
            let ese_id=   $('#ese_id-encuestacalidadservicio').val();
            let enc_id=   $('#enc_id-encuestacalidadservicio').val();

            event.preventDefault();
            let formulario=$("#form_encuestacalidadservicio");
            let $form = $(this);
            $form.find("button").prop("disabled", true);

               //validacionde de inputs
                              if(!$('input[name="opcion_preg_1_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 1',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }


                              if(!$('input[name="opcion_preg_2_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 2',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }

                              if(!$('input[name="opcion_preg_3_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 3',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }

                              if(!$('input[name="opcion_preg_4_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 4',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }
     

                              if(!$('input[name="opcion_preg_5_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 5',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }

                              if(!$('input[name="opcion_preg_6_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 6',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }

                              if(!$('input[name="opcion_preg_7_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 7',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }

                              if(!$('input[name="opcion_preg_8_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 8',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }


                              if(!$('input[name="opcion_preg_9_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 9',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }

                              if(!$('input[name="opcion_preg_10_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 10',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }


                              
                              if(!$('input[name="opcion_preg_10_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 10',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }


                              if(!$('input[name="opcion_preg_11_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 11',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }

                              if(!$('input[name="opcion_preg_12_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 12',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }


                              
                               if(!$('input[name="opcion_preg_13_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 13',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }

                              if(!$('input[name="opcion_preg_14_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 14',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }

                              if(!$('input[name="opcion_preg_15_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 15',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }

                              if(!$('input[name="opcion_preg_16_servicio_calida"]').is(':checked')){

                                Swal.fire({title:'Aviso',text:'Falta  seleccionar opción de la pregunta 16',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                                  $form.find("button").prop("disabled", false);

                                  return false;

                              }
                                 //validacionde de inputs end


            Swal.fire({title:'AVISO',text:"¿Está seguro de enviar los datos de esta encuesta?",
            type:"question",
            showCancelButton: true,
                    confirmButtonText: 'Si, deseo enviar',
                    cancelButtonText:'Cancelar acción',
            })
                           .then((question) => {

                            if (question.value) {
                              
                        
                           
                    



     

                              let url_enviar="<?php echo $this->url->get('respuesta/guardar_calidadservicio/') ?>";
                                            
                              $.ajax({
                                            type: "POST",
                                            url: url_enviar+enc_id,
                                            data: formulario.serialize(),
                                            success: function(res)
                                            {   

                                              if(res['estado']=='2')
                                                  {
                  
                                                      Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                  .then((value) => {
                                                                      location.reload();  


                                                      });
                                                  }
                                            
                                                  else
                                                  {
                                                      Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                                                              .then((value) => {
                                                                                  location.reload();  
                                                                                  });
                                                   }
                                  
                                    
                                              $form.find("button").prop("disabled", false);

                                            
                                            },
                                            error: function(res)
                                            { 
                                              alert('error en :'+res.responseText);
                                            
                                            }
                                  });
                                  return false;

                              
                            }else{
                              $form.find("button").prop("disabled", false);

                            }
            });
                        
                   

                
        });



  });

</script>