<script type="text/javascript">
	$(function (){
	    $("#form_estudio_seccionBienesInmuebles_truper").submit(function(event) 
	    {
	        var $form = $(this);
			var urled="<?php echo $this->url->get('antecedentesocial/guardar_formato_truper/') ?>";
			a=$form.valid();
			if(a==false){
			    return false;
			}
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urled+$ese_idantecedentesocial,
				data: $("#form_estudio_seccionBienesInmuebles_truper").serialize(),
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

                            $('#link_seccion_ref_laborales_truper').trigger('click');

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

	function fnAntecedenteSocialDetalleFormatoTruper(ese_id){
		let url_enviar="<?php echo $this->url->get('antecedentesocial/ajax_get_detalle_formato_truper/') ?>";
		$ese_idantecedentesocial=ese_id;
        $.ajax({
            type: "POST",
            url: url_enviar+ese_id,
            success: function(res)
            {

                let data_ans=res.data_ans.data;
                let data_bie=res.data_bie.data;

				fnCargarTablaDatoBienInmuebleDetallesFormatoTruper(data_bie.bie_id);
				
				fnCargarTablaAutomovilDetallesFormatoTruper(data_bie.bie_id);
                $('#ans_tiempolibre-formato_truper').val(data_ans.ans_tiempolibre);  
                $('#ans_deporte-formato_truper').val(data_ans.ans_deporte);                
                $('#ans_clubsocialnombre-formato_truper').val(data_ans.ans_clubsocialnombre);                
              

                
                let ans_deportepractica =(data_ans.ans_deportepractica==null || data_ans.ans_deportepractica==-1) ?-1 :data_ans.ans_deportepractica;
                      $('#ans_deportepractica-formato_truper').val(ans_deportepractica);
                      $('#ans_deportepractica-formato_truper').trigger('change');


					

            
                let ans_clubsocial =(data_ans.ans_clubsocial==null || data_ans.ans_clubsocial==-1) ?-1 :data_ans.ans_clubsocial;
                      $('#ans_clubsocial-formato_truper').val(ans_clubsocial);
                      $('#ans_clubsocial-formato_truper').trigger('change');


			    let ans_deportefrecuencia =(data_ans.ans_deportefrecuencia==null || data_ans.ans_deportefrecuencia==-1) ?-1 :data_ans.ans_deportefrecuencia;
                      $('#ans_deportefrecuencia-formato_truper').val(ans_deportefrecuencia);
                      $('#ans_deportefrecuencia-formato_truper').trigger('change');

			    let ans_religion =(data_ans.ans_religion==null || data_ans.ans_religion==-1) ?-1 :data_ans.ans_religion;
                      $('#ans_religion-formato_truper').val(ans_religion);
                      $('#ans_religion-formato_truper').trigger('change');



                
				$('#ans_id-formato_truper').val(data_ans.ans_id);
				$('#ans_bie_id-formato_truper').val(data_bie.bie_id);	  
	  
            },
            error: function(res)
            {
            	alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.');
            }
        });
	}
</script>