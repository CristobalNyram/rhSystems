<script>

        function load_table_rel_vac(){

            divListado = document.getElementById('listado');
            url="<?php echo $this->url->get('vacante/relacionvacante_tabla/') ?>";
            $.post(url, $(this).serialize() , function(data)
            {
            divListado.innerHTML=data;
            pintartabla("#td_vac_relacionvacante");
            }).done(function(){
            }).fail(function(){
            })
        }

 
</script>