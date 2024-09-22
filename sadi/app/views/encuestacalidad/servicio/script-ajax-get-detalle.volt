<script>

    function fnGetDatosDetalleEncuestaServicioCalidad(ese_id=0){
        let url_enviar="<?php echo $this->url->get('encuestacalidad/ajax_get_detalle/') ?>";
                
                $.ajax({
                        type: "POST",
                        url: url_enviar+ese_id,
                            
                        success: function(res)
                        {



                        },
                        error: function(data)
                        {
                            alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
                            
                        }
                });
    }

</script>