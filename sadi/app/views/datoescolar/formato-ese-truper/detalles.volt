{% include "/datoescolar/formato-ese-truper/script-ajax-select-dinamicos.volt" %}

<script type="text/javascript">
	$(function (){
	    $("#form_estudio_seccionDatosEscolares_formato_ese_truper").submit(function(event) 
	    {
	        var $form = $(this);
			var urled="<?php echo $this->url->get('datoescolar/guardar_formato_truper/') ?>";
			a=$form.valid();
			if(a==false){
			    return false;
			}
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urled+$ese_iddatoescolar,
				data: $("#form_estudio_seccionDatosEscolares_formato_ese_truper").serialize(),
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
                            $('#link_seccion_datos_medicos_truper').trigger('click');

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

	function fnDatosEscolaresDetalle_formato_truper(ese_id){
		let url_enviar="<?php echo $this->url->get('datoescolar/ajax_get_detalle/') ?>";
		$ese_iddatoescolar=ese_id;
        $.ajax({
            type: "POST",
            url: url_enviar+ese_id,
            success: function(data)
            {
                $('#dae_ese_id_truper').val(ese_id);
                if (data[0]==0) {
                   // console.log(data);
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=0,$('#dae_primariadocrecibido_formato_ese_truper'));
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=0,$('#dae_secundariadocrecibido_formato_ese_truper'));
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=0,$('#dae_carreratecnicadocrecibido_formato_ese_truper'));
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=0,$('#dae_preparatoriadocrecibido_formato_ese_truper'));
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=0,$('#dae_licenciaturadocrecibido_formato_ese_truper'));
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=0,$('#dae_otrodocrecibido_formato_ese_truper'));
                  
                }
                else
                {
                    // console.log(data);

                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=data[1].dae_primariadocrecibido,$('#dae_primariadocrecibido_formato_ese_truper'));
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=data[1].dae_secundariadocrecibido,$('#dae_secundariadocrecibido_formato_ese_truper'));
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=data[1].dae_carretecnicadocrecibido,$('#dae_carreratecnicadocrecibido_formato_ese_truper'));
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=data[1].dae_preparatoriadocrecibido,$('#dae_preparatoriadocrecibido_formato_ese_truper'));
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=data[1].dae_licenciaturadocrecibido,$('#dae_licenciaturadocrecibido_formato_ese_truper'));
                   fngetDataSelectsDinamicosDatosDocumentosRecibidos(value_id=data[1].dae_otrodocrecibido,$('#dae_otrodocrecibido_formato_ese_truper'));

                    document.getElementById("dae_primariaperiodo_formato_ese_truper").value = data[1].dae_primariaperiodo;
                    document.getElementById("dae_primariaescuela_formato_ese_truper").value = data[1].dae_primariaescuela;
                    // document.getElementById("dae_primariadocrecibido_formato_ese_truper").value = data[1].dae_primariadocrecibido;
                    document.getElementById("dae_primariapromedio_formato_ese_truper").value = data[1].dae_primariapromedio;
                    document.getElementById("dae_primariaentidad_formato_ese_truper").value = data[1].dae_primariaentidad;


                    document.getElementById("dae_secundariaperiodo_formato_ese_truper").value = data[1].dae_secundariaperiodo;
                    document.getElementById("dae_secundariaescuela_formato_ese_truper").value = data[1].dae_secundariaescuela;
                    // document.getElementById("dae_secundariadocrecibido_formato_ese_truper").value = data[1].dae_secundariadocrecibido;
                    document.getElementById("dae_secundariapromedio_formato_ese_truper").value = data[1].dae_secundariapromedio;
                    document.getElementById("dae_secundariaentidad_formato_ese_truper").value = data[1].dae_secundariaentidad;


                    document.getElementById("dae_carreratecnicaperiodo_formato_ese_truper").value = data[1].dae_carreratecnicaperiodo;
                    document.getElementById("dae_carreratecnicaescuela_formato_ese_truper").value = data[1].dae_carreratecnicaescuela;
                    // document.getElementById("dae_carreratecnicadocrecibido_formato_ese_truper").value = data[1].dae_carreratecnicadocrecibido;
                    document.getElementById("dae_carreratecnicapromedio_formato_ese_truper").value = data[1].dae_carreratecnicapromedio;
                    document.getElementById("dae_carreratecnicaentidad_formato_ese_truper").value = data[1].dae_carreratecnicaentidad;
                    document.getElementById("dae_carreratecnicaen_formato_ese_truper").value = data[1].dae_carreratecnicaen;
                 

                    document.getElementById("dae_preparatoriaperiodo_formato_ese_truper").value = data[1].dae_preparatoriaperiodo;
                    document.getElementById("dae_preparatoriaescuela_formato_ese_truper").value = data[1].dae_preparatoriaescuela;
                    // document.getElementById("dae_preparatoriadocrecibido_formato_ese_truper").value = data[1].dae_preparatoriadocrecibido;
                    document.getElementById("dae_preparatoriapromedio_formato_ese_truper").value = data[1].dae_preparatoriapromedio;
                    document.getElementById("dae_preparatoriaentidad_formato_ese_truper").value = data[1].dae_preparatoriaentidad;
                    document.getElementById("dae_preparatoriaen_formato_ese_truper").value = data[1].dae_preparatoriaen;


                    document.getElementById("dae_licenciaturaperiodo_formato_ese_truper").value = data[1].dae_licenciaturaperiodo;
                    document.getElementById("dae_licenciaturaescuela_formato_ese_truper").value = data[1].dae_licenciaturaescuela;
                    // document.getElementById("dae_licenciaturadocrecibido_formato_ese_truper").value = data[1].dae_licenciaturadocrecibido;
                    document.getElementById("dae_licenciaturapromedio_formato_ese_truper").value = data[1].dae_licenciaturapromedio;
                    document.getElementById("dae_licenciaturaentidad_formato_ese_truper").value = data[1].dae_licenciaturaentidad;
                    document.getElementById("dae_licenciaturaen_formato_ese_truper").value = data[1].dae_licenciaturaen;

                    document.getElementById("dae_otroperiodo_formato_ese_truper").value = data[1].dae_otroperiodo;
                    document.getElementById("dae_otroescuela_formato_ese_truper").value = data[1].dae_otroescuela;
                    // document.getElementById("dae_otrodocrecibido_formato_ese_truper").value = data[1].dae_otrodocrecibido;
                    document.getElementById("dae_otropromedio_formato_ese_truper").value = data[1].dae_otropromedio;
                    document.getElementById("dae_otroentidad_formato_ese_truper").value = data[1].dae_otroentidad;
                    document.getElementById("dae_otroen_formato_ese_truper").value = data[1].dae_otroen;
          

                	// document.getElementById("dae_primariaescuela_formato_truper").value = data[1].dae_primariaescuela;
                	

                    
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