<script>
    function tipoDeEmpleoInpust(value){
		if(value=="3"){
			$(".tie_id-temporal").slideDown("slow");
			$("#tpg_id-editar_vac_general").prop('required',true);
			$("#vac_tiempomeses-editar_vac_general").prop('required',true);
		}else{
			$(".tie_id-temporal").slideUp("slow");
			$("#tpg_id-editar_vac_general").prop('required',false);
			$("#vac_tiempomeses-editar_vac_general").prop('required',false);
		}

	}
	function fntipopago_adaptable(select_id,value_selected=-1)
	{
	    var negocio="<?php echo $this->url->get('helper/ajax_tipopagos/') ?>";
	    var $subsnegocio = $('#'+select_id);
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	        success: function(res)
	        {
				let data =res.data;
	            if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						if(value_selected=="-1" ||value_selected==null ){
						options += '<option  selected value="-1">Seleccionar</option>';

						}else{
						options += '<option   value="-1">Seleccionar</option>';

						}
						$.each(data, function (key, dat) {

							if(value_selected==dat.tpg_id){
							options += '<option selected value="' + dat.tpg_id + '">' +dat.tpg_nombre+'</option>';

							}else{
							options += '<option value="' + dat.tpg_id + '">' +dat.tpg_nombre+'</option>';

							}
						});
					    return options;
				  	});
				}else{
					$subsnegocio.append(function () {
					    var options = '';
					    options += '<option selected value="-1">No aplica</option>';
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