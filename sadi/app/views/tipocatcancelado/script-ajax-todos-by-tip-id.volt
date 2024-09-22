<script>
    function fnGetTipoCatCanceladoByTipId(valor=0,tip_id=0,select_id=0,text_select='Seleccionar',tiene_select_dependiente=0){
		let url="<?php echo $this->url->get('tipocatcancelado/ajax_get_todos/') ?>";
		let $subsnegocio = $('#'+select_id);
		$subsnegocio.empty();
		$.ajax({
			type: "POST",
			url: url+"/"+tip_id+"/"+tiene_select_dependiente,
			success: function(res)
			{
			let data=res.data;

			if (data.length > 0) {
				$subsnegocio.append(function () {
					var options = '';
					var defaultSelected = '';
					var dinamicSelected = '';

					if (valor==0) {
						 defaultSelected = 'selected';

					}
					options += '<option '+defaultSelected+'  value="-1">'+text_select+'</option>';
					$.each(data, function (key, dat) {
						if (valor==dat.tcc_id) {
						  dinamicSelected = 'selected';
						}
						options += '<option ' + dinamicSelected + '  data-tcc_id="'+dat.tcc_id+'"  value="' + dat.cac_id + '">' +dat.cac_nombre+'</option>';
					});

				    return options;
			  	});
			}else{
				$subsnegocio.append(function () {
				    var options = '';
				    options += '<option selected value="-1">Sin registros</option>';
				    return options;
				});
			}
			},
			error: function(res)
			{
			   // $("#btn_aprobar").prop("disabled", false);
			}
		});
	}

</script>