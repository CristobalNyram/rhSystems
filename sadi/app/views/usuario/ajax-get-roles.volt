<script>
    function getRolesSetOrShow(id_role=0,select_input){

    let $subsrol=select_input;

        
    $subsrol.empty();
    $.ajax({
        type: "POST",
        url: "<?php echo $this->url->get('rol/ajax_roles/') ?>",
        success: function(data)
        {
        if (data.length > 0){
          $subsrol.append(function () {
          var options = '';
          options += '<option  value="-1">Seleccionar</option>';

          $.each(data, function (key, dat) {


            if(dat.rol_id==id_role){
              options += '<option selected value="' + dat.rol_id + '">' +dat.rol_nombre +'</option>';

            }
            else{

              options += '<option value="' + dat.rol_id + '">' +dat.rol_nombre + '</option>';
            }

            //  console.log(dat.rol_id,$rolasignado);
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