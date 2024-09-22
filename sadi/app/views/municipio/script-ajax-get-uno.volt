<script  >
    function fnmunicipio_especifico(mun_id_cargado=0,input_set,est_id_cargado)
	{
	    let url_enviar="<?php echo $this->url->get('municipio/ajax_municipios/') ?>";
	  
	    $.ajax({
	        type: "POST",
	        url: url_enviar+est_id_cargado,
	          
	        success: function(data)
	        {
				if (data.length > 0) {
					//metodo find
					let mun_select =data.find(item=> item.mun_id==mun_id_cargado);
					input_set.val(mun_select.mun_nombre);

				}
	       
					
	        },
	        error: function(res)
	        {
				alert('ERROR EN EL SERVIDOR');
	        }
	    });
	}

</script>