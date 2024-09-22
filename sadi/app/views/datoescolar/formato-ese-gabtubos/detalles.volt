<script type="text/javascript">
	$(function (){
	    $("#form_estudio_seccionDatosEscolares_formato_gabtubos").submit(function(event) 
	    {
	        var $form = $(this);
			var urled="<?php echo $this->url->get('datoescolar/guardar_formato_gabtubos/') ?>";
			a=$form.valid();
			if(a==false){
			    return false;
			}
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urled+$ese_iddatoescolar,
				data: $("#form_estudio_seccionDatosEscolares_formato_gabtubos").serialize(),
				success: function(res)
				{
					if(res[0]<=0)
					{
                        Swal.fire({title:'ERROR',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                    // location.reload();  
                                                                     });
					}
					else
					{
                        Swal.fire({title:"Éxito",text:"Datos escolares guardados correctamente.",type:"success"})
                          .then((value) => {
                            $('#link_seccion_dato_grupo_familiar_formato_gabtubos').trigger('click');

                            // $('#contact-tab-md-3').trigger('click');

                          });
					}
					$form.find("button").prop("disabled", false); 
				},
				error: function(res)
				{ 
                    alert('Error en el servidor...');
					$form.find("button").prop("disabled", false); 
				}
			});
			return false;
	    });
    });

	function fnDatosEscolaresDetalle_formato_gabtubos(ese_id){
		let url_enviar="<?php echo $this->url->get('datoescolar/ajax_get_detalle/') ?>";
		$ese_iddatoescolar=ese_id;
        $.ajax({
            type: "POST",
            url: url_enviar+ese_id,
            success: function(data)
            {
                if (data[0]==0) {
                   // console.log(data);

                }
                else
                {
                    // console.log(data);
                   
                    document.getElementById("dae_primariaperiodo_formato_gabtubos").value = data[1].dae_primariaperiodo;
                	document.getElementById("dae_primariaescuela_formato_gabtubos").value = data[1].dae_primariaescuela;
                    $('#dae_primariacertificado_formato_gabtubos').val(data[1].dae_primariacertificado);
                    $('#dae_primariacertificado_formato_gabtubos').trigger('change');
                	document.getElementById("dae_primariapromedio_formato_gabtubos").value = data[1].dae_primariapromedio;
                	
                    document.getElementById("dae_secundariaperiodo_formato_gabtubos").value = data[1].dae_secundariaperiodo;
                	document.getElementById("dae_secundariaescuela_formato_gabtubos").value = data[1].dae_secundariaescuela;
                    $('#dae_secundariacertificado_formato_gabtubos').val(data[1].dae_secundariacertificado);
                    $('#dae_secundariacertificado_formato_gabtubos').trigger('change');
                	document.getElementById("dae_secundariapromedio_formato_gabtubos").value = data[1].dae_secundariapromedio;
                	
                    document.getElementById("dae_comercialperiodo_formato_gabtubos").value = data[1].dae_comercialperiodo;
                	document.getElementById("dae_comercialescuela_formato_gabtubos").value = data[1].dae_comercialescuela;
                    $('#dae_comercialcertificado_formato_gabtubos').val(data[1].dae_comercialcertificado);
                    $('#dae_comercialcertificado_formato_gabtubos').trigger('change');
                	document.getElementById("dae_comercialpromedio_formato_gabtubos").value = data[1].dae_comercialpromedio;


                    document.getElementById("dae_preparatoriaperiodo_formato_gabtubos").value = data[1].dae_preparatoriaperiodo;
                    document.getElementById("dae_preparatoriaescuela_formato_gabtubos").value = data[1].dae_preparatoriaescuela;
                    $('#dae_preparatoriacertificado_formato_gabtubos').val(data[1].dae_preparatoriacertificado);
                    $('#dae_preparatoriacertificado_formato_gabtubos').trigger('change');
                    document.getElementById("dae_preparatoriapromedio_formato_gabtubos").value = data[1].dae_preparatoriapromedio;
                  
                    document.getElementById("dae_licenciaturaperiodo_formato_gabtubos").value = data[1].dae_licenciaturaperiodo;
                    document.getElementById("dae_licenciaturaescuela_formato_gabtubos").value = data[1].dae_licenciaturaescuela;
                    $('#dae_licenciaturacertificado_formato_gabtubos').val(data[1].dae_licenciaturacertificado);
                    $('#dae_licenciaturacertificado_formato_gabtubos').trigger('change');
                    document.getElementById("dae_licenciaturapromedio_formato_gabtubos").value = data[1].dae_licenciaturapromedio;
 
                    document.getElementById("dae_cedulaperiodo_formato_gabtubos").value = data[1].dae_cedulaperiodo;
                    document.getElementById("dae_cedulaescuela_formato_gabtubos").value = data[1].dae_cedulaescuela;
                    $('#dae_cedulacertificado_formato_gabtubos').val(data[1].dae_cedulacertificado);
                    $('#dae_cedulacertificado_formato_gabtubos').trigger('change');
                    document.getElementById("dae_cedulapromedio_formato_gabtubos").value = data[1].dae_cedulapromedio;

                    document.getElementById("dae_otroperiodo_formato_gabtubos").value = data[1].dae_otroperiodo;
                    document.getElementById("dae_otroescuela_formato_gabtubos").value = data[1].dae_otroescuela;
                    $('#dae_otrocertificado_formato_gabtubos').val(data[1].dae_otrocertificado);
                    $('#dae_otrocertificado_formato_gabtubos').trigger('change');
                    document.getElementById("dae_otropromedio_formato_gabtubos").value = data[1].dae_otropromedio;

                    document.getElementById("dae_actualperiodo_formato_gabtubos").value = data[1].dae_actualperiodo;
                    document.getElementById("dae_actualescuela_formato_gabtubos").value = data[1].dae_actualescuela;
                    $('#dae_actualcertificado_formato_gabtubos').val(data[1].dae_actualcertificado);
                    $('#dae_actualcertificado_formato_gabtubos').trigger('change');
                    document.getElementById("dae_actualpromedio_formato_gabtubos").value = data[1].dae_actualpromedio;

                    document.getElementById("dae_periodoinactivo_formato_gabtubos").value = data[1].dae_periodoinactivo;
                    document.getElementById("dae_motivo_formato_gabtubos").value = data[1].dae_motivo;
                    document.getElementById("dae_notas_formato_gabtubos").value = data[1].dae_notas;

                    $('#dae_calificacion_formato_gabtubos').val(data[1].dae_calificacion);
                    $('#dae_calificacion_formato_gabtubos').trigger('change');
                    
                }
            },
            error: function(res)
            {
                Swal.fire({title:'ERROR',text:'No se pudieron cargar los datos, vuelve a intentar de nuevo.',type:"error"})
                                                                 .then((value) => {
                                                                    // location.reload();  
                                                                     });
            }
        });
	}
</script>