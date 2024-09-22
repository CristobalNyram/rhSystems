<script type="text/javascript">
    
    $('#form_estudio_seccionSituacionEconomica').submit((event)=>{
            event.preventDefault();
            let id= $('#ese_id_ese_actual').text();



            if($('#sie_manuingreso').val()==-1){
            Swal.fire({title:'Faltan datos',text:'Debes seleccionar si recibe manutención.',type:"warning"})
                                .then((value) => {
                                
                                });
              return false;

            }

            if($('#sie_manuegreso').val()==-1){
            Swal.fire({title:'Faltan datos',text:'Debes seleccionar si da manutención.',type:"warning"})
                                .then((value) => {
                                
                                });
              return false;

            }

            if($('#sie_manuingreso').val()==1){

              if($('#sie_manuingresomonto').val()=='' 
                ||$('#sie_manuingresomonto').val()==null
                ||$('#sie_manuingresomonto').val()=='00.00'
                ||$('#sie_manuingresomonto').val()=='0'
                ||$('#sie_manuingresomonto').val()=='0.00'
                ){
                  Swal.fire({title:'Faltan datos',text:'Debes colocar una cantidad en el monto de ingresos manutención.',type:"warning"})
                                      .then((value) => {
                                        return false;

                                      });

              }

            }

             if($('#sie_manuegreso').val()==1){

              if($('#sie_manuegresomonto').val()=='' 
                ||$('#sie_manuegresomonto').val()==null
                ||$('#sie_manuegresomonto').val()=='00.00'
                ||$('#sie_manuegresomonto').val()=='0'
                ||$('#sie_manuegresomonto').val()=='0.00'
                ){
                  Swal.fire({title:'Faltan datos',text:'Debes colocar una cantidad en el monto de egresos manutención.',type:"warning"})
                                      .then((value) => {
                                        return false;

                                      });

              }

            }

            // console.log($('#sie_manuegresomonto').val());

            let formulario=$("#form_estudio_seccionSituacionEconomica");
            let $form = $(this);
            $form.find("button").prop("disabled", true);
            let url_enviar="<?php echo $this->url->get('situacioneconomica/ajax_set_update/') ?>";
    
                  $.ajax({
                          type: "POST",
                          url: url_enviar+id,
                          data: formulario.serialize(),
                          success: function(res)
                          {   
                        
                            if(res[0]==2)
                             {
                                  Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                      .then((value) => {
                                        fnCargarDatosDelFormularioG(res['ese_id']);

                                            $('#contact-tab-md-8').trigger('click');
                                      });

                             }
                           else
                           {
                              alertify.alert(res['titular'],res['mensaje'], function(){
                              location.reload();  
                              });
                           }
                       
                            
                          },
                          error: function(res)
                          { 
                          alert('error en el servidor...');
                          }
                });
            
          });
    
</script>