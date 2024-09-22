<script>
    function fnGetTodasEmpresas(select_id=0,text_select='Todos'){
		let url="<?php echo $this->url->get('empresa/ajax_empresas/') ?>";
		let $subsnegocio = $('#'+select_id);
		$subsnegocio.empty();
		$.ajax({
			type: "POST",
			url: url,
			success: function(data)
			{

			     // Agregar nuevos sub-departamentos
			if (data.length > 0) {
				$subsnegocio.append(function () {
					var options = '';
					options += '<option selected value="-1">'+text_select+'</option>';
					$.each(data, function (key, dat) {
					options += '<option data-emp_id="'+dat.emp_id+'"  value="' + dat.emp_id + '">' +dat.emp_nombre+'</option>';
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