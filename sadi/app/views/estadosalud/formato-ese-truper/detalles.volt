<script type="text/javascript">
	$(function (){
	    $("#form_estudio_seccionEstadoGeneralDeSalud_formato_truper").submit(function(event) 
	    {
	        var $form = $(this);
			var urled="<?php echo $this->url->get('estadosalud/guardar_ess_anss/') ?>";
			/*a=$form.valid();
			if(a==false){
			    return false;
			}*/
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urled+$ese_idestadosalud,
				data: $("#form_estudio_seccionEstadoGeneralDeSalud_formato_truper").serialize(),
				success: function(res)
				{
					
					if(res['estado']=='2')
					{
					Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
							.then((value) => {

								$('#link_seccion_datos_familiares').trigger('click');
								fnEstadoSaludDetalleFormatoTruper(res['ese_id']);
							});
					}

					if(res['estado']=='-2')
					{
						
						Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
									.then((value) => {
									location.reload();  

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

	function fnEstadoSaludDetalleFormatoTruper(ese_id){
		let url_enviar="<?php echo $this->url->get('estadosalud/ajax_get_detalle_ans_ess_formato_truper/') ?>";
		$ese_idestadosalud=ese_id;
        $.ajax({
            type: "POST",
            url: url_enviar+ese_id,
            success: function(res)
            {
			

				
                if (res['estado']=='-2') {
					alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.');

                }
                else
                {
					let data_ess=res['data_ess'];
					let data_ans=res['data_ans'];

					let ess_enfermedadcronica_pre=(data_ess.ess_enfermedadcronicapreg =='' || data_ess.ess_enfermedadcronicapreg==null?'-1':data_ess.ess_enfermedadcronicapreg );
					$('#ess_enfermedadcronicapreg-formato-truper').val(ess_enfermedadcronica_pre );
					$('#ess_enfermedadcronicapreg-formato-truper').trigger('change');
					SelectMostrarOcultarDivDeAcuerdoASiONo(ess_enfermedadcronica_pre,'ess_enfermedadcronica-coontentquestion','ess_enfermedadcronica-formato-truper');
					$('#ess_enfermedadcronica-formato-truper').val(data_ess.ess_enfermedadcronica);

					let ess_incapacidadultimoaniopreg  =(data_ess.ess_incapacidadultimoaniopreg =='' || data_ess.ess_incapacidadultimoaniopreg==null?'-1':data_ess.ess_incapacidadultimoaniopreg );
					$('#ess_incapacidadultimoaniopreg-formato-truper').val( ess_incapacidadultimoaniopreg);
					$('#ess_incapacidadultimoaniopreg-formato-truper').trigger('change');
					SelectMostrarOcultarDivDeAcuerdoASiONo(ess_incapacidadultimoaniopreg,'ess_incapacidadultimoanio-coontentquestion','ess_incapacidadultimoanio-formato-truper')
					$('#ess_incapacidadultimoanio-formato-truper').val(data_ess.ess_incapacidadultimoanio);


					let ess_famconenfermedadcronicapreg  =(data_ess.ess_famconenfermedadcronicapreg =='' || data_ess.ess_famconenfermedadcronicapreg==null?'-1':data_ess.ess_famconenfermedadcronicapreg );
					$('#ess_famconenfermedadcronicapreg-formato-truper').val(ess_famconenfermedadcronicapreg);
					$('#ess_famconenfermedadcronicapreg-formato-truper').trigger('change');
					$('#ess_famconenfermedadcronica-formato-truper').val(data_ess.ess_famconenfermedadcronica);
					SelectMostrarOcultarDivDeAcuerdoASiONo(ess_famconenfermedadcronicapreg,'ess_famconenfermedadcronica-coontentquestion','ess_famconenfermedadcronica-formato-truper');
					

					let ess_intervencionquirurgicapreg =(data_ess.ess_intervencionquirurgicapreg =='' || data_ess.ess_intervencionquirurgicapreg==null?'-1':data_ess.ess_intervencionquirurgicapreg );
					$('#ess_intervencionquirurgicapreg-formato-truper').val(ess_intervencionquirurgicapreg);
					$('#ess_intervencionquirurgicapreg-formato-truper').trigger('change');
					SelectMostrarOcultarDivDeAcuerdoASiONo(ess_intervencionquirurgicapreg,'ess_intervencionquirurgicapreg-coontentquestion','ess_intervencionquirurgica-formato-truper')
					$('#ess_intervencionquirurgica-formato-truper').val(data_ess.ess_intervencionquirurgica);

					
					
					$('#ess_estatura-formato-truper').val(data_ess.ess_estatura);
					
					$('#ess_peso-formato-truper').val(data_ess.ess_peso);


					$('#ess_avisar-formato-truper').val(data_ess.ess_avisar);
					$('#ess_telefono-formato-truper').val(data_ess.ess_telefono);
					$('#ess_parentesco-formato-truper').val(data_ess.ess_parentesco);



					
					$('#ans_bebida-formato-truper').val( (data_ans.ans_bebida =='' || data_ans.ans_bebida==null?'-1':data_ans.ans_bebida ));
					$('#ans_bebida-formato-truper').trigger('change');
					$('#ans_droga-formato-truper').val( (data_ans.ans_droga =='' || data_ans.ans_droga==null?'-1':data_ans.ans_droga ));
					$('#ans_droga-formato-truper').trigger('change');
					$('#ans_fumar-formato-truper').val( (data_ans.ans_fumar =='' || data_ans.ans_fumar==null?'-1':data_ans.ans_fumar ));
					$('#ans_fumar-formato-truper').trigger('change');



					/*$('#ess_direccion').val(data_ess.ess_incapacidadultimoanio);
					$('#ess_direccion').val(data_ess.ess_incapacidadultimoanio);
*/
					
					

					
                }
            },
            error: function(res)
            {
            	alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.');
            }
        });
	}
</script>