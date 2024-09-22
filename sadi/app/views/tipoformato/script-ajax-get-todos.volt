<script>
    function getTodosTipoFormatoActivo(id=0)
    {
         let url_enviar="<?php echo $this->url->get('tipoformato/ajax_tiposformatos/') ?>";
         let $select_id = $('#'+id);

         $select_id.empty();
          $.ajax({
              type: "POST",
              url: url_enviar,
                
              success: function(data)
              {
                    // Agregar nuevos sub-departamentos
                    if (data.length > 0) {
                    $select_id.append(function () {
                        var options = '';
                    
                        
                        $.each(data, function (key, dat) {                       
                                options += '<option   value="' + dat.tif_id + '">' +dat.tif_nombre+'</option>'; 

                         });

                        return options;
                        });
                    }else{
                    $select_id.append(function () {
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