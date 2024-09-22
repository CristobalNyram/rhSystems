<script>
    function fnCargarTablaGeneralRVE(vac_id=0,config={}){
        if (!config.hasOwnProperty('id_div_contenedor')) {
            config.id_div_contenedor = "rve_eje_tabla-listado";
        }
        let url="<?php echo $this->url->get('relvacanteejecutivo/general_tabla/') ?>";
        let dataToSend={};
        url+=vac_id;
        $.post(url,dataToSend, function(data)
        {
            $(`#${config.id_div_contenedor}`).empty();
            $(`#${config.id_div_contenedor}`).html(data);
            pintartabla("#td_rve_general");
            }).done(function(){
            }).fail(function(res){
        })
    }
  
</script>

{% include "/relvacanteejecutivo/acciones/rve-eliminar-js.volt" %}
