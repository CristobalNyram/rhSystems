<script type="text/javascript">
	$(function (){
	    $("#form_estudio_seccionDatosEscolares").submit(function(event) 
	    {

            event.preventDefault();
          
	        var $form = $(this);
			var urled="<?php echo $this->url->get('datoescolar/guardar/') ?>";
			a=$form.valid();
			if(a==false){
			    return false;
			}
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urled+$ese_iddatoescolar,
				data: $("#form_estudio_seccionDatosEscolares").serialize(),
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
                            $('#contact-tab-md-3').trigger('click');

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

	function fnDatosEscolaresDetalle(ese_id){
		let url_enviar="<?php echo $this->url->get('datoescolar/ajax_get_detalle/') ?>";
		$ese_iddatoescolar=ese_id;
        $.ajax({
            type: "POST",
            url: url_enviar+ese_id,
            success: function(data)
            {
                if (data[0]==0) {
                }
                else
                {
                	document.getElementById("dae_primariaperiodo").value = data[1].dae_primariaperiodo;
                	document.getElementById("dae_primariaescuela").value = data[1].dae_primariaescuela;
                    $('#dae_primariacertificado').val(data[1].dae_primariacertificado);
                    $('#dae_primariacertificado').trigger('change');
                	document.getElementById("dae_primariapromedio").value = data[1].dae_primariapromedio;
                	
                    document.getElementById("dae_secundariaperiodo").value = data[1].dae_secundariaperiodo;
                	document.getElementById("dae_secundariaescuela").value = data[1].dae_secundariaescuela;
                    $('#dae_secundariacertificado').val(data[1].dae_secundariacertificado);
                    $('#dae_secundariacertificado').trigger('change');
                	document.getElementById("dae_secundariapromedio").value = data[1].dae_secundariapromedio;
                	
                    document.getElementById("dae_comercialperiodo").value = data[1].dae_comercialperiodo;
                	document.getElementById("dae_comercialescuela").value = data[1].dae_comercialescuela;
                    $('#dae_comercialcertificado').val(data[1].dae_comercialcertificado);
                    $('#dae_comercialcertificado').trigger('change');
                	document.getElementById("dae_comercialpromedio").value = data[1].dae_comercialpromedio;


                    document.getElementById("dae_preparatoriaperiodo").value = data[1].dae_preparatoriaperiodo;
                    document.getElementById("dae_preparatoriaescuela").value = data[1].dae_preparatoriaescuela;
                    $('#dae_preparatoriacertificado').val(data[1].dae_preparatoriacertificado);
                    $('#dae_preparatoriacertificado').trigger('change');
                    document.getElementById("dae_preparatoriapromedio").value = data[1].dae_preparatoriapromedio;
                  
                    document.getElementById("dae_licenciaturaperiodo").value = data[1].dae_licenciaturaperiodo;
                    document.getElementById("dae_licenciaturaescuela").value = data[1].dae_licenciaturaescuela;
                    $('#dae_licenciaturacertificado').val(data[1].dae_licenciaturacertificado);
                    $('#dae_licenciaturacertificado').trigger('change');
                    document.getElementById("dae_licenciaturapromedio").value = data[1].dae_licenciaturapromedio;

                    document.getElementById("dae_cedulaperiodo").value = data[1].dae_cedulaperiodo;
                    document.getElementById("dae_cedulaescuela").value = data[1].dae_cedulaescuela;
                    $('#dae_cedulacertificado').val(data[1].dae_cedulacertificado);
                    $('#dae_cedulacertificado').trigger('change');
                    document.getElementById("dae_cedulapromedio").value = data[1].dae_cedulapromedio;

                    document.getElementById("dae_otroperiodo").value = data[1].dae_otroperiodo;
                    document.getElementById("dae_otroescuela").value = data[1].dae_otroescuela;
                    $('#dae_otrocertificado').val(data[1].dae_otrocertificado);
                    $('#dae_otrocertificado').trigger('change');
                    document.getElementById("dae_otropromedio").value = data[1].dae_otropromedio;

                    document.getElementById("dae_actualperiodo").value = data[1].dae_actualperiodo;
                    document.getElementById("dae_actualescuela").value = data[1].dae_actualescuela;
                    $('#dae_actualcertificado').val(data[1].dae_actualcertificado);
                    $('#dae_actualcertificado').trigger('change');
                    document.getElementById("dae_actualpromedio").value = data[1].dae_actualpromedio;

                    document.getElementById("dae_periodoinactivo").value = data[1].dae_periodoinactivo;
                    document.getElementById("dae_motivo").value = data[1].dae_motivo;
                    document.getElementById("dae_notas").value = data[1].dae_notas;

                    $('#dae_calificacion').val(data[1].dae_calificacion);
                    $('#dae_calificacion').trigger('change');
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