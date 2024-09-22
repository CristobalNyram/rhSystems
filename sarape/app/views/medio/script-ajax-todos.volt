<script>
	/**
     * Carga dinámicamente las opciones de centros en un elemento select basado en el estado seleccionado.
     *
     * @param {jQuery} input_select - El elemento select donde se cargarán las opciones de centros.
     * @param {number} selected_value - El valor seleccionado por defecto (opcional).
     * @return {void}
     */
    function fnmedio_adaptable(input_select, selected_value = 0) {
        if (!input_select || !input_select instanceof jQuery) {
            alert('Error: Se requiere un elemento select válido.');
            return;
        }

        let $select_utilizar = input_select;
        let value_guardado_id = selected_value;
		var negocio="<?php echo $this->url->get('medio/ajax_medios/') ?>";
		$select_utilizar.empty();
		$.ajax({
			type: "POST",
			url: negocio,
			success: function(res)
			{
				let data=res["data"];
			  // Agregar nuevos sub-departamentos
				if (data.length > 0) {
					$select_utilizar.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {

                            
                            if (value_guardado_id == dat.med_id) {
                                options += '<option selected value="' + dat.med_id + '">' +dat.med_nombre+'</option>';

                            } else {
                                options += '<option value="' + dat.med_id + '">' +dat.med_nombre+'</option>';
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
				console.error(res.responseText);
			  // $("#btn_aprobar").prop("disabled", false);
			}
		});
	}

</script>