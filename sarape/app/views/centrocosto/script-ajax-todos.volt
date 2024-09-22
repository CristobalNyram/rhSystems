<script>
	/**
     * Carga dinámicamente las opciones de centros en un elemento select basado en el estado seleccionado.
     *
     * @param {jQuery} input_select - El elemento select donde se cargarán las opciones de centros.
     * @param {number} estado_select_id - El ID del estado seleccionado (opcional).
     * @param {number} selected_value - El valor seleccionado por defecto (opcional).
     * @return {void}
     */
    function fncentros_adaptable(input_select, empresa_select_id = 0, selected_value = 0) {
        if (!input_select || !input_select instanceof jQuery) {
            alert('Error: Se requiere un elemento select válido.');
            return;
        }

        let $empresa = empresa_select_id;
        let $select_utilizar = input_select;
        let value_guardado_id = selected_value;
		var negocio="<?php echo $this->url->get('centrocosto/ajax_centros/') ?>"+$empresa;

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
						options += '<option selected value="-2">Seleccionar</option>';
						$.each(data, function (key, dat) {

                            
                            if (value_guardado_id == dat.cen_id) {
                                options += '<option selected value="' + dat.cen_id + '">' +dat.cen_nombre+'</option>';

                            } else {
                                options += '<option value="' + dat.cen_id + '">' +dat.cen_nombre+'</option>';
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