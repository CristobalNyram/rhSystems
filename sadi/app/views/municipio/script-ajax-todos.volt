<script text="">
function fnmunicipios_adaptable($input_select_municipios,estado_select_id=0,$municipio_guardado_id=0,$mensaje_sin_municipio=""){
		let $estado =estado_select_id;
		let $select_utilizar = $input_select_municipios;

    	let url_enviar="<?php echo $this->url->get('municipio/ajax_municipios/') ?>"+$estado;
    
	    $select_utilizar.empty();
		$.ajax({
			type: "POST",
			url: url_enviar,

			success: function(data)
			{
			
			  // Agregar nuevos sub-departamentos
			  if (data.length > 0) {
			      $select_utilizar.append(function () {
			          var options = '';
						  if($municipio_guardado_id<=0)
						{
							options += '<option selected value="-1">Seleccionar</option>';

						}
						else
						{
							options += '<option  value="-1">Seleccionar</option>';

						}

			          $.each(data, function (key, dat) {
						if($municipio_guardado_id==dat.mun_id)
						{
							options += '<option  selected value="' + dat.mun_id + '">' +dat.mun_nombre+'</option>';

						}
						else
						{
							options += '<option value="' + dat.mun_id + '">' +dat.mun_nombre+'</option>';
						}
			          });

			          return options;
			      });
			  }else{
				  $select_utilizar.append(function () {
				  let options = '';
				  if($mensaje_sin_municipio!=""){
			        options += '<option selected value="-1">'+$mensaje_sin_municipio+'</option>';
				  }else{
			        options += '<option selected value="-1">No aplica</option>';

				  }
			        return options;
			    });
			  }
			},
			error: function(res)
			{
			}
		});
	}
</script>