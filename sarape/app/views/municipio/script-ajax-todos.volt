<script>
	/**
 * Carga dinámicamente las opciones de municipios en un elemento select basado en el estado seleccionado.
 *
 * @param {jQuery} input_select_municipios - El elemento select donde se cargarán las opciones de municipios.
 * @param {number} estado_select_id - El ID del estado seleccionado.
 * @param {number} municipio_guardado_id - El ID del municipio guardado (opcional).
 * @return {void}
 */
function fnmunicipios_adaptable(input_select_municipios, estado_select_id = 0, municipio_guardado_id = 0) {
  let estado = estado_select_id;
  let select_utilizar = input_select_municipios;

  //console.log(estado);
  // Validar que el estado y el select no sean nulos o indefinidos
  if (!estado || !select_utilizar) {
    alert("Error: Estado o select no están definidos.");
    return;
  }

  let url_enviar = "<?php echo $this->url->get('municipio/ajax_municipios/') ?>" + estado;

  //console.log(select_utilizar,estado_select_id);
  // Limpiar el select antes de cargar los municipios
  select_utilizar.empty();

  $.ajax({
    type: "POST",
    url: url_enviar,

    success: function(data) {
		//console.log(data);
      // Agregar nuevos sub-departamentos
      if (data.length > 0) {
        select_utilizar.append(function() {
          var options = '';

          // Validar si se debe agregar una opción seleccionada por defecto
          if (municipio_guardado_id <= 0) {
            options += '<option selected value="-1">Seleccionar</option>';
          } else {
            options += '<option value="-1">Seleccionar</option>';
          }

          $.each(data, function(key, dat) {
            // Validar si el municipio guardado coincide con el actual
            if (municipio_guardado_id == dat.mun_id) {
              options += '<option selected value="' + dat.mun_id + '">' + dat.mun_nombre + '</option>';
            } else {
              options += '<option value="' + dat.mun_id + '">' + dat.mun_nombre + '</option>';
            }
          });

          return options;
        });
      } else {
        // Si no hay datos, agregar una opción "No aplica"
        select_utilizar.append(function() {
          var options = '';
          options += '<option selected value="-1">Seleccionar estado</option>';
          return options;
        });
      }
    },done:function(res){
		select_utilizar.trigger('change');
	},
    error: function(res) {
      // Manejar errores de la solicitud AJAX
      console.log("Error en la solicitud AJAX:", res);
    }
  });
}

</script>