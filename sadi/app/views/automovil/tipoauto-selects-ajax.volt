<script>
    function fngetDataTipoAuto(auto_tipo_id=0,select_input=0){
             let url_enviar="<?php echo $this->url->get('automovil/ajax_get_data_tipo_auto/') ?>";
	          let $select_usado = select_input;
            $select_usado.empty();
            $.ajax({
	        type: "POST",
	        url: url_enviar,
	          
	        success: function(data)
	        {
				// console.log(data);

	            // console.log(data);
	              // Agregar nuevos sub-departamentos
				if (data.data.length > 0) {
					$select_usado.append(function () {
						let options = '';
						if(auto_tipo_id<=0)
						{
							options += '<option selected value="-1">Seleccionar</option>';

						}
						else
						{
							options += '<option  value="-1">Seleccionar</option>';

						}
						$.each(data.data, function (key, dat) {
							if (auto_tipo_id==dat.id) {
								options += '<option  selected value="' + dat.id + '">' +dat.nombre+'</option>';
								
					

							}	
							else
							{
								options += '<option value="' + dat.id + '">' +dat.nombre+'</option>';

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
	        },
	        error: function(res)
	        {
	            // $("#btn_aprobar").prop("disabled", false);
	        }
	    });

    }
</script>