<script>

function fncatvacante_adaptable(input_select_catvacante, select_id = 0, value_guardado_id = 0) {
  let empresa = select_id;
  let select_utilizar = input_select_catvacante;

  // Validar que el estado y el select no sean nulos o indefinidos
  if (!empresa || !select_utilizar) {
    alert("Error: Empresa o select no están definidos.");
    return;
  }

  let url_enviar = "<?php echo $this->url->get('catvacante/ajax_catvacantes/') ?>" + empresa;

  // Limpiar el select antes de cargar los municipios
  select_utilizar.empty();

  $.ajax({
    type: "POST",
    url: url_enviar,

    success: function(data) {
      // Agregar nuevos sub-departamentos
      if (data.length > 0) {
        select_utilizar.append(function() {
          var options = '';

          // Validar si se debe agregar una opción seleccionada por defecto
          if (value_guardado_id <= 0) {
            options += '<option selected value="-1">Seleccionar</option>';
          } else {
            options += '<option value="-1">Seleccionar</option>';
          }

          $.each(data, function(key, dat) {
            // Validar si el municipio guardado coincide con el actual
            if (value_guardado_id == dat.cav_id) {
              options += '<option selected value="' + dat.cav_id + '">' + dat.cav_nombre + '</option>';
            } else {
              options += '<option value="' + dat.cav_id + '">' + dat.cav_nombre + '</option>';
            }
          });

          return options;
        });
      } else {
        // Si no hay datos, agregar una opción "No aplica"
        select_utilizar.append(function() {
          var options = '';
          options += '<option selected value="-1">No aplica</option>';
          return options;
        });
      }
    },done:function(res){
		select_utilizar.trigger('change');
	},
    error: function(res) {
      // Manejar errores de la solicitud AJAX
    }
  });
}

</script>