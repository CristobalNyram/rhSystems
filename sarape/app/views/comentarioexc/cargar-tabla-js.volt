<script>
    function fnCargarTablaComentarioSolo(exc_id=0,vista="",config={}){
        if (!config.hasOwnProperty('id_div_contenedor')) {
            config.id_div_contenedor = "dato_archivo_listado";
        }
        let url="<?php echo $this->url->get('comentarioexc/tabla_seguimiento/') ?>";
        let dataToSend={};
        dataToSend.vista=vista;
        url+=exc_id;
        $.post(url,dataToSend, function(data)
        {
            $(`#${config.id_div_contenedor}`).empty();
            $(`#${config.id_div_contenedor}`).html(data);
            pintartabla("#td_comentariosseguimiento");
            }).done(function(){
            }).fail(function(res){
        })
    }
    function reiniciarTablaArcSolos() {
        if ($.fn.DataTable.isDataTable('#td_archivos')) {
            tabla.clear().destroy();
            $('#td_archivos').empty();
        }
    }
</script>