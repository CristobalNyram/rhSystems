<script>
  function fnempresas_adaptable(select_id = 0, $select_input) {
    let url_enviar = "<?php echo $this->url->get('empresa/ajax_empresa/') ?>";
    let $select_usado = $select_input;
    $select_usado.empty();
    $.ajax({
      type: "POST",
      url: url_enviar,
      success: function (data) {
        //  console.log(select_id);

        // console.log(data);
        // Agregar nuevos sub-departamentos
        if (data.length > 0) {
          $select_usado.append(function () {
            let options = "";
            if (select_id <= 0) {
              options += '<option selected value="-1">Seleccionar</option>';
            } else {
              options += '<option  value="-1">Seleccionar</option>';
            }
            $.each(data, function (key, dat) {
              if (select_id == dat.emp_id) {
                options +=
                  '<option  selected value="' +
                  dat.emp_id +
                  '">' +
                  dat.emp_nombre +
                  "</option>";
              } else {
                options +=
                  '<option value="' +
                  dat.emp_id +
                  '">' +
                  dat.emp_nombre +
                  "</option>";
              }
            });

            return options;
          });
        } else {
          $select_usado.append(function () {
            let options = "";
            options += '<option selected value="-1">No aplica</option>';
            return options;
          });
        }
      },
      error: function (res) {
        // $("#btn_aprobar").prop("disabled", false);
      },
      finally: function(res) {
        $select_input.trigger("change");
      }
    });
  }
  
</script>
