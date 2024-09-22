<script  >
    function fnestado_especifico(est_id_cargado=0,input_set)
	{
	    let url_enviar="<?php echo $this->url->get('estado/ajax_estados/') ?>";
		// url_enviar= url_enviar+est_id_cargado;
	    $.ajax({
	        type: "POST",
	        url: url_enviar,
	          
	        success: function(data)
	        {
	       
				if (data.length > 0) {
					let est_select= data.find(item=>item.est_id==est_id_cargado);
					input_set.val(est_select.est_nombre);
				  
				}else{

				}
	        },
	        error: function(res)
	        {
	         alert('ERROR EN EL SERVIDOR');
	        }
	    });
	}

</script>