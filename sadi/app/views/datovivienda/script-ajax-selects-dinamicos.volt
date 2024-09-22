<script>

function fngetDataSelectsDinamicosDatosVivienda(
				antiguedad_value_id=0,antiguedad_select_input=0,
				zona_value_id=0,zona_select_input=0,
				clase_social_value_id=0,clase_social_select_input=0,
				vivienda_value_id=0,vivienda_select_input=0,
				formato_vivienda_value_id=0,formato_vivienda_select_input=0,
				niveles_value_id=0,niveles_select_input=0,
				apariencia_value_id=0,apariencia_select_input=0,
				estadomobiliario_value_id=0,estadomobiliario_select_input=0,
				inmueble_value_id=0,inmueble_select_input=0,

				){

			 if(antiguedad_select_input!=0){
				
				antiguedad_select_input.empty();

			 }

			 if(zona_select_input!=0){
				let $select_usado_zona = zona_select_input;
				$select_usado_zona.empty();

			 }

			 if(vivienda_select_input!=0){
				let $select_usado_vivienda = vivienda_select_input;
				$select_usado_vivienda.empty();

			 }

			 if(formato_vivienda_select_input!=0){
				let $select_usado_formato_vivienda = formato_vivienda_select_input;

				$select_usado_formato_vivienda.empty();

			 }


			 if(niveles_select_input!=0){
			   let $select_usado_nivles = niveles_select_input;

				$select_usado_nivles.empty();

			 }

			 if(apariencia_select_input!=0){
				let $select_usado_apariencia = apariencia_select_input;
				$select_usado_apariencia.empty();

			 }

			 if(estadomobiliario_select_input!=0){
			    let $select_usado_estado_mobiliario = estadomobiliario_select_input;
				$select_usado_estado_mobiliario.empty();

			 }
			 if(inmueble_select_input!=0){
			    let $select_usado_inmueble = inmueble_select_input;
				$select_usado_inmueble.empty();

			 }
			 if(clase_social_select_input!=0){
			    let $clase_social_select_input = clase_social_select_input;
				$clase_social_select_input.empty();

			 }
			 
			 let url_enviar="<?php echo $this->url->get('datovivienda/ajax_get_data_selects_dinamicos/') ?>";

            $.ajax({
	        type: "POST",
	        url: url_enviar,
	        success: function(res)
	        {
				let antiguedad_data=Object.entries(res['antiguedad_data']);
				let apariencia_data=Object.entries(res['apariencia_data']);
				let estadomobiliario_data=Object.entries(res['estadomobiliario_data']);
				let formatovivienda_data=Object.entries(res['formatovivienda_data']);
				let inmueble_data=Object.entries(res['inmueble_data']);
				let niveles_data=Object.entries(res['niveles_data']);
				let vivienda_data=Object.entries(res['vivienda_data']);
				let zona_data=Object.entries(res['zona_data']);
				let clase_social_data=Object.entries(res['clase_social_data']);

				// console.log(data);
	              // Agregar nuevos sub-departamentos


				//inico de insercion de elemento a un select
				if(antiguedad_select_input!=0){


							if (antiguedad_data.length > 0) {
									
									antiguedad_select_input.append(function () {
									let options = '';
									if(antiguedad_value_id<=0)
									{
										options += '<option selected value="-1">Seleccionar</option>';

									}
									else
									{
										options += '<option  value="-1">Seleccionar</option>';

									}
											$.each( antiguedad_data, function (key, dat) {
												if (antiguedad_value_id==dat[0]) {
													options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
												}	
												else
												{
													 options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';

												}
												// console.log(dat[1]);
											//  console.log(dat[0]);
											//  antigu

											});

									return options;
								});
								
							}else{
								antiguedad_select_input.append(function () {
									let options = '';
									options += '<option selected value="-1">No aplica</option>';
									return options;
								});
							}
				}

				//fin de insercion de elemento a un select
				
				
				//inicio de insersion de select
				if(zona_select_input!=0){


							if (zona_data.length > 0) {
									
									zona_select_input.append(function () {
									let options = '';
									if(zona_value_id<=0)
									{
										options += '<option selected value="-1">Seleccionar</option>';

									}
									else
									{
										options += '<option  value="-1">Seleccionar</option>';

									}
											$.each( zona_data, function (key, dat) {
												if (zona_value_id==dat[0]) {
													options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
												}	
												else
												{
													 options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';

												}
												// console.log(dat[1]);
											//  console.log(dat[0]);
											//  antigu

											});

									return options;
								});
								
							}else{
								zona_select_input.append(function () {
									let options = '';
									options += '<option selected value="-1">No aplica</option>';
									return options;
								});
							}
				}
				// fin de insersion de select



				//inicio de insersion de select
				if(vivienda_select_input!=0){


							if (vivienda_data.length > 0) {
									
									vivienda_select_input.append(function () {
									let options = '';
									if(vivienda_value_id<=0)
									{
										options += '<option selected value="-1">Seleccionar</option>';

									}
									else
									{
										options += '<option  value="-1">Seleccionar</option>';

									}
											$.each( vivienda_data, function (key, dat) {
												if (vivienda_value_id==dat[0]) {
													options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
												}	
												else
												{
													 options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';

												}
												// console.log(dat[1]);
											//  console.log(dat[0]);
											//  antigu

											});

									return options;
								});
								vivienda_select_input.trigger('change');
								
							}else{
								vivienda_select_input.append(function () {
									let options = '';
									options += '<option selected value="-1">No aplica</option>';
									return options;
								});
							  vivienda_select_input.trigger('change');

							}
				}
				// fin de insersion de select


				//inicio de insersion de select
				if(niveles_select_input!=0){


							if (niveles_data.length > 0) {
									
									niveles_select_input.append(function () {
									let options = '';
									if(niveles_value_id<=0)
									{
										options += '<option selected value="-1">Seleccionar</option>';

									}
									else
									{
										options += '<option  value="-1">Seleccionar</option>';

									}
											$.each( niveles_data, function (key, dat) {
												if (niveles_value_id==dat[0]) {
													options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
												}	
												else
												{
													 options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';

												}
												// console.log(dat[1]);
											//  console.log(dat[0]);
											//  antigu

											});

									return options;
								});
								
							}else{
								niveles_select_input.append(function () {
									let options = '';
									options += '<option selected value="-1">No aplica</option>';
									return options;
								});
							}
				}
				// fin de insersion de select

				//inicio de insersion de select
				if(formato_vivienda_select_input!=0){


							if (formatovivienda_data.length > 0) {
									
									formato_vivienda_select_input.append(function () {
									let options = '';
									if(formato_vivienda_value_id<=0)
									{
										options += '<option selected value="-1">Seleccionar</option>';

									}
									else
									{
										options += '<option  value="-1">Seleccionar</option>';

									}
											$.each( formatovivienda_data, function (key, dat) {
												if (formato_vivienda_value_id==dat[0]) {
													options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
												}	
												else
												{
													 options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';

												}
												// console.log(dat[1]);
											//  console.log(dat[0]);
											//  antigu

											});

									return options;
								});
								
							}else{
								formato_vivienda_select_input.append(function () {
									let options = '';
									options += '<option selected value="-1">No aplica</option>';
									return options;
								});
							}
				}
				// fin de insersion de select


				//inicio de insersion de select
				/*if(vivienda_select_input!=0){


							if (vivienda_data.length > 0) {
									
									vivienda_select_input.append(function () {
									let options = '';
									if(vivienda_value_id<=0)
									{
										options += '<option selected value="-1">Seleccionar</option>';

									}
									else
									{
										options += '<option  value="-1">Seleccionar</option>';

									}
											$.each( vivienda_data, function (key, dat) {
												if (vivienda_value_id==dat[0]) {
													options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
												}	
												else
												{
													 options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';

												}
												// console.log(dat[1]);
											//  console.log(dat[0]);
											//  antigu

											});

									return options;
								});
								
							}else{
								vivienda_select_input.append(function () {
									let options = '';
									options += '<option selected value="-1">No aplica</option>';
									return options;
								});
							}
				}*/
				// fin de insersion de select

				
				//inicio de insersion de select
	


				if(clase_social_select_input!=0){


							if (clase_social_data.length > 0) {
									
								clase_social_select_input.append(function () {
									let options = '';
									if(estadomobiliario_value_id<=0)
									{
										options += '<option selected value="-1">Seleccionar</option>';

									}
									else
									{
										options += '<option  value="-1">Seleccionar</option>';

									}
											$.each( clase_social_data, function (key, dat) {
												if (clase_social_value_id==dat[0]) {
													options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
												}	
												else
												{
													 options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';

												}
												// console.log(dat[1]);
											//  console.log(dat[0]);
											//  antigu

											});

									return options;
								});
								
							}else{
								estadomobiliario_select_input.append(function () {
									let options = '';
									options += '<option selected value="-1">No aplica</option>';
									return options;
								});
							}
				}
				// fin de insersion de select
				

				//inicio de insersion de select
				if(estadomobiliario_select_input!=0){


							if (estadomobiliario_data.length > 0) {
									
									estadomobiliario_select_input.append(function () {
									let options = '';
									if(estadomobiliario_value_id<=0)
									{
										options += '<option selected value="-1">Seleccionar</option>';

									}
									else
									{
										options += '<option  value="-1">Seleccionar</option>';

									}
											$.each( estadomobiliario_data, function (key, dat) {
												if (estadomobiliario_value_id==dat[0]) {
													options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
												}	
												else
												{
													 options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';

												}
												// console.log(dat[1]);
											//  console.log(dat[0]);
											//  antigu

											});

									return options;
								});
								
							}else{
								estadomobiliario_select_input.append(function () {
									let options = '';
									options += '<option selected value="-1">No aplica</option>';
									return options;
								});
							}
				}
				// fin de insersion de select



				//inicio de insersion de select
				if(apariencia_select_input!=0){


							if (apariencia_data.length > 0) {
									
									apariencia_select_input.append(function () {
									let options = '';
									if(apariencia_value_id<=0)
									{
										options += '<option selected value="-1">Seleccionar</option>';

									}
									else
									{
										options += '<option  value="-1">Seleccionar</option>';

									}
											$.each( apariencia_data, function (key, dat) {
												if (apariencia_value_id==dat[0]) {
													options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
												}	
												else
												{
													 options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';

												}
												// console.log(dat[1]);
											//  console.log(dat[0]);
											//  antigu

											});

									return options;
								});
								
							}else{
								apariencia_select_input.append(function () {
									let options = '';
									options += '<option selected value="-1">No aplica</option>';
									return options;
								});
							}
				}
				// fin de insersion de select


				//inicio de insersion de select
				if(inmueble_select_input!=0){


							if (inmueble_data.length > 0) {
									
									inmueble_select_input.append(function () {
									let options = '';
									if(inmueble_value_id<=0)
									{
										options += '<option selected value="-1">Seleccionar</option>';

									}
									else
									{
										options += '<option  value="-1">Seleccionar</option>';

									}
											$.each( inmueble_data, function (key, dat) {
												if (inmueble_value_id==dat[0]) {
													options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
												}	
												else
												{
													 options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';

												}
												// console.log(dat[1]);
											//  console.log(dat[0]);
											//  antigu

											});

									return options;
								});
								
							}else{
								inmueble_select_input.append(function () {
									let options = '';
									options += '<option selected value="-1">No aplica</option>';
									return options;
								});
							}
				}
				// fin de insersion de select




	        },
	        error: function(res)
	        {
				alert('Error al cargar los selects...');
	            // $("#btn_aprobar").prop("disabled", false);
	        }
	    });

    }

</script>