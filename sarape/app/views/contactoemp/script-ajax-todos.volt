<script>
    function fncontactos_adaptable(input_select, empresa_select_id = 0, selected_value = 0) {
        if (!input_select || !input_select instanceof jQuery) {
            alert('Error: Se requiere un elemento select válido.');
        }

        let value_guardado_id=selected_value;
        let $empresa = empresa_select_id;
        let $select_utilizar = input_select;
		var negocio="<?php echo $this->url->get('contactoemp/ajax_contactos/') ?>"+$empresa;

		$select_utilizar.empty();
		$.ajax({
			type: "POST",
			url: negocio,
			success: function(data)
			{
				if (data.length > 0) {
					$select_utilizar.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {

                            if (value_guardado_id == dat.cne_id) {
                                options += '<option selected value="' + dat.cne_id + '">' +dat.cne_nombre+' '+dat.cne_primerapellido+' '+dat.cne_segundoapellido+ '</option>';

                            } else {
                                    options += '<option value="' + dat.cne_id + '">' +dat.cne_nombre+' '+dat.cne_primerapellido+' '+dat.cne_segundoapellido+ '</option>';
                            }
						});

						return options;
					});
				}else{
					$select_utilizar.append(function () {
						var options = '';
						options += '<option selected value="-1">No hay contactos asignados</option>';
						return options;
					});
				}
			},
			error: function(res)
			{
				alert('Error en el servidor...'+res.responseText);
			  // $("#btn_aprobar").prop("disabled", false);
			}
		});
	}


	function fncontactos_adaptable_inputs(id_cne=0,inputs={}) {
      
	  let url="<?php echo $this->url->get('contactoemp/ajax_contactos/') ?>"+id_cne;
	  $.ajax({
		  type: "POST",
		  url: url,
		  success: function(res)
		  {
			let inputData =inputs;

			let data = res[0];
			let inputIndex = 0;

			for (let input of inputData) {
				let inputId = input.input_id;
				let propertyName = input.nombre_de_valor;
				let propertyValue = data[propertyName];
				$("#" + inputId).val(propertyValue);
				console.log(propertyValue);

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