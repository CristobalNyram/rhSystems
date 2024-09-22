<script  >
 function fnestados_estados_adaptable(select_est_id=0,$select_input,select_municipios=0,mun_id_cargado=0)
	{
	    let url_enviar="<?php echo $this->url->get('estado/ajax_estados/') ?>";
	    let $select_usado = $select_input;
		let $select_mun_utilizar =select_municipios;
	    $select_usado.empty();
	    $.ajax({
	        type: "POST",
	        url: url_enviar,
	          
	        success: function(data)
	        {
				// console.log(data);

	            // console.log(data);
	              // Agregar nuevos sub-departamentos
				if (data.length > 0) {
					$select_usado.append(function () {
						let options = '';
						if(select_est_id<=0)
						{
							options += '<option selected value="-1">Seleccionar</option>';

						}
						else
						{
							options += '<option  value="-1">Seleccionar</option>';

						}
						$.each(data, function (key, dat) {
							if (select_est_id==dat.est_id) {
								options += '<option  selected value="' + dat.est_id + '">' +dat.est_nombre+'</option>';
								
								if(select_municipios != 0 )
								{	

									//de esta manera cargamos el estado y el municipio
									//fnmunicipios_adaptable(select_municipios,dat.est_id,0,mun_id_cargado,mun_id_cargado);
								}

							}	
							else
							{
								options += '<option value="' + dat.est_id + '">' +dat.est_nombre+'</option>';

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
    function fnestados_estados(select_est_id=0,$select_input,select_municipios=0,mun_id_cargado=0)
	{
	    let url_enviar="<?php echo $this->url->get('estado/ajax_estados/') ?>";
	    let $select_usado = $select_input;
		let $select_mun_utilizar =select_municipios;
	    $select_usado.empty();
	    $.ajax({
	        type: "POST",
	        url: url_enviar,
	          
	        success: function(data)
	        {
	            // console.log(data);
	              // Agregar nuevos sub-departamentos
				if (data.length > 0) {
					$select_usado.append(function () {
						let options = '';
						// console.log(1);
						if(select_est_id<=0)
						{
							options += '<option selected value="-1">Seleccionar</option>';

						}
						else
						{
							options += '<option  value="-1">Seleccionar</option>';

						}
						$.each(data, function (key, dat) {
							if (select_est_id==dat.est_id) {
								options += '<option  selected value="' + dat.est_id + '">' +dat.est_nombre+'</option>';
								
								if(select_municipios != 0 )
								{	

									//de esta manera cargamos el estado y el municipio
									//fnmunicipios_adaptable(select_municipios,dat.est_id,0,mun_id_cargado,mun_id_cargado);
								}

							}	
							else
							{
								options += '<option value="' + dat.est_id + '">' +dat.est_nombre+'</option>';

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