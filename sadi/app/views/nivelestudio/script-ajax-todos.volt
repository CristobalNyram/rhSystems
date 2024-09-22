<script>
    
      //funcion  para jalar datos del nivel de estudios
      function fnnivelestudios_adapatable($select_utilzar=0,id_cargado_nivel_estudio=0,$truper=0)
      {

          let url_enviar="<?php echo $this->url->get('nivelestudio/get_ajax_nivelestudios/') ?>";
          url_enviar =url_enviar+$truper;
        
          let $nivel_estudios = $select_utilzar;
          $nivel_estudios.empty();
          $.ajax({
              type: "POST",
              url: url_enviar,
                
              success: function(data)
              {
                  // console.log(data);
                    // Agregar nuevos sub-departamentos
            if (data.length > 0) {
              $nivel_estudios.append(function () {
                var options = '';
                if (id_cargado_nivel_estudio<=0) {
                  options += '<option selected value="-1">Seleccionar</option>';

                }
                else
                {
                  options += '<option  value="-1">Seleccionar</option>';

                }
                $.each(data, function (key, dat) {
                  if(id_cargado_nivel_estudio==dat.niv_id)
                  {
                    options += '<option selected value="' + dat.niv_id + '">' +dat.niv_nombre+'</option>';

                  }
                  else
                  {
                    options += '<option value="' + dat.niv_id + '">' +dat.niv_nombre+'</option>';

                  }

                });

                  return options;
                });
            }else{
              $nivel_estudios.append(function () {
                  var options = '';
                  options += '<option selected value="-1">No aplica</option>';
                  return options;
              });
            }
              },
              error: function(res)
              {
                alert('Error en el servidor...');
                  // $("#btn_aprobar").prop("disabled", false);
              }
          });
      }



</script>
