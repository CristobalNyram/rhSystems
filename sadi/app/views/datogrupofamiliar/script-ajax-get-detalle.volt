<script>
  function fnCargarDatosDelFormularioE(ese_id,dgf_matrimoniopadres_input=0,dgf_calificacion_input=0,id_ubicacion_boton=0){
          
          let form_seccionB=document.getElementById('form_estudio_seccionGrupoFamiliar');
          form_seccionB.reset();
          $('#dgf_ese_id').val(ese_id);

          
          let url_enviar="<?php echo $this->url->get('datogrupofamiliar/ajax_get_detalle/') ?>";

            $.ajax({
                    type: "POST",
                    url: url_enviar+ese_id,
                      
                    success: function(data)
                    {
                         if (data.length ==0) {
                              $(`#${id_ubicacion_boton}`).empty();
                             fnCrearAutomaticoDatoGrupoFamiliar(ese_id);
                         }
                         else
                         {
                 
                        
                    
                          
                           $('#gfd_id_titulo_gfd').text(data[0].dgf_id);
                           fnCargarDatogrupofamiliardetalles(data[0].dgf_id,data[0].ese_id);
                           fnCargarDatogrupofamiliardetalles(data[0].dgf_id,data[0].ese_id);

                          
                          (
                          (dgf_matrimoniopadres_input!=0)?dgf_matrimoniopadres_input.val(data[0].dgf_matrimoniopadres):'');

                          let Calificación_dgf=(data[0].dgf_calificacion>=1)?data[0].dgf_calificacion:-1;                          
                            $(`#${dgf_calificacion_input}`).val(Calificación_dgf);
                            $(`#${dgf_calificacion_input}`).trigger('change');

  
                     
                         }



                    },
                    error: function(data)
                    {
                        alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                      
                    }
           });

    }

    function fnCrearAutomaticoDatoGrupoFamiliar(ese_id)
    {
      let url_enviar="<?php echo $this->url->get('datogrupofamiliar/crear_automatico_dgf/') ?>";

            $.ajax({
                    type: "POST",
                    url: url_enviar+ese_id,
                      
                    success: function(res)
                    {

                          if(res[0]==2)
                          {
                            cargarDatosSeccion_E_ESES(ese_id);
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