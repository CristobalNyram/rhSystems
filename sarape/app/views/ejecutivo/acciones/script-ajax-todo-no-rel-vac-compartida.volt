<script>
	/**
 * Carga dinámicamente las opciones de municipios en un elemento select basado en el estado seleccionado.
 *
 * @param {jQuery} input_select_eje - El elemento select donde se cargarán las opciones de municipios.
 * @param {number} eje_select_id - El ID del ejecutivo seleccionado.
 * @return {void}
 */
function fnejecutivosNoCompartenVac_adaptable(input_select_eje, eje_select_id = 0,vac_id=0) {
  let ejecutivo = eje_select_id;
  let $select_usado = input_select_eje;
  if (!ejecutivo || !$select_usado) {
    alert("Error: EjeId o select no están definidos.");
    return;
  }
	let url_enviar = '<?php echo $this->url->get("ejecutivo/ajax_get_all_ejecutivos_no_compartidos_vac/") ?>' + `${ejecutivo}/${vac_id}`;
  	$select_usado.empty();
  $.ajax({
    type: "POST",
    url: url_enviar,
    success: function(res) {
                let data=res.data;
				if (data.length > 0) {
					$select_usado.append(function () {
						let options = '';
						if(eje_select_id<=0)
						{
							options += '<option selected value="-1">Seleccionar</option>';
						}
						else
						{
							options += '<option  value="-1">Seleccionar</option>';
						}
						$.each(data, function (key, dat) {
							if (eje_select_id==dat.usu_id) {
								options += '<option  selected value="' + dat.usu_id + '">' +dat.usu_nombre+'</option>';
							}	
							else
							{
								options += '<option value="' + dat.usu_id + '">' +dat.usu_nombre+'</option>';
							}
						});

					    return options;
				  	});
				}else{
					$select_usado.append(function () {
					    let options = '';
					    options += '<option selected value="-1">No aplica</option>';
					    return options;
					});
				}
    },done:function(res){
		$select_usado.trigger('change');
	},
    error: function(res) {
     
      console.log("Error en la solicitud AJAX:", res);
    }
  });
}

</script>