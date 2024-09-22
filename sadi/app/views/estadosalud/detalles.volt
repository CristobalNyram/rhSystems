<script type="text/javascript">
	$(function (){
	    $("#form_estudio_seccionEstadoGeneralDeSalud").submit(function(event) 
	    {
	        var $form = $(this);
			var urled="<?php echo $this->url->get('estadosalud/guardar/') ?>";
			a=$form.valid();
			if(a==false){
			    return false;
			}
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urled+$ese_idestadosalud,
				data: $("#form_estudio_seccionEstadoGeneralDeSalud").serialize(),
				success: function(res)
				{
					if(res[0]<=0)
					{
						alertify.alert("Error",res[1]);
					}
					else
					{
                        Swal.fire({title:"Éxito",text:"Antecedentes de Salud guardados correctamente.",type:"success"})
                          .then((value) => {
                            $('#contact-tab-md-5').trigger('click');
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

	function fnEstadoSaludDetalle(ese_id){
		let url_enviar="<?php echo $this->url->get('estadosalud/ajax_get_detalle/') ?>";
		$ese_idestadosalud=ese_id;
        $.ajax({
            type: "POST",
            url: url_enviar+ese_id,
            success: function(data)
            {
                if (data[0]==0) {
                }
                else
                {
                	
                    document.getElementById("ess_fechaexamenmedico").value = data[1].ess_fechaexamenmedico;
                    document.getElementById("ess_estadosalud").value = data[1].ess_estadosalud;

                    document.getElementById("ess_enfermedadcronica").value = data[1].ess_enfermedadcronica;
                    document.getElementById("ess_medicamento").value = data[1].ess_medicamento;

                    document.getElementById("ess_intervencionquirurgica").value = data[1].ess_intervencionquirurgica;
                    document.getElementById("ess_alergia").value = data[1].ess_alergia;
                    document.getElementById("ess_tiposangre").value = data[1].ess_tiposangre;

                    document.getElementById("ess_estatura").value = data[1].ess_estatura;
                    document.getElementById("ess_peso").value = data[1].ess_peso;
                    document.getElementById("ess_avisar").value = data[1].ess_avisar;
                    document.getElementById("ess_telefono").value = data[1].ess_telefono;
                    document.getElementById("ess_direccion").value = data[1].ess_direccion;
                    document.getElementById("ess_parentesco").value = data[1].ess_parentesco;

                    document.getElementById("ess_nota").value = data[1].ess_nota;

                    $('#ess_calificacion').val(data[1].ess_calificacion);
                    $('#ess_calificacion').trigger('change');
                }
            },
            error: function(res)
            {
            	alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.');
            }
        });
	}
</script>