<script>
	/**
     * Carga dinámicamente las opciones de centros en un elemento select basado en el estado seleccionado.
     *
     * @param {jQuery} input_select - El elemento select donde se cargarán las opciones de centros.
     * @param {number} selected_value - El valor seleccionado por defecto (opcional).
     * @return {void}
     */
    function fntipocita_adaptable(input_select, selected_value = 0) {
        if (!input_select || !input_select instanceof jQuery) {
            alert('Error: Se requiere un elemento select válido.');
            return;
        }

        let $select_utilizar = input_select;
        let value_guardado_id = selected_value;
		var negocio="<?php echo $this->url->get('tipocita/ajax_tiposcitas/') ?>";

		$select_utilizar.empty();
		$.ajax({
			type: "POST",
			url: negocio,
			success: function(data)
			{
			  // Agregar nuevos sub-departamentos
				if (data.length > 0) {
					$select_utilizar.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {

                            
                            if (value_guardado_id == dat.tic_id) {
                                options += '<option selected value="' + dat.tic_id + '">' +dat.tic_nombre+'</option>';

                            } else {
                                options += '<option value="' + dat.tic_id + '">' +dat.tic_nombre+'</option>';
                            }
						});
						return options;
					});
				}else{
					$select_utilizar.append(function () {
						var options = '';
						options += '<option selected value="-1">No hay centros asignados</option>';
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