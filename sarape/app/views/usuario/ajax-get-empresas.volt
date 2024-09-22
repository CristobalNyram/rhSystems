<script>
    function getEmpresasSetOrShow(id_empresa=0,select_input=0){
        // var $subsemp = $('select[name="emp_ideditar"]');
    let $subsemp =select_input;
    let $empasignado=id_empresa;
    $subsemp.empty();
    $.ajax({
        type: "POST",
        url: "<?php echo $this->url->get('empresa/ajax_empresas/') ?>",
        success: function(data)
        {
        if (data.length > 0){
          $subsemp.append(function () {
          var options = '';
          if(id_empresa==0){
            options += '<option  selected value="-1">Seleccionar</option>';

          }else{
            options += '<option value="-1">Seleccionar</option>';

          }
          $.each(data, function (key, dat) {
            if(dat.emp_id==$empasignado){
              options += '<option selected value="' + dat.emp_id + '">' +dat.emp_nombre +'</option>';
            }
            else
              options += '<option value="' + dat.emp_id + '">' +dat.emp_nombre + '</option>';
          });
          return options;
          });
        }
        },
        error: function(res)
        {
          alert('Error en el servidor...');
        }
    });
    }

</script>