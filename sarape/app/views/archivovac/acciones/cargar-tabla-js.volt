<script>
     function fnCargarTablaArchivoVacSolo(vac_id=0,vista="",config={}){
        
       // reiniciarTablaArcSolos();    
        if (!config.hasOwnProperty('id_div_contenedor')) {
              config.id_div_contenedor = "dato_archivo_listado";
        }
        let url="<?php echo $this->url->get('archivovac/tabla/') ?>";
        let dataToSend={};
        dataToSend.vista=vista;
        url+=vac_id;
        $.post(url,dataToSend, function(data)
            {
            $(`#${config.id_div_contenedor}`).empty();
            $(`#${config.id_div_contenedor}`).html(data); 
            pintartabla("#td_archivos_vac");
            }).done(function(){
            }).fail(function(res){
        })

        
    }
     function reiniciarTablaArcVacSolos() {
                if ($.fn.DataTable.isDataTable('#td_archivos_vac')) {
                    tabla.clear().destroy();
                    $('#td_archivos').empty();
                }
    }
</script>