<script>

$(function (){
          $('#nocontesto-encuestacalidadservicio').click(function(event){
            let ese_id=   $('#ese_id-encuestacalidadservicio').val();
            let enc_id=   $('#enc_id-encuestacalidadservicio').val();

       
            let $form = $(this);
            $form.find("button").prop("disabled", true);

            Swal.fire({
              title: "Comentario",
              text: "Escribe un comentario",
              input: 'textarea',
              confirmButtonText: 'Guardar comentario',

              showCancelButton: false,

              inputAttributes: {
                  required: true
              },
          }).then((comentario) => {

                  if(comentario.value){



                        let comentario_input=comentario.value;

                        // console.log(comentario);
                        Swal.fire({title:'AVISO',text:"¿Está seguro relizar esta acción?",
                        type:"question",
                        showCancelButton: true,
                                confirmButtonText: 'Si, estoy seguro',
                                cancelButtonText:'Cancelar acción',
                        })
                                      .then((question) => {

                                        if (question.value) {

                                          

                                  
                                          let url_enviar="<?php echo $this->url->get('encuestacalidad/ajax_set_no_contesto_candidato/') ?>";
                                          $.ajax({
                                                  type: "POST",
                                                  url: url_enviar+enc_id,
                                                  data:{
                                                    'comentario':comentario_input
                                                  },
                                                  
                                                  success: function(res)
                                                  {   
                                                    // console.log(res);                          
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
                                              
                                                  
                                                  },
                                                  error: function(res)
                                                  { 

                                                    alert('error en '+res.responseText);
                                                  
                                                  }
                                        });
                                  
                                      

                                          
                                        }else{
                                          $form.find("button").prop("disabled", false);

                                        }
                        });
                            

                  }

              

          });

          

                
        });



  });

</script>