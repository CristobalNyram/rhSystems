<script>
  function fnCargarDatosDelFormularioC_formato_gabtubos(ese_id){
          
          let form_seccionB=document.getElementById('form_estudio_seccionGrupoFamiliar_formato_gabtubos');
          form_seccionB.reset();
          $('#dgf_ese_id_formato_gabtubos').val(ese_id);

            // console.log(ese_id);
          let url_enviar="<?php echo $this->url->get('datogrupofamiliar/ajax_get_detalle/') ?>";

            $.ajax({
                    type: "POST",
                    url: url_enviar+ese_id,
                      
                    success: function(data)
                    {
                         if (data.length ==0) {
                          // console.log(data);

                            //  $(`#${id_ubicacion_boton}`).empty();
                              fnCrearAutomaticoDatoGrupoFamiliar_formato_gabtubos(ese_id);
                         }
                         else
                         {
                 
                                              
                          $('#gfd_id_titulo_gfd_formato_gabtubos').text(data[0].dgf_id);
                          fnRecargarCargarDatogrupofamiliardetallesformato_gabtubos(data[0].dgf_id,data[0].ese_id);
                          fnRecargarCargarDatogrupofamiliardetallesformato_gabtubos(data[0].dgf_id,data[0].ese_id);

                        
                            $('#dgf_matrimoniopadres_formato_gabtubos').val(data[0].dgf_matrimoniopadres);

                            let Calificación_dgf=(data[0].dgf_calificacion>=1)?data[0].dgf_calificacion:-1;                          
                          
                            // console.log(Calificación_dgf);
                            $('#dgf_calificacion_formato_gabtubos').val(Calificación_dgf);
                            $('#dgf_calificacion_formato_gabtubos').trigger('change');



  
                     
                         }



                    },
                    error: function(data)
                    {
                        alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                      
                    }
           });

    }

    function fnCrearAutomaticoDatoGrupoFamiliar_formato_gabtubos(ese_id)
    {
      let url_enviar="<?php echo $this->url->get('datogrupofamiliar/crear_automatico_dgf/') ?>";

            $.ajax({
                    type: "POST",
                    url: url_enviar+ese_id,
                      
                    success: function(res)
                    {

                          if(res[0]==2)
                          {
                           fnCargarDatosDelFormularioC_formato_gabtubos(ese_id);
                          }
                          else
                          {
                            alertify.alert('ERROR','ERROR AL PROCESAR LOS DATOS'); 

                          }


                    },
                    error: function(res)
                    {
                        alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                      
                    }
            });
          
        
      }

  

</script>