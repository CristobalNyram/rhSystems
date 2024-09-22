<script>
  function fnestadocivils_adaptable(select,id_cargado_estado_civil=0,categoria=0)
  {
         let url_enviar="<?php echo $this->url->get('estadocivil/get_ajax_estadocivil/') ?>";
          let $estado_civil =select
           $estado_civil.empty();
          $.ajax({
              type: "POST",
              url: url_enviar+categoria,
                
              success: function(data)
              {
                    // Agregar nuevos sub-departamentos
            if (data.length > 0) {
              $estado_civil.append(function () {
                var options = '';
              
                 
             
                   if(id_cargado_estado_civil<=0)
                   {
                    options += '<option selected value="-1">Seleccionar</option>';

                   }
                   else
                   {
                    options += '<option  value="-1">Seleccionar</option>';

                   }
                
                   $.each(data, function (key, dat) {
                                                            
                        if(id_cargado_estado_civil==dat.esc_id)
                        {
                          options += '<option  selected value="' + dat.esc_id + '">' +dat.esc_nombre+'</option>';

                        }
                        else
                        {
                          options += '<option value="' + dat.esc_id + '">' +dat.esc_nombre+'</option>';

                        }
                    });

              


                  return options;
                });
            }else{
              $estado_civil.append(function () {
                  var options = '';
                  options += '<option selected value="-1">No aplica</option>';
                  return options;
              });
            }
              },
              error: function(res)
              {
                  // $("#btn_aprobar").prop("disabled", false);
              }
          });
  }

</script>
