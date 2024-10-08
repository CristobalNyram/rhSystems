
<!-- datos finales js  inicio -->
<script type="text/javascript">
	$(function (){
	    $("#form_estudio_seccionDatosFinales").submit(function(event) 
	    {
	        var $form = $(this);
			var urled="<?php echo $this->url->get('datofinal/guardar/') ?>";
			a=$form.valid();
			if(a==false){
			    return false;
			}
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urled+$ese_iddatofinal,
				data: $("#form_estudio_seccionDatosFinales").serialize(),
				success: function(res)
				{
					if(res[0]<=0)
					{
						Swal.fire({title:'Error',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                    location.reload();  
                                                                     });
					}
					else
					{
                        Swal.fire({title:"Éxito",text:"Datos finales guardados correctamente.",type:"success"})
                          .then((value) => {
                            //acciones
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

	function fnDatosFinalesDetalle(ese_id){
		let url_enviar="<?php echo $this->url->get('datofinal/ajax_get_detalle/') ?>";
		$ese_iddatofinal=ese_id;
        $.ajax({
            type: "POST",
            url: url_enviar+ese_id,
            success: function(data)
            {
				// console.log("%cFORMATO GENERAL", "color: red; font-size: 20px;");
				let daf_calificacion=0;
				let gru_id=0;
				let cal_id=-1;

				if (data[2].length!=0) {
					gru_id=data[2].gru_id;
                }
               
                if (data[0]==0) {
                    // alertify.alert('DATOS','El cuestionario aún no tiene datos');
                }
                else
                {
                	document.getElementById("daf_notafinal").value = data[1].daf_notafinal;
					daf_calificacion=data[1].daf_calificacion;
					cal_id= validarValorFormatoLimpioOSetearValor(data[1].cal_id,-1);

                    // $('#daf_calificacion').val(data[1].daf_calificacion);
                    // $('#daf_calificacion').trigger('change');
                }
				// console.log(gru_id,daf_calificacion);
				fnGetCalificacionesFinalesByGrupo('daf_calificacion',gru_id,daf_calificacion,"Seleccionar...");
				$('#cal_id-ese_general').val(cal_id);
				
            },
            error: function(res)
            {
				Swal.fire({title:'Error',text:'No se pudieron cargar los datos vuelve a intentar de nuevo.',type:"error"})
                                                                 .then((value) => {
                                                                    location.reload();  
                                                                     });
            }
        });
	}
	$('#daf_calificacion').change(function() {
		let nuevoValor = $(this).find('option:selected').data('cal_id');
		// console.log(nuevoValor);
		
		$('#cal_id-ese_general').val(nuevoValor);
	});


</script>
<!-- datos finales js  fin -->
