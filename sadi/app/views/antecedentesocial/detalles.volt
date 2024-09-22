<script type="text/javascript">
	$(function (){
	    $("#form_estudio_seccionAntecedenteSocial").submit(function(event) 
	    {
	        var $form = $(this);
			var urled="<?php echo $this->url->get('antecedentesocial/guardar/') ?>";
			a=$form.valid();
			if(a==false){
			    return false;
			}
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urled+$ese_idantecedentesocial,
				data: $("#form_estudio_seccionAntecedenteSocial").serialize(),
				success: function(res)
				{
					if(res[0]<=0)
					{
						alertify.alert("Error",res[1]);
					}
					else
					{
                        Swal.fire({title:"Éxito",text:"Antecedentes Sociales guardados correctamente.",type:"success"})
                          .then((value) => {

                            $('#contact-tab-md-4').trigger('click');

                          });
					}
					$form.find("button").prop("disabled", false); 
				},
				error: function(res)
				{ 
					$form.find("button").prop("disabled", false); 
				}
			});
			return false;
	    });
    });

	function fnAntecedenteSocialDetalle(ese_id){
		let url_enviar="<?php echo $this->url->get('antecedentesocial/ajax_get_detalle/') ?>";
		$ese_idantecedentesocial=ese_id;
        $.ajax({
            type: "POST",
            url: url_enviar+ese_id,
            success: function(data)
            {
                if (data[0]==0) {
                }
                else
                {
                	document.getElementById("ans_tiempolibre").value = data[1].ans_tiempolibre;
                    $('#ans_clubdeportivo').val(data[1].ans_clubdeportivo);
                    $('#ans_clubdeportivo').trigger('change');
                	document.getElementById("ans_deporte").value = data[1].ans_deporte;

                    $('#ans_puestosindical').val(data[1].ans_puestosindical);
                    $('#ans_puestosindical').trigger('change');
                    document.getElementById("ans_puestonombre").value = data[1].ans_puestonombre;
                    document.getElementById("ans_puestocargo").value = data[1].ans_puestocargo;

                    $('#ans_politico').val(data[1].ans_politico);
                    $('#ans_politico').trigger('change');
                    document.getElementById("ans_politiconombre").value = data[1].ans_politiconombre;
                    document.getElementById("ans_politicocargo").value = data[1].ans_politicocargo;

                    document.getElementById("ans_religion").value = data[1].ans_religion;
                    document.getElementById("ans_religionfrecuencia").value = data[1].ans_religionfrecuencia;

                    document.getElementById("ans_cortoplazo").value = data[1].ans_cortoplazo;
                    document.getElementById("ans_medianoplazo").value = data[1].ans_medianoplazo;
                    document.getElementById("ans_largoplazo").value = data[1].ans_largoplazo;

                    $('#ans_bebida').val(data[1].ans_bebida);
                    $('#ans_bebida').trigger('change');
                    document.getElementById("ans_bebidafrecuencia").value = data[1].ans_bebidafrecuencia;

                    $('#ans_fumar').val(data[1].ans_fumar);
                    $('#ans_fumar').trigger('change');
                    document.getElementById("ans_fumarfrecuencia").value = data[1].ans_fumarfrecuencia;

                    document.getElementById("ans_nota").value = data[1].ans_nota;

                    $('#ans_calificacion').val(data[1].ans_calificacion);
                    $('#ans_calificacion').trigger('change');
                }
            },
            error: function(res)
            {
            	alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.');
            }
        });
	}
</script>